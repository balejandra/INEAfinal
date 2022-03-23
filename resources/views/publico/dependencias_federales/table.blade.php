    <table class="table table-striped table-bordered" id="dependenciaFederals-table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Capitanias </th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($dependenciaFederals as $dependenciaFederal)
            <tr>
                <td>{{ $dependenciaFederal->nombre }}</td>
                <td>{{ $dependenciaFederal->capitania}}   </td>
                <td width="20%" class="text-center">
                    {!! Form::open(['route' => ['dependenciasfederales.destroy', $dependenciaFederal->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('dependenciasfederales.show', [$dependenciaFederal->id]) }}" class='btn btn-sm btn-success'>
                            <i class="fa fa-search"></i>
                        </a>
                        &nbsp;&nbsp;&nbsp;
                        <a href="{{ route('dependenciasfederales.edit', [$dependenciaFederal->id]) }}" class='btn btn-sm btn-info'>
                            <i class="fa fa-edit"></i>
                        </a>
                        &nbsp;&nbsp;&nbsp;
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
