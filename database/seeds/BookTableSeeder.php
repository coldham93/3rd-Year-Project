<?php

use App\Book;
use App\Subject;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BookTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
        DB::table('books')->truncate();
        
		$faker = Faker\Factory::create();
 
        $users = User::where('username', '!=', 'callum')->get()->lists('id');
        $subjects = Subject::all()->lists('id');
        
        for ($i = 0; $i < 200; $i++)
        {
            $subjectId = $faker->randomElement($subjects);
            $category = 'abstract';
            
            if (Subject::find($subjectId)->slug == "computing-it") $category = 'technics';
            if (Subject::find($subjectId)->slug == "biology") $category = $faker->randomElement(['nature', 'animals']);
            if (Subject::find($subjectId)->slug == "economics") $category = $faker->randomElement(['business', 'city', 'transport']);
            if (Subject::find($subjectId)->slug == "accounting-business-finance") $category = 'business';
            if (Subject::find($subjectId)->slug == "management") $category = 'business';
            if (Subject::find($subjectId)->slug == "law") $category = $faker->randomElement(['business', 'city']);
            if (Subject::find($subjectId)->slug == "geography") $category = $faker->randomElement(['nature', 'animals', 'city']);
            if (Subject::find($subjectId)->slug == "history") $category = $faker->randomElement(['people', 'city']);
            if (Subject::find($subjectId)->slug == "veterinary-medicine") $category = $faker->randomElement(['animals']);
            if (Subject::find($subjectId)->slug == "sociology") $category = $faker->randomElement(['people']);
            if (Subject::find($subjectId)->slug == "psychology-and-counselling") $category = $faker->randomElement(['people']);
            if (Subject::find($subjectId)->slug == "politics") $category = $faker->randomElement(['city']);
            if (Subject::find($subjectId)->slug == "engineering") $category = $faker->randomElement(['transport', 'city']);
            if (Subject::find($subjectId)->slug == "physics") $category = $faker->randomElement(['technics', 'transport', 'sports']);
            
            $image = explode('/', $faker->image('storage/app/books/img', 640, 640, $category));
            
            $book = Book::create([
                'image' => array_pop($image),
                'title' => str_replace('.', '', $faker->sentence(rand(1, 3))),
                'author' => $faker->name,
                'isbn' => $faker->ean13,
                'description' => $faker->paragraph,
                'price' => $faker->randomNumber(2),
                'subject_id' => $subjectId,
                'user_id' => $faker->randomElement($users)
            ]);
        }
	}

}
