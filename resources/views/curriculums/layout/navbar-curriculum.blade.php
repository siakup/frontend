<div class="navigation-card">
    <a href="{{ route('curriculum.list') }}" class="item @if (Route::currentRouteName() === 'curriculum.list') active @endif">Daftar Kurikulum</a>
    <a href="{{ 
        (Route::currentRouteName() === 'curriculum.required-structure' || Route::currentRouteName() !== 'curriculum.optional-structure') 
        ? route('curriculum.required-structure') 
        : route('curriculum.optional-structure') 
      }}" 
      class="item @if (Route::currentRouteName() === 'curriculum.required-structure' || Route::currentRouteName() === 'curriculum.optional-structure') active @endif">
        Struktur Kurikulum
    </a>
    <a href="{{ route('curriculum.equivalence') }}" class="item @if (Route::currentRouteName() === 'curriculum.equivalence') active @endif">Ekuivalensi Kurikulum</a>
</div>
