<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use Validator, Storage, Debugbar, DB;

class AjaxController extends Controller
{
    protected $movie_ids;

    public function cropMoviePoster(Request $request)
    {
        if($request->has('path') && Storage::exists('public' . substr($request->path, 7)))
        {
            Storage::delete('public' . substr($request->path, 7));
        }

        if($request->hasFile('poster'))
        {
            $validator = Validator::make($request->all(),  [
                'poster' => 'mimes:jpeg,jpg,png,gif|max:1024'
            ]);
            if($validator->fails())
            {
                return response()->json($validator->errors(), 200);
            }

            $path = $request->file('poster')->store(Movie::$poster_path);
            $path = 'storage' . substr($path, 6);
            $result = array('path' => $path);
            return response()->json($result, 200);
        }
        else if($request->hasFile('croppedImage'))
        {
            $validator = Validator::make($request->all(),  [
                'croppedImage' => 'mimes:jpeg,jpg,png,gif|max:1024'
            ]);
            if($validator->fails())
            {
                return response()->json($validator->errors(), 200);
            }

            $path = $path = $request->file('croppedImage')->store(Movie::$poster_path);
            $path = 'storage' . substr($path, 6);
            $result = array('path' => $path);
            return response()->json($result, 200);
        }
    }

    public function searchMovie(Request $request)
    {
        if(!$request->has('id') || !$request->has('key'))
        {
            return response()->json(array(), 200);
        }

        $this->movie_ids = array();
        DB::table('movie_user')->where('user_id', $request->id)->get()->each(function($item, $key) {
            array_push($this->movie_ids, $item->movie_id);
        });
        $result = DB::table('movies')->select(['id', 'name', 'description'])->whereIn('id', $this->movie_ids)->where('name', 'like', '%' . $request->key . '%')->get();
        foreach($result as $item)
        {
            $item->url = route('movies.show', ['id' => $request->id, 'movie_id' => $item->id]);
        }

        return response()->json(array('items' => $result), 200);
    }
}
