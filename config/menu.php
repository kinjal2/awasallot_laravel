<?php
return [
    'superadmin' => [
        'Dashboard' => [
            'title' => 'menus.Dashboard',
            'icon' => 'nav-icon fas fa-tachometer-alt',
            'permission_route' => 'admin.dashboard.admindashboard',
            'route' => [
                'admin.dashboard.admindashboard'
            ],
            'link' => 'admin.dashboard.admindashboard',
            'submenu' => []
        ],
       'Quarters' => [
            'title' => 'menus.Quarters',
            'icon' => 'icon-home',
            'permission_route' => 'quarters',
            'route' => [
                'quarters'
            ],
            'link' => 'quarters',
            'submenu' => [
					'Request List (Normal)' => [
                    'title' => 'menus.Request List (Normal)',
                    'icon' => 'fa fa-list',
                    'permission_route' => 'reports',
                    'route' => [
                        'reports'
                    ],
                    'link' => 'reports',
                ],
					'Request List (Priority)' => [
                    'title' => 'menus.Request List (Priority)',
                    'icon' => 'fa fa-list',
                    'permission_route' => 'reports',
                    'route' => [
                        'reports'
                    ],
                    'link' => 'reports',
                ],
					'New Request' => [
                    'title' => 'menus.New Request',
                    'icon' => 'fa fa-paper-plane',
                    'permission_route' => 'reports',
                    'route' => [
                        'reports'
                    ],
                    'link' => 'reports',
                ],
			]
        ],
		 'Reports' => [
            'title' => 'menus.Reports',
            'icon' => 'icon-home',
            'permission_route' => 'reports',
            'route' => [
                'reports'
            ],
            'link' => 'reports',
            'submenu' => [
				'Waiting List' => [
                    'title' => 'menus.Waiting List',
                    'icon' => 'fa fa-cogs ',
                    'permission_route' => 'reports',
                    'route' => [
                        'reports'
                    ],
                    'link' => 'reports',
                ],
				'Quarter Allotment' => [
                    'title' => 'menus.Quarter Allotment ',
                    'icon' => 'fa fa-cogs ',
                    'permission_route' => 'reports',
                    'route' => [
                        'reports'
                    ],
                    'link' => 'reports',
                ],
					'Vacant Quarter List' => [
                    'title' => 'menus.Vacant Quarter List',
                    'icon' => 'fa fa-cogs ',
                    'permission_route' => 'reports',
                    'route' => [
                        'reports'
                    ],
                    'link' => 'reports',
                ],
				
				 
			]
        ],
		 'User' => [
            'title' => 'menus.User',
            'icon' => 'icon-home',
            'permission_route' => 'User',
            'route' => [
                'user'
            ],
            'link' => 'user',
            'submenu' => []
        ],
	],
	'admin' => [
	'Dashboard' => [
            'title' => 'menus.Dashboard',
            'icon' => 'nav-icon fas fa-tachometer-alt',
            'permission_route' => 'user.dashboard.userdashboard',
            'route' => [
                'userdashboard'
            ],
            'link' => 'user.dashboard.userdashboard',
            'submenu' => []
        ],
        'Profile' => [
            'title' => 'menus.Profile',
            'icon' => 'nav-icon fa fa-user',
            'permission_route' => 'user.profile',
            'route' => [
                'profile'
            ],
            'link' => 'user.profile',
            'submenu' => []
        ],
        'Quarters' => [
            'title' => 'menus.Quarters',
            'icon' => 'nav-icon fa fa-Home',
            'permission_route' => 'user.Quarters',
            'route' => [
                'user.Quarters'
            ],
            'link' => 'user.Quarters',
            'submenu' => [
                'New Request' => [
                    'title' => 'menus.New Quarter',
                    'icon' => 'nav-icon fa fa-Home ',
                    'permission_route' => 'user.Quarters',
                    'route' => [
                        'quartersuser'
                    ],
                    'link' => 'user.Quarters',
                ],
                'Higher Category Quarter Request' => [
                    'title' => 'menus.Higher Category Quarter',
                    'icon' => 'nav-icon fa fa-Home ',
                    'permission_route' => 'user.Quarter.higher',
                    'route' => [
                        'user.Quarter.higher'
                    ],
                    'link' => 'user.Quarter.higher',
                ],
                
                'Request History' => [
                    'title' => 'menus.Request History',
                    'icon' => 'nav-icon fa fa-history',
                    'permission_route' => 'user.Quarter.history',
                    'route' => [
                        'user.Quarter.history'
                    ],
                    'link' => 'user.Quarter.history',
                ],

            ]
        ],
        'Logout' => [
            'title' => 'menus.Logout',
            'icon' => 'nav-icon fas fa-tachometer-alt',
            'permission_route' => 'logout',
            'route' => [
                'logout'
            ],
            'link' => 'logout',
            'submenu' => []
        ],
	],
];
