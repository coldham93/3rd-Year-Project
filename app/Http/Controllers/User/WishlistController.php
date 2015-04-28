<?php namespace App\Http\Controllers\User;

use App\Book;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\WishlistRequest;
use App\User;
use Redirect;

class WishlistController extends Controller {

    /**
     *  @var WishlistRequest $request
     */
    protected $request;
    
    /**
	 * Create an instance of a book controller
	 *
	 * @return Response
	 */
    public function __construct(WishlistRequest $request)
    {
        $this->request = $request;
    }
    
    /**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function getIndex(User $user, Book $book)
	{
        if ($book->id) return redirect(route('users.show', $user->username).'/wishlist');
        
        $wishlist = $user->wishlist()->orderBy('wishlists.created_at', 'DESC')->paginate(6);
        
		return view('users.wishlist.index', compact('user', 'wishlist'));
	}
    
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postIndex(User $user, Book $book)
	{
		$wishlist = $this->request->get('wishlist');
        
        $user->wishlist()->attach($book->id);
        $user->save();
        
        return redirect(route('books.show', $book->slug));
    }
    
    public function deleteIndex(User $user, Book $book)
    {
        $user->wishlist()->detach($book->id);
        $user->save();
        
        return Redirect::to(Redirect::back()->getTargetUrl());
    }
    
}
