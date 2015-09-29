# Authentication

Laravel Admin uses Laravel authentication Driver, if you need to protect routes for authenticated users in the admin panel you can use the middleware like the following example:
 
```php 
    Route::group(['middleware' => 'Joselfonseca\LaravelAdmin\Http\Middleware\AuthMiddleware'], function(){});
```

