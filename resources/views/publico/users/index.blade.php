@extends('layouts.app')
@section("titulo")
    Usuarios
@endsection
@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Usuarios</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            @include('flash::message')


            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-plus-square-o fa-lg"></i>
                            <strong>Usuarios</strong>
                            @can('crear-usuario')
                            <div class="card-header-actions">
                                <a class="btn btn-primary btn-sm"  href="{{ route('users.create') }}">Nuevo</a>
                            </div>
                            @endcan
                        </div>
                        <div class="card-body">
                            @include('publico.users.table')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

