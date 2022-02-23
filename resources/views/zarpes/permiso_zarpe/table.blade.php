<table class="table table-striped table-bordered" id="permisoZarpes-table">
    <thead>
    <tr>
        <th>Nro Solicitud</th>
        <th>Bandera</th>
        <th>Matricula</th>
        <th>Tipo Zarpe Id</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($permisoZarpes as $permisoZarpe)
        <tr>
            <td>{{ $permisoZarpe->nro_solicitud }}</td>
            <td>{{ $permisoZarpe->bandera }}</td>
            <td>{{ $permisoZarpe->matricula }}</td>
            <td>{{ $permisoZarpe->tipo_zarpe_id }}</td>
            <td>
                @can('consultar-zarpe')
                    <a class="btn btn-sm btn-success"
                       href=" {{route('permisoszarpes.show',$permisoZarpe->id)}}">
                        <i class="fa fa-search"></i>
                    </a>
                @endcan
                @can('eliminar-zarpe')

                    <div class='btn-group'>
                        {!! Form::open(['route' => ['permisoszarpes.destroy', $permisoZarpe->id], 'method' => 'delete']) !!}

                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Realmente desera eliminar el rol $permisoZarpe->id ?')"]) !!}

                        {!! Form::close() !!}
                    </div>
                @endcan

            </td>
        </tr>
    @endforeach
    </tbody>
</table>
