@extends('layouts.app')
@section("titulo")
    Permisos
@endsection
@section('content')
    <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">Permisos Eliminados</li>
            </ol>
        </nav>
    </div>
    </header>
    <div class="container-fluid">
        <div class="animated fadeIn">
            @include('flash::message')
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header btncancelarZarpes text-white">
                            <i class="fas fa-trash-restore"></i>
                            <strong>Permisos Eliminados</strong>
                            @can('crear-permiso')
                            <div class="card-header-actions">
                                <a class="btn btn-primary btn-sm" href="{{ route('permissions') }}">Volver a Permisos</a>
                            </div>
                            @endcan
                        </div>

                        <div class="card-body">
                            <table class="table table-bordered table-striped" id="generic-table" style="width:100%">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Guard</th>
                                    <th>Eliminado</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($permissions as $permission)
                                    <tr>
                                        <td> {{$permission->id}} </td>
                                        <td>{{$permission->name}} </td>
                                        <td>{{$permission->guard_name}} </td>
                                        <td>{{$permission->deleted_at}} </td>
                                        <td>
                                            @can('eliminar-permiso')
                                                <a class="btn btn-sm btn-warning" href="{{ route('permissionDeleted.restore', [$permission->id]) }}">
                                                    <i class="fas fa-trash-restore"></i>
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
