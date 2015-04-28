<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PageController extends Controller {

	/**
	 * Display the home page
	 *
	 * @return Response
	 */
	public function home()
	{
		return view('pages.home');
	}
    
}
