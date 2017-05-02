<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['as' => 'api.'], function () {

	Route::post('/cropper-movie-poster', ['as' => 'ajax.crop-movie-poster', 'uses' => 'AjaxController@cropMoviePoster']);

	Route::get('/search-movie', ['as' => 'search.movie', 'uses' => 'AjaxController@searchMovie']);
	Route::get('/search-code', ['as' => 'search.code', 'uses' => 'AjaxController@searchCode']);
});