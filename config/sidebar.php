<?php

return [
    [
        'title' => 'Dashboard',
        'icon' => 'fas-house',
        'route' => 'dashboard',
        'active' => 'dashboard*',
        'permission' => null, // Bebas diakses semua user terautentikasi
    ],
    [
        'title' => 'User Management',
        'icon' => 'fas-users',
        'active' => ['users*', 'roles*', 'permissions*'],
        'permission' => ['view-users', 'view-roles', 'view-permissions'], // Parent muncul jika punya salah satu
        'children' => [
            [
                'title' => 'Users',
                'icon' => 'fas-user',
                'route' => 'users.index',
                'active' => 'users*',
                'permission' => 'view-users',
            ],
            [
                'title' => 'Roles',
                'icon' => 'fas-shield',
                'route' => 'roles.index',
                'active' => 'roles*',
                'permission' => 'view-roles',
            ],
            [
                'title' => 'Permissions',
                'icon' => 'fas-key',
                'route' => 'permissions.index',
                'active' => 'permissions*',
                'permission' => 'view-permissions',
            ],
        ],
    ],
    [
        'title' => 'Program Management',
        'icon' => 'fas-book',
        'active' => ['programs*'],
        'permission' => ['view-programs', 'create-programs', 'edit-programs', 'delete-programs'], // Parent muncul jika punya salah satu
        'children' => [
            [
                'title' => 'Programs',
                'icon' => 'fas-book-open',
                'route' => 'programs.index',
                'active' => 'programs*',
                'permission' => 'view-programs',
            ],
            [
                'title' => 'Kategori Programs',
                'icon' => 'fas-list',
                'route' => 'kategori-programs.index',
                'active' => 'kategori-programs*',
                'permission' => 'view-kategori-programs',
            ],
        ],
    ],
    [
        'title' => 'Informasi Management',
        'icon' => 'fas-info-circle',
        'active' => ['informasis*'],
        'permission' => ['view-informasis', 'create-informasis', 'edit-informasis', 'delete-informasis'], // Parent muncul jika punya salah satu
        'route' => 'informasis.index',

        
    ],
];