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

