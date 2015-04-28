<?php namespace App\Http\Controllers\User;

use App\Book;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\BookRequest;
use App\Subject;
use App\User;
use File;
use Storage;

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
	public function index(User $user)
	{
        $books = $user->books()->forSale()->get();
        
		return view('users.books.index', compact('user', 'books'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(User $user)
	{
        $subjects = Subject::all();
        
        $subjects->sortBy('name')->groupBy(function ($subject) {
            return $subject->name{0};
        });
        
		return view('users.books.create', compact('user', 'subjects'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(User $user)
	{
        $data = $this->request->get('book');
        
        if ($this->request->hasFile('book.image'))
        {
            $file = $this->request->file('book.image');
            $extension = $file->getClientOriginalExtension();
            $fileName = $file->getFilename().'.'.$extension;
            $destination = "books/img/$fileName";
            
            Storage::put($destination, File::get($file));
            
            $data['image'] = $fileName;
        }
        
        $data['user_id'] = $user->id;
        
        $book = Book::create($data);
        
        return redirect(route('books.show', $book->slug));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(User $user, Book $book)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(User $user, Book $book)
	{
		$subjects = Subject::all();
        
        $subjects->sortBy('name')->groupBy(function ($subject) {
            return $subject->name{0};
        });
        
		return view('users.books.edit', compact('user', 'book', 'subjects'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(User $user, Book $book)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(User $user, Book $book)
	{
		//
	}

}
