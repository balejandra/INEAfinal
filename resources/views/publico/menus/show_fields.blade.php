<table class="table">
    <tbody>
        <tr>
            <th class="bg-light" style="width:25%">Roles permisados</th>
            <td>
                @foreach($menuRols as $Roles)

                 @if($Roles->checked!='')
                                                      
                    <span class="badge badge-info"> 
                        {{ $Roles->name}}
                    </span>
                @endif

                @endforeach
            </td>
        </tr>
        <tr>
            <th class="bg-light" style="width:25%">Nombre</th>
            <td>{{ $menu->name }}</td>
        </tr>
        <tr>
            <th class="bg-light">Descripcion</th>
            <td>{{ $menu->description }}</td>
        </tr>
        <tr>
            <th class="bg-light">Url</th>
            <td>{{ $menu->url }}</td>
        </tr>
        <tr>
            <th class="bg-light">Menu padre</th>
            <td><b>{{$parent[$menu->parent]}} </b> </td>
        </tr>
        <tr>
            <th class="bg-light">Orden</th>
            <td>{{ $menu->order }}</td>
        </tr>
        <tr>
            <th class="bg-light">Icono</th>
            <td>{{ $menu->icono }}</td>
        </tr>
        <tr>
            <th class="bg-light">Habilitado</th>
            <td>@if($menu->enabled ==1 ) SI @else NO @endif</td>
        </tr>
    </tbody>
</table>
