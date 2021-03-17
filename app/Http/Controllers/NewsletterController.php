<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NewsletterUsers;

class NewsletterController extends Controller
{
	public function signup()
	{
		$message = '';
		$user = NewsletterUsers::where('newsletter_email', request()->newsletter_email)->first();
		
		if (!$user) {
			$message = 'Email registered!';
			NewsletterUsers::create(request()->validate([
				'newsletter_email' => 'required|min:5|email'
			]));
		} else {
			$message = 'The email is already registered!';
		}
		return back()->with('message', $message);
	}
}
