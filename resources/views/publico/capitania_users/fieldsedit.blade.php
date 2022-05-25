<!-- Cargo Field -->
<div class="row">
    <div class="form-group col-sm-6">
        {!! Form::label('cargo', 'Cargo:') !!}
        {!! Form::select('cargo',$roles, null, ['class' => 'form-control custom-select','placeholder' => 'Seleccione un cargo','onchange="cargoCapitaniaUser();"']) !!}
    </div>

    <!-- User Id Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('user_id', 'Email del Usuario:') !!}
        {!! Form::select('user_id',$users, null, ['class' => 'form-control custom-select','placeholder' => 'Seleccione un usuario']) !!}
    </div>

    <!-- Capitania Id Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('capitania_id', 'Capitanía:') !!}
        {!! Form::select('capitania_id', $capitania, null, ['class' => 'form-control custom-select','placeholder' => 'Seleccione una capitania','onchange="EstablecimientoUser();"']) !!}
    </div>
    @if (($capitaniaUser->cargo==5) ||($capitaniaUser->cargo==6))
        <div class="form-group col-sm-6" id="divestablecimiento" style="display: block">
            @else
                <div class="form-group col-sm-6" id="divestablecimiento" style="display: none">
                    @endif
                    {!! Form::label('establecimientos', 'Establecimiento Náutico Asignado:') !!}
                    {!! Form::select('establecimiento_nautico_id',$establecimientos, null, ['id'=>'establecimientos','class' => ' form-control custom-select','placeholder' => 'Esta...']) !!}
                </div>

                <!-- Submit Field -->
                <div class="row form-group  mt-4">
                    <div class="col text-center">
                        <a href="{{route('capitaniaUsers.index')}} " class="btn btn-primary btncancelarZarpes">Cancelar</a>
                    </div>
                    <div class="col text-center">
                        {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>
        </div>
