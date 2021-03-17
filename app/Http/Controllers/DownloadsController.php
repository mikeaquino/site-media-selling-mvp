<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MediaList;

class DownloadsController extends Controller
{
	public function download($mediafileid)
	{
		$media = MediaList::findOrFail($mediafileid);
		$fileName = $media->media;
		$filePath = public_path('images/originalMedia/' . $fileName);
		return response()->download($filePath);
	}
}
