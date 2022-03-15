<div class="row">

    <div class="col-md-12">
        <div class="row">
        <!-- bandera Field -->
        <div class="form-group col-sm-5">
            {!! Form::label('0', 'Bandera:') !!}
            {!! Form::select('bandera', ['nacional'=>'NACIONAL', 'extrangera'=>'EXTRANJERA'], null, ['class' => 'form-control custom-select','placeholder' => 'Seleccione su bandera', 'onChange'=>'bandera()', 'id'=>'bandera']) !!}
        </div>

        <div id="form-nacional" style="display:none" class="col-md-6 ">
            <div class="row">
                <!-- Email Field -->
                <div class="form-group col-sm-5">
                    {!! Form::label('matricula', 'Matricula:') !!}
                    {!! Form::text('matricula', null, ['class' => 'form-control', 'id'=>'matricula']) !!}
                </div>
                <div class="form-group col-sm-5">
                {!! Form::label('0', 'Tipo de zarpe:') !!}
                {!! Form::select('tipozarpe', ['1'=>'Navegación comercial', '2'=>'Navegación deportiva'], null, ['class' => 'form-control custom-select','placeholder' => 'Seleccione']) !!}
                </div>
                <!-- Submit Field -->
                <div class="form-group col-sm-2">
                    {!! Form::label('0', ' ') !!}
                    {!! Form::button('Guardar', ['class' => 'btn btn-primary mt-2', 'onclick' => 'matricula()']) !!}
                </div>
            </div>
        </div>
        <div id="form-extrangera">

        </div>


</div>
    </div>
    <div class="col-md-12">
        <div id="table-licencia" style="display: none;">
            <div class="text-center">
                <h4>Datos de la embarcación</h4>
            </div>
            <table class="table table-striped table-bordered" id=" ">
        <thead>
        <tr>
            <th>MATRÍCULA</th>
            <th>NOMBRE</th>
            <th>DESTINACIÓN DEL BUQUE</th>
            <th>PROPIETARIO</th>
        </tr>
        </thead>
        <tbody id=" ">
            <tr>
                <td>
                    ADKN-SE-0002
                </td>
                <td>
                    SAGITA
                </td>
                <td>
                    SERVICIO
                </td>
                <td>
                    INEA
                </td>
            </tr>
        </tbody>
    </table>


        </div>


    </div>

</div>
