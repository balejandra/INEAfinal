    <table class="table table-responsive-sm table-bordered table-striped" id="users-table">
        <thead>
            <tr>
                <th>Id</th>
        <th>Email</th>
        <th>Nombres</th>
        <th>Iniciales</th>
                <th colspan="3">Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->nombres }}</td>
            <td>{{ $user->iniciales }}</td>
                <td>
                    @can('consultar-usuario')
                    <a class="btn btn-sm btn-success" href="  {{ route('users.show', [$user->id]) }}">
                        <i class="fa fa-search"></i>
                    </a>
                    @endcan
                    @can('editar-usuario')
                    <a class="btn btn-sm btn-info" href=" {{ route('users.edit', [$user->id]) }}">
                        <i class="fa fa-edit"></i>
                    </a>
                    @endcan
                    @can('eliminar-usuario')
                    <div class='btn-group'>
                        {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}

                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Realmente desera eliminar el user $user->nombres ?')"]) !!}

                        {!! Form::close() !!}
                    </div>
                    @endcan
                    <!-- Modal -->
                    <div class="modal fade" id="deletemodal{{$user->id}}" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Eliminar registro</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div id="bodymodal" class="modal-body">
                                    Realmente desea eliminar el rol <b>{{$user->nombres}}</b> y sus permisos asignados ?
                                    recuerde que esta acción es permanente y no se podrá deshacer.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn  btn-sm btn-secondary" data-dismiss="modal">Close
                                    </button>
                                    <form action="{{route('roles.destroy',$user->id)}}" id="delete{{$user->id}}"
                                          method="post" style="display:inline-block;">
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
        @endforeach
        </tbody>
    </table>
