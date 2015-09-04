# Laravel Admin Panel Installation

To install this package, open your composer.json file and add "joselfonseca/laravel-admin" : "0.4.*"

```json
    "require": {
        "laravel/framework": "5.1.*",
        "joselfonseca/laravel-admin" : "0.4.*"
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

Once the service provider has been added, make sure you are using the soft delete setting in your User model, if you are not sure, please check that your Users table has the deleted_at column. if you don't have it please create a migration to add that column. more info: [http://laravel.com/docs/5.1/eloquent#soft-deleting](http://laravel.com/docs/5.1/eloquent#soft-deleting)

Once you have the deleted_at column in your users table, open the user model and add the trait which will be necessary for the installation process, please note that the trait already imports the soft deleting trait mentioned in the laravel documentation.

```php
    use Joselfonseca\LaravelAdmin\Traits\LaravelAdminUser;
```

Your user model should look like this

```php
    
    <?php namespace App;
    use Illuminate\Auth\Authenticatable;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Auth\Passwords\CanResetPassword;
    use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
    use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
    use Joselfonseca\LaravelAdmin\Traits\LaravelAdminUser;
    class User extends Model implements AuthenticatableContract, CanResetPasswordContract
    {
        use Authenticatable, CanResetPassword, LaravelAdminUser;
        /**
         * The database table used by the model.
         *
         * @var string
         */
        protected $table = 'users';
        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = ['name', 'email', 'password'];
        /**
         * The attributes excluded from the model's JSON form.
         *
         * @var array
         */
        protected $hidden = ['password', 'remember_token'];
    }
```
Run this command in the CLI to start the installation process.

```
    php artisan laravelAdmin:install
```

This will ask you for an email to create the default admin user, as well as the password. After that it will publish some other migrations, migrate the database and it will also publish some public assets and configuration file

Once that is done you can navigate to http://yoursite.dev/backend/login and you will be able to log in with the credentials provided.