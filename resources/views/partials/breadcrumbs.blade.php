@php
    use App\Helpers\Menu;
    $breadcrumbs = Menu::getBreadcrumbs(Request::path());
@endphp

<div class="breadcrumb-container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            @foreach($breadcrumbs as $breadcrumb)
                <li class="breadcrumb-item {{ $breadcrumb['active'] ? 'active' : '' }}">
                    @if($breadcrumb['active'])
                        {{ $breadcrumb['name'] }}
                    @else
                        <a href="{{ $breadcrumb['url'] }}">
                            {{ $breadcrumb['name'] }}
                        </a>
                    @endif
                </li>
            @endforeach
        </ol>
    </nav>
</div>