<?php

use Illuminate\Database\Seeder;
use App\Models\Movie;
use App\User;

class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('movies')->truncate();

        $faker = \Faker\Factory::create('zh_CN');

        $users = User::all();

        foreach ($users as $user)
        {
        	for($i = 0; $i < 20; ++$i)
        	{
	            Movie::create([
                    'user_id' => $user->id,
	                'name'   => $faker->text(30),
	                'director' => $faker->name,
	                'actors' => implode(',', array($faker->name, $faker->name, $faker->name)),
                    'poster' => env('DEFAULT_MOVIE_POSTER'),
	                'description' => $faker->text(100),
	                'recommend' => $faker->text(50),
	                'ranking' => $faker->numberBetween(1, 10000),
	                'stars' => $faker->randomFloat(1, 0, 9.9)
	            ]);
        	}
        }
    }
}
