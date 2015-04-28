<?php namespace App\Providers;

use App\Book;
use App\Subject;
use App\User;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;

class RouteServiceProvider extends ServiceProvider {
    
	/**
	 * This namespace is applied to the controller routes in your routes file.
	 *
	 * In addition, it is set as the URL generator's root namespace.
	 *
	 * @var string
	 */
	protected $namespace = 'App\Http\Controllers';
        
	/**
	 * Define your route model bindings, pattern filters, etc.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function boot(Router $router)
	{
		parent::boot($router);
        
        $router->bind('users', function($username) {
            if (is_numeric($username)) return User::find($username);
            return User::whereUsername($username)->first();
        });
        
        $router->bind('books', function($slug) {
            if (is_numeric($slug)) return Book::find($slug);
            return Book::whereSlug($slug)->first();
        });
        
        $router->bind('subjects', function($slug) {
            if (is_numeric($slug)) return Subject::find($slug);
            return Subject::whereSlug($slug)->first();
        });
        
        $router->model('orders', 'App\Order');
        $router->model('reviews', 'App\Review');
	}
    
	/**
	 * Define the routes for the application.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function map(Router $router)
	{
		$router->group(['namespace' => $this->namespace], function($router)
		{
			require app_path('Http/routes.php');
		});
	}

}
