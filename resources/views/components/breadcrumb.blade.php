@php
    use App\Helpers\Menu;
    $breadcrumbs = Menu::getBreadcrumbs(Request::path());
@endphp

<div class="py-4 px-6" x-data="{ breadcrumbs: @js($breadcrumbs) }">
    <nav aria-label="breadcrumb">
        <ol class="flex items-center gap-2 m-0 p-0 list-none">
            <template x-for="breadcrumb in breadcrumbs">
                <li 
                  class="flex items-center gap-3" 
                  x-bind:class="{ 'text-[#333333]': breadcrumb.active, 'text-[#E62129]': !breadcrumb.active }"
                >
                    <template x-if="breadcrumb.active">
                        <span x-text="breadcrumb.name"></span>
                    </template>
                    <template x-if="!breadcrumb.active">
                      <div>
                        <a x-bind:href="breadcrumb.url" x-text="breadcrumb.name"></a>
                        <span class="text-[#333333]" x-text="'/'"></span>
                      </div>
                    </template>
                </li>
            </template>
        </ol>
    </nav>
</div>