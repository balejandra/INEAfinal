@extends('layouts.app')
@section("titulo")
    Tabla de mandos
@endsection
@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Tabla de Mandos</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            @include('flash::message')

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-plus-square-o fa-lg"></i>
                            <strong>Tabla de Mandos</strong>
                            @can('crear-mandos')
                            <div class="card-header-actions">
                                <a class="btn btn-primary btn-sm"  href="{{ route('tablaMandos.create') }}">Nuevo</a>
                            </div>
                            @endcan
                        </div>
                        <div class="card-body">
                            @include('zarpes.tabla_mando.table')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

