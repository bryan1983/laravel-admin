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
                    'link' => url('backend'),
                    'text' => '<i class="fa fa-dashboard fa-lg"></i> Dashboard',
                ],
                'permissions' => []
            ],
            'Users' => [
                'link' => [
                    'link' => '#',
                    'text' => '<i class="fa fa-user fa-lg"></i> Usuarios',
                ],
                'permissions' => [],
                'submenus' => [
                    'List' => [
                        'link' => [
                            'link' => url('backend/users/'),
                            'text' => 'Listado',
                        ],
                        'permissions' => [],
                    ]
                ]
            ],
        ]
    ]
];
