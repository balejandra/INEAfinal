 <div class="container-fluid">
            <button class="header-toggler px-md-0 me-md-3" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
                <svg class="icon icon-lg">
                    <use xlink:href="{{asset('assets/@coreui/icons/svg/free.svg')}}#cil-menu"></use>
                </svg>
            </button>
     <a class="header-brand d-md-none" href="#">
         <img width="118" height="46" src="{{asset('images/logo-inea.svg')}}" alt="">
     </a>
            <ul class="header-nav d-none d-md-flex">
                <strong class="titulo-princ">SISTEMA DE CONTROL Y GESTIÓN DE ZARPES</strong>
            </ul>

            <ul class="header-nav ms-3">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle py-0" data-coreui-toggle="dropdown"  href="#" role="button" aria-haspopup="true" aria-expanded="false">

                        {{ Auth::user()->email }}

                    </a>
                    <div class="dropdown-menu dropdown-menu-end pt-0">

                       <a class="dropdown-item" href="#">
                           <a href="#" class="dropdown-item btn btn-default btn-flat"
                              onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                               <i class="fa fa-lock"></i> Cerrar Sesion
                           </a>
                           <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                               @csrf
                           </form>
                       </a>
                    </div>
                </li>
            </ul>
        </div>
