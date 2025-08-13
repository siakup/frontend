<div class="navigation-card">
    <a href="{{ route('curriculum.list') }}" class="item @if (Route::currentRouteName() === 'curriculum.list') active @endif">Daftar Kurikulum</a>
    <a href="{{ route('curriculum.structure') }}" class="item @if (Route::currentRouteName() === 'curriculum.structure') active @endif">Struktur Kurikulum</a>
    <a href="{{ route('curriculum.equivalence') }}" class="item @if (Route::currentRouteName() === 'curriculum.equivalence') active @endif">Ekuivalensi Kurikulum</a>
</div>
