<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
        DB::table('users')->truncate();
        
        $faker = Faker\Factory::create();
        
        $image = explode('/', $faker->image('storage/app/users/img', 640, 640, 'technics'));
        
        $user = User::create([
            'image' => array_pop($image),
            'username' => 'callum',
            'first_name' => 'Callum',
            'last_name' => 'Oldham',
            'email' => 'callum@sotonshop.uk',
            'password' => bcrypt('secure-password'),
        ]);
        
        for ($i = 0; $i < 50; $i++)
        {
            $image = explode('/', $faker->image('storage/app/users/img', 640, 640, 'people'));
            
            $first = $faker->firstName;
            $last = $faker->lastName;
            
            $a = strtolower($first{0});
            $b = strtolower($last{0});
            
            $email = $faker->regexify('('.$a.')[a-z]{0,1}('.$b.')[0-9]{3}@soton\.ac\.uk');
            
            $user = User::create([
                'image' => array_pop($image),
                'username' => explode('@', $email)[0],
                'first_name' => $first,
                'last_name' => $last,
                'email' => $email,
                'password' => bcrypt($faker->word)
            ]);
        }
	}

}
