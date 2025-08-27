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
            'study' => [
              'name' => 'Mata Kuliah',
              'url' => '/mata-kuliah',
              'parent' => 'study.index',
              'isExpandable' => true,
              'children' => [
                'upload-study' => [
                  'name' => 'Upload Mata Kuliah',
                  'url' => '/mata-kuliah/upload',
                  'parent' => 'study.upload',
                  'isExpandable' => false
                ],
                'study-add' => [
                  'name' => 'Tambah Mata Kuliah',
                  'url' => '/mata-kuliah/tambah',
                  'parent' => 'study.create',
                  'isExpandable' => false
                ],
                'study-view' => [
                  'name' => 'Lihat Mata Kuliah',
                  'url' => '/mata-kuliah/view/*',
                  'parent' => 'study.view',
                  'isExpandable' => false
                ],
                'study-edit' => [
                  'name' => 'Edit Mata Kuliah',
                  'url' => '/mata-kuliah/edit/*',
                  'parent' => 'study.edit',
                  'isExpandable' => false
                ],
              ]
            ],
            'curriculum-list' => [
              'name' => 'Daftar Kurikulum',
              'url' => '/kurikulum/daftar-kurikulum',
              'parent' => 'curriculum.list',
              'isExpandable' => true,
              'children' => [
                'create-curriculum-list' => [
                  'name' => 'Tambah Kurikulum',
                  'url' => '/kurikulum/daftar-kurikulum/tambah/*',
                  'parent' => 'curriculum.list.create',
                  'isExpandable' => false
                ],
                'view-curriculum-list' => [
                  'name' => 'Lihat Detail Kurikulum',
                  'url' => '/kurikulum/daftar-kurikulum/view/*',
                  'parent' => 'curriculum.list.view',
                  'isExpandable' => true,
                  'children' => [
                    'see-curriculum-course-list' => [
                      'name' => 'Lihat Daftar Mata Kuliah',
                      'url' => '/kurikulum/daftar-kurikulum/view/*/lihat-mata-kuliah',
                      'parent' => 'curriculum.list.edit.edit-study',
                      'isExpandable' => false,
                    ],
                  ]
                ],
                'edit-curriculum-list' => [
                  'name' => 'Ubah Kurikulum',
                  'url' => '/kurikulum/daftar-kurikulum/ubah/*',
                  'parent' => 'curriculum.list.edit',
                  'isExpandable' => true,
                  'children' => [
                    'see-curriculum-course-list' => [
                      'name' => 'Ubah Mata Kuliah',
                      'url' => '/kurikulum/daftar-kurikulum/ubah/*/lihat-mata-kuliah',
                      'parent' => 'curriculum.list.edit.edit-study',
                      'isExpandable' => false,
                      'children' => [
                        'update-curriculum-course-list' => [
                          'name' => 'Ubah Mata Kuliah Kurikulum',
                          'url' => '/kurikulum/daftar-kurikulum/ubah/*/lihat-mata-kuliah/*',
                          'parent' => 'curriculum.list.edit.edit-study',
                          'isExpandable' => false
                        ]
                      ],
                    ],
                    'assign-curriculum-course-list' => [
                      'name' => 'Ubah Mata Kuliah',
                      'url' => '/kurikulum/daftar-kurikulum/ubah/*/assign-mata-kuliah',
                      'parent' => 'curriculum.list.edit.assign-study',
                      'isExpandable' => false,
                    ],
                  ]
                ],
              ]
            ],
            'curriculum-structure-required' => [
              'name' => 'Struktur Kurikulum',
              'url' => '/kurikulum/struktur-kurikulum/wajib',
              'parent' => 'curriculum.required-structure',
              'isExpandable' => false,
            ],
            'curriculum-structure-optional' => [
              'name' => 'Struktur Kurikulum',
              'url' => '/kurikulum/struktur-kurikulum/pilihan',
              'parent' => 'curriculum.optional-structure',
              'isExpandable' => false,
            ],
            'curriculum-equivalence' => [
              'name' => 'Ekuivalensi Kurikulum',
              'url' => '/kurikulum/ekuivalensi-kurikulum',
              'parent' => 'curriculum.equivalence',
              'isExpandable' => false,
            ],
            
            'college-schedule' => [
                'name' => 'Jadwal Kuliah',
                'url' => '/persiapan-perkuliahan/jadwal-kuliah/program-studi',
                'parent' => 'academics.schedule.index',
                'isExpandable' => true,
                'children' => [
                    'create-prodi-schedule' => [
                        'name' => 'Tambah Jadwal Kuliah Program Studi',
                        'url' => '/persiapan-perkuliahan/jadwal-kuliah/program-studi/tambah',
                        'parent' => 'academics.schedule.prodi-schedule.create',
                        'isExpandable' => false,
                    ],
                    'view-prodi-schedule' => [
                        'name' => 'Lihat Jadwal Kuliah Program Studi',
                        'url' => '/persiapan-perkuliahan/jadwal-kuliah/program-studi/*',
                        'parent' => 'academics.schedule.prodi-schedule.show',
                        'isExpandable' => false,
                    ],
                    'edit-prodi-schedule' => [
                        'name' => 'Ubah Jadwal Kuliah Program Studi',
                        'url' => '/persiapan-perkuliahan/jadwal-kuliah  /program-studi/*/ubah',
                        'parent' => 'academics.schedule.prodi-schedule.edit',
                        'isExpandable' => false,
                    ],
                    'import-fet1' => [
                        'name' => 'Impor File FET',
                        'url' => '/persiapan-perkuliahan/jadwal-kuliah/program-studi/import/fet1',
                        'parent' => 'academics.schedule.prodi-schedule.import-fet1',
                        'isExpandable' => false,
                    ],
                    'delete-prodi-schedule' => [
                        'name' => 'Hapus Jadwal Kuliah Program Studi',
                        'url' => '/persiapan-perkuliahan/jadwal-kuliah/program-studi/*',
                        'parent' => 'academics.schedule.prodi-schedule.delete',
                        'isExpandable' => false,
                    ],
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
