<table class="table">
    <tbody>
    <tr>
        <th class="bg-light">ID</th>
        <td>{{$status->id}}</td>
    </tr>
    <tr>
        <th class="bg-light">Nombre</th>
        <td>{{ $status->nombre }}</td>
    </tr>
    <tr>
        <th class="bg-light">Creado</th>
        <td>{{ $status->created_at }}</td>
    </tr>
    <tr>
        <th class="bg-light">Actualizado</th>
        <td>{{ $status->updated_at }}</td>
    </tr>
    </tbody>
</table>
