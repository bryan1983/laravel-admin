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
            'Users' => [
                'link' => [
                    'link' => '#',
                    'text' => '<i class="fa fa-user"></i> ' . trans('laravel-admin.usersTitle'),
                ],
                'permissions' => ['list-users'],
                'submenus' => [
                    'List' => [
                        'link' => [
                            'link' => 'backend/users',
                            'text' => trans('laravel-admin.usersList'),
                        ],
                        'permissions' => ['list-users'],
                    ],
                    'Roles' => [
                        'link' => [
                            'link' => 'backend/roles',
                            'text' => trans('laravel-admin.userRoles'),
                        ],
                        'permissions' => ['roles-crud'],
                    ],
                    'Permissions' => [
                        'link' => [
                            'link' => 'backend/permissions',
                            'text' => trans('laravel-admin.permissions'),
                        ],
                        'permissions' => ['permissions-crud'],
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