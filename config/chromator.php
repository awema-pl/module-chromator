<?php
return [
    // this resources has been auto load to layout
    'dist' => [
        'js/main.js',
        'js/main.legacy.js',
        'css/main.css',
    ],
    'routes' => [
        // all routes is active
        'active' => true,
        // section installations
        'installation' => [
            'active' => true,
            'prefix' => '/installation/chromator',
            'name_prefix' => 'chromator.installation.',
            // this routes has beed except for installation module
            'expect' => [
                'module-assets.assets',
                'chromator.installation.index',
                'chromator.installation.store',
            ]
        ],
        'creator' => [
            'active' => true,
            'prefix' => '/panel/chromator/creator',
            'name_prefix' => 'chromator.creator.',
            'middleware' => [
                'web',
                'auth',
                'verified'
            ]
        ],
        'example' => [
            'active' => false,
            'prefix' => '/panel/chromator/example',
            'name_prefix' => 'chromator.example.',
            'middleware' => [
                'web',
                'auth',
                'verified'
            ]
        ],
        'information' => [
            'active' => true,
            'prefix' => '/api/chromator/information',
            'name_prefix' => 'api.chromator.information.',
            'middleware' => [
                'auth:sanctum',
            ]
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Use permissions in application.
    |--------------------------------------------------------------------------
    |
    | This permission has been insert to database with migrations
    | of module permission.
    |
    */
    'permissions' =>[
        'install_packages'
    ],

    /*
    |--------------------------------------------------------------------------
    | Can merge permissions to module permission
    |--------------------------------------------------------------------------
    */
    'merge_permissions' => true,

    'installation' => [
        'auto_redirect' => [
            // user with this permission has been automation redirect to
            // installation package
            'permission' => 'install_packages'
        ]
    ],

    'database' => [
        'tables' => [
            'chromator_histories' =>'chromator_histories',
        ]
    ],

];
