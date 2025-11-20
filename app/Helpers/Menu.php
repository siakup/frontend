<?php
namespace App\Helpers;

class Menu
{
    public static function getMenuItems()
    {
        return [
            'home' => [
                'name' => 'Beranda',
                'url' => '/home',
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
                    ],
                    'generate-riwayat-akademik' => [
                      'name' => 'Generate Riwayat Akademik',
                      'url' => '/calendar/generate',
                      'parent' => 'calendar.generate',
                      'isExpandable' => false,
                    ]
                ]
            ],
            'study' => [
              'name' => 'Mata Kuliah',
              'url' => '/courses',
              'parent' => 'study.index',
              'isExpandable' => true,
              'children' => [
                'upload-study' => [
                  'name' => 'Upload Mata Kuliah',
                  'url' => '/courses/upload',
                  'parent' => 'study.upload',
                  'isExpandable' => false
                ],
                'study-add' => [
                  'name' => 'Tambah Mata Kuliah',
                  'url' => '/courses/create',
                  'parent' => 'study.create',
                  'isExpandable' => false
                ],
                'study-view' => [
                  'name' => 'Lihat Mata Kuliah',
                  'url' => '/courses/view/*',
                  'parent' => 'study.view',
                  'isExpandable' => false
                ],
                'study-edit' => [
                  'name' => 'Edit Mata Kuliah',
                  'url' => '/courses/edit/*',
                  'parent' => 'study.edit',
                  'isExpandable' => false
                ],
              ]
            ],
            'curriculum-list' => [
              'name' => 'Daftar Kurikulum',
              'url' => '/curriculums/list',
              'parent' => 'curriculum.list',
              'isExpandable' => true,
              'children' => [
                'create-curriculum-list' => [
                  'name' => 'Tambah Kurikulum',
                  'url' => '/curriculums/list/create/*',
                  'parent' => 'curriculum.list.create',
                  'isExpandable' => false
                ],
                'view-curriculum-list' => [
                  'name' => 'Lihat Detail Kurikulum',
                  'url' => '/curriculums/list/view/*',
                  'parent' => 'curriculum.list.view',
                  'isExpandable' => true,
                  'children' => [
                    'see-curriculum-course-list' => [
                      'name' => 'Lihat Daftar Mata Kuliah',
                      'url' => '/curriculums/list/view/*/view-courses',
                      'parent' => 'curriculum.list.edit.edit-study',
                      'isExpandable' => false,
                    ],
                  ]
                ],
                'edit-curriculum-list' => [
                  'name' => 'Ubah Kurikulum',
                  'url' => '/curriculums/list/edit/*',
                  'parent' => 'curriculum.list.edit',
                  'isExpandable' => true,
                  'children' => [
                    'see-curriculum-course-list' => [
                      'name' => 'Ubah Mata Kuliah',
                      'url' => '/curriculums/list/edit/*/show-courses',
                      'parent' => 'curriculum.list.edit.edit-study',
                      'isExpandable' => false,
                      'children' => [
                        'update-curriculum-course-list' => [
                          'name' => 'Ubah Mata Kuliah Kurikulum',
                          'url' => '/curriculums/list/edit/*/view-courses/*',
                          'parent' => 'curriculum.list.edit.edit-study',
                          'isExpandable' => false
                        ]
                      ],
                    ],
                    'assign-curriculum-course-list' => [
                      'name' => 'Ubah Mata Kuliah',
                      'url' => '/curriculums/list/edit/*/assign-course',
                      'parent' => 'curriculum.list.edit.assign-study',
                      'isExpandable' => false,
                    ],
                  ]
                ],
              ]
            ],
            'curriculum-structure-required' => [
              'name' => 'Struktur Kurikulum',
              'url' => '/curriculums/structure/required',
              'parent' => 'curriculum.required-structure',
              'isExpandable' => false,
            ],
            'curriculum-structure-optional' => [
              'name' => 'Struktur Kurikulum',
              'url' => '/curriculums/structure/optional',
              'parent' => 'curriculum.optional-structure',
              'isExpandable' => false,
            ],
            'curriculum-equivalence' => [
              'name' => 'Ekuivalensi Kurikulum',
              'url' => '/curriculums/equivalence',
              'parent' => 'curriculum.equivalence',
              'isExpandable' => true,
              'children' => [
                'create-curriculum-equivalence' => [
                  'name' => 'Tambah Ekuivalensi',
                  'url' => '/curriculums/equivalence/add/*/*',
                  'parent' => 'curriculum.equivalence.create',
                  'isExpandable' => false
                ],
                'edit-curriculum-equivalence' => [
                  'name' => 'Ubah Ekuivalensi',
                  'url' => '/curriculums/equivalence/edit/*',
                  'parent' => 'curriculum.equivalence.edit',
                  'isExpandable' => false
                ],
                'upload-curriculum-equivalence' => [
                  'name' => 'Unggah Ekuivalensi',
                  'url' => '/curriculums/equivalence/upload',
                  'parent' => 'curriculum.equivalence.upload',
                  'isExpandable' => false,
                ],
                'upload-result-curriculum-equivalence' => [
                  'name' => 'Unggah Ekuivalensi',
                  'url' => '/curriculums/equivalence/upload-result',
                  'parent' => 'curriculum.equivalence.upload-result',
                  'isExpandable' => false,
                ],
              ]
            ],
            'lecture-preparation' => [
              'name' => 'Persiapan Perkuliahan',
              'url' => '/lecture-preparation',
              'parent' => '',
              'isExpandable' => true,
              'children' => [
                'college-schedule' => [
                    'name' => 'Jadwal Kuliah',
                    'url' => '/lecture-preparation/schedule/program-studi',
                    'parent' => 'academics.schedule.index',
                    'isExpandable' => true,
                    'children' => [
                        'create-prodi-schedule' => [
                            'name' => 'Tambah Jadwal Kuliah Program Studi',
                            'url' => '/lecture-preparation/schedule/program-studi/create',
                            'parent' => 'academics.schedule.prodi-schedule.create',
                            'isExpandable' => false,
                        ],
                        'edit-prodi-schedule' => [
                            'name' => 'Ubah Jadwal Kuliah Program Studi',
                            'url' => '/lecture-preparation/schedule/program-studi/edit/*',
                            'parent' => 'academics.schedule.prodi-schedule.edit',
                            'isExpandable' => false,
                        ],
                        'import-fet1' => [
                            'name' => 'Impor File FET',
                            'url' => '/lecture-preparation/schedule/program-studi/upload/page',
                            'parent' => 'academics.schedule.prodi-schedule.import-fet1',
                            'isExpandable' => false,
                            'children' => [
                              'preview' => [
                                  'name' => 'Preview File FET',
                                  'url' => '/lecture-preparation/schedule/program-studi/upload/preview',
                                  'parent' => 'academics.schedule.prodi-schedule.import-fet1',
                                  'isExpandable' => false,
                              ],
                            ]
                        ],
                    ]
                ],
                'parent-institution-schedule' => [
                  'name' => 'Jadwal Kuliah',
                  'url' => 'lecture-preparation/schedule/parent-institution',
                  'parent' => 'academics.schedule.parent-institution-schedule.index',
                  'isExpandable' => false,
                  'children' => [
                    'create-parent-institution' => [
                      'name' => 'Tambah Jadwal Kuliah Institusi Parent',
                      'url' => '/lecture-preparation/schedule/parent-institution/create',
                      'parent' => 'academics.schedule.parent-institution-schedule.create',
                      'isExpandable' => false
                    ],
                    'edit-parent-institution' => [
                      'name' => 'Ubah Jadwal Kuliah Institusi Parent',
                      'url' => '/lecture-preparation/schedule/parent-institution/edit/*',
                      'parent' => 'academics.schedule.parent-institution-schedule.edit',
                      'isExpandable' => false
                    ],
                    'upload-parent-institution' => [
                      'name' => 'Upload Jadwal Kuliah Institusi Parent',
                      'url' => '/lecture-preparation/schedule/parent-institution/upload/page',
                      'parent' => 'academics.schedule.parent-institution-schedule.upload',
                      'isExpandable' => true,
                      ],
                      'preview-upload-parent-institution' => [
                        'name' => 'Upload Jadwal Kuliah Institusi Parent',
                        'url' => '/lecture-preparation/schedule/parent-institution/upload/preview',
                        'parent' => 'academics.schedule.parent-institution-schedule.upload-result',
                        'isExpandable' => false
                      ],
                  ]
                ]
              ]
            ],
            'tutelage-group-student-list' => [
                'name' => 'Kelompok Perwalian',
                'url' => '/tutelage-group/student-list',
                'parent' => 'tutelage-group.index',
                'isExpandable' => true,
                'children' => [
                    'tutelage-group-student-list-krs' => [
                        'name' => 'Detail Kartu Mahasiswa',
                        'url' => '/tutelage-group/student-list/detail/krs/*',
                        'parent' => 'tutelage-group.student-list.detail-krs',
                        'isExpandable' => true,
                        'children' => [

                        ]
                    ],
                    'tutelage-group-student-list-student-data' => [
                        'name' => 'Detail Kartu Mahasiswa',
                        'url' => '/tutelage-group/student-list/detail/student-data/*',
                        'parent' => 'tutelage-group.student-list.detail-student-data',
                        'isExpandable' => true,
                        'children' => [

                        ]
                    ],
                    'tutelage-group-student-list-transkrip-resmi' => [
                        'name' => 'Detail Kartu Mahasiswa',
                        'url' => '/tutelage-group/student-list/detail/transkrip-resmi/*',
                        'parent' => 'tutelage-group.student-list.detail-transkrip-resmi',
                        'isExpandable' => true,
                        'children' => [

                        ]
                    ],
                    'tutelage-group-student-list-transkrip-historis' => [
                        'name' => 'Detail Kartu Mahasiswa',
                        'url' => '/tutelage-group/student-list/detail/transkrip-historis/*',
                        'parent' => 'tutelage-group.student-list.detail-transkrip-historis',
                        'isExpandable' => true,
                        'children' => [

                        ]
                    ],
                    'tutelage-group-student-list-transkrip-kurikulum' => [
                        'name' => 'Detail Kartu Mahasiswa',
                        'url' => '/tutelage-group/student-list/detail/transkrip-kurikulum/*',
                        'parent' => 'tutelage-group.student-list.detail-transkrip-kurikulum',
                        'isExpandable' => true,
                        'children' => [

                        ]
                    ],
                    'tutelage-group-student-list-transkrip-pem' => [
                        'name' => 'Detail Kartu Mahasiswa',
                        'url' => '/tutelage-group/student-list/detail/transkrip-pem/*',
                        'parent' => 'tutelage-group.student-list.detail-transkrip-pem',
                        'isExpandable' => true,
                        'children' => [

                        ]
                    ],
                ]
            ],
            'rps' => [
                'name' => 'RPS (Rencana Pembelajaran Semester)',
                'url' => '/rps',
                'parent' => 'rps.index',
                'isExpandable' => true,
                'children' => [
                  'buat-rps' => [
                        'name' => 'Buat RPS (Rencana Pembelajaran Semester)',
                        'url' => '/rps/*',
                        'parent' => 'rps',
                        'isExpandable' => true,
                        'children' => [
                          'buat-cpl' => [
                            'name' => 'Capaian Pembelajaran Lulusan',
                            'url' => '/rps/capaian-pembelajaran/*',
                            'parent' => 'rps.capaian-pembelajaran.index',
                            'isExpandable' => false,
                          ],
                          'buat-rencana-perkuliahan' => [
                            'name' => 'Tambah Rencana Perkuliahan',
                            'url' => '/rps/rencana-perkuliahan/*',
                            'parent' => 'rps.rencana-perkuliahan.index',
                            'isExpandable' => false,
                          ],
                          'buat-rencana-evaluasi-mahasiswa' => [
                            'name' => 'Tambah Rencana Evaluasi',
                            'url' => '/rps/rencana-evaluasi-mahasiswa/create',
                            'parent' => 'rps.rencana-evaluasi-mahasiswa.index',
                            'isExpandable' => false,
                          ],
                          'ubah-rencana-evaluasi-mahasiswa' => [
                            'name' => 'Ubah Rencana Evaluasi',
                            'url' => '/rps/rencana-evaluasi-mahasiswa/edit/*',
                            'parent' => 'rps.rencana-evaluasi-mahasiswa.index',
                            'isExpandable' => false,
                          ],
                    
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
                    $target  = trim($targetPath, '/');

                    $menuSegments   = explode('/', $menuUrl);
                    $targetSegments = explode('/', $target);

                    $isMatch = true;

                    if (count($menuSegments) === count($targetSegments)) {
                        foreach ($menuSegments as $i => $seg) {
                            if ($seg !== '*' && $seg !== $targetSegments[$i]) {
                                $isMatch = false;
                                break;
                            }
                        }
                    } else {
                        $isMatch = false;
                    }

                    if ($isMatch) {
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

        $currentSegments = explode('/', trim($currentPath, '/'));

        foreach ($breadcrumbs as &$crumb) {
            $urlSegments = explode('/', trim($crumb['url'], '/'));
            foreach ($urlSegments as $i => &$seg) {
                if ($seg === '*') {
                    $seg = $currentSegments[$i] ?? $seg; // replace * dengan segment asli
                }
            }
            $crumb['url'] = '/' . implode('/', $urlSegments);
        }
        unset($crumb);

        return $breadcrumbs;
    }
}
