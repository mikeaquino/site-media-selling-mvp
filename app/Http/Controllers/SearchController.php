<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MediaGroup;

class SearchController extends Controller
{
	public function search()
	{
		$results = null;
		$data = request()->result;
		
		if (!empty($data)) {
			$results = MediaGroup::where('group_name', 'LIKE', '%' . $data . '%')->get();
		} else {
			$results = MediaGroup::latest()->get();
		}

		return view('search', [
			'results' => $results
		]);
	}

	public function search404()
	{
		$results = null;
		$data = request()->result;
		
		if (!empty($data)) {
			$results = MediaGroup::where('group_name', 'LIKE', '%' . $data . '%')->get();
		} else {
			$results = MediaGroup::latest()->get();
		}

		return view('error-404-result', [
			'results' => $results
		]);
	}
}
