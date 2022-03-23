<table class="table">
    <tbody>
    <tr>
        <th class="bg-light">ID</th>
        <td>{{$equipo->id}}</td>
    </tr>
    <tr>
        <th class="bg-light">Nombre</th>
        <td>{{ $equipo->equipo }}</td>
    </tr>
    <tr>
        <th class="bg-light">Cantidad</th>
        @if ($equipo->cantidad===true)
            <td>Verdadero</td>
        @else
            <td>Falso</td>
        @endif
    </tr>
    <tr>
        <th class="bg-light">Nombre</th>
        <td>{{ $equipo->otros }}</td>
    </tr>
    <tr>
        <th class="bg-light">Creado</th>
        <td>{{ $equipo->created_at }}</td>
    </tr>
    <tr>
        <th class="bg-light">Actualizado</th>
        <td>{{ $equipo->updated_at }}</td>
    </tr>
    </tbody>
</table>

