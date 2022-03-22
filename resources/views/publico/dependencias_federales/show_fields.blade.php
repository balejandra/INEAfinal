<!-- Nombre Field -->
<div class="form-group">
    {!! Form::label('nombre', 'Nombre:') !!}
    <p>{{ $dependenciaFederal->nombre }}</p>
</div>

<!-- Capitanias Id Field -->
<div class="form-group">
    {!! Form::label('capitanias_id', 'Capitanias Id:') !!}
    <p>{{ $dependenciaFederal->capitania_id }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $dependenciaFederal->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $dependenciaFederal->updated_at }}</p>
</div>

