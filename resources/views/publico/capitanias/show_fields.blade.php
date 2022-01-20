<!-- Nombre Field -->
<div class="form-group">
    {!! Form::label('nombre', 'Nombre:') !!}
    <p>{{ $capitania->nombre }}</p>
</div>

<!-- Sigla Field -->
<div class="form-group">
    {!! Form::label('sigla', 'Sigla:') !!}
    <p>{{ $capitania->sigla }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Creado:') !!}
    <p>{{ $capitania->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Actualizado:') !!}
    <p>{{ $capitania->updated_at }}</p>
</div>

