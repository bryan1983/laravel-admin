# Config File

If you want to publish your configuration, run:

```bash
    php artisan vendor:publish --provider="Joselfonseca\LaravelAdmin\Providers\LaravelAdminServiceProvider"
```
However, at the time of installation it should already be published.

## The file

```php
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

```
- You can change your App name updating the `appName` option.
- You can modify where the user is taken after the successful login with the `'afterLoginRoute'` option.
- You can also set `routePrefix` to change the prefix of the panel routes for something like `admin`.
- You can apply a Middleware stack to the package routes by providing the middleware classes in the `middleware` array
- You can change the application version number that is shown in the footer by changing the value in the `version` key
- You can change the copyright message that is shown in the footer by changing the value in the `copyright` key