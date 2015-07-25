<?php

namespace Joselfonseca\LaravelAdmin\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use View;

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
        'Joselfonseca\LaravelAdmin\Providers\MenuServiceProvider',
        'Zizaco\Entrust\EntrustServiceProvider',
        'Collective\Html\HtmlServiceProvider',
        'TwigBridge\ServiceProvider',
        'Laracasts\Flash\FlashServiceProvider',
        'Barryvdh\Debugbar\ServiceProvider',
        'Kris\LaravelFormBuilder\FormBuilderServiceProvider'
    ];
    /**
     * @var array
     */
    protected $aliases = [
        'Entrust' => 'Zizaco\Entrust\EntrustFacade',
        'Form' => 'Collective\Html\FormFacade',
        'Html' => 'Collective\Html\HtmlFacade',
        'Twig' => 'TwigBridge\Facade\Twig',
        'Flash' => 'Laracasts\Flash\Flash',
        'Debugbar' => 'Barryvdh\Debugbar\Facade',
        'FormBuilder' => 'Kris\LaravelFormBuilder\Facades\FormBuilder'
    ];

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
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
            __DIR__ . '/../Views/' => base_path('resources/views/vendor/LaravelAdmin'),
        ], 'la-views');
        $this->publishes([
            __DIR__ . '/../Config/laravel-admin.php' => config_path('laravel-admin.php'),
        ], 'la-config');
        $this->publishes([
            __DIR__ . '/../../public' => public_path('vendor/laravelAdmin'),
        ], 'la-public');
        $this->loadViewsConfiguration()
            ->loadRoutes()
            ->registerTranslations();
        \Config::set('entrust.role', 'Joselfonseca\LaravelAdmin\Services\Users\Role');
        \Config::set('entrust.permission', 'Joselfonseca\LaravelAdmin\Services\Users\Permission');
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
        $this->loadViewsFrom(__DIR__ . '/../Views/', 'LaravelAdmin');
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

}
