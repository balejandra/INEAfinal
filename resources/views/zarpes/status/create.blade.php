@extends('layouts.app')
@section("titulo")
    Estatus
@endsection
@section('content')
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
         <a href="{!! route('status.index') !!}">Estatus</a>
      </li>
      <li class="breadcrumb-item active">Crear</li>
    </ol>
     <div class="container-fluid">
          <div class="animated fadeIn">
                @include('coreui-templates::common.errors')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-plus-square-o fa-lg"></i>
                                <strong>Crear Estatus</strong>
                                <div class="card-header-actions">
                                    <a href="{{route('status.index')}} " class="btn btn-primary btn-sm">Listado de Estatus</a>
                                </div>
                            </div>
                            <div class="card-body">
                                {!! Form::open(['route' => 'status.store']) !!}

                                   @include('zarpes.status.fields')

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
           </div>
    </div>
@endsection
