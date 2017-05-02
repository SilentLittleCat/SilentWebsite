<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\File;
use App\User;
use Auth, DB, Storage, Validator, Debugbar;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        $info = User::getUserInfo($id);
        $movies = Movie::getMoviesByUserId($id);
        $info = array_merge(array('movies' => $movies), $info);

        if($request->has('style') && in_array($request->input('style'), Movie::$display_styles))
        {
            $info = array_merge(array('style' => $request->input('style')), $info);
        }
        else
        {
            $info = array_merge(array('style' => Movie::$default_display_style), $info);
        }

        return view('frontend.movies.index', $info);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        $info = User::getUserInfo($id);
        if($info['is_admin'])
        {
            return view('frontend.movies.create', $info);
        }
        else
        {
            return redirect('/u/' . $id . '/movies');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $movie = new Movie;
        $movie->name = $request->name;
        $movie->director = $request->director;
        $movie->actors = $request->actor;
        $movie->description = $request->description;
        $movie->recommend = $request->recommend;
        $movie->ranking = $request->ranking;
        $movie->stars = $request->stars;

        if($request->hasFile('poster'))
        {
            if($request->has('crop-poster') && Storage::exists('public' . substr($request->input('crop-poster'), 7)))
            {
                $movie->poster = $request->input('crop-poster');
            }
        }
        $movie_id = $movie->save();
        $movie_id = $movie->id;
        DB::transaction(function() use($id, $movie_id){
            DB::table('movie_user')->insert([
                'user_id' => $id,
                'movie_id' => $movie_id
            ]);
        });
        return redirect()->route('movies.show', ['id' => $id, 'movie_id' => $movie_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $movie_id)
    {
        $info = User::getUserInfo($id);
        $movie = Movie::where('id', $movie_id)->first();
        
        $movie->poster = $movie->poster ?: Movie::$default_poster;

        $info = array_merge(array('movie' => $movie), $info);
        return view('frontend.movies.show', $info);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $movie_id)
    {
        $info = User::getUserInfo($id);
        $movie = Movie::where('id', $movie_id)->get();
        $info = array_merge(array('movie' => $movie), $info);
        return view('frontend.movies.edit', $info);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $movie_id)
    {
        $movie = Movie::find($movie_id);
        if(!is_null($movie))
        {
            $movie->name = $request->name;
            $movie->director = $request->director;
            $movie->actors = $request->actor;
            $movie->description = $request->description;
            $movie->recommend = $request->recommend;
            $movie->ranking = $request->ranking;
            $movie->stars = $request->stars;

            if($request->hasFile('poster'))
            {
                if($request->has('crop-poster') && Storage::exists('public' . substr($request->input('crop-poster'), 7)))
                {
                    $movie->poster = $request->input('crop-poster');
                }
            }
            $movie_id = $movie->save();
            $movie_id = $movie->id;
            DB::transaction(function() use($id, $movie_id){
                DB::table('movie_user')->insert([
                    'user_id' => $id,
                    'movie_id' => $movie_id
                ]);
            });
            return redirect()->route('movies.store', ['id' => $id]);
        }
        return redirect()->back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $movie_id)
    {
        $poster = Movie::where('id', $movie_id)->first()->poster;
        $path = 'public' . substr($poster, 7);
        Storage::delete($path);

        DB::transaction(function() use($movie_id) {
            Movie::where('id', $movie_id)->delete();
            DB::table('movie_user')->where('movie_id', $movie_id)->delete();
        });

        return back();
    }
}
