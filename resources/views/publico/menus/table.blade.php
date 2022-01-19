<div class="table-responsive-sm">
    <table class="table table-striped" id="menus-table">
        <thead>
            <tr>
                <th>Id</th>
        <th>Name</th>
        <th>Description</th>
        <th>Url</th>
        <th>Parent</th>
        <th>Order</th>
        <th>Icono</th>
        <th>Enabled</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($menus as $menu)
            <tr>
                <td>{{ $menu->id }}</td>
            <td>{{ $menu->name }}</td>
            <td>{{ $menu->description }}</td>
            <td>{{ $menu->url }}</td>
            <td>{{ $menu->parent }}</td>
            <td>{{ $menu->order }}</td>
            <td>{{ $menu->icono }}</td>
            <td>{{ $menu->enabled }}</td>
                <td>
                    {!! Form::open(['route' => ['menus.destroy', $menu->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('menus.show', [$menu->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('menus.edit', [$menu->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>