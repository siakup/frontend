<div>
    <div id="calendar-header" class="flex items-center justify-between px-5 py-4 bg-gradient-to-r from-[#FFFFFF] to-[#FFECED]">
        <div class="flex items-center gap-[38px]">
            <h2 class="text-[16px] font-bold leading-[24px] text-[#262626]">Jadwal Kuliah Mahasiswa</h2>
            <button id="today-btn" class="border border-[#E62129] text-[#E62129] rounded-lg py-2 px-4 text-sm font-medium">Hari ini</button>
            <div class="flex items-center gap-2">
                <button id="prev-btn" class="border border-[#E8E8E8] bg-white rounded-full w-[28px] h-[28px] flex items-center justify-center text-[#262626]">&lt;</button>
                <button id="next-btn" class="border border-[#E8E8E8] bg-white rounded-full w-[28px] h-[28px] flex items-center justify-center text-[#262626]">&gt;</button>
            </div>
        </div>

        <h3 id="calendar-title" class="text-[14px] font-normal leading-[22px] text-[#262626]"></h3>

        <div id="calendar-filters" class="flex gap-[38px]">
            <div class="border border-[#bfbfbf] rounded-lg p-2 text-sm outline-none focus:ring focus:ring-[#E62129] flex gap-2">
                <img src="{{ asset('assets/icon-search.svg') }}" alt="" />
                <input
                    id="calendar-search"
                    type="text"
                    placeholder="Cari mata kuliah..."
                    class="text-sm outline-none focus:ring focus:ring-[#E62129] w-full"
                />
            </div>

            <div class="flex border border-[#E62129] rounded-lg overflow-hidden">
                <button data-view="dayGridMonth" class="view-btn text-[#E62129] px-3 py-2 text-sm">Bulan</button>
                <button data-view="timeGridWeek" class="view-btn bg-[#E62129] text-white px-3 py-2 text-sm">Minggu</button>
                <button data-view="timeGridDay" class="view-btn text-[#E62129] px-3 py-2 text-sm">Hari</button>
                <button data-view="listWeek" class="view-btn text-[#E62129] px-3 py-2 text-sm">List</button>
            </div>
        </div>
    </div>

    <div id="calendar"></div>
</div>


@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css" rel="stylesheet">
    <style>
        button {
            cursor: pointer;
        }

        /* HEADER GRID (hari + tanggal) */
        .fc-col-header-cell-cushion {
            display: flex !important;
            flex-direction: column !important;
            align-items: center !important;
            justify-content: center !important;
            padding-top: 10px !important;
            padding-bottom: 10px !important;
            text-transform: capitalize !important;
            font-size: 12px !important;
            line-height: 20px !important;
            font-weight: 400 !important;
        }

        .fc-col-header-cell {
            background-color: #D9D9D9 !important;
            border-color: #D9D9D9 !important;
        }

        .fc-col-header-cell-cushion span:last-child {
            font-weight: 700 !important;
            font-size: 14px !important;
            line-height: 22px !important;
        }

        /* JAM DI SEBELAH KIRI */
        .fc-timegrid-slot-label {
            font-weight: 700 !important;
            font-size: 14px !important;
            line-height: 22px !important;
            background-color: #D9D9D9 !important;
            text-align: center !important;
            margin: 0 auto !important;
        }

        .fc-timegrid-slot {
            border-color: #D9D9D9 !important;
            height: 20px !important;
        }

        .fc-timegrid-axis {
            background-color: #D9D9D9 !important;
        }

        .fc-scrollgrid {
            border-color: #D9D9D9 !important;
        }

        .fc-daygrid-day, .fc-timegrid-col {
            width: 138px !important;
        }

        .fa-clock {
            font-size: 9px !important;
        }
    </style>
@endpush


@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('calendar');
            const titleEl = document.getElementById('calendar-title');
            const searchInput = document.getElementById('calendar-search');
            const todayBtn = document.getElementById('today-btn');
            const prevBtn = document.getElementById('prev-btn');
            const nextBtn = document.getElementById('next-btn');
            const viewButtons = document.querySelectorAll('.view-btn');

            const baseEvents = @json($events ?? []);
            const generatedEvents = [];

            baseEvents.forEach(event => {
                const startDate = new Date(event.start_date);
                const endDate = new Date(event.end_date);
                const dayOfWeek = event.day_of_week;
                const startTime = event.start_time;
                const endTime = event.end_time;

                for (let d = new Date(startDate); d <= endDate; d.setDate(d.getDate() + 7)) {
                    const current = new Date(d);
                    const diff = dayOfWeek - current.getDay();
                    const targetDate = new Date(current);
                    targetDate.setDate(current.getDate() + diff);

                    if (targetDate >= startDate && targetDate <= endDate) {
                        const dateStr = targetDate.toISOString().split('T')[0];
                        const today = new Date();
                        const todayStr = today.toISOString().split('T')[0];
                        const isToday = dateStr === todayStr;

                        const bgColor = isToday ? '#EB474D' : '#D9D9D9';
                        const textColor = isToday ? 'white' : 'black';

                        generatedEvents.push({
                            title: event.title,
                            start: `${dateStr}T${startTime}`,
                            end: `${dateStr}T${endTime}`,
                            backgroundColor: bgColor,
                            borderColor: bgColor,
                            textColor: textColor,
                            extendedProps: { startTime, endTime }
                        });
                    }
                }
            });

            const calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: false,
                initialView: 'timeGridWeek',
                slotMinTime: '07:00:00',
                slotMaxTime: '19:00:00',
                allDaySlot: false,
                locale: 'id',
                nowIndicator: true,
                dayHeaderFormat: { weekday: 'long', day: 'numeric' },
                slotLabelFormat: { hour: '2-digit', minute: '2-digit', hour12: false },
                events: generatedEvents,
                height: 'auto',
                eventContent(arg) {
                    const { event } = arg;
                    const { startTime, endTime } = event.extendedProps;
                    const timeColor = event.backgroundColor === '#EB474D' ? 'white' : '#E62129';
                    const iconSrc = event.backgroundColor === '#EB474D'
                        ? "{{ asset('assets/icon-timer-white.svg') }}"
                        : "{{ asset('assets/icon-timer.svg') }}";

                    return {
                        html: `
                    <div class="p-2 text-[10px] leading-[12px]">
                        <div class="font-bold">${event.title}</div>
                        <div class="flex items-center gap-1 text-[10px] leading-[12px]" style="color:${timeColor}">
                            <img src="${iconSrc}" alt="clock" class="w-3 h-3" />
                            <span>${startTime} - ${endTime}</span>
                        </div>
                    </div>`
                    };
                },
                datesSet(info) {
                    const month = info.start.toLocaleString('id-ID', { month: 'long', year: 'numeric' });
                    titleEl.textContent = month;
                }
            });

            calendar.render();

            // Navigation
            prevBtn.addEventListener('click', () => calendar.prev());
            nextBtn.addEventListener('click', () => calendar.next());
            todayBtn.addEventListener('click', () => calendar.today());

            // View change
            viewButtons.forEach(btn => {
                btn.addEventListener('click', () => {
                    viewButtons.forEach(b => b.classList.remove('bg-[#E62129]', 'text-white'));
                    viewButtons.forEach(b => b.classList.add('text-[#E62129]'));
                    btn.classList.add('bg-[#E62129]', 'text-white');
                    btn.classList.remove('text-[#E62129]');
                    calendar.changeView(btn.dataset.view);
                });
            });

            // Search filter
            searchInput.addEventListener('input', function() {
                const keyword = this.value.toLowerCase();
                const filtered = generatedEvents.filter(ev => ev.title.toLowerCase().includes(keyword));
                calendar.removeAllEvents();
                calendar.addEventSource(filtered);
            });
        });
    </script>
@endpush

