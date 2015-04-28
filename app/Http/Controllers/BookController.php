<?php namespace App\Http\Controllers;

use App\Book;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Subject;

class BookController extends Controller {

    /**
     *  @var BookRequest $request
     */
    protected $request;
    
    /**
	 * Create an instance of a book controller
	 *
	 * @return Response
	 */
    public function __construct(BookRequest $request)
    {
        $this->request = $request;
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $_search = $this->request->get('search');
        $_subject = $this->request->get('subject');
        $_order = explode(',', $this->request->get('order'));
        
        $books = Book::where(function($query) use ($_search)
        {
            return $query->where('title', 'like', '%'.$_search.'%')
                ->orWhere('author', 'like', '%'.$_search.'%')
                ->orWhereHas('subject', function($_query) use ($_search)
                {
                    return $_query->where('name', 'like', '%'.$_search.'%');
                });
        });
        
        if ($_subject = Subject::whereSlug($_subject)->first())
        {
            $books = $books->whereHas('subject', function($query) use ($_subject)
            {
                return $query->whereSlug($_subject->slug);
            });            
        }
        
        if (empty($_order[0])) $_order[0] = 'created_at';
        if (empty($_order[1])) $_order[1] = 'desc';
        
        $books = $books->orderBy($_order[0], $_order[1])->paginate(15);
                
		return view('books.index', compact('books', '_search', '_subject'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Book $book)
	{
		return view('books.show', compact('book'));
	}
    
}
