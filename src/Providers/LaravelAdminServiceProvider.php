<?php

namespace Joselfonseca\LaravelAdmin\Providers;

use View;
use Config;
use JavaScript;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Joselfonseca\LaravelAdmin\Repositories\UserRepository;
use Joselfonseca\LaravelAdmin\Contracts\UserRepositoryContract;

/**
 * Class LaravelAdminServiceProvider
 * @package Joselfonseca\LaravelAdmin\Providers
 */
class LaravelAdminServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * @var array
     */
    protected $providers = [
        \Joselfonseca\LaravelAdmin\Providers\MenuServiceProvider::class,
        \Zizaco\Entrust\EntrustServiceProvider::class,
        \Barryvdh\Debugbar\ServiceProvider::class,
        \UxWeb\SweetAlert\SweetAlertServiceProvider::class,
        \Laracasts\Utilities\JavaScript\JavaScriptServiceProvider::class,
        \Styde\Html\HtmlServiceProvider::class,
        \Prettus\Repository\Providers\RepositoryServiceProvider::class,
        \Yajra\Datatables\DatatablesServiceProvider::class,
    ];
    /**
     * @var array
     */
    protected $aliases = [
        'Entrust' => \Zizaco\Entrust\EntrustFacade::class,
        'Form' => \Collective\Html\FormFacade::class,
        'Html' => \Collective\Html\HtmlFacade::class,
        'Debugbar' => \Barryvdh\Debugbar\Facade::class,
        'SweetAlert' => \UxWeb\SweetAlert\SweetAlert::class,
        'Datatables' => \Yajra\Datatables\Facades\Datatables::class,

    ];

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryContract::class, UserRepository::class);
        $this->registerCommands()
            ->registerOtherProviders()
            ->registerAliases();
    }

    /**
     * Boot the service provider
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../resources/lang' => base_path('resources/lang'),
        ], 'la-lang');
        $this->publishes([
            __DIR__ . '/../../resources/views/' => base_path('resources/views/vendor/LaravelAdmin'),
        ], 'la-views');
        $this->publishes([
            __DIR__ . '/../../config/config.php' => config_path('laravel-admin.php'),
        ], 'la-config');
        $this->publishes([
            __DIR__ . '/../../public' => public_path('vendor/laravelAdmin'),
        ], 'la-public');
        $this->publishes([
            __DIR__ . '/../../migrations' => base_path('database/migrations'),
        ], 'la-migrations');
        $this->loadViewsConfiguration()
            ->loadRoutes()
            ->registerTranslations();
        $this->mergeConfigFrom(
            __DIR__.'/../../config/config.php',
            'laravel-admin'
        );
        Config::set('entrust.role', 'Joselfonseca\LaravelAdmin\Services\Users\Role');
        Config::set('entrust.permission', 'Joselfonseca\LaravelAdmin\Services\Users\Permission');
        Config::set('javascript.bind_js_vars_to_this_view', 'LaravelAdmin::layouts.withsidebar');
        $this->setLangJs();
    }

    /**
     * Register other Service Providers
     * @return $this
     */
    private function registerOtherProviders()
    {
        foreach ($this->providers as $provider) {
            $this->app->register($provider);
        }

        return $this;
    }

    /**
     * Register some Aliases
     * @return $this
     */
    protected function registerAliases()
    {
        foreach ($this->aliases as $alias => $original) {
            AliasLoader::getInstance()->alias($alias, $original);
        }

        return $this;
    }

    /**
     * Load The views configuration
     * @return $this
     */
    private function loadViewsConfiguration()
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views/', 'LaravelAdmin');

        return $this;
    }

    /**
     * Load the Routes File
     * @return $this
     */
    private function loadRoutes()
    {
        include __DIR__ . '/../Http/routes.php';

        return $this;
    }

    /**
     * Register some artisan commands
     * @return $this
     */
    private function registerCommands()
    {
        $this->app->bind('command.laravel-admin.install', 'Joselfonseca\LaravelAdmin\Console\Installer');
        $this->commands('command.laravel-admin.install');
        return $this;
    }

    /**
     * Register the translations
     * @return $this
     */
    private function registerTranslations()
    {
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'LaravelAdmin');
        return $this;
    }

    /**
     * set the lang for the JS
     */
    protected function setLangJs()
    {
        JavaScript::put([
            'la_lang' => app('translator')->getLoader()->load(app()->getLocale(), 'laravel-admin', 'LaravelAdmin')
        ]);
    }
}
