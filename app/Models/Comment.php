<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Debugbar;
use App\User;

class Comment extends Model
{
    protected $table = 'comments';

    protected $fillable = [
        'user_id', 'commented_user_id', 'type', 'commented_type_id', 'replied_comment_id', 'replied_user_id', 'content'
    ];

    public static $permitted_types = ['code', 'comment'];

    public static function getComments($type, $type_id)
    {
    	$result = collect();
    	if(!in_array($type, static::$permitted_types))
    	{
    		return $result;
    	}
    	else if($type == 'code')
    	{
    		$comments = Comment::where([
    			['type', 'code'],
    			['commented_type_id', $type_id]
    		])->get();

    		foreach($comments as $comment)
    		{
    			$comment->total_replies = Comment::where([
    				['type', 'reply'],
    				['commented_type_id', $comment->id]
    			])->get()->count();

    			// foreach($replies as $reply)
    			// {
    			// 	if($reply->replied_comment_id != $comment->id)
    			// 	{
    			// 		$reply->talks = $replies->filter(function($item, $key) use($reply){
    			// 			if((($item->user_id == $reply->user_id) && ($item->replied_user_id == $reply->replied_user_id)) || (($item->user_id == $reply->replied_user_id) && ($item->replied_user_id == $reply->user_id)))
    			// 			{
    			// 				return true;
    			// 			}
    			// 		});

    			// 		$replid_comment = $replies->where('id', $reply->talks->first()->replied_comment_id)->first();
    			// 		$reply->talks->push($replid_comment)->sortBy('id');
    			// 	}
    			// }
    			// foreach($replies as $reply)
    			// {
    			// 	$reply->user_avatar = User::find($reply->user_id)->avatar;
    			// 	$reply->user_name = User::find($reply->user_id)->name;
    			// 	if($reply->replied_comment_id != $comment->id)
    			// 	{
    			// 		$reply->replied_user_name = User::find($reply->replied_user_id)->name;
    			// 	}
    			// }
    			// $comment->replies = $replies;
    			$comment->user_avatar = User::find($comment->user_id)->avatar;
    			$comment->user_name = User::find($comment->user_id)->name;
    		}
    		$result = $comments;
    	}

    	return $result;
    }

    public static function getCommentReplies($comment_id)
    {
    	$replies = Comment::where([
    		['type', 'reply'],
    		['commented_type_id', $comment_id]
    	])->get();
    	foreach($replies as $reply)
    	{
    		$reply->user_avatar = User::find($reply->user_id)->avatar;
    		$reply->user_name = User::find($reply->user_id)->name;
    		if($reply->replied_comment_id != $comment_id)
    		{
    			$reply->replied_user_name = User::find($reply->replied_user_id)->name;
    		}
    	}
    	return $replies;
    }
}
