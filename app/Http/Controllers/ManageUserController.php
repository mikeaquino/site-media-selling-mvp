<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserProfile;
use Auth;
use Session;

class ManageUserController extends Controller
{
	public function displaysettings()
	{
		$userEmail = Auth::user()->email;
		$profile = UserProfile::GetEmail($userEmail)->first();
		
		return view('account.account-settings', [
			'profile' => $profile
		]);
	}

	public function save()
	{
		request()->validate([
			'fname' => 'required',
			'lname' => 'required',
			'description' => 'required'
		]);

		$userEmail = Auth::user()->email;
		$profile = UserProfile::GetEmail($userEmail)->first();

		if (!empty($profile)) {
			$profile->update([
				'user_firstname' => request()->fname,
				'user_lastname' => request()->lname,
				'user_description' => request()->description
			]);
		} else {
			UserProfile::create([
				'user_email' => $userEmail,
				'user_firstname' => request()->fname,
				'user_lastname' => request()->lname,
				'user_description' => request()->description
			]);
		}

		return back()->with('success', 'Profile edited!');
	}

	public function deleteform()
	{
		return view('account.confirm-delete');
	}

	public function delete()
	{
		if (Auth::user()->email != request()->email) {
			return back()->with('message', 'Invalid email. Sorry, we cannot continue to deletion of your account.');
		} else {
			User::where('email', request()->email)->update([
				'status' => 3
			]);
			return $this->logout();
		}
	}

	public function logout()
	{
		Auth::logout();
		Session::flush();
		return redirect('/');
	}
}
