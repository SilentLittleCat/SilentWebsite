<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Movie;
use App\Models\Comment;
use Debugbar;
use Storage, Auth;

class TestController extends Controller
{
    public function test()
    {
        $info = route('codes.show', ['id' => 1, 'code_id' => 5]);
        Debugbar::info($info);

    	return view('test.index');
    }
}
