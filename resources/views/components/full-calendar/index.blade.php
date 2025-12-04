@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const titleEl = document.getElementById('calendar-title');
            const todayBtn = document.getElementById('today-btn');
            const prevBtn = document.getElementById('prev-btn');
            const nextBtn = document.getElementById('next-btn');

            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridWeek',
                height: 'auto',
                locale: 'id',
                headerToolbar: false,
                slotMinTime: '07:00:00',
                slotMaxTime: '19:00:00',
                allDaySlot: false,
                datesSet(info) {
                    const month = info.start.toLocaleString('id-ID', { month: 'long', year: 'numeric' });
                    titleEl.textContent = month;
                }
            });
            calendar.render();

            setTimeout(() => {
                calendar.updateSize();
            }, 250);

            prevBtn.addEventListener('click', () => calendar.prev());
            nextBtn.addEventListener('click', () => calendar.next());
            todayBtn.addEventListener('click', () => calendar.today());

        });
    </script>
@endpush

@php
    $waktu = [
        'Hari' => 'hari',
        'Minggu' => 'minggu',
        'Bulan' => 'bulan',
    ];
@endphp

<div class="border rounded-md border-gray-400">
    {{-- header --}}
    <div class="bg-linear-to-r from-disable-red to-white rounded-t-md p-5">
        <div class="grid grid-cols-12">
            <div class="col-start-1 col-end-4 self-center">
                <x-typography tag="div" variant="body-medium-bold" class="self-center">Jadwal Kuliah
                    Mahasiswa</x-typography>
            </div>
            <div class="col-start-4 col-end-5 self-center">
                <x-button.secondary :id="'today-btn'">Hari Ini</x-button.secondary>
            </div>
            <div class="col-start-5 col-end-6 flex gap-5 justify-end self-center">
                <x-icon :id="'prev-btn'" :name="'circle-circle-left/black-20'" class="cursor-pointer"></x-icon>
                <x-icon :id="'next-btn'" :name="'circle-chevron-right/black-20'" class="cursor-pointer"></x-icon>
            </div>
            <div class="col-start-6 col-end-8 items-center self-center">
                <x-typography tag="div" id="calendar-title" variant="body-small-regular"
                    class="text-center">November
                    2025</x-typography>
            </div>
            <div class="col-start-8 col-end-11">
                <x-form.search class="bg-white" :placeholder="'Cari Jadwal'" />
            </div>
            <div class="col-start-11 col-end-13 self-center flex justify-center">
                <x-form.dropdown :dropdownContainerClass="'w-full flex justify-center'" :buttonId="'buttonJadwalKuliah'" :dropdownId="'dropdownJadwalKuliah'" :dropdownItem="$waktu"
                    label="Pilih" />
            </div>
        </div>
    </div>
    <div id='calendar'></div>
</div>
