<header class="app-header navbar">
    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#">
        <img class="navbar-brand-full" src="{{asset("images/inea.png")}}" width="30" height="30"
             alt="INEA Logo">
        <img class="navbar-brand-minimized" src="{{asset("images/inea.png")}}" width="30"
             height="30" alt="INEA Logo">
    </a>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="nav navbar-nav ml-auto">
    <h3><strong>SISTEMA DE CONTROL Y GESTIÓN DE ZARPES</strong></h3>
    </div>
    <ul class="nav navbar-nav ml-auto">
        <div class="dropdown">
            <a class="nav-link  dropdown-toggle" style="margin-right: 50px" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                {{ Auth::user()->email }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start" aria-labelledby="dropdownMenuLink">
                <li>
                <a class="dropdown-item" href="#">
                    <i class="fa fa-user"></i> Perfil</a>
                </li>
                <li>
                    <a class="dropdown-item" href="#">
                    <i class="fa fa-wrench"></i> Configuracion</a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a href="#" class="dropdown-item btn btn-default btn-flat"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-lock"></i>Cerrar Sesion
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                </li>
            </ul>
        </div>
    </ul>
</header>
