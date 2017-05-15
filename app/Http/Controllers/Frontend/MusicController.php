<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MusicController extends Controller
{
    public function index(Request $request, $id)
    {
        $info = file_get_contents(storage_path('app/public/music/songs.json'));
        $json_info = json_decode($info, TRUE);
    	return view('frontend.music.index', ['songs' => $json_info['songs']]);
    }
}
