@extends('layouts.app')
@section("titulo")
    Zarpes
@endsection
@section('content')

    <ol class="breadcrumb">
        <li class="breadcrumb-item">Permisos de Zarpe</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            @include('flash::message')
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-ship"></i>
                            <strong>Solicitud de Permisos de Zarpe</strong>
                            <div class="card-header-actions">
                                <a class="btn btn-primary btn-sm" href="{{ route('permisoszarpes.createStepOne') }}">Nuevo</a>
                            </div>
                        </div>
                        <div class="card-body" style="min-height: 350px;">
                            <table class="table table-striped table-bordered" id="permisoZarpes-table">
                                <thead>
                                <tr>
                                    <th>Nro Solicitud</th>
                                    <th>Solicitante</th>
                                    <th>Bandera</th>
                                    <th>Matricula</th>
                                    <th>Tipo Navegacion</th>
                                    <th>Status</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($permisoOrigenZarpes as $permisoOrigenZarpe)
                                    <tr>
                                        <td>{{ $permisoOrigenZarpe->nro_solicitud }}</td>
                                        <td>{{ $permisoOrigenZarpe->user->nombres }} {{ $permisoOrigenZarpe->user->apellidos }}</td>
                                        <td>{{ $permisoOrigenZarpe->bandera }}</td>
                                        <td>{{ $permisoOrigenZarpe->matricula }}</td>
                                        <td>{{ $permisoOrigenZarpe->tipo_zarpe->nombre }}</td>
                                        <td>{{ $permisoOrigenZarpe->status->nombre}} </td>
                                        <td>
                                            @if(($permisoOrigenZarpe->status->id=='2') || ($permisoOrigenZarpe->status->id=='3'))
                                            <a href="{{route('status',[$permisoOrigenZarpe->id,'aprobado'])}}" class="btn btn-primary btn-sm" title="Aprobar">
                                                <i class="fa fa-check" ></i>
                                            </a>
                                            @endif
                                                @if ($permisoOrigenZarpe->status->id=='3')
                                            <a href="{{route('status',[$permisoOrigenZarpe->id,'rechazado'])}}" class="btn btn-danger btn-sm" title="Rechazar">
                                                <i class="fa fa-ban"></i>
                                            </a>
                                                @endif
                                            @can('consultar-zarpe')
                                                <a class="btn btn-sm btn-success"
                                                   href=" {{route('permisoszarpes.show',$permisoOrigenZarpe->id)}}">
                                                    <i class="fa fa-search"></i>
                                                </a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                @foreach($permisoDestinoZarpes as $permisoDestinoZarpe)
                                    <tr>
                                        <td>{{ $permisoDestinoZarpe->nro_solicitud }}</td>
                                        <td>{{ $permisoDestinoZarpe->user->nombres }} {{ $permisoDestinoZarpe->user->apellidos }}</td>
                                        <td>{{ $permisoDestinoZarpe->bandera }}</td>
                                        <td>{{ $permisoDestinoZarpe->matricula }}</td>
                                        <td>{{ $permisoDestinoZarpe->tipo_zarpe->nombre }}</td>
                                        <td>{{ $permisoDestinoZarpe->status->nombre}} </td>
                                        <td>
                                            @can('consultar-zarpe')
                                                <a class="btn btn-sm btn-success"
                                                   href=" {{route('permisoszarpes.show',$permisoDestinoZarpe->id)}}">
                                                    <i class="fa fa-search"></i>
                                                </a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
