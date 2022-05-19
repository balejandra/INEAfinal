<!-- Email Field -->
<div class="row">
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Nombres Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombres', 'Nombres:') !!}
    {!! Form::text('nombres', null, ['class' => 'form-control']) !!}
</div>
</div>

<div class="row">
<div class="form-group col-sm-6">
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" name="password_change" id="password_change" value="password"
               onclick="cambiar()">
        <label class="form-check-label" for="natural">
            Cambiar Contraseña
        </label>
    </div>

</div>
</div>
<div  id="password-div" style="display: none">
<!-- Password Field -->
    <div class="row">
    <div class="form-group col-sm-6"  >
        {!! Form::label('password', 'Contraseña:') !!}
        <input type="password" class="form-control" id="password" name="password">
    </div>
    <div class="form-group col-sm-6"  >
        {!! Form::label('password', 'Confirmar Contraseña:') !!}
        <input type="password" name="password_confirmation" class="form-control"
            placeholder={{ __('Confirm Password') }}>
    </div>
    </div>
    
</div>

<div class="row">
<div class="form-group col-sm-6">
    {!! Form::label('role id', 'Rol asignado:') !!}

    {!! Form::select('roles', $roles, null, ['class' => 'roles form-control custom-select','placeholder' => 'Puede asignar un Rol...','onchange="requeridos();"']) !!}
</div>
</div>


<!-- Submit Field -->

<div class="row   mt-4">
    <div class="col-md-6 text-center">
        <a href="{{route('users.index')}} " class="btn btn-primary btncancelarZarpes">Cancelar</a>
    </div>
    <div class="form-group col-md-6 text-center">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
<input type="text" name="tipo_usuario" value="interno" hidden>
 