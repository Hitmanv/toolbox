<?php

return [
    [
        'title' => '总览',
        'icon'  => 'home',
    ],
    [
        'title'    => '用户管理',
        'icon'     => 'user',
        'children' => [
            [
                'title' => '用户列表',
                'url'   => '/users',
            ],
        ],
    ],
];
