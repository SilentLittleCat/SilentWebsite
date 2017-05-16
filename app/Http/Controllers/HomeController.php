<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        return view('home.index', ['user' => $user]);
    }

    public function update(Request $request)
    {
        $info = 'ok';
        if($request->object == 'movie')
        {
            if($request->operation == 'manage')
            {
                $movies = Movie::select(['id', 'name'])->where('user_id', Auth::user()->id)->get();
                $info = view('home.movie.manage', ['movies' => $movies, 'user' => Auth::user()])->render();
            }
        }
        return response()->json($info, 200);
    }
}
