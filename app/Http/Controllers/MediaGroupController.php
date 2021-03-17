<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MediaGroup;
use Auth;

class MediaGroupController extends Controller
{
	public function create()
	{
		request()->validate([
			'groupname' => 'required',
			'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240'
		]);

		$imageName = time() . '-' . request()->image->getClientOriginalName();
		request()->image->move('images', $imageName);

		MediaGroup::create([
			'user_email' => Auth::user()->email,
			'group_id' => rand(1000, 9999),
			'group_name' => request()->groupname,
			'groupname_url' => strtolower(str_replace(' ', '-', request()->groupname)),
			'image_thumbnail' => $imageName
		]);

		return back()->with('success', 'Successfully created!');
	}

	public function displayall()
	{
		if (Auth::check()) {
			$userStatus = Auth::user()->status;

			switch ($userStatus) {
				case 1:
				//return view('email.inputotp');
				return $this->fetchMgroup();
				break;

				case 2:
				return $this->fetchMgroup();
				break;

				case 3:
				return back()->with('warning', 'The email is already existing and tagged as deactivated with our records.');
				break;
				
				default:
				return 'Not found!';
				break;
			}
		}
		return $this->fetchMgroup();
	}

	public function display()
	{
		$userEmail = Auth::user()->email;
		$mediaGroups = MediaGroup::MediaGroupOwner($userEmail)->latest()->get();

		return view('account.media-group', [
			'mediaGroups' => $mediaGroups
		]);
	}

	public function fetchMgroup()
	{
		$mediaGroups = MediaGroup::latest()->get();

		return view('media-group', [
			'mediaGroups' => $mediaGroups
		]);
	}
}
