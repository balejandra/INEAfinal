@extends('layouts.app')
@section("titulo")
    Zarpes
@endsection
@section('content')
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
         <a href="{!! route('menus.index') !!}">Permisos de zarpes</a>
      </li>
      <li class="breadcrumb-item">Crear</li>
    </ol>
     <div class="container-fluid">
          <div class="animated fadeIn">
                @include('coreui-templates::common.errors')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <i class="fas fa-ship fa-lg"></i>
                                <strong>Solicitud de permiso de zarpe</strong>

                                <div class="card-header-actions">
                                    <a href= "./" class="btn btn-primary btn-sm">Volver al listado</a>
                                </div>

                            </div>
                            <div class="card-body">
                                

                                   @include('zarpes.PermisoDeZarpe.taps')

                                
                            </div>
                        </div>
                    </div>
                </div>
           </div>
    </div>
@endsection
