<div class="navigation-card">
    <a 
      href="{{ route('curriculum.required-structure') }}" class="item @if (Route::currentRouteName() === 'curriculum.required-structure') active @endif"
      @if(Route::currentRouteName() === 'curriculum.required-structure') style="background-color: #F5F5F5" @endif
    >
      Mata Kuliah Wajib
    </a>
    <a 
      href="{{ route('curriculum.optional-structure') }}" class="item @if (Route::currentRouteName() === 'curriculum.optional-structure') active @endif"
      @if(Route::currentRouteName() === 'curriculum.optional-structure') style="background-color: #F5F5F5" @endif
    >
      Mata Kuliah Pilihan
    </a>
</div>
