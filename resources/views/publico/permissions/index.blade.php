@extends('layouts.app')
@section("titulo")
    Permisos
@endsection
@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Permisos</li>
    </ol>
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
                                    <a class="btn btn-primary btm-sm" href="{{ route('permissions.create') }}">Nuevo</a>
                                </div>
                            @endcan
                        </div>
                        <div class="card-body">
                            <table class="table table-responsive-sm table-bordered table-striped" id="TablePermissions">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Guard</th>
                                    <th>Created_at</th>
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
                                            {!! Form::open(['route' => ['permissions.destroy', $permission->id], 'method' => 'delete']) !!}
                                            <div class='btn-group'>
                                            <!-- <a href="{{ route('permissions.show', [$permission->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a> -->
                                                @can('editar-permiso')
                                                    <a href="{{ route('permissions.edit', [$permission->id]) }}"
                                                       class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                                                @endcan
                                                @can('eliminar-permiso')
                                                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Realmente desera eliminar este permiso?')"]) !!}
                                                    {!! Form::close() !!}
                                                @endcan
                                            </div>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center"> No existen registros para mostrar</td>
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
