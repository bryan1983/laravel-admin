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
        Route::get('/{id}/edit', [
                'as' => 'LaravelAdminUsersEdit',
                'uses' => 'Joselfonseca\LaravelAdmin\Http\Controllers\Users\UsersController@edit'
        ]);
        Route::post('/{id}/edit', [
                'as' => 'updateUser',
                'uses' => 'Joselfonseca\LaravelAdmin\Http\Controllers\Users\UsersController@update'
        ]);
        Route::post('/{id}/edit/password', [
                'as' => 'updatePassword',
                'uses' => 'Joselfonseca\LaravelAdmin\Http\Controllers\Users\UsersController@updatePassword'
        ]);
        
    });
});
