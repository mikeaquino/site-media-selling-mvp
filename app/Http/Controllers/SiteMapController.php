<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Sitemap\SitemapGenerator;

class SiteMapController extends Controller
{
	public function generate()
	{
		SitemapGenerator::create(config('app.url'))->writeToFile(public_path('sitemap.xml'));
	}
}
