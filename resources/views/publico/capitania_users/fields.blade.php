<!-- Cargo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cargo', 'Cargo:') !!}
    {!! Form::select('cargo',$roles, null, ['class' => 'form-control custom-select','placeholder' => 'Seleccione un cargo']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'Usuario:') !!}
    {!! Form::select('user_id',$users, null, ['class' => 'form-control custom-select','placeholder' => 'Seleccione un usuario']) !!}
</div>

<!-- Capitania Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('capitania_id', 'Capitania:') !!}
    {!! Form::select('capitania_id', $capitania, null, ['class' => 'form-control custom-select','placeholder' => 'Seleccione una capitania']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('capitaniaUsers.index') }}" class="btn btn-secondary">Cancelar</a>
</div>
