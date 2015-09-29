# The ACL

I am using [https://github.com/Zizaco/entrust/](https://github.com/Zizaco/entrust/) for the ACL, since the package comes with an admin interface for the permissions, you can create, edit or assign the permissions there, or you can also use Entrust methods to do so.

## Middleware

Laravel admin ships with a middleware to protect routes. Simply add the middleware to your route definition and give it the permission as a parameter like so:
 
```php
    'middleware' => 'Joselfonseca\LaravelAdmin\Http\Middleware\AclMiddleware:list-users' 
```

You can give it multiple permissions also separating them with a coma (,):

```php
    'middleware' => 'Joselfonseca\LaravelAdmin\Http\Middleware\AclMiddleware:list-users,see-something' 
```

## Example

```php
    Route::get('/',[
        'as' => 'LaravelAdminUsers',
        'uses' => 'Joselfonseca\LaravelAdmin\Http\Controllers\Users\UsersController@index',
        'middleware' => 'Joselfonseca\LaravelAdmin\Http\Middleware\AclMiddleware:list-users'
    ]);
```

## Protecting Routes

Say you want to protect a route so only users with the correct permission are able to access it, use the Entrust alias for that in a service provider or bootstrap file.

```php 
    \Entrust::routeNeedsPermission('backend/permissions*', array('permissions-crud'), view('LaravelAdmin::errors.unauthorized'), false);
```
First parameter is the route you want to protect, the second receives an array of permissions required to see the route, third would be the return, this can be a view or a text, its up to you, laravel admin gives you a simple view for that, and last parameter will tell Entrust if all of the permissions are required to access the route. [More info.](https://github.com/Zizaco/entrust/blob/master/README.md#short-syntax-route-filter)

For more advance ACL usage, please refer to [Entrust Documentation](https://github.com/Zizaco/entrust/blob/master/README.md#usage)