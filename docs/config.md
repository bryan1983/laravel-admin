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
        * make for Wim_cartago
        **/
        'viewErrors' => false,
        /**
         * Route prefix for admin routes
         */
        'routePrefix' => 'backend'
    ];
```
You can change your App name updating the `appName` option<br />
You can modify where the user is taken after the successful login with the `'afterLoginRoute'` option. <br />
You can also set `viewErrors` to true to have a partial with the errors display for every page. <br />
You can also set `routePrefix` to change the prefix of the panel routes for something like `admin`. <br />