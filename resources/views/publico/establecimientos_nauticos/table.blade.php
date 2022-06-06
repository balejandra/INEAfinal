<style>
    table.dataTable {
        margin: 0 auto;
    }
</style>

    <table class="table table-striped table-bordered table-grow" id="generic-table" style="width:70%">
        <thead>
        <tr>
            <th >Nombre</th>
            <th>RIF</th>
            <th>Capitanía</th>
            <th width="20%">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($estNautico as $estNaut)
            <tr>
                <td>{{ $estNaut->nombre }}</td>
                <td>{{ $estNaut->RIF }}</td>
                <td>{{ $estNaut->capitania }}</td>
                <td>
                    @can('consultar-estableimientoNautico')
                        <a class="btn btn-sm btn-success" href="  {{ route('establecimientosNauticos.show', [$estNaut->id]) }}">
                            <i class="fa fa-search"></i>
                        </a>
                    @endcan
                    @can('editar-estableimientoNautico')
                        <a class="btn btn-sm btn-info" href=" {{ route('establecimientosNauticos.edit', [$estNaut->id]) }}">
                            <i class="fa fa-edit"></i>
                        </a>
                    @endcan
                    @can('eliminar-estableimientoNautico')
                        <div class='btn-group'>
                            {!! Form::open(['route' => ['establecimientosNauticos.destroy', $estNaut->id], 'method' => 'delete']) !!}

                            {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Realmente desera eliminar el establecimiento náutico $estNaut->nombre ?')"]) !!}

                            {!! Form::close() !!}
                        </div>
                @endcan
                
                    <div class="modal fade" id="deletemodal{{$estNaut->id}}" tabindex="-1" role="dialog"
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
                                    Realmente desea eliminar el rol <b>{{$estNaut->nombre}}</b> y sus permisos
                                    asignados ?
                                    recuerde que esta acción es permanente y no se podrá deshacer.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn  btn-sm btn-secondary" data-dismiss="modal">Close
                                    </button>
                                    <form action="{{route('roles.destroy',$estNaut->id)}}"
                                          id="delete{{$estNaut->id}}"
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
