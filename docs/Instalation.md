# Laravel Admin Panel Installation

To install this package, open your composer.json file and add "joselfonseca/laravel-admin" : "0.4.*"

```json
    "require": {
        "laravel/framework": "5.1.*",
        "joselfonseca/laravel-admin" : "0.5.*"
    }
```
Then run composer update and wait until it installs the dependencies.
Once all the dependencies are installed, open the config/app.php file and add the Laravel Admin Service provider.

```php
    'providers' => [
        ...
        Joselfonseca\LaravelAdmin\Providers\LaravelAdminServiceProvider::class,
        ...
    ]
```

Once the service provider has been added, make sure your user model extends the class `Joselfonseca\LaravelAdmin\Services\Users\User` like the following example

```php

    namespace JarvisPlatform;

    use Joselfonseca\LaravelAdmin\Services\Users\User as Model;

    class User extends Model {

    }

```

Once your model extends de laravel admin user model, publish the assets and migrations for the package running

```bash
    php artisan vendor:publish --provider="Joselfonseca\LaravelAdmin\Providers\LaravelAdminServiceProvider"
```

Migrate the database

```php
    php artisan migrate
```

Run this command in the CLI to start the installation process.

```
    php artisan laravelAdmin:install
```

Once that is done you can navigate to http://yoursite.dev/backend/login and you will be able to log in with the credentials `admin@admin.com` and password `secret`.