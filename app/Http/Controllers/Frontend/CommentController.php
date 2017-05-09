<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;

class CommentController extends Controller
{
    public function getCommentReplies(Request $request)
    {
    	if($request->has('comment_id') && Comment::find($request->comment_id))
    	{
    		$result = Comment::getCommentReplies($request->comment_id);
    		return response()->json($result, 200);
    	}
    	return response()->json(array('error'), 200);
    }
}
