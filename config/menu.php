<?php
return [
    'superadmin' => [
        'Dashboard' => [
            'title' => 'menus.Dashboard',
            'icon' => 'nav-icon fas fa-tachometer-alt',
            'permission_route' => 'admin.dashboard.admindashboard',
            'route' => [
                'admindashboard'
            ],
            'link' => 'admin.dashboard.admindashboard',
            'submenu' => []
        ],
       'Quarters' => [
            'title' => 'menus.Quarters',
            'icon' => 'icon-home',
            'permission_route' => 'quarters',
            'route' => [
                'quarters',
                'quarterlistnormal',
                'quarterlistpriority',
                'quarterlistnew'
            ],
            'link' => 'quarters',
            'submenu' => [
					'Request List (Normal)' => [
                    'title' => 'menus.Request List (Normal)',
                    'icon' => 'fa fa-list',
                    'permission_route' => 'quarter.list.normal',
                    'route' => [
                        'quarterlistnormal'
                    ],
                    'link' => 'quarter.list.normal',
                ],
					'Request List (Priority)' => [
                    'title' => 'menus.Request List (Priority)',
                    'icon' => 'fa fa-list',
                    'permission_route' => 'quarterlistpriority*',
                    'route' => [
                        'quarterlistpriority'
                    ],
                    'link' => 'quarterlistpriority.index',
                ],
				/*	'New Request' => [
                    'title' => 'menus.New Request',
                    'icon' => 'fa fa-paper-plane',
                    'permission_route' => 'quarter.list.new',
                    'route' => [
                        'quarterlistnew'
                    ],
                    'link' => 'quarter.list.new',
                ],*/
			]
        ],
		 'Reports' => [
            'title' => 'menus.Reports',
            'icon' => 'icon-home',
            'permission_route' => 'reports',
            'route' => [
                'reports',
                'waitinglist',
                'allotmentlist',
                'vacantlist',
                'quarter-occupancy'
            ],
            'link' => '#',
            'submenu' => [
				'Waiting List' => [
                    'title' => 'menus.Waiting List',
                    'icon' => 'fa fa-spinner',
                    'permission_route' => 'waiting.list',
                    'route' => [
                        'waitinglist'
                    ],
                    'link' => 'waiting.list',
                ],
				'Quarter Allotment' => [
                    'title' => 'menus.Quarter Allotment ',
                    'icon' => 'fa fa-thumbs-up',
                    'permission_route' => 'allotment.list',
                    'route' => [
                        'allotmentlist'
                    ],
                    'link' => 'allotment.list',
                ],
					'Vacant Quarter List' => [
                    'title' => 'menus.Vacant Quarter List',
                    'icon' => 'fa fa-users ',
                    'permission_route' => 'vacant.list',
                    'route' => [
                        'vacantlist'
                    ],
                    'link' => 'vacant.list',
                ],
                'Quarter Occupancy' => [
                    'title' => 'menus.Quarter Occupancy',
                    'icon' => 'fa fa-bars',
                    'permission_route' => 'quarter.occupancy',
                    'route' => [
                        'quarter-occupancy'
                    ],
                    'link' => 'quarter.occupancy',
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
         'Important link' => [
            'title' => 'menus.Important link',
            'icon' => 'nav-icon fas fa-link ',
            'permission_route' => 'masterquartertype*',
            'route' => [
                'masterquartertype',
                'masterarea'
            ],
            'link' => '#',
            'submenu' => [
                'Quarter Type' => [
                    'title' => 'menus.Quarter Type',
                    'icon' => 'fa fa-home',
                    'permission_route' => 'masterquartertype*',
                    'route' => [
                        'masterquartertype'
                    ],
                    'link' => 'masterquartertype.index',
                ],
                'Area' => [
                    'title' => 'menus.Area',
                    'icon' => 'nav-icon fas fa-area-chart ',
                    'permission_route' => 'masterarea*',
                    'route' => [
                        'masterarea'
                    ],
                    'link' => 'masterarea.index',
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
                'user.Quarters',
                'quartersuser',
                'user.Quarter.higher'
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
