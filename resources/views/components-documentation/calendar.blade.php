@extends('layouts.main')

@section('title', 'Calendar')

@php
    $events = [
      [
        'title' => 'Matematika Diskrit',
        'class' => 'CS7-2024',
        'room' => '2705',
        'start_date' => '2025-12-01',
        'end_date' => '2025-12-15',
        'day_of_week' => 1,
        'start_time' => '08:00:00',
        'end_time' => '10:00:00'
      ],
      [
        'title' => 'Algoritma & Struktur Data',
        'class' => 'CS7-2024',
        'room' => '2705',
        'start_date' => '2025-12-02',
        'end_date' => '2025-12-16',
        'day_of_week' => 3,
        'start_time' => '10:00:00',
        'end_time' => '12:00:00'
      ],
      [
        'title' => 'Basis Data',
        'class' => 'CS7-2024',
        'room' => '2706',
        'start_date' => '2025-12-01',
        'end_date' => '2025-12-20',
        'day_of_week' => 1, 
        'start_time' => '10:00:00',
        'end_time' => '12:00:00'
      ],
      [
        'title' => 'Jaringan Komputer',
        'class' => 'CS7-2024',
        'room' => '2707',
        'start_date' => '2025-12-03',
        'end_date' => '2025-12-17',
        'day_of_week' => 2, // Selasa
        'start_time' => '08:00:00',
        'end_time' => '10:00:00'
      ],
      [
        'title' => 'Pemrograman Web',
        'class' => 'CS7-2024',
        'room' => '2708',
        'start_date' => '2025-12-04',
        'end_date' => '2025-12-18',
        'day_of_week' => 4,
        'start_time' => '09:00:00',
        'end_time' => '11:00:00'
      ],
      [
        'title' => 'Sistem Operasi',
        'class' => 'CS7-2024',
        'room' => '2709',
        'start_date' => '2025-12-05',
        'end_date' => '2025-12-19',
        'day_of_week' => 5,
        'start_time' => '13:00:00',
        'end_time' => '15:00:00'
      ],
      [
        'title' => 'Kecerdasan Buatan',
        'class' => 'CS7-2024',
        'room' => '2710',
        'start_date' => '2025-12-06',
        'end_date' => '2025-12-20',
        'day_of_week' => 6,
        'start_time' => '10:00:00',
        'end_time' => '12:00:00'
      ],
    ];

@endphp

@section('content')
    <x-container.wrapper :gapY="4" >
        <x-typography variant="body-large-semibold">Dokumentasi Komponen Card</x-typography>
        <x-full-calendar :events="$events" :title="'Jadwal'" />
    </x-container.wrapper>
@endsection
