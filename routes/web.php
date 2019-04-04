<?php
use Illuminate\Support\Facades\URL;

//TODO For local dev
URL::forceScheme('https');

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/mayday/create', 'MaydayController@create')->name('mayday.create');
Route::post('/mayday/create', 'MaydayController@store')->name('mayday.message');
Route::get('/mayday/{mayday}', 'MaydayController@show')->name('mayday.page');
Route::get('/mayday/{mayday}/track', 'MaydayController@track')->name('mayday.track');
Route::post('/mayday/{mayday}/location', 'MaydayController@updateLocation')->name('mayday.update.location');
Route::post('/mayday/{mayday}/connection', 'MaydayController@updateConnection')->name('mayday.update.connection');
