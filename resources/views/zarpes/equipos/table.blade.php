<table class="table table-striped table-bordered" id="generic-table">
        <thead>
            <tr>
                <th>Equipo</th>
                <th>Cantidad</th>
                <th>Otros</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach($equipos as $equipo)
            <tr>
                <td>{{ $equipo->equipo }}</td>
                @if ($equipo->cantidad===true)
                    <td>Verdadero</td>
                @else
                    <td>Falso</td>
                @endif
                <td>{{ $equipo->otros }}</td>
                <td>
                    <a class="btn btn-sm btn-success" href="  {{ route('equipos.show', [$equipo->id]) }}">
                        <i class="fa fa-search"></i>
                    </a>

                    <a class="btn btn-sm btn-info" href=" {{ route('equipos.edit', [$equipo->id]) }}">
                        <i class="fa fa-edit"></i>
                    </a>

                    <div class='btn-group'>
                        {!! Form::open(['route' => ['equipos.destroy', $equipo->id], 'method' => 'delete']) !!}

                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Realmente desera eliminar el equipo $equipo->id ?')"]) !!}

                        {!! Form::close() !!}
                    </div>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
