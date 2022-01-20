@if ($item['submenu'] == [])
    <li class="nav-item {{ Request::is($item['url'].'*') ? 'active' : '' }}">
        <a class="nav-link px-0 align-middle" href="{{ url($item['url']) }}">
            <i class="nav-icon {{$item['icono']}}"></i>
            <span>{{ $item['name'] }}</span> </a>
    </li>
@else
    <li class="nav-item {{ Request::is($item['url'].'*') ? 'active' : '' }}">
        <a class="nav-link px-0 align-middle" href="#submenu{{$item['id']}}"  data-bs-toggle="collapse" id="a{{$item['id']}}">
            <i class="nav-icon {{$item['icono']}}"></i>
            <span>{{ $item['name'] }}</span>
        </a>
            <ul class="collapse nav flex-column sub-menu" id="submenu{{$item['id']}}" data-bs-parent="#menu">
            @foreach ($item['submenu'] as $submenu)
                @if ($submenu['submenu'] == [])
                    <li class="w-100 {{ Request::is($submenu['url'].'*') ? 'active' : '' }}" id="hijo{{$submenu['id']}}">
                        <a class="nav-link" href="{{url($submenu['url'])}}">
                            <i class="nav-icon {{$submenu['icono']}}"></i>
                            <span class="d-none d-sm-inline">{{ $submenu['name'] }}</span>
                        </a>
                    </li>
                @else
                    @include('partials.menu.menu-item', [ 'item' => $submenu ])
                @endif
                    <script>
                        $(document).ready(function(){
                            $("#hijo{{$submenu['id']}}").on("click",function(){
                                $("#hijo{{$submenu['id']}}").removeClass("active");
                                $(this).addClass("active");
                                $("submenu{{$item['id']}}").addClass("show");
                            })
                        })
                    </script>
            @endforeach
        </ul>
    </li>
@endif

