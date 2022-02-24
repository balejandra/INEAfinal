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
                {!! Form::open(['route' => ['permisoszarpes.destroy', $permisoZarpe->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{{ route('permisoszarpes.show', [$permisoZarpe->id]) }}" class='btn btn-ghost-success'><i
                            class="fa fa-eye"></i></a>
                    <a href="{{ route('permisoszarpes.edit', [$permisoZarpe->id]) }}" class='btn btn-ghost-info'><i
                            class="fa fa-edit"></i></a>
                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}

                @can('')
                    <a class="btn btn-sm btn-success"
                       href=" {{route('permisoszarpes.show',$permisoZarpe->id)}}">
                        <i class="fa fa-search"></i>
                    </a>
                @endcan
                @can('')

                    <div class='btn-group'>
                        {!! Form::open(['route' => ['permisoZarpes.destroy', $permisoZarpe->id], 'method' => 'delete']) !!}

                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Realmente desera eliminar el rol $permisoZarpe->id ?')"]) !!}

                        {!! Form::close() !!}
                    </div>
                @endcan

            </td>
        </tr>
    @endforeach
    </tbody>
</table>
