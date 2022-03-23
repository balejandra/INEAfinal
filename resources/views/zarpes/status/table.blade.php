<table class="table table-striped table-bordered" id="generic-table">
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
                <a class="btn btn-sm btn-success" href="  {{ route('status.show', [$status->id]) }}">
                    <i class="fa fa-search"></i>
                </a>

                <a class="btn btn-sm btn-info" href=" {{ route('status.edit', [$status->id]) }}">
                    <i class="fa fa-edit"></i>
                </a>

                <div class='btn-group'>
                    {!! Form::open(['route' => ['status.destroy', $status->id], 'method' => 'delete']) !!}

                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Realmente desera eliminar el estatus $status->id ?')"]) !!}

                    {!! Form::close() !!}
                </div>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>
