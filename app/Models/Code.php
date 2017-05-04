<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    protected $table = 'codes';

    protected $fillable = [
        'user_id', 'header', 'content_path', 'type', 'categories', 'description', 'reading_times', 
    ];

    public static $types = ['original', 'transport', 'translate'];
    public static $default_content_path = 'storage/code/content/default.txt';
    public static $content_path = 'public/code/content/';
    public static $display_styles = ['abstract', 'directory'];
    public static $default_display_style = 'abstract';
	public static $codes_of_each_page = 5;
	public static $number_of_reading_ranks = 5;
}
