@php
    $tabItems = [
        (object)[
            'title' => 'Deskripsi Umum',
            'routeName' => 'rps.deskripsi-umum',
            'routeQuery' => 'rps.deskripsi-umum',
        ],
        (object)[
            'title' => 'Capaian Pembelajaran',
            'routeName' => 'rps.capaian-pembelajaran',
            'routeQuery' => 'rps.capaian-pembelajaran',
        ],
        (object)[
            'title' => 'Komponen Penilaian',
            'routeName' => 'rps.komponen-penilaian',
            'routeQuery' => 'rps.komponen-penilaian',
        ],
        (object)[
            'title' => 'Rencana Perkuliahan',
            'routeName' => 'rps.rencana-perkuliahan',
            'routeQuery' => 'rps.rencana-perkuliahan',
        ],
        (object)[
            'title' => 'Matriks Penilaian Kognitif',
            'routeName' => 'rps.matriks-penilaian-kognitif',
            'routeQuery' => 'rps.matriks-penilaian-kognitif',
        ],
        (object)[
            'title' => 'Evaluasi Pemetaan Capaian',
            'routeName' => 'rps.evaluasi-pemetaan-capaian',
            'routeQuery' => 'rps.evaluasi-pemetaan-capaian',
        ],
        (object)[
            'title' => 'Rencana Evaluasi Mahasiswa',
            'routeName' => 'rps.rencana-evaluasi-mahasiswa',
            'routeQuery' => 'rps.rencana-evaluasi-mahasiswa',
        ],
        (object)[
            'title' => 'Submission',
            'routeName' => 'rps.submission',
            'routeQuery' => 'rps.submission',
        ],
    ];
@endphp

<x-tab :tabItems="$tabItems" />

