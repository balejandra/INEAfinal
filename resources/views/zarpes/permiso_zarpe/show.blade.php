@extends('layouts.app')
@section("titulo")
    Zarpes
@endsection
@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('tablaMandos.index') }}">Zarpes</a>
        </li>
        <li class="breadcrumb-item active">Consulta</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            @include('coreui-templates::common.errors')
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Consultar Solicitud Zarpe</strong>
                            <div class="card-header-actions">
                                <a href= "{{route('permisoszarpes.index')}} " class="btn btn-primary btn-sm">Listado de Solicitud de Zarpes</a>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('zarpes.permiso_zarpe.show_fields')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
