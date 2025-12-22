@extends('layouts.main')

@section('title', 'Pagination Documentation')

@section('content')
<x-container.container :variant="'content-wrapper'">
  <div class="mb-6">
    <x-typography variant="body-large-semibold">Komponen Pagination</x-typography>
    <p class="text-sm text-gray-600 mt-2">
      Dokumentasi singkat dan contoh penggunaan komponen pagination. Komponen ini mendukung props untuk menampilkan/sembunyikan bagian tertentu sesuai kebutuhan.
    </p>
  </div>

  <x-container.container class="flex flex-col gap-10" borderRadius="rounded-lg">
    
    {{-- Section 1: Per-halaman selector --}}
    <div>
      <x-typography variant="body-medium-semibold" class="mb-4">1. Tampilkan per Halaman</x-typography>
      <div class="space-y-4">
        <x-pagination 
          x-data="{ pagination: { currentPage: 1, last: 10, totalItems: 322, limit: 5, totalPages: 10 } }" 
          :defaultPerPageOptions="[5,10,25,50]" 
          :showLimit="true" 
          :showInfo="false" 
          :showNav="false" 
          :showSearch="false" 
          requestRoute="" 
        />

        <pre class="bg-gray-100 p-3 rounded text-sm overflow-auto">&lt;x-pagination 
  x-data="{ pagination: { currentPage: 1, last: 10, totalItems: 322, limit: 5 } }" 
  :defaultPerPageOptions="[5,10,25,50]" 
  :showLimit="true" 
  :showInfo="false" 
  :showNav="false" 
  :showSearch="false" 
/&gt;</pre>
      </div>
    </div>

    {{-- Section 2: Result + navigation --}}
    <div>
      <x-typography variant="body-medium-semibold" class="mb-4">2. Hasil (info) + Navigasi Halaman</x-typography>
      <div class="space-y-4">
        <x-pagination 
          x-data="{ pagination: { currentPage: 161, last: 322, totalItems: 322, limit: 5, totalPages: 322 } }" 
          :showLimit="false" 
          :showInfo="true" 
          :showNav="true" 
          :showSearch="false" 
          :defaultPerPageOptions="[5,10,25,50]" 
          requestRoute="" 
        />

        <pre class="bg-gray-100 p-3 rounded text-sm overflow-auto">&lt;x-pagination 
  x-data="{ pagination: { currentPage: 1, last: 10, totalItems: 322 } }" 
  :showLimit="false" 
  :showInfo="true" 
  :showNav="true" 
  :showSearch="false" 
/&gt;</pre>
      </div>
    </div>

    {{-- Section 3: Cari Halaman --}}
    <div>
      <x-typography variant="body-medium-semibold" class="mb-4">3. Cari Halaman</x-typography>
      <div class="space-y-4">
        <div class="flex justify-end">
          <x-pagination 
            x-data="{ pagination: { currentPage: 1, last: 1000, totalItems: 1000, limit: 10, totalPages: 100 } }" 
            :showLimit="false" 
            :showInfo="false" 
            :showNav="false" 
            :showSearch="true" 
            requestRoute="" 
          />
        </div>

        <pre class="bg-gray-100 p-3 rounded text-sm overflow-auto">&lt;x-pagination 
  x-data="{ pagination: { currentPage: 1, last: 1000, totalItems: 1000 } }" 
  :showLimit="false" 
  :showInfo="false" 
  :showNav="false" 
  :showSearch="true" 
/&gt;</pre>
      </div>
    </div>

  </x-container.container>

</x-container.container>
@endsection