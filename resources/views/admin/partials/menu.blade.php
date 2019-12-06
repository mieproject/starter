@php
    $r = \Route::current()->getAction();
    $route = (isset($r['as'])) ? $r['as'] : '';
    $url = urldecode(url()->full());
@endphp

<style>
    a.sidebar-link.actives {
        font-weight: 350;
        color: #2196F3;
    }
</style>
<li class="nav-item mT-30">
    <a class="sidebar-link {{ Str::startsWith($route, 'admin' . '.dash') ? 'actives' : '' }}" href="#edit">
        <span class="icon-holder">
            <i class="c-blue-500 ti-home"></i>
        </span>
        <span class="title">Dashboard</span>
    </a>
</li>
<li class="nav-item">
    <a class="sidebar-link {{ Str::contains($route, 'admin' . '.settings') ? 'actives active' : '' }}" href="{{ route('admin' . '.settings') }}">
        <span class="icon-holder">
            <i class="c-blue-500 ti-settings"></i>
        </span>
        <span class="title">Settings</span>
    </a>
</li>
{{--<li class="nav-item">--}}
{{--    <a class="sidebar-link {{ Str::startsWith($route, ADMIN . '.users') ? 'active' : '' }}" href="{{ route(ADMIN . '.users.index') }}">--}}
{{--        <span class="icon-holder">--}}
{{--            <i class="c-brown-500 ti-user"></i>--}}
{{--        </span>--}}
{{--        <span class="title">Users</span>--}}
{{--    </a>--}}
{{--</li>--}}
{{--@foreach(getMenuPages(['productComments','productLikes']) as $item)--}}
{{--    @if(!is_array($item))--}}
{{--    <li class="nav-item">--}}
{{--        <a class="sidebar-link {{ Str::contains($route, ADMIN . '.'.$item) ? 'actives active' : '' }}" href="{{ route(ADMIN . ".$item.index") }}">--}}
{{--            <span class="icon-holder">--}}
{{--                <i class="c-brown-500 ti-folder"></i>--}}
{{--            </span>--}}
{{--            <span class="title">{{ ucfirst($item) }}</span>--}}
{{--        </a>--}}
{{--    </li>--}}
{{--    @else--}}
{{--        <hr>--}}
{{--        @foreach($item as $baseName=>$theItem)--}}
{{--            <li class="nav-item">--}}
{{--                <a class="sidebar-link  {{ (Str::contains($url, ADMIN . "/$theItem") ? 'actives active' : '') }}"--}}
{{--                   href="{{ url(ADMIN . "/$theItem") }}">--}}
{{--            <span class="icon-holder">--}}
{{--                <i class="c-brown-500 ti-folder"></i>--}}
{{--            </span>--}}
{{--                    <span class="title">{{ ucfirst($baseName) }}</span>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--        @endforeach--}}
{{--        <hr>--}}
{{--    @endif--}}
{{--@endforeach--}}
