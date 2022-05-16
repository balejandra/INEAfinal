@extends('layouts.app')
@section("titulo")
    Zarpes
@endsection
@section('content')
    <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <a href="{{ route('tablaMandos.index') }}">Zarpes</a>
                </li>
                <li class="breadcrumb-item active">Consulta</li>
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
                            <strong>Consultar Solicitud Zarpe INTERNACIONAL</strong>
                            <div class="card-header-actions">
                                <a href= "{{route('permisoszarpes.index')}} " class="btn btn-primary btn-sm">Listado</a>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('zarpes.zarpe_internacional.show_fields')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection