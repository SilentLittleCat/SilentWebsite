<?php

use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\User;
use Illuminate\Support\Facades\DB;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->truncate();

        $faker = \Faker\Factory::create('zh_CN');

        $users = User::where('id', '<', 3)->get();
        $allUsers = User::all();
        $user_ids = User::select(['id']);

        foreach($users as $user)
        {
        	$codes = DB::table('codes')->where('user_id', $user->id)->get();
        	foreach($codes as $code)
        	{
        		for($i = 0; $i < 5; ++$i)
        		{
        			$comment = Comment::create([
		            	'user_id' => $allUsers->random()->id,
		        		'commented_user_id' => $user->id,
		        		'commented_type_id' => $code->id,
		        		'type' => 'code',
		        		'content' => $faker->text(200)
	            	]);

	            	for($j = 0; $j < 3; ++$j)
	            	{
	        			$comment_reply = Comment::create([
			            	'user_id' => $allUsers->random()->id,
			        		'commented_user_id' => $comment->user_id,
			        		'commented_type_id' => $comment->id,
			        		'type' => 'reply',
			        		'replied_comment_id' => $comment->id,
			        		'replied_user_id' => $comment->user_id,
			        		'content' => $faker->text(200)
		            	]);

	        			$comment_reply_ask_user_id = $allUsers->random()->id;
		            	for($k = 0; $k < 2; ++$k)
		            	{
		            		$comment_reply_ask = Comment::create([
				            	'user_id' => $comment_reply_ask_user_id,
				        		'commented_user_id' => $comment->user_id,
				        		'commented_type_id' => $comment->id,
				        		'type' => 'reply',
				        		'replied_comment_id' => $comment_reply->id,
				        		'replied_user_id' => $comment_reply->user_id,
				        		'content' => $faker->text(200)
			            	]);

			            	$comment_reply_ask_reply = Comment::create([
				            	'user_id' => $comment->user_id,
				        		'commented_user_id' => $comment->user_id,
				        		'commented_type_id' => $comment->id,
				        		'type' => 'reply',
				        		'replied_comment_id' => $comment_reply_ask->id,
				        		'replied_user_id' => $comment_reply_ask->user_id,
				        		'content' => $faker->text(200)
			            	]);
		            	}
	            	}
        		}
        	}
        }
    }
}
