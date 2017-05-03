<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Storage;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();

        User::create([
            'name'   => 'admin',
            'email' => 'admin@test.com',
            'password' => bcrypt(123456),
            'status' => 1,
            'moto' => env('DEFAULT_MOTO'),
            'avatar' => env('DEFAULT_AVATAR'),
            'avatar_back' => env('DEFAULT_AVATAR_BACK'),
        ]);

        $faker = Faker\Factory::create('zh_CN');

        for ($i = 0; $i < 20; ++$i) {
        	$avatar = env('DEFAULT_AVATAR_PATH') . 'avatar' . rand(1, 6) . '.png';
        	$avatar_back = env('DEFAULT_AVATAR_PATH') . 'avatar' . rand(1, 6) . '.png';
            $user = User::create([
                'name'   => $faker->name,
                'email' => $faker->email,
                'password' => bcrypt(123456),
                'status' => 1,
                'moto' => $faker->text(50),
                'avatar' => $avatar,
                'avatar_back' => $avatar_back
            ]);
        }
    }
}
