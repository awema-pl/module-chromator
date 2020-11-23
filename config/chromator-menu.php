<?php
return [
    'merge_to_navigation' => true,
    'navs' => [
        'sidebar' => [
            [
                'name' => 'Chromator',
                'link' => '/chromator/creator',
                'icon' => 'speed',
                'key' => 'chromator::menus.chromator',
                'children_top' => [
                    [
                        'name' => 'Creator',
                        'link' => '/chromator/creator',
                        'key' => 'chromator::menus.creator',
                    ],
                    [
                        'name' => 'Example',
                        'link' => '/chromator/example',
                        'key' => 'chromator::menus.example',
                    ]
                ],
                'children' => [
                    [
                        'name' => 'Creator',
                        'link' => '/chromator/creator',
                        'key' => 'chromator::menus.creator',
                    ],
                    [
                        'name' => 'Example',
                        'link' => '/chromator/example',
                        'key' => 'chromator::menus.example',
                    ]
                ],
            ]
        ],
        'guestSidebar' => [
            [
                'name' => 'Chromator',
                'link' => '/chromator/creator',
                'icon' => 'speed',
                'key' => 'chromator::menus.chromator',
                'children_top' => [
                    [
                        'name' => 'Creator',
                        'link' => '/chromator/creator',
                        'key' => 'chromator::menus.creator',
                    ],
                ],
                'children' => [
                    [
                        'name' => 'Creator',
                        'link' => '/chromator/creator',
                        'key' => 'chromator::menus.creator',
                    ],
                ],
            ]
        ],
    ]
];
