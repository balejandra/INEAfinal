@extends('layouts.app')
@section("titulo")
    Estadias
@endsection
@section('content')
    @push('scripts')
        <script src="{{asset('js/estadia.js')}}"></script>
    @endpush
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
         <a href="{!! route('permisosestadia.index') !!}">Permiso Estadia</a>
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
                                <i class="fa fa-plus-square-o fa-lg"></i>
                                <strong>Crear Permiso de Estadia</strong>
                                <div class="card-header-actions">
                                    <a href= "{{route('permisosestadia.index')}} " class="btn btn-primary btn-sm">Listado de Permisos de Estadia</a>
                                </div>
                            </div>
                            <div class="card-body">
                                {!! Form::open(['route' => 'permisosestadia.store', 'files' => true]) !!}

                                   @include('zarpes.permiso_estadias.fields')

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
           </div>
    </div>
@endsection
