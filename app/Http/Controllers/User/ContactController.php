<?php namespace App\Http\Controllers\User;

use App\Book;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\ContactRequest;
use App\Order;
use App\User;
use Mail;

class ContactController extends Controller {

    /**
     *  @var ContactRequest $request
     */
    protected $request;
    
    /**
	 * Create an instance of a book controller
	 *
	 * @return Response
	 */
    public function __construct(ContactRequest $request)
    {
        $this->middleware('auth');
        $this->request = $request;
    }
    
    /**
	 * Show the application contact form.
	 *
     * @param  User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function getIndex(User $user)
	{
        $books = $user->books()->forSale()->get();
        
		return view('users.contact.index', compact('user', 'books'));
	}
    
	/**
	 * Handle a contact request for the application.
	 *
	 * @param  User  $seller
	 * @return \Illuminate\Http\Response
	 */
	public function postIndex(User $seller)
	{
        $data = $this->request->get('contact');
        $user = $this->request->user();
        $book = Book::find($data['book_id']);
        
        $data = [
            'seller' => serialize($seller),
            'user' => serialize($user),
            'text' => $data['text']
        ];
        
        Mail::send('emails.users.contact', $data, function($message) use ($seller, $user, $book) {
            $subject = $user->first_name.' sent a message about your book "'.$book->title.'"';
            $message->to($seller->email, $seller->first_name)->subject($subject);
        });
                
        return view('users.contact.sent', compact('seller', 'user'));
	}

}
