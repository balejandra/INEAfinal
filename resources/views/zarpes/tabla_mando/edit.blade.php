@extends('layouts.app')
@section("titulo")
    Usuarios
@endsection
@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! route('tablaMandos.index') !!}">Tabla Mando</a>
        </li>
        <li class="breadcrumb-item active">Editar</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            @include('coreui-templates::common.errors')
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-edit fa-lg"></i>
                            <strong>Editar Tabla de Mando</strong>
                            <div class="card-header-actions">
                                <a href="{{route('tablaMandos.index')}} " class="btn btn-primary btn-sm">Listado de Tabla de Mandos</a>
                            </div>
                        </div>
                        <div class="card-body">
                            {!! Form::model($tablaMando, ['route' => ['tablaMandos.update', $tablaMando->id], 'method' => 'patch']) !!}

                            @include('zarpes.tabla_mando.fields')

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
