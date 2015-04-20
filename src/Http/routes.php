<?php
Route::group(['prefix' => config('laravel-admin.routePrefix')], function () {
	Route::get('/login', [
		'as' => 'LaravelAdminLogin',
		'uses' => 'Joselfonseca\LaravelAdmin\Http\Controllers\LoginController@getLogin'
	]);
	Route::post('/login', [
		'as' => 'LaravelAdminLoginPost',
		'uses' => 'Joselfonseca\LaravelAdmin\Http\Controllers\LoginController@postLogin'
	]);
	Route::get('/home', [
		'as' => 'LaravelAdminHome',
		'uses' => 'Joselfonseca\LaravelAdmin\Http\Controllers\HomeController@index'
	]);
});
