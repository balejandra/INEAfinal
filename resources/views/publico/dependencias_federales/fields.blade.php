<!-- Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
</div>

<!-- Capitanias Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('capitania_id', 'Capitania Id:') !!}
    {!! Form::text('capitania_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('dependenciasfederales.index') }}" class="btn btn-secondary">Cancel</a>
</div>
