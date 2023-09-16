<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SitemapController extends Controller
{


	public function sitemap()
	{
   		return view('pages.sitemap');
	}
	
		public function sitemaps()
	{
   		return view('pages.sitemaps');
	}


}