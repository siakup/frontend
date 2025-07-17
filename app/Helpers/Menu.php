<?php
namespace App\Helpers;

class Menu
{
    public static function getMenuItems()
    {
        return [
            'home' => [
                'name' => 'Beranda',
                'url' => '/',
                'parent' => null,
                'isExpandable' => false
            ],
            'users' => [
                'name' => 'Konfigurasi',
                'url' => '#',
                'parent' => null,
                'isExpandable' => true,
                'children' => [
                    'index' => [
                        'name' => 'Manajemen Pengguna',
                        'url' => '/users',
                        'parent' => 'users',
                        'isExpandable' => false,
                        'children' => [
                            'create' => [
                                'name' => 'Tambah Pengguna',
                                'url' => '/users/create',
                                'parent' => 'users.index',
                                'isExpandable' => false
                            ],
                            'edit' => [
                                'name' => 'Ubah Informasi',
                                'url' => '/users/edit/*',
                                'parent' => 'users.index',
                                'isExpandable' => false
                            ],
                        ],
                    ],
                ]
            ],
            'academics' => [
              'name' => 'Konfigurasi',
              'url' => '#',
              'parent' => null,
              'isExpandable' => true,
              'children' => [
                'index' => [
                        'name' => 'Akademik',
                        'url' => '/academics',
                        'parent' => 'academics',
                        'isExpandable' => false,
                        'children' => [
                            'event-akademik' => [
                              'name' => 'Event Akademik',
                              'url' => '/academics/event',
                              'parent' => 'academics-event.index',
                              'isExpandeble' => false,
                              'children' => [
                                'edit-event-akademik' => [
                                  'name' => 'Edit Event Akademik',
                                  'url' => '/academics/event/edit/*',
                                  'parent' => 'academics-event.edit',
                                  'isExpandable' => false,
                                ],
                                'add-event-akademik' => [
                                  'name' => 'Tambah Event Akademik',
                                  'url' => '/academics/event/create',
                                  'parent' => 'academics-event.create',
                                  'isExpandable' => false,
                                ]
                              ]
                            ],
                            'periode-akademik' => [
                              'name' => 'Periode Akademik',
                              'url' => '/academics/periode',
                              'parent' => 'academics-periode.index',
                              'isExpandable' => false,
                            ],
                            // 'create' => [
                            //     'name' => 'Tambah Pengguna',
                            //     'url' => '/users/create',
                            //     'parent' => 'users.index',
                            //     'isExpandable' => false
                            // ],
                            // 'edit' => [
                            //     'name' => 'Ubah Informasi',
                            //     'url' => '/users/edit/*',
                            //     'parent' => 'users.index',
                            //     'isExpandable' => false
                            // ],
                        ],
                    ],
              ]
            ]

        ];
    }

    public static function getMenuName($segment)
    {
        $menus = self::getMenuItems();
        
        // Check direct menu items
        if (isset($menus[$segment])) {
            return $menus[$segment]['name'];
        }

        // Check children of all menu items
        foreach ($menus as $menuKey => $menu) {
            if (isset($menu['children']) && isset($menu['children'][$segment])) {
                return $menu['children'][$segment]['name'];
            }
        }

        return ucfirst($segment);
    }

    public static function getBreadcrumbs($path)
    {
        $segments = array_filter(explode('/', $path));
        $breadcrumbs = [];
        $menus = self::getMenuItems();

        // Always add home
        $breadcrumbs[] = [
            'name' => $menus['home']['name'],
            'url' => $menus['home']['url'],
            'active' => empty($segments)
        ];

        if (empty($segments)) {
            return $breadcrumbs;
        }

        // Helper function to find menu item by URL path
        $findMenuByPath = function($items, $targetPath) use (&$findMenuByPath) {
            foreach ($items as $key => $item) {
                if (isset($item['url'])) {
                    $menuUrl = trim($item['url'], '/');
                    $target = trim($targetPath, '/');
                    // Cek wildcard
                    if (strpos($menuUrl, '*') !== false) {
                        $pattern = '#^' . str_replace('\*', '.*', preg_quote($menuUrl, '#')) . '$#';
                        if (preg_match($pattern, $target)) {
                            return [$item];
                        }
                    } elseif ($menuUrl === $target) {
                        return [$item];
                    }
                }
                if (isset($item['children'])) {
                    $result = $findMenuByPath($item['children'], $targetPath);
                    if ($result !== null) {
                        return array_merge([$item], $result);
                    }
                }
            }
            return null;
        };

        $currentPath = '';
        foreach ($segments as $segment) {
            $currentPath .= '/' . $segment;
            $menuChain = $findMenuByPath($menus, $currentPath);
            
            if ($menuChain !== null) {
                foreach ($menuChain as $index => $menuItem) {
                    // Skip if it's already in breadcrumbs
                    $exists = false;
                    foreach ($breadcrumbs as $crumb) {
                        if ($crumb['name'] === $menuItem['name']) {
                            $exists = true;
                            break;
                        }
                    }
                    
                    if (!$exists) {
                        $breadcrumbs[] = [
                            'name' => $menuItem['name'],
                            'url' => $menuItem['url'],
                            'active' => ($currentPath === '/' . $path && $index === count($menuChain) - 1)
                        ];
                    }
                }
            }
        }

        return $breadcrumbs;
    }
}