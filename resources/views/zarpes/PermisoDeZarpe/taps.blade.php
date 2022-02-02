 
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Datos del buque</button>
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
      <div class="col-md-6">

        <div class="form-group col-sm-12">
            {!! Form::label('0', 'Bandera:') !!}
            {!! Form::select('bandera', ['nacional'=>'NACIONAL', 'extrangera'=>'EXTRANGERA'], null, ['class' => 'form-control custom-select','placeholder' => 'Seleccione su bandera', 'onChange'=>'bandera()', 'id'=>'bandera']) !!}
        </div>
          
      </div>
      </div>


  </div>

  <div class="tab-pane fade bg-white" id="tab5" role="tabpanel" aria-labelledby="tab5-tab">
     Declaracion
  </div>

   
</div>

 