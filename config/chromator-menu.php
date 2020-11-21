<?php
return [
    'merge_to_navigation' => true,
    'navs' => [
        'sidebar' => [
            [
                'name' => 'Chromator',
                'link' => '/panel/chromator/creator',
                'icon' => 'speed',
                'key' => 'chromator::menus.chromator',
                'children_top' => [
                    [
                        'name' => 'Creator',
                        'link' => '/panel/chromator/creator',
                        'key' => 'chromator::menus.creator',
                    ],
                    [
                        'name' => 'Example',
                        'link' => '/panel/chromator/example',
                        'key' => 'chromator::menus.example',
                    ]
                ],
                'children' => [
                    [
                        'name' => 'Creator',
                        'link' => '/panel/chromator/creator',
                        'key' => 'chromator::menus.creator',
                    ],
                    [
                        'name' => 'Example',
                        'link' => '/panel/chromator/example',
                        'key' => 'chromator::menus.example',
                    ]
                ],
            ]
        ],
    ]
];
