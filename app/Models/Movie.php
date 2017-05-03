<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Debugbar;

class Movie extends Model
{
    protected $fillable = [
        'user_id', 'name', 'director', 'actors', 'poster', 'description', 'recommend', 'ranking', 'stars'
    ];

    public static $movies_of_each_page = 5;

    public static $display_styles = ['grid', 'list'];
    public static $default_display_style = 'grid';

    public static $poster_path = 'public/image/movie';
    public static $poster_extension = ['jpeg', 'jpg', 'png'];
}
