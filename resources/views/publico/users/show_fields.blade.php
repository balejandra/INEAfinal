
<table class="table">
    <tbody>
        <tr>
            <th class="bg-light">Tipo de identificación</th>
            <td>{{ $user->tipo_identificacion }}</td>
        </tr>
        <tr>
            <th class="bg-light">Numero de identificación</th>
            <td>{{ $user->numero_identificacion }}</td>
        </tr>
        <tr>
            <th class="bg-light" style="width:25%">Email</th>
            <td>{{ $user->email }}</td>
        </tr>
        
        <tr>
            <th class="bg-light">Nombre</th>
            <td>{{ $user->nombres }}</td>
        </tr>
        @if($user->tipo_identificacion!='rif')
        <tr>
            <th class="bg-light">Apellidos</th>
            <td>{{ $user->apellidos }}</td>
        </tr>
        
        <tr>
            <th class="bg-light">Iniciales</th>
            <td>{{ $user->iniciales }}</td>
        </tr>
        <tr>
            <th class="bg-light">Fecha de nacimiento</th>
            <td>{{ $user->fecha_nacimiento }}</td>
        </tr>
        @endif

        <tr>
            <th class="bg-light">Teléfono</th>
            <td>{{ $user->telefono }}</td>
        </tr>
        <tr>
            <th class="bg-light">Dirección</th>
            <td>{{ $user->direccion }}</td>
        </tr>
        <tr>
            <th class="bg-light">Tipo de usuario</th>
            <td>{{ $user->tipo_usuario }}</td>
        </tr>

    </tbody>
</table>
