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
        'Kodeine\Acl\AclServiceProvider',
        'Collective\Html\HtmlServiceProvider',
        'TwigBridge\ServiceProvider',
        'Laracasts\Flash\FlashServiceProvider'
    ];
    protected $aliases = [
        'Form' => 'Collective\Html\FormFacade',
        'Html' => 'Collective\Html\HtmlFacade',
        'Twig' => 'TwigBridge\Facade\Twig',
        'Flash' => 'Laracasts\Flash\Flash'
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
        $this->app->singleton('Joselfonseca\LaravelAdmin\Services\Menu\MenuBuilder', 'Joselfonseca\LaravelAdmin\Services\Menu\MenuBuilder');
        $menu = $this->app->make('Joselfonseca\LaravelAdmin\Services\Menu\MenuBuilder');
        $this->loadViewsConfiguration()
             ->loadRoutes()
             ->publishesConfiguration()
             ->publishesAssets()
             ->registerTranslations()
             ->setMenuComposer($menu);
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
        ], 'LAconfig');
        return $this;
    }

    private function publishesAssets()
    {
        $this->publishes([
            __DIR__ . '/../../public' => public_path('vendor/laravelAdmin'),
        ], 'public');
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
        ], 'LALang');
        return $this;
    }
    private function setMenuComposer($menu)
    {
        View::composer('*', function ($view) use ($menu) {
            $menu->setMenu(config('laravel-admin.menu'));
            $view->with('menu', $menu);
        });
        return $this;
    }

}
