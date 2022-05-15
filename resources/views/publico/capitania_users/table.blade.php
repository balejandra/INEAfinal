    <table class="table table-striped table-bordered" id="generic-table">
        <thead>
            <tr>
                <th>Cargo</th>
        <th>Usuario</th>
        <th>Capitania</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach($capitaniaUsers as $capitaniaUser)
            <tr>
                <td>{{ $capitaniaUser->cargos->name }}</td>
            <td>{{ $capitaniaUser->user->email}}</td>
            <td>{{ $capitaniaUser->capitania->nombre }}</td>
                <td>
                    @can('consultar-usuarios-capitanias')
                        <a class="btn btn-sm btn-success" href="  {{ route('capitaniaUsers.show', [$capitaniaUser->id]) }}">
                            <i class="fa fa-search"></i>
                        </a>
                    @endcan
                    @can('editar-usuarios-capitanias')
                        <a class="btn btn-sm btn-info" href=" {{ route('capitaniaUsers.edit', [$capitaniaUser->id]) }}">
                            <i class="fa fa-edit"></i>
                        </a>
                    @endcan
                    @can('eliminar-usuarios-capitanias')
                        <div class='btn-group'>
                            {!! Form::open(['route' => ['capitaniaUsers.destroy', $capitaniaUser->id], 'method' => 'delete']) !!}

                            {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Realmente desea eliminar el usuario $capitaniaUser->id ?')"]) !!}

                            {!! Form::close() !!}
                        </div>
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
