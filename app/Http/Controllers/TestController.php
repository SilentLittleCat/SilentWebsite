<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\User;
use App\Models\Movie;
use App\Models\Comment;
use Debugbar;
use Storage, Auth;

class TestController extends Controller
{
    public function test()
    {
        $movies = Movie::select(['id', 'name'])->where('user_id', Auth::user()->id)->get();
        $info = view('home.movie.manage', ['movies' => $movies, 'user' => Auth::user()])->render();
        Debugbar::info($info);
        return 'nihao';
    	return view('test.index');
    }
}
