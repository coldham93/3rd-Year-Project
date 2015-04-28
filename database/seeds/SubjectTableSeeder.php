<?php

use App\Subject;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SubjectTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
        DB::table('subjects')->truncate();
        
        $subjects = [
            'music' => 'Music',
            'globe' => 'Geography',
            'gavel' => 'Law',
            'flask' => 'Chemistry',
            'leaf' => 'Biology',
            'gears' => 'Engineering',
            'institution' => 'History',
            'desktop' => 'Computing & IT',
            'key' => 'Archaeology',
            'line-chart' => 'Accounting, Business & Finance',
            'paint-brush' => 'Art & Design',
            'diamond' => 'Dentistry',
            'money' => 'Economics',
            'edit' => 'English Language',
            'language' => 'Languages',
            'pie-chart' => 'Management',
            'calculator' => 'Mathematics',
            'user-md' => 'Nursing',
            'medkit' => 'Pharmacology',
            'lightbulb-o' => 'Philosophy',
            'flash' => 'Physics',
            'newspaper-o' => 'Politics',
            'comments' => 'Psychology & Counselling',
            'group' => 'Sociology',
            'cloud-upload' => 'Theology & Religion',
            'paw' => 'Veterinary Medicine'
        ];
        
        foreach($subjects as $icon => $name)
        {
            $subject = Subject::create(['name' => $name, 'icon' => $icon]);
        }
	}

}
