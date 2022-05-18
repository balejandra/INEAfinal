<table class="table table-striped table-bordered" id="generic-table" style="width:100%">
    <thead>
        <th>UAB minimo</th>
        <th>UAB maximo</th>
        <th>Tripulantes</th>
        <th>Cargo</th>
        <th>Titulacion Minima</th>
        <th  style="width: max-content">Acciones</th>
    </thead>
    <tbody>
    @foreach($tablaMandos as $tablaMando)
        <tr>
            <td>{{ $tablaMando->UAB_minimo }}</td>
            <td>{{ $tablaMando->UAB_maximo }}</td>
            <td>{{ $tablaMando->cant_tripulantes }}</td>
            <td>
            @forelse($tablaMando->cargotablamandos as $cargotablamando)
                <span class="badge badge-info">{{$cargotablamando->cargo_desempena}} </span>
            @empty
                <span class="badge badge-danger">Sin Cargos asignados</span>
            @endforelse
            </td>
            <td  style="width: 30%">
                @forelse($tablaMando->cargotablamandos as $cargotablamando)
                    <span class="badge badge-info">{{$cargotablamando->titulacion_aceptada_minima}} </span>
                @empty
                    <span class="badge badge-danger">Sin Cargos asignados</span>
                @endforelse
            </td>
            <td>
                @can('consultar-mando')
                    <a class="btn btn-sm btn-success" href="  {{ route('tablaMandos.show', [$tablaMando->id]) }}">
                        <i class="fa fa-search"></i>
                    </a>
                @endcan
                @can('editar-mando')
                    <a class="btn btn-sm btn-info" href=" {{ route('tablaMandos.edit', [$tablaMando->id]) }}">
                        <i class="fa fa-edit"></i>
                    </a>
                @endcan
                @can('eliminar-mando')
                    <div class='btn-group'>
                        {!! Form::open(['route' => ['tablaMandos.destroy', $tablaMando->id], 'method' => 'delete']) !!}

                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Realmente desera eliminar la tabla $tablaMando->id ?')"]) !!}

                        {!! Form::close() !!}
                    </div>
                @endcan
            <!-- Modal -->
                <div class="modal fade" id="deletemodal{{$tablaMando->id}}" tabindex="-1" role="dialog"
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
                                Realmente desea eliminar el rol <b>{{$tablaMando->id}}</b> y sus permisos asignados ?
                                recuerde que esta acción es permanente y no se podrá deshacer.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn  btn-sm btn-secondary" data-dismiss="modal">Close
                                </button>
                                <form action="{{route('roles.destroy',$tablaMando->id)}}" id="delete{{$tablaMando->id}}"
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
