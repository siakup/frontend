<x-modal.container-pure-js id="modalDetailEvent">
  <x-slot name="header">
    <x-container.container :variant="'content-wrapper'" :class="'flex flex-row justify-between items-center !px-0 !ps-5 !gap-0'">
      <x-typography :variant="'body-medium-bold'" :class="'flex-1 text-center'">Lihat Event Akademik</x-typography>
      <button 
        type="button" 
        class="text-[#888] cursor-pointer transition-all duration-200 hover:text-[#E74C3C] flex items-center" 
        onclick="
          document.getElementById('modalDetailEvent').classList.add('hidden');
          document.getElementById('modalDetailEvent').classList.remove('flex');
        "
      >
        <x-typography :variant="'heading-h3'" :class="'!font-medium'">&times;</x-typography>
      </button>
    </x-container>
  </x-slot>
  <x-slot name="body">
    <x-typography :variant="'body-medium-bold'" :class="'w-full flex items-center text-center justify-center'">Event Akademik</x-typography>
    <x-container.container :variant="'content-wrapper'" :class="'!px-0'" id="section-detail">
      <x-container.container :variant="'content-wrapper'" :class="'flex !gap-2 flex-col !px-0'" id="content-detail">
        <x-form.input-container class="min-w-[120px]" id="nama_event">
          <x-slot name="label">Nama Event</x-slot>
          <x-slot name="input">
            <input type="text" class="w-full px-3 py-2 border-[1px] border-[#D9D9D9] text-sm rounded-lg leading-5 bg-[#F5F5F5] text-[#8C8C8C] cursor-not-allowed" value="{{ $data->nama_event }}" readonly>
          </x-slot>
        </x-form.input-container>
        <x-form.input-container class="min-w-[120px]" id="flag">
          <x-slot name="label">Flag</x-slot>
          <x-slot name="input">
            <div class="grid grid-cols-3 grid-rows-3 gap-y-3 gap-x-8 justify-items-start py-3">
              <div class="flex gap-3 items-center">
                <input type="checkbox" class="form-control" value="true" disabled @if($data->nilai_on) checked @endif>
                <label class="text-[#8C8C8C] text-sm w-max">Nilai</label>
              </div>
              <div class="flex gap-3 items-center">
                <input type="checkbox" class="form-control" value="true" disabled @if($data->irs_on) checked @endif>
                <label class="text-[#8C8C8C] text-sm w-max">IRS</label>
              </div>
              <div class="flex gap-3 items-center">
                <input type="checkbox" class="form-control" value="true" disabled @if($data->lulus_on) checked @endif>
                <label class="text-[#8C8C8C] text-sm w-max">Lulus</label>
              </div>
              <div class="flex gap-3 items-center">
                <input type="checkbox" class="form-control" value="true" disabled @if($data->registrasi_on) checked @endif>
                <label class="text-[#8C8C8C] text-sm w-max">Registrasi</label>
              </div>
              <div class="flex gap-3 items-center">
                <input type="checkbox" class="form-control" value="true" disabled @if($data->yudisium_on) checked @endif>
                <label class="text-[#8C8C8C] text-sm w-max">Yudisium</label>
              </div>
              <div class="flex gap-3 items-center">
                <input type="checkbox" class="form-control" value="true" disabled @if($data->survei_on) checked @endif>
                <label class="text-[#8C8C8C] text-sm w-max">Survei</label>
              </div>
              <div class="flex gap-3 items-center">
                <input type="checkbox" class="form-control" value="true" disabled @if($data->dosen_on) checked @endif>
                <label class="text-[#8C8C8C] text-sm w-max">Dosen</label>
              </div>
            </div>
          </x-slot>
        </x-form.input-container>
        <x-form.toggle 
          :id="'academic-event-status'" 
          :value="$data->status === 'active'" 
          :variant="'readonly'"
        />
      </x-container>
    </x-container>
  </x-slot>
  <x-slot name="footer"></x-slot>
</x-modal.container-pure-js>