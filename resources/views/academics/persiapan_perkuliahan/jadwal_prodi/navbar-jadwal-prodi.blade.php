<div class="navigation-card">
    <a href="{{ route('academics.persiapan-perkuliahan.jadwal-prodi.index') }}"
      class="item @if (Route::currentRouteName() === 'academics.persiapan-perkuliahan.jadwal-prodi.index') active @endif">
        Jadwal Kuliah Program Studi
    </a>
    <a href="{{ route('curriculum.list') }}" class="item @if (Route::currentRouteName() === 'curriculum.list') active @endif">Jadwal Kuliah Institusi Parent</a>
</div>
