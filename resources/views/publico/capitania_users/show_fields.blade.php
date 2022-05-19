<table class="table table-bordered">
    <tbody>
    <tr>
        <th width="30%" class="bg-light">Cargo</th>
        <td> {{ $capitaniaUser->cargos->name }} </td>
    </tr>
    <tr>
        <th class="bg-light">Usuario</th>
        <td> {{ $capitaniaUser->user->email }}</td>
    </tr>
    <tr>
        <th class="bg-light">Capitania</th>
        <td> {{ $capitaniaUser->capitania->nombre }}</td>
    </tr>
    <tr>
        <th class="bg-light">Creado</th>
        <td> {{ $capitaniaUser->created_at }}</td>
    </tr>

    </tbody>
</table>
