@extends('layouts.app')
@section("titulo")
    Permisos
@endsection
@section('content')
    <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">Permisos</li>
            </ol>
        </nav>
    </div>
    </header>
    <div class="container-fluid">
        <div class="animated fadeIn">
            @include('flash::message')


            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" id="msj" role="success">
                    <button type="button" class="close success-op" data-dismiss="alert" aria-label="close">
                        &times;
                    </button>
                    {{session('success')}}
                </div>
            @endif

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i>
                            <strong>Permisos</strong>
                            @can('crear-permiso')
                            <div class="card-header-actions">
                                <a class="btn btn-primary btn-sm" href="{{ route('permissions.create') }}">Nuevo</a>
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
                                    <th>Creado</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($permissions as $permission)
                                    <tr>
                                        <td> {{$permission->id}} </td>
                                        <td>{{$permission->name}} </td>
                                        <td>{{$permission->guard_name}} </td>
                                        <td>{{$permission->created_at}} </td>
                                        <td>
                                            @can('editar-menu')
                                                <a class="btn btn-sm btn-info" href="{{ route('permissions.edit', [$permission->id]) }}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            @endcan
                                            @can('eliminar-menu')
                                                <div class='btn-group'>
                                                    {!! Form::open(['route' => ['permissions.destroy', $permission->id], 'method' => 'delete']) !!}

                                                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Realmente desera eliminar este permiso?')"]) !!}

                                                    {!! Form::close() !!}
                                                </div>
                                            @endcan

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                         No existen registros para mostrar
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
