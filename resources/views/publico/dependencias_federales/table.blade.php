    <table class="table table-striped" id="dependenciaFederals-table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Capitanias Id</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($dependenciaFederals as $dependenciaFederal)
            <tr>
                <td>{{ $dependenciaFederal->nombre }}</td>
                <td>{{ $dependenciaFederal->capitania_id }}</td>
                <td>
                    {!! Form::open(['route' => ['dependenciasfederales.destroy', $dependenciaFederal->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('dependenciasfederales.show', [$dependenciaFederal->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('dependenciasfederales.edit', [$dependenciaFederal->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
