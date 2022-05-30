<!-- Nombre Buque Field -->
<div class="row">
<div class="form-group col-sm-3">
    {!! Form::label('nombre_buque', 'Nombre del Buque:') !!}
    {!! Form::text('nombre_buque', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Numero Registro Field -->
<div class="form-group col-sm-3">
    {!! Form::label('nro_registro', 'Nro. de Registro del Buque:') !!}
    {!! Form::text('nro_registro', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Tipo Buque Field -->
<div class="form-group col-sm-2">
    {!! Form::label('tipo_buque', 'Tipo de Buque:') !!}
    <select name="tipo_buque" id="tipo_buque" class="form-control custom-select" placeholder='Seleccione' required>
        <option value="deportivo">Deportivo</option>
        <option value="recreativo">Recreativo</option>
    </select>
</div>

<!-- Nacionalidad Buque Field -->
<div class="form-group col-sm-3" >
    {!! Form::label('paises', 'Nacionalidad del Buque:') !!}
    <select id="nacionalidad_buque" name="nacionalidad_buque"
            class="form-control custom-select"  required>
        <option value="">Seleccione</option>
        @foreach ($paises as $pais)
            <option value="{{$pais->name}}">{{$pais->name}} </option>
        @endforeach
    </select>
</div>

<!-- Propietario Field -->
<div class="form-group col-sm-3">
    {!! Form::label('nombre_propietario', 'Nombres del Propietario:') !!}
    {!! Form::text('nombre_propietario', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Pasaporte Capitan Field -->
<div class="form-group col-sm-3">
    {!! Form::label('pasaporte_capitan', 'Nro. Pasaporte del Capitán:') !!}
    {!! Form::text('pasaporte_capitan', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Nombrescompletos Capitan Field -->
<div class="form-group col-sm-3">
    {!! Form::label('nombre_capitan', 'Nombre y Apellido del Capitán:') !!}
    {!! Form::text('nombre_capitan', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Eslora Field -->
<div class="form-group col-sm-2">
    {!! Form::label('cant_tripulantes', 'Cantidad de Tripulantes:') !!}
    {!! Form::number('cant_tripulantes', null, ['class' => 'form-control', 'required','onKeyDown'=>"return soloNumeros(event)"]) !!}
</div>

    <div class="form-group col-sm-2">
        {!! Form::label('cant_pasajeros', 'Cantidad Máxima  de Personas a Bordo:') !!}
        {!! Form::number('cant_pasajeros', null, ['class' => 'form-control', 'required','onKeyDown'=>"return soloNumeros(event)"]) !!}
    </div>

<!-- Arqueo Bruto Field -->
<div class="form-group col-sm-2">
    {!! Form::label('arqueo_bruto', 'Arqueo Bruto:') !!}
    {!! Form::number('arqueo_bruto', null, ['class' => 'form-control', 'required','onKeyDown'=>"return soloNumeros(event)"]) !!}
</div>
    <!-- Eslora Field -->
    <div class="form-group col-sm-2">
        {!! Form::label('eslora', 'Eslora:') !!}
        {!! Form::text('eslora', null, ['class' => 'form-control', 'required','onKeyDown'=>"return soloNumeros(event)"]) !!}
    </div>

    <div class="form-group col-sm-2">
        {!! Form::label('potencia_kw', 'Potencia KW:') !!}
        {!! Form::text('potencia_kw', null, ['class' => 'form-control', 'required','onKeyDown'=>"return soloNumeros(event)"]) !!}
    </div>
<!-- Actividades Field -->
<div class="form-group col-sm-3">
    {!! Form::label('actividades', 'Actividades que Realizará:') !!}
    <select name="actividades" id="actividades" class="form-control custom-select" placeholder='Seleccione' required>
        <option value="deportivo">Deportivo</option>
        <option value="recreativo">Recreativo</option>
        <option value="cambio de bandera">Cambio de Bandera</option>
        <option value="mantenimiento">Mantenimiento</option>
    </select>
</div>

<!-- Puerto Origen Field -->
<div class="form-group col-sm-3">
    {!! Form::label('puerto_origen', 'Puerto de Origen / País:') !!}
    {!! Form::text('puerto_origen', null, ['class' => 'form-control'], 'required') !!}
</div>

<!-- Ultimo Puertovisitado Field -->
<div class="form-group col-sm-3">
    {!! Form::label('capitania_id', 'Circunscripción Acuática de Arribo:') !!}
    <select id="capitania_id" name="capitania_id"
            class="form-control custom-select {{ $errors->has("capitania_id")?"is-invalid":"" }}"  required>
        <option value="">Seleccione</option>
        @foreach ($capitanias as $capitania)
            <option value="{{$capitania->id}}">{{$capitania->nombre}} </option>
        @endforeach
    </select>
    @error('capitania_id')
    <span class="error invalid-feedback">{{ $message }}</span>
    @enderror
</div>

<!-- Tiempo Estadia Field -->
<div class="form-group col-sm-2">
    {!! Form::label('tiempo_estadia', 'Vigencia:') !!}
    <input type="text" name="tiempo_estadia" readonly value="90 días" id="tiempo_estadia" class="form-control">
</div>

<div class="form-group col-sm-4">
    {!! Form::label('documento_1', 'Zarpe Original de Procedencia:') !!}
    <input type="file" class="form-control" name="zarpe_procedencia" id="zarpe_procedencia" accept="application/pdf, image/*" required>
</div>
    <div class="form-group col-sm-4">
        {!! Form::label('documento_1', 'Registro de la Embarcación:') !!}
        <input type="file" class="form-control" name="registro_embarcacion" id="registro_embarcacion" accept="application/pdf, image/*" required>
    </div>
    <div class="form-group col-sm-4">
        {!! Form::label('documento_1', 'Despacho de Aduana de Procedencia:') !!}
        <input type="file" class="form-control" name="despacho_aduana_procedencia" id="despacho_aduana_procedencia" accept="application/pdf, image/*" required>
    </div>
    <div class="form-group col-sm-4">
        {!! Form::label('documento_1', 'Pasaportes de los Tripulantes:') !!}
        <input type="file" class="form-control" name="pasaportes_tripulantes" id="pasaporte_tripulantes" accept="application/pdf, image/*" required>
    </div>
    <div class="form-group col-sm-4">
        {!! Form::label('documento_1', 'Nominación Agencia Naviera:') !!}
        <input type="file" class="form-control" name="nominacion_agencia" id="nominacion_agencia" accept="application/pdf, image/*" required>
    </div>

</div>
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Generar Solicitud', ['class' => 'btn btn-primary']) !!}
</div>
