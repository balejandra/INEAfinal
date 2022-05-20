@extends('layouts.app')
@section("titulo")
    Roles
@endsection
@section('content')
    <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">Roles</li>
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
                             <i class="fa fa-id-badge"></i>
                            <strong>Roles</strong>
                            @can('crear-rol')
                                <div class="card-header-actions">
                                    <a class="btn btn-primary btn-sm"  href="{{ route('roles.create') }}">Nuevo</a>
                                </div>
                            @endcan

                        </div>
                        <div class="card-body">


                            <table class="table table-striped table-bordered" style="width:100%" id="generic-table">
                                <thead>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>guard</th>
                                <th>Creado</th>
                                <th>Permisos</th>
                                <th class="text-center" width="15%">Acciones</th>
                                </thead>
                                <tbody>
                                @forelse($roles as $role)
                                    <tr>
                                        <td> {{$role->id}} </td>
                                        <td>{{$role->name}} </td>
                                        <td>{{$role->guard_name}} </td>
                                        <td>{{$role->created_at->toFormattedDateString()}} </td>
                                        <td width="45%">
                                            @forelse($role->permissions as $permission)
                                                <span class="badge badge-info">{{$permission->name}} </span>
                                            @empty
                                                <span class="badge badge-danger">Sin permisos asignados</span>
                                            @endforelse
                                        </td>
                                        <td class="text-center">
                                            @can('consultar-rol')
                                                <a class="btn btn-sm btn-success"
                                                   href=" {{route('roles.show',$role->id)}}">
                                                    <i class="fa fa-search"></i>
                                                </a>
                                            @endcan
                                            @can('editar-rol')
                                                <a class="btn btn-sm btn-info"
                                                   href=" {{route('roles.edit',$role->id)}}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            @endcan
                                            @can('eliminar-rol')

                                                <div class='btn-group'>
                                                    {!! Form::open(['route' => ['roles.destroy', $role->id], 'method' => 'delete']) !!}

                                                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Realmente desera eliminar el rol $role->name ?')"]) !!}

                                                    {!! Form::close() !!}
                                                </div>
                                        @endcan

                                        <!-- Modal -->
                                            <div class="modal fade" id="deletemodal{{$role->id}}" tabindex="-1"
                                                 role="dialog" aria-labelledby="exampleModalCenterTitle"
                                                 aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Eliminar
                                                                registro</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div id="bodymodal" class="modal-body">
                                                            Realmente desea eliminar el rol <b>{{$role->name}}</b> y sus
                                                            permisos asignados ?
                                                            recuerde que esta acción es permanente y no se podrá
                                                            deshacer.
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn  btn-sm btn-secondary"
                                                                    data-dismiss="modal">Close
                                                            </button>
                                                            <form action="{{route('roles.destroy',$role->id)}}"
                                                                  id="delete{{$role->id}}" method="post"
                                                                  style="display:inline-block;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-sm btn-danger" type="submit">
                                                                    Eliminar
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
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
