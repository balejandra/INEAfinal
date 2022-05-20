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
                                     <a href= "{{route('capitaniaUsers.index')}} " class="btn btn-primary btn-sm">Cancelar</a>
                                 </div>
                             </div>
                             <div class="card-body">
                                 <div class="my-2">
                                     <div class="container">
                                         <div class="row">
                                             <div class="col-md-3"></div>
                                             <div class="col-md-6 p-0 border rounded">
                                 @include('publico.capitania_users.show_fields')
                                             </div>
                                             <div class="col-md-3"></div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
          </div>
    </div>
@endsection
