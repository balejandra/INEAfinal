 
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Datos del buque</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="licencia-tab" data-bs-toggle="tab" data-bs-target="#licencia" type="button" role="tab" aria-controls="licencia" aria-selected="false">Licencia</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link " id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Datos de la tripulación</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Datos de pasajeros</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="tab4-tab" data-bs-toggle="tab" data-bs-target="#tab4" type="button" role="tab" aria-controls="tab4" aria-selected="false">Ruta</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="tab5-tab" data-bs-toggle="tab" data-bs-target="#tab5" type="button" role="tab" aria-controls="tab5" aria-selected="false">Declaracion jurada</button>
  </li>
   
</ul>
<div class="tab-content" id="myTabContent ">
  <div class="tab-pane fade show active bg-white" id="home" role="tabpanel" aria-labelledby="home-tab">
  	 @include('zarpes.PermisoDeZarpe.fields')
  </div>
  <div class="tab-pane fade bg-white" id="profile" role="tabpanel" aria-labelledby="profile-tab">
   @include('zarpes.PermisoDeZarpe.datosZarpe')
  </div>
  <div class="tab-pane fade bg-white" id="contact" role="tabpanel" aria-labelledby="contact-tab">
  	 @include('zarpes.PermisoDeZarpe.pasajeros')
  </div>
  <div class="tab-pane fade bg-white" id="tab4" role="tabpanel" aria-labelledby="tab4-tab">
     
      <div class="row">
        <div class="col-lg-12" id="msjruta"></div>
      <div class="col-md-3">


        <div class="form-group col-sm-12">
            {!! Form::label('0', 'Origen:') !!}
            {!! Form::select('origen', ['1'=>' Maracaibo', '2'=>'Las Piedras', '3'=>'La Guaira', '4'=>'Puerto la Cruz', '5'=>'Carupano', '6'=>'Pampatar', '7'=>'Puerto Cabello', '8'=>'Caripito', '9'=>'Puerto Sucre', '10'=>'Ciudad Bolivar', '11'=>'Guiria', '12'=>'Ciudad Guayana', '13'=>'Apure', '14'=>'Amazonas', '15'=>'Miranda', '16'=>'La Vela de Coro', '17'=>'La Ceiba', '18'=>'Delta Amacuro'], null, ['class' => 'form-control custom-select','placeholder' => 'Seleccione', 'id'=>'bandera']) !!}
        </div>

      </div>

      <div class="col-md-3">
        {!! Form::label('salida', 'Fecha/hora Salida:') !!}
        <input type="datetime-local" name="salida" class="form-control">
                    
      </div>

      <div class="col-md-3">

        {!! Form::label('regreso', 'Fecha/hora regreso:') !!}
        <input type="datetime-local" name="regreso" class="form-control">
                     
      </div>


      <div class="col-md-3">


        <div class="form-group col-sm-12">
            {!! Form::label('0', 'Destino:') !!}
            {!! Form::select('origen', ['1'=>' Maracaibo', '2'=>'Las Piedras', '3'=>'La Guaira', '4'=>'Puerto la Cruz', '5'=>'Carupano', '6'=>'Pampatar', '7'=>'Puerto Cabello', '8'=>'Caripito', '9'=>'Puerto Sucre', '10'=>'Ciudad Bolivar', '11'=>'Guiria', '12'=>'Ciudad Guayana', '13'=>'Apure', '14'=>'Amazonas', '15'=>'Miranda', '16'=>'La Vela de Coro', '17'=>'La Ceiba', '18'=>'Delta Amacuro'], null, ['class' => 'form-control custom-select','placeholder' => 'Seleccione', 'id'=>'bandera']) !!}
        </div>


      </div>


      <div class="form-group col-sm-12 text-center">
          {!! Form::label('0', ' ') !!}
          {!! Form::button('Continuar', ['class' => 'btn btn-primary mt-2', 'onclick' => 'rutas()']) !!}
        </div>


      </div>


  </div>

  <div class="tab-pane fade bg-white" id="tab5" role="tabpanel" aria-labelledby="tab5-tab">
     <h3>Declaracion de cumplimineto de normativas</h3>

     <p class="text-justify">Por medio de la presente declaro que la presente solicitud se hace bajo el estricto cumplimiento de las normativas vigentes y las disposiciones previstas por las leyes venezolanas.</p>

     <div class="form-group col-sm-12 text-center">
          {!! Form::label('0', ' ') !!}
          {!! Form::button('Registrar solicitud', ['class' => 'btn btn-primary mt-2', 'onclick' => 'final()']) !!}
      </div>
  </div>

  <div class="tab-pane fade bg-white" id="licencia" role="tabpanel" aria-labelledby="licencia-tab">
     
     <div id="form-nacional"   class="col-md-12">
      <h3>Consultar licencia de navegación</h3>
            <div class="row">
                <!-- Email Field -->
                <div class="form-group col-sm-5">
                    {!! Form::label('licencia', 'Licencia:') !!}
                    {!! Form::text('txtlicencias', null, ['class' => 'form-control', 'id'=>'txtlicencias']) !!}
                </div>
                 
                <!-- Submit Field -->
                <div class="form-group col-sm-2">
                    {!! Form::label('0', ' ') !!}
                    {!! Form::button('Consultar', ['class' => 'btn btn-primary mt-2', 'onclick' => 'licencia()']) !!}
                </div>
            </div>

            <div  class="col-lg-12  " id="msjlic"></div>

            <table class="table table-striped table-bordered mt-5"  style="display: none;" id="tableLicencias">
        <thead>
        <tr>
            <th>Numero registro</th>
            <th>Tipo documento</th>
            <th>Emisión</th>
            <th>vencimiento</th>
            <th>Nombre y apellido</th>
        </tr>
        </thead>
        <tbody id="permisosZarpes">
            <tr>
                <td>
                  729
                </td>
                <td>
                  Capitán de Yate
                </td>
                <td>
                  2/9/2018
                </td>
                <td>
                  2/9/2023 
                </td>
                <td>
                  Jorge Luis Montenegro
                </td>
            </tr>
        </tbody>
    </table>
      </div>

  </div>

   
</div>

 