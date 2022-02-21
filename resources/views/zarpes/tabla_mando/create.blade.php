@extends('layouts.app')
@section("titulo")
    Tabla de Mandos
@endsection
@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! route('tablaMandos.index') !!}">Tabla Mando</a>
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
                            <strong>Crear Tabla de Mando</strong>
                            <div class="card-header-actions">
                                <a href="{{route('tablaMandos.index')}} " class="btn btn-primary btn-sm">Listado de Tabla de Mandos</a>
                            </div>
                        </div>
                        <div class="card-body">
                            {!! Form::open(['route' => 'tablaMandos.store']) !!}

                            @include('zarpes.tabla_mando.fields')

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
