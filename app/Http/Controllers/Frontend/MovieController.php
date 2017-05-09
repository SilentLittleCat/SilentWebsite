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
        $info = array('user' => User::find($id));
        $movies = Movie::where('user_id', $id)->paginate(Movie::$movies_of_each_page);

        if($movies->count() == 0)
        {
            $movies = Movie::where('user_id', $id)->paginate(Movie::$movies_of_each_page, ['*'], 'page', $movies->lastPage());
        }

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
        if(Auth::check() && Auth::user()->id == $id)
        {
            return view('frontend.movies.create', [
                'user' => User::find($id)
            ]);
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
        $movie->user_id = $id;
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

        $movie->save();
        $movie_id = $movie->id;
        return redirect()->route('movies.show', ['id' => $id, 'movie_id' => $movie_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id, $movie_id)
    {
        return view('frontend.movies.show', [
            'user' => User::find($id),
            'movie' => Movie::where('id', $movie_id)->first()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $movie_id)
    {
        return view('frontend.movies.edit', [
            'user' => User::find($id),
            'movie' => Movie::where('id', $movie_id)->first()
        ]);
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

            return redirect()->route('movies.show', ['id' => $id, 'movie_id' => $movie_id]);
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
        $movie = Movie::where('id', $movie_id)->first();
        if(!is_null($movie->poster) && $movie->poster != Movie::$default_movie_poster && Storage::exists('public' . substr($movie->poster, 7)))
        {
            Storage::delete('public' . substr($movie->poster, 7));
        }
        $movie->delete();
        return redirect()->route('movies.index', ['id' => $id]);
    }

    public function searchMovie(Request $request, $id)
    {
        if(!$request->has('key'))
        {
            return response()->json(array(), 200);
        }
        
        $movies = Movie::select(['id', 'name', 'description'])->where('user_id', $id)->where('name', 'like', '%' . $request->key . '%')->get();

        foreach($movies as $movie)
        {
            $movie->url = route('movies.show', ['id' => $id, 'movie_id' => $movie->id]);
        }

        return response()->json(array('items' => $movies), 200);
    }
}
