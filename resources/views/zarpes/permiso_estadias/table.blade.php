<table class="table table-striped table-bordered" id="permisoEstadias-table">
    <thead>
    <tr>
        <th>Nombre Buque</th>
        <th>Numero Registro</th>
        <th>Tipo Buque</th>
        <th>Propietaro</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($permisoEstadias as $permisoEstadia)

        <tr>
            <td>{{ $permisoEstadia['nombre_buque'] }}</td>
            <td>{{ $permisoEstadia['numero_registro'] }}</td>
            <td>{{ $permisoEstadia['tipo_buque'] }}</td>
            <td>{{ $permisoEstadia['propietario'] }}</td>

            <td>
                    <a class="btn btn-sm btn-success" href="  {{ route('permisosestadia.show', $permisoEstadia['id']) }}">
                        <i class="fa fa-search"></i>
                    </a>
                    <a class="btn btn-sm btn-info" href=" {{ route('permisosestadia.edit', $permisoEstadia['id'])  }}">
                        <i class="fa fa-edit"></i>
                    </a>

                <div class='btn-group'>
                    {!! Form::open(['route' => ['permisosestadia.destroy', $permisoEstadia['id']], 'method' => 'delete']) !!}

                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Realmente desera eliminar el permiso ?')"]) !!}

                    {!! Form::close() !!}
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
