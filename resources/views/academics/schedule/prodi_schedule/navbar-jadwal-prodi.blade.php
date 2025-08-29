<div class="navigation-card">
    <a href="{{ route('academics.schedule.prodi-schedule.index') }}"
      class="item @if (Route::currentRouteName() === 'academics.schedule.prodi-schedule.index') active @endif">
        Jadwal Kuliah Program Studi
    </a>
    <a href="{{ route('academics.schedule.parent-institution-schedule.index') }}" class="item @if (Route::currentRouteName() === 'academics.schedule.parent-institution-schedule.index') active @endif">Jadwal Kuliah Institusi Parent</a>
</div>


