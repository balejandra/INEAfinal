@extends('layouts.app')
@section("titulo")
    Usuarios de Capitania
@endsection
@section('content')
    <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <a href="{{ route('capitaniaUsers.index') }}">Usuarios de Capitanias</a>
                </li>
                <li class="breadcrumb-item active">Detalle</li>
            </ol>
        </nav>
    </div>
    </header>
     <div class="container-fluid">
          <div class="animated fadeIn">
                 @include('coreui-templates::common.errors')
                 <div class="row">
                     <div class="col-lg-12">
                         <div class="card">
                             <div class="card-header">
                                 <strong>Consultar Usuario de Capitania</strong>
                                 <div class="card-header-actions">
                                     <a href= "{{route('capitaniaUsers.index')}} " class="btn btn-primary btn-sm">Listado de Usuarios de Capitanias</a>
                                 </div>
                             </div>
                             <div class="card-body">
                                 @include('publico.capitania_users.show_fields')
                             </div>
                         </div>
                     </div>
                 </div>
          </div>
    </div>
@endsection
