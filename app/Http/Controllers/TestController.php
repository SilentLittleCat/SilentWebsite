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
        $info = file_get_contents(storage_path('app/public/music/songs.json'));
        $json_info = json_decode($info, TRUE);
        Debugbar::info($json_info['songs']);
        return 'nihao';
    	return view('test.index');
    }
}
