<?php
Route::group(['prefix' => config('laravel-admin.routePrefix', 'backend'), 'middleware' => config('laravel-admin.middleware', [])],
    function () {
        Route::get('/', 'Joselfonseca\LaravelAdmin\Http\Controllers\HomeController@index');
        Route::get('/login',
            [
                'as' => 'LaravelAdminLogin',
                'uses' => 'Joselfonseca\LaravelAdmin\Http\Controllers\LoginController@getLogin'
            ]);
        Route::get('/logout',
            [
                'as' => 'LaravelAdminLogout',
                'uses' => 'Joselfonseca\LaravelAdmin\Http\Controllers\LoginController@getLogout'
            ]);
        Route::post('/login',
            [
                'as' => 'LaravelAdminLoginPost',
                'uses' => 'Joselfonseca\LaravelAdmin\Http\Controllers\LoginController@postLogin'
            ]);
        Route::group(['middleware' => 'Joselfonseca\LaravelAdmin\Http\Middleware\AuthMiddleware'],
            function () {
                Route::get('/home',
                    [
                        'as' => 'LaravelAdminHome',
                        'uses' => 'Joselfonseca\LaravelAdmin\Http\Controllers\HomeController@index'
                    ]);
                Route::get('/me/edit',
                    [
                        'as' => 'LaravelAdminUpdateMe',
                        'uses' => 'Joselfonseca\LaravelAdmin\Http\Controllers\Users\UsersController@me'
                    ]);
                Route::post('/me/edit',
                    [
                        'as' => 'LaravelAdminUpdateMePost',
                        'uses' => 'Joselfonseca\LaravelAdmin\Http\Controllers\Users\UsersController@meEdit'
                    ]);
                Route::group(['prefix' => 'users'],
                    function () {
                        Route::get('/',
                            [
                                'as' => 'LaravelAdminUsers',
                                'uses' => 'Joselfonseca\LaravelAdmin\Http\Controllers\Users\UsersController@index',
                                'middleware' => 'Joselfonseca\LaravelAdmin\Http\Middleware\AclMiddleware:list-users'
                            ]);
                        Route::get('/create',
                            [
                                'as' => 'LaravelAdminUsersCreate',
                                'uses' => 'Joselfonseca\LaravelAdmin\Http\Controllers\Users\UsersController@create',
                                'middleware' => 'Joselfonseca\LaravelAdmin\Http\Middleware\AclMiddleware:create-user'
                            ]);
                        Route::post('/create',
                            [
                                'as' => 'LaravelAdminUsersCreatePost',
                                'uses' => 'Joselfonseca\LaravelAdmin\Http\Controllers\Users\UsersController@store',
                                'middleware' => 'Joselfonseca\LaravelAdmin\Http\Middleware\AclMiddleware:create-user'
                            ]);
                        Route::get('/{id}/edit',
                            [
                                'as' => 'LaravelAdminUsersEdit',
                                'uses' => 'Joselfonseca\LaravelAdmin\Http\Controllers\Users\UsersController@edit',
                                'middleware' => 'Joselfonseca\LaravelAdmin\Http\Middleware\AclMiddleware:edit-user'
                            ]);
                        Route::post('/{id}/edit',
                            [
                                'as' => 'updateUser',
                                'uses' => 'Joselfonseca\LaravelAdmin\Http\Controllers\Users\UsersController@update',
                                'middleware' => 'Joselfonseca\LaravelAdmin\Http\Middleware\AclMiddleware:edit-user'
                            ]);
                        Route::post('/{id}/edit/password',
                            [
                                'as' => 'updatePassword',
                                'uses' => 'Joselfonseca\LaravelAdmin\Http\Controllers\Users\UsersController@updatePassword',
                                'middleware' => 'Joselfonseca\LaravelAdmin\Http\Middleware\AclMiddleware:edit-user'
                            ]);
                        Route::delete('/{id}/delete',
                            [
                                'as' => 'deleteUser',
                                'uses' => 'Joselfonseca\LaravelAdmin\Http\Controllers\Users\UsersController@destroy',
                                'middleware' => 'Joselfonseca\LaravelAdmin\Http\Middleware\AclMiddleware:delete-user'
                            ]);
                    });
                /** Roles Routes * */
                Route::group(['prefix' => 'roles'],
                    function () {
                        Route::get('/',
                            [
                                'as' => 'LaravelAdminRoles',
                                'uses' => 'Joselfonseca\LaravelAdmin\Http\Controllers\Users\RolesController@index',
                                'middleware' => 'Joselfonseca\LaravelAdmin\Http\Middleware\AclMiddleware:roles-crud'
                            ]);
                        Route::get('/create',
                            [
                                'as' => 'LaravelAdminRolesCreate',
                                'uses' => 'Joselfonseca\LaravelAdmin\Http\Controllers\Users\RolesController@create',
                                'middleware' => 'Joselfonseca\LaravelAdmin\Http\Middleware\AclMiddleware:roles-crud'
                            ]);
                        Route::post('/create',
                            [
                                'as' => 'LaravelAdminRolesCreatePost',
                                'uses' => 'Joselfonseca\LaravelAdmin\Http\Controllers\Users\RolesController@store',
                                'middleware' => 'Joselfonseca\LaravelAdmin\Http\Middleware\AclMiddleware:roles-crud'
                            ]);
                        Route::get('/{id}/edit',
                            [
                                'as' => 'LaravelAdminRolesEdit',
                                'uses' => 'Joselfonseca\LaravelAdmin\Http\Controllers\Users\RolesController@edit',
                                'middleware' => 'Joselfonseca\LaravelAdmin\Http\Middleware\AclMiddleware:roles-crud'
                            ]);
                        Route::post('/{id}/edit',
                            [
                                'as' => 'LaravelAdminRolesEditPost',
                                'uses' => 'Joselfonseca\LaravelAdmin\Http\Controllers\Users\RolesController@update',
                                'middleware' => 'Joselfonseca\LaravelAdmin\Http\Middleware\AclMiddleware:roles-crud'
                            ]);
                        Route::delete('/{id}/delete',
                            [
                                'as' => 'LaravelAdminRolesDelete',
                                'uses' => 'Joselfonseca\LaravelAdmin\Http\Controllers\Users\RolesController@destroy',
                                'middleware' => 'Joselfonseca\LaravelAdmin\Http\Middleware\AclMiddleware:roles-crud'
                            ]);
                        Route::get('/{id}/permissions',
                            [
                                'as' => 'LaravelAdminRolesPermissions',
                                'uses' => 'Joselfonseca\LaravelAdmin\Http\Controllers\Users\RolesController@permissions',
                                'middleware' => 'Joselfonseca\LaravelAdmin\Http\Middleware\AclMiddleware:roles-crud'
                            ]);
                        Route::put('{id}/permissions', [
                            'as' => 'LaravelAdminRolesPermissionsUpdate',
                            'uses' => 'Joselfonseca\LaravelAdmin\Http\Controllers\Users\RolesController@permissionsUpdate',
                            'middleware' => 'Joselfonseca\LaravelAdmin\Http\Middleware\AclMiddleware:roles-crud'
                        ]);
                        Route::get('/{id}/permissions/{permission}/delete',
                            [
                                'as' => 'LaravelAdminRolesPermissionsDelete',
                                'uses' => 'Joselfonseca\LaravelAdmin\Http\Controllers\Users\RolesController@permissionsDelete',
                                'middleware' => 'Joselfonseca\LaravelAdmin\Http\Middleware\AclMiddleware:roles-crud'
                            ]);
                        Route::get('/permissions/get',
                            [
                                'as' => 'LaravelAdminPermissionsForSelect',
                                'uses' => 'Joselfonseca\LaravelAdmin\Http\Controllers\Users\PermissionsController@getForSelect',
                                'middleware' => 'Joselfonseca\LaravelAdmin\Http\Middleware\AclMiddleware:roles-crud'
                            ]);
                        Route::post('/permissions/assign/',
                            [
                                'as' => 'LaravelAdminAssignPermission',
                                'uses' => 'Joselfonseca\LaravelAdmin\Http\Controllers\Users\PermissionsController@permissionsAssign',
                                'middleware' => 'Joselfonseca\LaravelAdmin\Http\Middleware\AclMiddleware:roles-crud'
                            ]);
                    });
                /** Permissions Routes * */
                Route::group(['prefix' => 'permissions'],
                    function () {
                        Route::get('/',
                            [
                                'as' => 'LaravelAdminPermissions',
                                'uses' => 'Joselfonseca\LaravelAdmin\Http\Controllers\Users\PermissionsController@index',
                                'middleware' => 'Joselfonseca\LaravelAdmin\Http\Middleware\AclMiddleware:permissions-crud'
                            ]);
                        Route::get('/create',
                            [
                                'as' => 'LaravelAdminPermissionsCreate',
                                'uses' => 'Joselfonseca\LaravelAdmin\Http\Controllers\Users\PermissionsController@create',
                                'middleware' => 'Joselfonseca\LaravelAdmin\Http\Middleware\AclMiddleware:permissions-crud'
                            ]);
                        Route::post('/create',
                            [
                                'as' => 'LaravelAdminPermissionsCreatePost',
                                'uses' => 'Joselfonseca\LaravelAdmin\Http\Controllers\Users\PermissionsController@store',
                                'middleware' => 'Joselfonseca\LaravelAdmin\Http\Middleware\AclMiddleware:permissions-crud'
                            ]);
                        Route::get('/{id}/edit',
                            [
                                'as' => 'LaravelAdminPermissionsEdit',
                                'uses' => 'Joselfonseca\LaravelAdmin\Http\Controllers\Users\PermissionsController@edit',
                                'middleware' => 'Joselfonseca\LaravelAdmin\Http\Middleware\AclMiddleware:permissions-crud'
                            ]);
                        Route::post('/{id}/edit',
                            [
                                'as' => 'LaravelAdminPermissionsEditPost',
                                'uses' => 'Joselfonseca\LaravelAdmin\Http\Controllers\Users\PermissionsController@update',
                                'middleware' => 'Joselfonseca\LaravelAdmin\Http\Middleware\AclMiddleware:permissions-crud'
                            ]);
                        Route::delete('/{id}/delete',
                            [
                                'as' => 'LaravelAdminPermissionsDelete',
                                'uses' => 'Joselfonseca\LaravelAdmin\Http\Controllers\Users\PermissionsController@destroy',
                                'middleware' => 'Joselfonseca\LaravelAdmin\Http\Middleware\AclMiddleware:permissions-crud'
                            ]);
                    });
            });
    });
