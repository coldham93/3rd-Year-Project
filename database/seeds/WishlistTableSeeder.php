<?php

use App\Book;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class WishlistTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
        DB::table('wishlists')->truncate();
        
		$faker = Faker\Factory::create();
 
        $users = User::all()->lists('id');
        $books = Book::all()->lists('id');
        
        for ($i = 0; $i < count($users) * 2; $i++)
        {
            $user = User::find($faker->randomElement($users));
            $user->wishlist()->attach($faker->randomElement($books));
            $user->save();
        }
	}

}
