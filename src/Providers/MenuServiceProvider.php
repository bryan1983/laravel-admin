<?php

namespace Joselfonseca\LaravelAdmin\Providers;

use View;
use Illuminate\Support\ServiceProvider;

/**
 * Class MenuServiceProvider
 * @package Joselfonseca\LaravelAdmin\Providers
 */
class MenuServiceProvider extends ServiceProvider
{

    /**
     * Boot the provider
     */
    public function boot()
    {
        $menu = $this->app->make('admin.menu');
        $menu->addMenu([
            'users' => [
                'link' => [
                    'link' => '#',
                    'text' => '<i class="fa fa-user"></i> ' . trans('laravel-admin.usersTitle'),
                ],
                'permissions' => ['list-users'],
                'submenus' => [
                    'list' => [
                        'link' => [
                            'link' => config('laravel-admin.routePrefix', 'backend').'/users',
                            'text' => trans('laravel-admin.usersList'),
                        ],
                        'permissions' => ['list-users'],
                    ],
                    'roles' => [
                        'link' => [
                            'link' => config('laravel-admin.routePrefix', 'backend').'/roles',
                            'text' => trans('laravel-admin.userRoles'),
                        ],
                        'permissions' => ['roles-crud'],
                    ]
                ]
            ],
            'logs' => [
                'link' => [
                    'link' => '#',
                    'text' => '<i class="fa fa-file"></i> ' . trans('laravel-admin.logs'),
                ],
                'permissions' => ['system-logs'],
                'submenus' => [
                    'requests' => [
                        'link' => [
                            'link' => config('laravel-admin.routePrefix', 'backend').'/system-logs/requests',
                            'text' => trans('laravel-admin.requestsLogs'),
                        ],
                        'permissions' => ['system-logs'],
                    ]
                ]
            ]
        ]);
        $this->setMenuComposer($menu);
    }

    /**
     * Register Stuff in the application
     */
    public function register()
    {
        $this->app->singleton('admin.menu',
            'Joselfonseca\LaravelAdmin\Services\Menu\MenuBuilder');
    }

    /**
     * Menu View Composer
     * @param $menu
     * @return $this
     */
    private function setMenuComposer($menu)
    {
        View::composer('*', function ($view) use ($menu) {
            $view->with('menu', $menu);
        });

        return $this;
    }
}
