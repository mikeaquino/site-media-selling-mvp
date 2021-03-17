<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MediaList;
use Intervention\Image\ImageManagerStatic as Image;
use Session;

class MediaController extends Controller
{
	public function display($mediaslug, $mediaid)
	{
		$mediaIdentifier = Session::get('media-identifier');
		if ($mediaIdentifier == 'show') {
			return $this->show($mediaid);
		} else {
			$groupId = $mediaid;
			$media = MediaList::MediaGroupId($groupId)->latest()->get();

			return view('account.all-media', [
				'groupId' => $groupId,
				'media' => $media
			]);
		}
	}

	public function redirect()
	{
		return back();
	}

	public function filtermedia()
	{
		$mediaFilter = request()->filter_media;
		$media = null;

		if ($mediaFilter == 'oldest') {
			$media = MediaList::oldest()->get();
		} elseif ($mediaFilter == 'lowtohigh') {
			$media = MediaList::Ascending()->get();
		} elseif ($mediaFilter == 'hightolow') {
			$media = MediaList::Descending()->get();
		} else {
			$media = MediaList::latest()->get();
		}

		return view('account.filter-media', [
			'media' => $media
		]);
	}

	public function uploadmform($groupId)
	{
		return view('account.upload-media', [
			'groupId' => $groupId
		]);
	}

	public function uploadmedia($groupId)
	{
		request()->validate([
			'media_name' => 'required',
			'media_description' => 'required',
			'media' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240|dimensions:min_width=500,min_height=500',
			'media_thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
			'typeof_media' => 'required'
		]);

		$nameofMedia = MediaList::where('media_name', request()->media_name)->first();
		if ($nameofMedia) {
			$message = 'The name/title of media that you are trying to input is already existing.';
			return back()->with('warning', $message);
		}

		$fileSize = request()->file('media')->getSize();

		$media = time() . '-' . request()->media->getClientOriginalName();
		request()->media->move('images/originalMedia', $media);

		Image::make('images/originalMedia/' . $media)->resize(500, 500)->save('images/assets/' . $media);

		$mediaThumbnail = time() . '-' . request()->media_thumbnail->getClientOriginalName();
		request()->media_thumbnail->move('images/originalMedia', $mediaThumbnail);

		MediaList::create([
			'mediagroup_id' => $groupId,
			'media_name' => request()->media_name,
			'medianame_url' => strtolower(str_replace(' ', '-', request()->media_name)),
			'media_description' => request()->media_description,
			'media' => $media,
			'media_thumbnail' => $mediaThumbnail,
			'typeof_media' => request()->typeof_media,
			'media_filesize' => $fileSize
		]);

		return redirect('/all-media/' . $groupId);
	}

	public function show($id)
	{
		$media = MediaList::findOrFail($id);
		Session::put('mediafile-id', $media->id);
		
		return view('account.show-media', [
			'media' => $media
		]);
	}
}
