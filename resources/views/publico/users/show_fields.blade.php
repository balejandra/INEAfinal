
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
        
         
    </tbody>
</table>
<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', 'Email:') !!}
    <p>{{ $user->email }}</p>
</div>

<!-- Nombres Field -->
<div class="form-group">
    {!! Form::label('nombres', 'Nombres:') !!}
    <p>{{ $user->nombres }}</p>
</div>

<!-- Iniciales Field -->
<div class="form-group">
    {!! Form::label('iniciales', 'Iniciales:') !!}
    <p>{{ $user->iniciales }}</p>
</div>


<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Creado:') !!}
    <p>{{ $user->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Actualizado:') !!}
    <p>{{ $user->updated_at }}</p>
</div>

