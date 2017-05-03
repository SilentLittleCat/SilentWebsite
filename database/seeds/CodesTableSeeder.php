<?php

use Illuminate\Database\Seeder;
use App\Models\Code;
use App\User;

class CodesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('codes')->truncate();

        $faker = \Faker\Factory::create('zh_CN');

        $users = User::all();

        foreach ($users as $user)
        {
        	for($i = 0; $i < 20; ++$i)
        	{
	            $movie = Code::create([
	            	'user_id' => $user->id,
	        		'header' => $faker->text(50),
	        		'content_path' => Code::$default_content_path,
	        		'type' => $faker->randomElement(Code::$types),
	        		'categories' => implode(',', $faker->randomElements($array = array ('java', 'php', 'c/c++', 'html', 'css', 'acm', 'math'), 3)),
	        		'description' => $faker->text(200),
	        		'reading_times' => $faker->numberBetween(1, 1000)
	            ]);
        	}
        }
    }
}
