@php
    $tabItems = [
        (object)[
            'title' => 'Daftar Mahasiswa',
            'routeName' => 'tutelage-group',
            'routeQuery' => 'tutelage-group',
        ],
        (object)[
            'title' => 'Sesi Perwalian',
            'routeName' => 'tutelage-group.session.index',
            'routeQuery' => 'tutelage-group.session.index',
        ],
        (object)[
            'title' => 'Pengaturan Buddy',
            'routeName' => 'tutelage-group.buddy.index',
            'routeQuery' => 'tutelage-group.buddy.index',
        ],
    ];
@endphp

<x-tab :tabItems="$tabItems" :widthMax="false"/>

