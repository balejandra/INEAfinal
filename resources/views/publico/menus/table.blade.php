<table class="table table-bordered table-striped " id="generic-table" style="width:100%">
    <thead>

        <th>Id</th>
        <th>Nombre</th>
        <th>Descripcion</th>
        <th>Url</th>
        <th>Padre</th>
        <th>Orden</th>
        <th>Icono</th>
        <th>Habilitado</th>
        <th>Acciones</th>
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
                @can('consultar-menu')
                <a class="btn btn-sm btn-success" href="  {{ route('menus.show', [$menu->id]) }}">
                    <i class="fa fa-search"></i>
                </a>
                @endcan
                @can('editar-menu')
                <a class="btn btn-sm btn-info" href=" {{ route('menus.edit', [$menu->id]) }}">
                    <i class="fa fa-edit"></i>
                </a>
                @endcan
                 @can('eliminar-menu')
                <div class='btn-group'>
                    {!! Form::open(['route' => ['menus.destroy', $menu->id], 'method' => 'delete']) !!}

                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Realmente desera eliminar el menu $menu->name ?')"]) !!}

                    {!! Form::close() !!}
                </div>
                @endcan

            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>
