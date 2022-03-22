@extends('layouts.app')
@section("titulo")
    Estadias
@endsection
@section('content')
     <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('permisosestadia.index') }}">Permisos de Estadia</a>
            </li>
            <li class="breadcrumb-item ">Consulta</li>
     </ol>
     <div class="container-fluid">
          <div class="animated fadeIn">
                 @include('coreui-templates::common.errors')
                 <div class="row">
                     <div class="col-lg-12">
                         <div class="card">
                             <div class="card-header">
                                 <strong>Consultar Permiso de Estadia</strong>
                                 <div class="card-header-actions">
                                     <a href= "{{route('permisosestadia.index')}} " class="btn btn-primary btn-sm">Listado de Permisos de Estadia</a>
                                 </div>
                             </div>
                             <div class="card-body">
                                 @include('zarpes.permiso_estadias.show_fields')
                             </div>
                         </div>
                     </div>
                 </div>
          </div>
    </div>
@endsection
