<?php

namespace Joselfonseca\LaravelAdmin\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use View;

class LaravelAdminServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    protected $providers = [
        'Joselfonseca\LaravelAdmin\Providers\MenuServiceProvider',
        'Zizaco\Entrust\EntrustServiceProvider',
        'Collective\Html\HtmlServiceProvider',
        'TwigBridge\ServiceProvider',
        'Laracasts\Flash\FlashServiceProvider',
        'Barryvdh\Debugbar\ServiceProvider',
        'Kris\LaravelFormBuilder\FormBuilderServiceProvider'
    ];
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

    public function boot()
    {
        $this->loadViewsConfiguration()
            ->loadRoutes()
            ->publishesConfiguration()
            ->publishesAssets()
            ->registerTranslations();
        \Config::set('entrust.role', 'Joselfonseca\LaravelAdmin\Services\Users\Role');
        \Config::set('entrust.permission', 'Joselfonseca\LaravelAdmin\Services\Users\Permission');
    }

    private function registerOtherProviders()
    {
        foreach ($this->providers as $provider) {
            $this->app->register($provider);
        }

        return $this;
    }

    protected function registerAliases()
    {
        foreach ($this->aliases as $alias => $original) {
            AliasLoader::getInstance()->alias($alias, $original);
        }

        return $this;
    }

    private function loadViewsConfiguration()
    {
        $this->loadViewsFrom(__DIR__ . '/../Views/', 'LaravelAdmin');
        $this->publishes([
            __DIR__ . '/../Views/' => base_path('resources/views/vendor/LaravelAdmin'),
        ]);

        return $this;
    }

    private function publishesConfiguration()
    {
        $this->publishes([
            __DIR__ . '/../Config/laravel-admin.php' => config_path('laravel-admin.php'),
        ]);

        return $this;
    }

    private function publishesAssets()
    {
        $this->publishes([
            __DIR__ . '/../../public' => public_path('vendor/laravelAdmin'),
        ], 'LAPublic');

        return $this;
    }

    private function loadRoutes()
    {
        include __DIR__ . '/../Http/routes.php';

        return $this;
    }

    private function registerCommands()
    {
        $this->app->bind('command.laravel-admin.install', 'Joselfonseca\LaravelAdmin\Console\Installer');
        $this->commands('command.laravel-admin.install');

        return $this;
    }

    private function registerTranslations()
    {
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'LaravelAdmin');
        $this->publishes([
            __DIR__ . '/../../resources/lang' => base_path('resources/lang'),
        ]);

        return $this;
    }

}
