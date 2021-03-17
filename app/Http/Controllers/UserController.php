<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Auth;
use Session;

class UserController extends Controller
{
	public function displaysform()
	{
		if (Session::has('remember-email') && Session::has('remember-pass')) {
			$email = Session::get('remember-email');
			$password = Session::get('remember-pass');
			return view('signup')->with('remember-email', $email)->with('remember-pass', $password);
		} else {
			return view('signup');
		}
	}

	public function register()
	{
		request()->validate([
			'email' => 'required|min:5|email',
			'pass' => 'required',
			'cpassword' => 'required|same:pass'
		]);

		if (User::where('email', request()->email)->exists()) {
			$message = 'The email has already been taken.';
			return back()->with('message', $message);
		} else {
			User::create([
				'email' => request()->email,
				'password' => Hash::make(request()->pass),
				'otp' => Str::random(15)
			]);
			return $this->autoLogin(request()->email, request()->pass);
		}
	}

	public function login()
	{
		return $this->autoLogin(request()->email, request()->pass);
	}

	public function autoLogin($email, $password)
	{
		request()->validate([
			'email' => 'required',
			'pass' => 'required'
		]);

		$userData = array(
			'email' => $email,
			'password' => $password
		);

		if (Auth::attempt($userData)) {
			return redirect('/all-media-groups');
		} else {
			Session::put('remember-email', request()->email);
			Session::put('remember-pass', request()->pass);
			return back()->with('message', 'These credentials do not match our records, ');
		}
	}
}
