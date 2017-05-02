<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Storage;

class UsersTableSeeder extends Seeder
{
	protected $defaultAvatar = 'public/image/avatar/';
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
            'status' => 1
        ]);

        $faker = Faker\Factory::create('zh_CN');

        $avatars = Storage::files($this->defaultAvatar);
        for ($i = 0; $i < 20; ++$i) {
        	$avatar = 'storage' . substr($avatars[array_rand($avatars, 1)], 6);
        	$avatar_back = 'storage' . substr($avatars[array_rand($avatars, 1)], 6);
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
