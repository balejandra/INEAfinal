<table class="table table-striped table-bordered" id="generic-table" style="width:100%">
    <thead>
    <th>ID</th>
    <th>Nombre</th>
    <th>Acciones</th>
    </thead>
    <tbody>
    @foreach($statuses as $status)
        <tr>
            <td>{{ $status->id }}</td>
            <td>{{ $status->nombre }}</td>
            <td>
                @can('consultar-status')
                    <a class="btn btn-sm btn-success" href="  {{ route('status.show', [$status->id]) }}">
                        <i class="fa fa-search"></i>
                    </a>
                @endcan
                @can('editar-status')
                    <a class="btn btn-sm btn-info" href=" {{ route('status.edit', [$status->id]) }}">
                        <i class="fa fa-edit"></i>
                    </a>
                @endcan
                @can('eliminar-status')
                    <div class='btn-group'>
                        {!! Form::open(['route' => ['status.destroy', $status->id], 'method' => 'delete']) !!}

                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Realmente desera eliminar el estatus $status->id ?')"]) !!}

                        {!! Form::close() !!}
                    </div>
                @endcan
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
