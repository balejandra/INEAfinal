<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Nombres Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombres', 'Nombres:') !!}
    {!! Form::text('nombres', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" name="password_change" id="password_change" value="password"
               onclick="cambiar()">
        <label class="form-check-label" for="natural">
            Cambiar Contraseña
        </label>
    </div>

</div>
<!-- Password Field -->
<div class="form-group col-sm-6" id="password-div" style="display: none">
    {!! Form::label('password', 'Contraseña:') !!}
    <input type="password" class="form-control" id="password" name="password">
    {!! Form::label('password', 'Confirmar Contraseña:') !!}
    <input type="password" name="password_confirmation" class="form-control"
           placeholder={{ __('Confirm Password') }}>
</div>


<div class="form-group col-sm-6">
    {!! Form::label('role id', 'Rol asignado:') !!}

    {!! Form::select('roles', $roles, null, ['class' => 'roles form-control custom-select','placeholder' => 'Puede asignar un Rol...','onchange="requeridos();"']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('capitania_id', 'Capitania Asignada:') !!}
    {!! Form::select('capitanias', $capitanias, null, ['id'=>'capitanias','class' => ' form-control custom-select','placeholder' => 'Puede asignar una Capitania...','onchange="EstablecimientoUser();"']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('capitania_id', 'Establecimiento náutico asignado:') !!}
    {!! Form::select('establecimientos',$establecimientos, null, ['id'=>'establecimientos','class' => ' form-control custom-select','placeholder' => 'Esta...']) !!}
</div>
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
</div>

<input type="text" name="tipo_usuario" value="interno" hidden>
