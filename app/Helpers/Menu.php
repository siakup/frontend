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
                'isExpandable' => false,
                'children' => [
                  
                ]
            ],
            'konfigurasi' => [
                'name' => 'Konfigurasi',
                'url' => '#',
                'parent' => null,
                'isExpandable' => true,
                'children' => [
                    'user' => [
                        'name' => 'Manajemen Pengguna',
                        'url' => '/users',
                        'parent' => 'konfigurasi',
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
                    'akademik' => [
                        'name' => 'Akademik',
                        'url' => '/academics',
                        'parent' => 'konfigurasi',
                        'isExpandable' => false,
                        'children' => [
                            'event-akademik' => [
                              'name' => 'Event Akademik',
                              'url' => '/academics/event',
                              'parent' => 'academics-event.index',
                              'isExpandeble' => false,
                              'children' => [
                                'ubah-event-akademik' => [
                                  'name' => 'Ubah Event Akademik',
                                  'url' => '/academics/event/edit/*',
                                  'parent' => 'academics-event.edit',
                                  'isExpandable' => false,
                                ],
                                'add-event-akademik' => [
                                  'name' => 'Tambah Event Akademik',
                                  'url' => '/academics/event/create',
                                  'parent' => 'academics-event.create',
                                  'isExpandable' => false,
                                ],
                                'upload-event-akademik' => [
                                  'name' => 'Unggah Event Akademik',
                                  'url' => '/academics/event/upload',
                                  'parent' => 'academics-event.upload',
                                  'isExpandable' => false,
                                ],
                                'preview-event-akademik' => [
                                  'name' => 'Unggah Event Akademik',
                                  'url' => '/academics/event/preview',
                                  'parent' => 'academics-event.preview',
                                  'isExpandable' => false,
                                ]
                              ]
                            ],
                            'periode-akademik' => [
                              'name' => 'Periode Akademik',
                              'url' => '/academics/periode',
                              'parent' => 'academics-periode.index',
                              'isExpandable' => false,
                              'children' => [
                                'ubah-periode-akademik' => [
                                  'name' => 'Ubah Periode Akademik',
                                  'url' => '/academics/periode/edit/*',
                                  'parent' => 'academics-periode.edit',
                                  'isExpandable' => false,
                                ],
                                'add-periode-akademik' => [
                                  'name' => 'Tambah Periode Akademik',
                                  'url' => '/academics/periode/create',
                                  'parent' => 'academics-periode.create',
                                  'isExpandable' => false,
                                ],
                              ]
                            ],
                        ],
                    ],
                ]
            ],
            'calendar-academics' => [
                'name' => 'Kalender Akademik',
                'url' => '/calendar',
                'parent' => 'calendar.index',
                'isExpandable' => true,
                'children' => [
                    'event-calendar-index' => [
                      'name' => 'Lihat Event Kalender Akademik',
                      'url' => '/calendar/event/*',
                      'parent' => 'calendar.show',
                      'isExpandable' => true,
                      'children' => [
                        'upload-event-calendar' => [
                          'name' => 'Unggah Event',
                          'url' => '/calendar/event/*/upload',
                          'parent' => 'calendar.upload',
                          'isExpandable' => false,
                        ]
                      ]
                    ]
                ]
            ],
              
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
                          if (isset($item['children'])) {
                              $result = $findMenuByPath($item['children'], $targetPath);
                              if ($result !== null) {
                                  return array_merge([$item], $result);
                              }
                          }
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