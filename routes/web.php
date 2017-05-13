<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['namespace' => 'Frontend'], function ()
{
    Route::group(['prefix' => '/u/{id}', 'middleware' => 'user.auth'], function($id) {

    	Route::get('/', ['as' => 'welcome', 'uses' => 'UserController@index']);

    	Route::resource('/movies', 'MovieController');
    	Route::get('/search-movie', ['as' => 'movies.search', 'uses' => 'MovieController@searchMovie']);
    	
        Route::resource('/codes', 'CodeController');
        Route::get('/search-code', ['as' => 'codes.search', 'uses' => 'CodeController@searchCode']);

        Route::get('/videos', ['as' => 'videos.index', 'uses' => 'VideoController@index']);
        Route::get('/videos/home', ['as' => 'videos.home', 'uses' => 'VideoController@home']);
    });

    Route::post('/comments/replies', ['as' => 'comments.replies', 'uses' => 'CommentController@getCommentReplies']);
});

Route::get('/test', 'TestController@test');