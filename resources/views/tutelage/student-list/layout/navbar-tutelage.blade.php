<div class="navigation-card">
    <a href="{{ route('tutelage-group.student-list.detail-krs', ['id' => '1']) }}" class="item @if (Route::currentRouteName() === 'tutelage-group.student-list.detail-krs') active @endif">KRS</a>
    <a href="{{ 
        (Route::currentRouteName() === 'curriculum.required-structure' || Route::currentRouteName() !== 'curriculum.optional-structure') 
        ? route('curriculum.required-structure') 
        : route('curriculum.optional-structure') 
      }}" 
      class="item @if (Route::currentRouteName() === 'curriculum.required-structure' || Route::currentRouteName() === 'curriculum.optional-structure') active @endif">
        Data Mahasiswa
    </a>
    <a href="{{ route('curriculum.equivalence') }}" class="item @if (Route::currentRouteName() === 'curriculum.equivalence') active @endif">Transk. Resmi</a>
    <a href="{{ route('curriculum.equivalence') }}" class="item @if (Route::currentRouteName() === 'curriculum.equivalence') active @endif">Transk. Historis</a>
    <a href="{{ route('curriculum.equivalence') }}" class="item @if (Route::currentRouteName() === 'curriculum.equivalence') active @endif">Transk. Kurikulum</a>
    <a href="{{ route('curriculum.equivalence') }}" class="item @if (Route::currentRouteName() === 'curriculum.equivalence') active @endif">Transk. PEM</a>
</div>
