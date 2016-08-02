<?php
return [
    /**
     * The App name
     * */
    'appName' => "Laravel Admin Panel",
    /**
     * Route to go after login
    **/ 
    'afterLoginRoute' => 'users',
    /**
    * Add Errors & Logging from Validator Laravel 5.*
    **/
    'viewErrors' => false,
    /**
     * Route prefix for admin routes
     */
    'routePrefix' => 'backend',
    /**
     * Middleware stack for routes
     */
    'middleware' => [

    ]
];
