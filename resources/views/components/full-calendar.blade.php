@props([
    'events' => [],
    'slotMinTime' => '07:00:00',
    'slotMaxTime' => '19:00:00',
    'initialView' => 'timeGridWeek',
    'title' => 'Jadwal Kuliah Mahasiswa',
])

<div>
    <div id="calendar-header" class="calendar-header-wrapper">

        <div class="calendar-control-group">
            <h2 class="calendar-title-h2">{{ $title }}</h2>

            <button id="today-btn" class="calendar-today-btn">Hari ini</button>

            <div class="flex items-center gap-2">
                <button id="prev-btn" class="calendar-nav-btn">&lt;</button>
                <button id="next-btn" class="calendar-nav-btn">&gt;</button>
            </div>
        </div>

        <h3 id="calendar-title" class="calendar-title-h3"></h3>

        <div id="calendar-filters" class="calendar-filter-group">

            <div class="calendar-search-wrapper">
                <input id="calendar-search" type="text" placeholder="Cari Jadwal" class="calendar-search-input" />
                <x-icon :name="'search-2/grey-24'" />
            </div>

            <div class="calendar-view-wrapper">
                <button data-view="dayGridMonth" class="view-btn calendar-view-btn">Bulan</button>
                <button data-view="timeGridWeek" class="view-btn calendar-view-btn active">Minggu</button>
                <button data-view="timeGridDay" class="view-btn calendar-view-btn">Hari</button>
                <button data-view="listWeek" class="view-btn calendar-view-btn">List</button>
            </div>
        </div>
    </div>
    <div id="calendar"></div>
</div>

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css" rel="stylesheet">
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

            const baseEvents = @json($events);
            const generatedEvents = [];

            baseEvents.forEach(event => {
                const classCode = event.class || '';
                const roomCode = event.room || '';

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

                        const bgColor = isToday ? '#EB474D' : '#E8E8E8';
                        const textColor = isToday ? 'white' : 'black';

                        generatedEvents.push({
                            title: event.title,
                            start: `${dateStr}T${startTime}`,
                            end: `${dateStr}T${endTime}`,
                            backgroundColor: bgColor,
                            borderColor: bgColor,
                            textColor: textColor,
                            extendedProps: {
                                startTime: startTime,
                                endTime: endTime,
                                classCode: classCode,
                                roomCode: roomCode
                            }
                        });
                    }
                }

            });

            const calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: false,
                initialView: '{{ $initialView }}',
                slotMinTime: '{{ $slotMinTime }}',
                slotMaxTime: '{{ $slotMaxTime }}',
                allDaySlot: false,
                locale: 'id',
                nowIndicator: true,
                dayHeaderFormat: {
                    weekday: 'long',
                    day: 'numeric'
                },
                slotLabelFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: false
                },
                events: generatedEvents,
                height: 'auto',

                eventContent(arg) {
                    const {
                        event
                    } = arg;
                    const {
                        startTime,
                        endTime,
                        classCode,
                        roomCode
                    } = event.extendedProps;
                    const timeColor = event.backgroundColor === '#EB474D' ? 'white' : '#E62129';
                    const iconSrc = event.backgroundColor === '#EB474D' ?
                        "{{ asset('assets/icons/timer/outline-white-20.svg') }}" :
                        "{{ asset('assets/icons/timer/outline-red-20.svg') }}";

                    return {
                        html: `
                        <div class="p-2 text-xs">
                            <div class="font-bold">${event.title}</div>
                            
                            <div class="mt-1 font-bold">
                                ${classCode ? classCode + ' - ' : ''} ${roomCode ? '[' + roomCode + ']': ''}
                            </div>
                            
                            <div class="flex items-center gap-1 mt-1" style="color:${timeColor}">
                                <img src="${iconSrc}" alt="clock"/>
                                <span>${startTime} - ${endTime}</span>
                            </div>
                        </div>`
                    };
                },
                datesSet(info) {
                    const month = info.start.toLocaleString('id-ID', {
                        month: 'long',
                        year: 'numeric'
                    });
                    titleEl.textContent = month;
                }
            });

            calendar.render();

            setTimeout(() => {
                calendar.updateSize();
            }, 10);

            // Navigation
            prevBtn.addEventListener('click', () => calendar.prev());
            nextBtn.addEventListener('click', () => calendar.next());
            todayBtn.addEventListener('click', () => calendar.today());

            // View change
            viewButtons.forEach(btn => {
                btn.addEventListener('click', () => {
                    viewButtons.forEach(b => b.classList.remove('bg-red-400', 'text-white'));
                    viewButtons.forEach(b => b.classList.add('text-red-400'));
                    btn.classList.add('bg-red-400', 'text-white');
                    btn.classList.remove('text-red-400');
                    calendar.changeView(btn.dataset.view);
                });
            });

            // Search filter
            searchInput.addEventListener('input', function() {
                const keyword = this.value.toLowerCase();
                const filtered = generatedEvents.filter(ev =>
                    ev.title.toLowerCase().includes(keyword) ||
                    ev.extendedProps.classCode.toLowerCase().includes(keyword) ||
                    ev.extendedProps.roomCode.toLowerCase().includes(keyword)
                );
                calendar.removeAllEvents();
                calendar.addEventSource(filtered);
            });
        });
    </script>
@endpush
