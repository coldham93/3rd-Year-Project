<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubjectRequest;
use App\Subject;

class SubjectController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $subjects = Subject::all();
        
        $data = $subjects->sortBy('name')->groupBy(function ($subject) { return $subject->name{0}; });
        
		return view('subjects.index', compact('data'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Subject $subject)
	{
		return redirect(route('books.index').'?subject='.$subject->slug);
	}

}
