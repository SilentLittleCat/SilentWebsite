<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Movie;
use Debugbar;
use Storage;

class TestController extends Controller
{
    public function test()
    {
    	$info = Movie::where('id', [1, 2, 3])->get();
    	Debugbar::info($info);
    	return 'nihoa';
    }
}
