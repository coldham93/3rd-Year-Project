<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function(){
    return redirect('/books');
});

Route::get('home', ['uses' => 'PageController@home', 'as' => 'pages.home']);

Route::resource('books', 'BookController');
Route::resource('users', 'UserController');
Route::resource('subjects', 'SubjectController');

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function()
{
    Route::resource('books', 'BookController');
    Route::resource('users', 'UserController');
    Route::resource('orders', 'OrderController');
    Route::resource('subjects', 'SubjectController');
});

Route::group(['namespace' => 'User'], function()
{
    Route::resource('users.books', 'BookController');
    Route::resource('users.orders', 'OrderController');
    Route::resource('users.reviews', 'ReviewController');
    
    Route::controller('users/{users}/wishlist/{books?}', 'WishlistController');
    Route::controller('users/{users}/contact', 'ContactController');
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('{resource}/{id}/img', function($resource, $id)
{
    $object = null;
    
    switch($resource)
    {
        case 'books':
            $object = App\Book::find($id);
            break;
        case 'users':
            $object = App\User::find($id);
            break;
        default:
            break;
    }

    $mime = Storage::mimeType("{$resource}/img/{$object->image}");
    $file = Storage::get("{$resource}/img/{$object->image}");
    
    return \Response::make($file, 200, [
        'Content-type' => $mime
    ]);
});