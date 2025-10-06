<div class="navigation-card">
    <a href="{{ route('tutelage-group.student-list.detail-krs', ['id' => $id]) }}" class="item @if (Route::currentRouteName() === 'tutelage-group.student-list.detail-krs') active @endif">KRS</a>
    <a href="{{
      route('tutelage-group.student-list.detail-student-data',['id' => $id])
      }}"
      class="item @if (Route::currentRouteName() === 'tutelage-group.student-list.detail-student-data') active @endif">
        Data Mahasiswa
    </a>
    <a href="{{ route('tutelage-group.student-list.detail-transkrip-resmi', ['id' => $id]) }}" class="item @if (Route::currentRouteName() === 'tutelage-group.student-list.detail-transkrip-resmi') active @endif">Transk. Resmi</a>
    <a href="{{ route('tutelage-group.student-list.detail-transkrip-historis', ['id' => $id]) }}" class="item @if (Route::currentRouteName() === 'tutelage-group.student-list.detail-transkrip-historis') active @endif">Transk. Historis</a>
    <a href="{{ route('curriculum.equivalence') }}" class="item @if (Route::currentRouteName() === 'curriculum.equivalence') active @endif">Transk. Kurikulum</a>
    <a href="{{ route('curriculum.equivalence') }}" class="item @if (Route::currentRouteName() === 'curriculum.equivalence') active @endif">Transk. PEM</a>
</div>
