<div class="row">
    <!-- Nombre Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('nombre', 'Nombre:') !!}
        {!! Form::text('nombre', old('nombre'), ['class' => 'form-control']) !!}
    </div>

    <!-- Sigla Field -->
    <div class="form-group col-sm-4 py-0 ">
        <div class="row p-0">
        
        {!! Form::label('rif', 'RIF:') !!}
        <div class="col-sm-4  p-0">        
            {!! Form::select('prefijo',['J'=>'J','G'=>'G','V'=>'V'], null, ['class' => 'form-control custom-select','placeholder' => 'Seleccione']) !!}
        </div>
        <div class="col-sm-8  p-0">
        {!! Form::text('rif', null, ['class' => 'form-control ','maxlength'=>'12','onKeyDown'=>"return soloNumeros(event)"]) !!}
        </div>
        
        </div>
       
    </div>

    <div class="form-group col-sm-4">
        {!! Form::label('capitania_id', 'Capitanía:') !!}
        {!! Form::select('capitania_id',$capitanias, null, ['class' => 'form-control custom-select','placeholder' => 'Seleccione una capitanía']) !!}
    </div>
</div>

 

<!-- Button -->
<div class="row form-group  mt-4">
    <div class="col text-center">
        <a href="{{route('establecimientosNauticos.index')}} " class="btn btn-primary btncancelarZarpes">Cancelar</a>
    </div>
    <div class=" col text-center">
        {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
