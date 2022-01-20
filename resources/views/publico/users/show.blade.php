@extends('layouts.app')
@section("titulo")
    Usuarios
@endsection
@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('users.index') }}">Usuario</a>
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
                            <strong>Consulta de Usuario {{$user->nombres}}</strong>
                            <div class="card-header-actions">
                                <a href="{{route('users.index')}} " class="btn btn-primary btn-sm">Listado de
                                    Usuarios</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="my-2">
                                <div class="container">
                                    @include('publico.users.show_fields')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
