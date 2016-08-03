<?php
return [
    /*
    |--------------------------------------------------------------------------
    | App Name
    |--------------------------------------------------------------------------
    |
    | Name of your app, will be displayed in the top left corner
    |
    */

    'appName' => "Laravel Admin Panel",

    /*
    |--------------------------------------------------------------------------
    | Route After Login
    |--------------------------------------------------------------------------
    |
    | Name of the route where you want to go after the login
    |
    */

    'afterLoginRoute' => 'users',

    /*
    |--------------------------------------------------------------------------
    | Route Prefix
    |--------------------------------------------------------------------------
    |
    | Prefix for admin routes, it defaults to backend but you can change it to admin
    | This will make the routes have a prefix of admin like http://example.com/admin/
    |
    */

    'routePrefix' => 'backend',

    /*
    |--------------------------------------------------------------------------
    | Middleware Stack
    |--------------------------------------------------------------------------
    |
    | Middleware Stack to apply to the package routes, this will be applied to
    | all routes in the package
    |
    */

    'middleware' => [

    ],

    /*
    |--------------------------------------------------------------------------
    | Application Version
    |--------------------------------------------------------------------------
    |
    | Your application version, it will be displayed in the footer
    |
    */

    'version' => '1.0',

    /*
    |--------------------------------------------------------------------------
    | Application copyright
    |--------------------------------------------------------------------------
    |
    | Your application copyright, it will be displayed in the footer
    |
    */

    'copyright' => 'Copyright © Laravel Admin - All rights reserved.'
];
