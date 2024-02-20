@props([
    'menu' => [],
])

@if ($menu->childrens->count() > 0)
    <div data-kt-menu-placement="bottom-start" class="menu-item menu-here-bg menu-lg-down-accordion me-0 me-lg-2">

        <a class="menu-link dropdown-toggle bg-transparent" href="#" role="button" data-bs-toggle="dropdown"
            aria-expanded="false" href="{{ $menu->url }}">
            <span class="menu-title">
                {{ $menu->name }}
            </span>
        </a>

        <ul class="dropdown-menu">
            @foreach ($menu->childrens as $menu)
                @can($menu->module)
                    <x-atoms.topbar-menu-item :menu="$menu" />
                @endcan
            @endforeach
        </ul>

    </div>
@else
    <div data-kt-menu-placement="bottom-start" class="menu-item menu-here-bg menu-lg-down-accordion me-0 me-lg-2">
        <!--begin:Menu link-->
        <a class="menu-link" href="{{ $menu->url }}">
            <span class="menu-title">{{ $menu->name }}</span>
            <span class="menu-arrow d-lg-none"></span>
        </a>
    </div>
@endif
