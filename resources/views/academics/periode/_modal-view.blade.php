<x-modal.container-pure-js id="modalPeriodeAkademik">
  <x-slot name="header">
    <span class="text-lg-bd">Lihat Periode Akademik</span>
    <button 
      type="button" 
      class="absolute top-4 right-5 bg-none border-none text-[2rem] text-[#888] cursor-pointer z-10 transition-all duration-200 hover:text-[#E74C3C]"
      onclick="
        document.getElementById('modalPeriodeAkademik').classList.add('hidden');
        document.getElementById('modalPeriodeAkademik').classList.remove('flex');
      ">
        &times;
    </button>
  </x-slot>
  <x-slot name="body">
    <div class="expandable-section" id="section-detail">
      <div class="text-left">
          <span class="text-md-bd">Periode Akademik</span>
      </div>

      <div class="expandable-content flex flex-col" id="content-detail">
        <x-form.input-container id="year" class="min-w-[175px]">
          <x-slot name="label">Tahun</x-slot>
          <x-slot name="input">
            <input 
              type="text" 
              class="w-full px-3 py-2 border-[1px] border-[#D9D9D9] text-sm rounded-lg leading-5 bg-[#F5F5F5] text-[#8C8C8C] cursor-not-allowed" 
              value="{{ $response->data->periode->tahun ?? '-' }}" 
              readonly
            />
          </x-slot>
        </x-form.input-container>
        <x-form.input-container class="min-w-[175px]">
          <x-slot name="label">Semester</x-slot>
          <x-slot name="input">
            <div class="flex items-center justify-center gap-1">
                <input type="checkbox" class="" value="Ganjil" disabled
                    {{ $data->semester == 1 ? 'checked' : '' }}>
                <label class="text-xs">Ganjil</label>
            </div>
            <div class="flex items-center justify-center gap-1">
                <input type="checkbox" class="" value="Pendek" disabled
                    {{ $data->semester == 3 ? 'checked' : '' }}>
                <label class="text-xs">Pendek</label>
            </div>
            <div class="flex items-center justify-center gap-1">
                <input type="checkbox" class="" value="Genap" disabled
                    {{ $data->semester == 2 ? 'checked' : '' }}>
                <label class="text-xs">Genap</label>
            </div>
          </x-slot>
        </x-form.input-container>
        <x-form.input-container class="min-w-[175px]">
          <x-slot name="label">Tahun Akademik</x-slot>
          <x-slot name="input">
            <input 
              type="text" 
              class="w-full px-3 py-2 border-[1px] border-[#D9D9D9] text-sm rounded-lg leading-5 bg-[#F5F5F5] text-[#8C8C8C] cursor-not-allowed" 
              value="{{ $data->tahun ?? '-' }}/{{ ($data->tahun ?? 0) + 1 }}" 
              readonly
            />
          </x-slot>
        </x-form.input-container>
        <x-form.input-container class="min-w-[175px]">
          <x-slot name="label">Tanggal Mulai - Berakhir</x-slot>
          <x-slot name="input">
            <input 
              type="text" 
              class="w-full px-3 py-2 border-[1px] border-[#D9D9D9] text-sm rounded-lg leading-5 bg-[#F5F5F5] text-[#8C8C8C] cursor-not-allowed" 
              value="{{ \Carbon\Carbon::parse($data->tanggal_mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($data->tanggal_akhir)->format('d M Y') }}" 
              readonly
            />
          </x-slot>
        </x-form.input-container>
        <x-form.input-container class="min-w-[175px]">
          <x-slot name="label">Deskripsi</x-slot>
          <x-slot name="input">
            <input 
              type="text" 
              class="w-full px-3 py-2 border-[1px] border-[#D9D9D9] text-sm rounded-lg leading-5 bg-[#F5F5F5] text-[#8C8C8C] cursor-not-allowed" 
              value="{{ $data->deskripsi ?? '-' }}" 
              readonly
            />
          </x-slot>
        </x-form.input-container>
        <x-form.toggle 
          :id="'academic-periode-status'" 
          :value="$data->status === 'active'" 
          :variant="'readonly'"
        />
      </div>
    </div>
  </x-slot>
  <x-slot name="footer"></x-slot>
</x-modal.container-pure-js>