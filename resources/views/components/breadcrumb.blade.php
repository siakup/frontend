@php
    use App\Helpers\Menu;

    $breadcrumbs = Menu::getBreadcrumbs(Request::path());
    $full = $breadcrumbs;

    if (count($breadcrumbs) > 4) {
        $compact = [
            $breadcrumbs[0],                                
            ['name' => '…', 'url' => '#'],                
            $breadcrumbs[count($breadcrumbs)-2],            
            $breadcrumbs[count($breadcrumbs)-1],            
        ];
    } else {
        $compact = $breadcrumbs;
    }
@endphp

<div class="py-4 px-6 relative"
     x-data="{
        mode: 'compact',
        full: @js($full),
        compact: @js($compact),
        openDropdown: false,
        get breadcrumbs() {
            return this.mode === 'compact' ? this.compact : this.full;
        }
     }"
     @click.outside="openDropdown = false">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb-list">
            <template x-for="(breadcrumb, index) in breadcrumbs" :key="index">
                <li class="breadcrumb-item"
                    :class="breadcrumb.active ? 'breadcrumb-active' : 'breadcrumb-inactive'">
                    
                    <template x-if="breadcrumb.name.trim() === '…'">
                        <span class="breadcrumb-ellipsis"
                              @click="openDropdown = !openDropdown">
                            <img 
                                src="{{ asset('assets/icons/more/red-12.svg') }}" 
                                alt="More"
                                class="w-5 h-5"
                            >
                        </span>
                    </template>

                    <template x-if="breadcrumb.name.trim() !== '…'">
                        <a :href="breadcrumb.url"
                           x-text="breadcrumb.name">
                        </a>
                    </template>

                    <span x-show="index < breadcrumbs.length - 1">/</span>
                </li>
            </template>
        </ol>
    </nav>

    <div x-show="openDropdown"
         x-transition
         class="breadcrumb-dropdown">
        <template x-for="item in full.slice(1, full.length - 1)" :key="item.name">
            <a :href="item.url"
               class="breadcrumb-dropdown-item"
               x-text="item.name">
            </a>
        </template>
    </div>
</div>