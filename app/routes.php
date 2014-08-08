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

Route::get('/', 'App\\Controllers\\NewsController@index');
Route::get('/news/{id}', 'App\\Controllers\\NewsController@show');
Route::match(array('GET', 'POST'), '/news/create/', 'App\\Controllers\\NewsController@create');
Route::get('/news/edit/{id}/', array('as' => 'edit', 'uses' => 'App\\Controllers\\NewsController@edit'));
Route::get('/news/delete/{id}/', array('as' => 'delete', 'uses' => 'App\\Controllers\\NewsController@delete'));
