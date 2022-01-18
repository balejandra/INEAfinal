@if ($item['submenu'] == [])
    <li class="nav-item {{ Request::is($item['url']) ? 'active' : '' }}">
        <a class="nav-link px-0 align-middle" href="{{ url($item['url']) }}">
            <i class="nav-icon {{$item['icono']}}"></i>
            <span>{{ $item['name'] }}</span> </a>
    </li>
@else
    <li class="nav-item {{ Request::is($item['name']) ? 'active' : '' }}">
        <a class="nav-link px-0 align-middle" href="#submenu{{$item['id']}}"  data-bs-toggle="collapse">
            <i class="nav-icon {{$item['icono']}}"></i>
            <span>{{ $item['name'] }}</span>
        </a>
            <ul class="collapse nav flex-column" id="submenu{{$item['id']}}" data-bs-parent="#menu">
            @foreach ($item['submenu'] as $submenu)
                @if ($submenu['submenu'] == [])
                    <li class="w-100">
                        <a class="nav-link" href="{{route($item['url'])}}">
                            <i class="nav-icon {{$item['icono']}}"></i>
                            <span class="d-none d-sm-inline">{{ $submenu['name'] }}</span>
                        </a>
                    </li>
                @else
                    @include('partials.menu.menu-item', [ 'item' => $submenu ])
                @endif
            @endforeach
        </ul>
    </li>
@endif
