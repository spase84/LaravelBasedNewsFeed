<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::pattern('id', '[0-9]+');

Route::get('/', function() {
  $news = News::all();

  return View::make('news.list')->with('collection', $news);
});


Route::get('/news/{id}', 'NewsController@show');
Route::get('/news/new/', 'NewsController@new');
Route::get('/news/edit/{id}/', 'NewsController@edit');
Route::get('/news/delete/{id}/', 'NewsController@delete');
