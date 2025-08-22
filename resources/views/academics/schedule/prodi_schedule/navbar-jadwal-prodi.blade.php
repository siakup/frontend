<div class="navigation-card">
    <a href="{{ route('academics.schedule.prodi-schedule.index') }}"
      class="item @if (Route::currentRouteName() === 'academics.schedule.prodi-schedule.index') active @endif">
        Jadwal Kuliah Program Studi
    </a>
    <a href="{{ route('curriculum.list') }}" class="item @if (Route::currentRouteName() === 'curriculum.list') active @endif">Jadwal Kuliah Institusi Parent</a>
</div>


