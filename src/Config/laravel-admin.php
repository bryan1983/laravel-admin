<?php

return [
	/**
	 * The App name
	**/
	'appName' => "Laravel Admin Panel",
    /**
     * The route prefix or the administrator
    **/
    'routePrefix' => 'backend',
    /**
     * Menu Items
    **/ 
    'menu' => [
    	'sidebar' => [
            'Dashboard' => [
                'link' => [
                    'link' => '#',
                    'text' => '<i class="fa fa-dashboard fa-lg"></i> Dashboard',
                ],
                'permissions' => []
            ],
        ]
    ]
];