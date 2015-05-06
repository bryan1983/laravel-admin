<?php
Route::group(['prefix' => 'backend'], function () {
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
        Route::group(['prefix' => 'users'], function(){
            Route::get('/', [
                    'as' => 'LaravelAdminUsers',
                    'uses' => 'Joselfonseca\LaravelAdmin\Http\Controllers\Users\UsersController@index'
            ]);
        });
});
