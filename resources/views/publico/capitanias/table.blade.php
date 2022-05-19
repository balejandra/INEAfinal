    <table class="table table-striped table-bordered" id="capitanias-table" style="width:100%">
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Sigla</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($capitanias as $capitania)
            <tr>
                <td>{{ $capitania->nombre }}</td>
                <td>{{ $capitania->sigla }}</td>
                <td width="20%">
                    @can('consultar-capitania')
                        <a class="btn btn-sm btn-success" href="  {{ route('capitanias.show', [$capitania->id]) }}">
                            <i class="fa fa-search"></i>
                        </a>
                    @endcan
                    @can('editar-capitania')
                        <a class="btn btn-sm btn-info" href=" {{ route('capitanias.edit', [$capitania->id]) }}">
                            <i class="fa fa-edit"></i>
                        </a>
                    @endcan
                    @can('eliminar-capitania')
                        <div class='btn-group'>
                            {!! Form::open(['route' => ['capitanias.destroy', $capitania->id], 'method' => 'delete']) !!}

                            {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Realmente desera eliminar el capitania $capitania->nombre ?')"]) !!}

                            {!! Form::close() !!}
                        </div>
                @endcan
                <!-- Modal -->
                    <div class="modal fade" id="deletemodal{{$capitania->id}}" tabindex="-1" role="dialog"
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
                                    Realmente desea eliminar el rol <b>{{$capitania->nombre}}</b> y sus permisos
                                    asignados ?
                                    recuerde que esta acción es permanente y no se podrá deshacer.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn  btn-sm btn-secondary" data-dismiss="modal">Close
                                    </button>
                                    <form action="{{route('roles.destroy',$capitania->id)}}"
                                          id="delete{{$capitania->id}}"
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
