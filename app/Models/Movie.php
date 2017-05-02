<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Debugbar;

class Movie extends Model
{
    protected $fillable = [
        'name', 'director', 'actors', 'poster', 'description', 'recommend', 'ranking', 'stars'
    ];

    public static $movie_of_each_page = 5;
    public static $movie_ids;

    public static $display_styles = ['grid', 'list'];
    public static $default_display_style = 'grid';

    public static $poster_path = 'public/image/movie';
    public static $poster_extension = ['jpeg', 'jpg', 'png'];
    public static $default_poster = 'image/movie/no-poster.jpg';

    protected static function getMoviesByUserId($id)
    {
        $result = DB::table('movie_user')->where('user_id', $id)->get()->map(function($item, $key) {
            return Movie::where('id', $item->movie_id)->get();
        });
        static::$movie_ids = array();
        DB::table('movie_user')->where('user_id', $id)->get()->each(function($item, $key) {
            array_push(static::$movie_ids, $item->movie_id);
        });

        $result = Movie::whereIn('id', static::$movie_ids)->paginate(static::$movie_of_each_page);

        foreach($result as $item)
        {
        	$item->poster = $item->poster ?: Movie::$default_poster;
        }

        // Debugbar::info($result);
        return $result;
    }
}
