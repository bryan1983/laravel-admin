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
        Route::get('/me/edit', [
                'as' => 'LaravelAdminUpdateMe',
                'uses' => 'Joselfonseca\LaravelAdmin\Http\Controllers\Users\UsersController@me'
        ]);
        Route::post('/me/edit', [
                'as' => 'LaravelAdminUpdateMePost',
                'uses' => 'Joselfonseca\LaravelAdmin\Http\Controllers\Users\UsersController@meEdit'
        ]);
        Route::get('/create', [
                'as' => 'LaravelAdminUsersCreate',
                'uses' => 'Joselfonseca\LaravelAdmin\Http\Controllers\Users\UsersController@create'
        ]);
        Route::post('/create', [
                'as' => 'LaravelAdminUsersCreatePost',
                'uses' => 'Joselfonseca\LaravelAdmin\Http\Controllers\Users\UsersController@store'
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
        Route::get('/{id}/delete', [
                'as' => 'deleteUser',
                'uses' => 'Joselfonseca\LaravelAdmin\Http\Controllers\Users\UsersController@destroy'
        ]);
    });
    /** Roles Routes **/
    Route::group(['prefix' => 'roles'], function(){
        Route::get('/', [
            'as' => 'LaravelAdminRoles',
            'uses' => 'Joselfonseca\LaravelAdmin\Http\Controllers\Users\RolesController@index'
        ]);
        Route::get('/create', [
            'as' => 'LaravelAdminRolesCreate',
            'uses' => 'Joselfonseca\LaravelAdmin\Http\Controllers\Users\RolesController@create'
        ]);
        Route::post('/create', [
            'as' => 'LaravelAdminRolesCreatePost',
            'uses' => 'Joselfonseca\LaravelAdmin\Http\Controllers\Users\RolesController@store'
        ]);
        Route::get('/{id}/edit', [
            'as' => 'LaravelAdminRolesEdit',
            'uses' => 'Joselfonseca\LaravelAdmin\Http\Controllers\Users\RolesController@edit'
        ]);
        Route::post('/{id}/edit', [
            'as' => 'LaravelAdminRolesEditPost',
            'uses' => 'Joselfonseca\LaravelAdmin\Http\Controllers\Users\RolesController@update'
        ]);
        Route::get('/{id}/delete', [
            'as' => 'LaravelAdminRolesDelete',
            'uses' => 'Joselfonseca\LaravelAdmin\Http\Controllers\Users\RolesController@destroy'
        ]);
        Route::get('/{id}/permissions', [
            'as' => 'LaravelAdminRolesPermissions',
            'uses' => 'Joselfonseca\LaravelAdmin\Http\Controllers\Users\RolesController@permissions'
        ]);
        Route::get('/{id}/permissions/{permission}/delete', [
            'as' => 'LaravelAdminRolesPermissionsDelete',
            'uses' => 'Joselfonseca\LaravelAdmin\Http\Controllers\Users\RolesController@permissionsDelete'
        ]);
    });
    /** Permissions Routes **/ 
    Route::group(['prefix' => 'permissions'], function(){
        Route::get('/get', [
            'as' => 'LaravelAdminPermissionsForSelect',
            'uses' => 'Joselfonseca\LaravelAdmin\Http\Controllers\Users\PermissionsController@getForSelect'
        ]);
        Route::post('/assign/', [
            'as' => 'LaravelAdminAssignPermission',
            'uses' => 'Joselfonseca\LaravelAdmin\Http\Controllers\Users\PermissionsController@permissionsAssign'
        ]);
    });
});
