<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

/*Route::get('/', function () {
    return view('home');
});
*/
Route::get('/','HomeController@index');
Route::post('/addUser','HomeController@addUser');
Route::post('/login','HomeController@login');
Route::get('/logUser','HomeController@logUser');
Route::get('/logout','HomeController@logout');
Route::post('/deleteUser','HomeController@deleteUser');
Route::get('/search','HomeController@search');
Route::get('/download','HomeController@getDownload');