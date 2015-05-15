<?php

return [
    /**
     * The App name
     * */
    'appName' => "Laravel Admin Panel",
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
                'permissions' => [],
                'submenus' => [
                    'List' => [
                        'link' => [
                            'link' => 'backend/users',
                            'text' => 'List',
                        ],
                        'permissions' => [],
                    ],
                    'Roles' => [
                        'link' => [
                            'link' => 'backend/roles',
                            'text' => 'Roles',
                        ],
                        'permissions' => [],
                    ],
                    'Permissions' => [
                        'link' => [
                            'link' => 'backend/permissions',
                            'text' => 'Permissions',
                        ],
                        'permissions' => [],
                    ]

                ]
            ],
        ]
    ]
];
