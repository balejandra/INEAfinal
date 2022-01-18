<div class="table-responsive-sm">
    <table class="table table-striped" id="menuRols-table">
        <thead>
            <tr>
                <th>Id</th>
        <th>Role Id</th>
        <th>Menu Id</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($menuRols as $menuRol)
            <tr>
                <td>{{ $menuRol->id }}</td>
            <td>{{ $menuRol->role_id }}</td>
            <td>{{ $menuRol->menu }}</td>
                <td>
                    {!! Form::open(['route' => ['menuRols.destroy', $menuRol->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('menuRols.show', [$menuRol->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('menuRols.edit', [$menuRol->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
