<?php

return [
    /**
     * The App name
     * */
    'appName' => "Laravel Admin Panel",
    /**
     * Route to go after login
    **/ 
    'afterLoginRoute' => 'backend/users',
    /**
     * Menu Items
     * */
    'menu' => [
        'sidebar' => [
            'Dashboard' => [
                'link' => [
                    'link' => 'backend/home',
                    'text' => '<i class="fa fa-dashboard fa-lg"></i> Dashboard',
                ],
                'permissions' => []
            ],
            'Users' => [
                'link' => [
                    'link' => '#',
                    'text' => '<i class="fa fa-user fa-lg"></i> Users',
                ],
                'permissions' => ['list-users'],
                'submenus' => [
                    'List' => [
                        'link' => [
                            'link' => 'backend/users',
                            'text' => 'List',
                        ],
                        'permissions' => ['list-users'],
                    ],
                    'Roles' => [
                        'link' => [
                            'link' => 'backend/roles',
                            'text' => 'Roles',
                        ],
                        'permissions' => ['roles-crud'],
                    ],
                    'Permissions' => [
                        'link' => [
                            'link' => 'backend/permissions',
                            'text' => 'Permissions',
                        ],
                        'permissions' => ['permissions-crud'],
                    ]

                ]
            ],
        ]
    ]
];
