@extends('layouts.main')

@section('title', 'Kurikulum Mata Kuliah Wajib')

@section('breadcrumbs')
    <div class="breadcrumb-item active">Daftar Kurikulum</div>
@endsection

@section('javascript')
  <script src="{{asset('js/custom/curriculum.js')}}"></script>
@endsection

@section('content')
<x-container.container :variant="'content-wrapper'">
  <x-typography :variant="'body-large-semibold'">Kurikulum</x-typography>
  <x-container.container :variant="'content-wrapper'" class="flex flex-col !gap-0 !px-0">
    <x-tab 
      :tabItems="[
        (object)[
          'routeName' => 'curriculum.list',
          'routeQuery' => 'curriculum.list',
          'title' => 'Daftar Kurikulum'
        ],
        (object)[
          'routeName' => Request::routeIs('curriculum.optional-structure') ? 'curriculum.optional-structure' : 'curriculum.required-structure',
          'routeQuery' => Request::routeIs('curriculum.optional-structure') ? 'curriculum.optional-structure' : 'curriculum.required-structure',
          'title' => 'Struktur Kurikulum'
        ],
        (object)[
          'routeName' => 'curriculum.equivalence',
          'routeQuery' => 'curriculum.equivalence',
          'title' => 'Ekuivalensi Kurikulum'
        ],
      ]"
    />
    <x-container.container :class="'flex flex-col !gap-8 items-stretch my-0 border-t-[1px] border-t-[#F39194] relative !z-0'">
      <x-typography variant="body-large-semibold">Struktur Kurikulum</x-typography>
      <x-container.container :variant="'content-wrapper'" class="flex flex-row items-center !mx-0 !px-0 !w-max" id="CampusProgramSection">
        <x-typography :variant="'body-medium-bold'">Program Perkuliahan</x-typography>
        <x-form.dropdown 
          :buttonId="'sortButtonCampus'"
          :dropdownId="'sortCampus'"
          :label="
            count(
              array_filter(
                $programPerkuliahanList, 
                function($item) use($id_program) { 
                  return $item->name == urldecode($id_program); 
                }
              )
            ) > 0 
              ? array_values(
                  array_filter(
                    $programPerkuliahanList, 
                    function($item) use($id_program) { 
                      return $item->name == urldecode($id_program); 
                    }
                  )
                )[0]->name
              : ''
          "
          :imgSrc="asset('assets/active/icon-arrow-down.svg')"
          :isIconCanRotate="true"
          :isOptionRedirectableToURLQueryParameter="true"
          :queryParameter="'program_perkuliahan'"
          :url="route('curriculum.required-structure')"
          :dropdownItem="array_column($programPerkuliahanList, 'name', 'name')"
        />
      </x-container>
      <x-container.container :variant="'content-wrapper'" class="flex flex-col !gap-0 !px-0">
        <x-tab 
          :tabItems="[
            (object)[
              'routeName' => 'curriculum.required-structure',
              'routeQuery' => 'curriculum.required-structure',
              'title' => 'Mata Kuliah Wajib'
            ],
            (object)[
              'routeName' => 'curriculum.optional-structure',
              'routeQuery' => 'curriculum.optional-structure',
              'title' => 'Mata Kuliah Pilihan'
            ]
          ]"
          :bgActive="'bg-[#F5F5F5]'"
        />
        <x-container.container :class="'!bg-[#E8E8E8] rounded-tl-none'">
          @foreach($data as $d)
            <x-container.container :variant="'content-wrapper'" :class="'flex flex-col gap-[10px] !px-0'">
              <x-container.container 
                :variant="'content-wrapper'" 
                :class="'flex flex-row py-[18px] justify-between detail-clickable cursor-pointer !px-0'"
                onclick=""
              >
                <x-container.container :variant="'content-wrapper'" :class="'flex flex-row gap-1 !px-0'">
                  <x-typography :variant="'body-medium-bold'">Semester {{$d['semester']}}</x-typography>
                  <x-typography :variant="'body-medium-regular'">(Total {{$d['total_sks']}} SKS)</x-typography>
                </x-container>
                <img src="{{asset('assets/icon-arrow-down-black-20.svg')}}" alt="">
              </x-container>
              <x-container.container :variant="'content-wrapper'" class="hidden grid-cols-3 grid-rows-3 gap-2.5">
                @foreach($d['matkul_list'] as $matkulList)
                  <x-container.container :class="'bg-cover bg-center bg-no-repeat flex flex-col gap-1'" style="background-image: url('/images/bg-study-list.png')">
                    <x-typography :variant="'body-large-bold'">{{$matkulList['nama_matkul']}}</x-typography>
                    <x-typography :variant="'body-small-bold'">{{$matkulList['sks']}} SKS </x-typography> | 
                    <x-typography :variant="'body-small-regular'">{{$matkulList['kode']}}</x-typography>
                  </x-container>
                @endforeach
              </x-container>
            </x-container>
          @endforeach
        </x-container>
      </x-container>
      <x-container.container :variant="'content-wrapper'" :class="'!px-0 !mx-0 flex items-end'">
        <x-button.primary>Tambah Kurikulum</x-button.primary>
      </x-container>
    </x-container>
  </x-container>
</x-container>
@endsection