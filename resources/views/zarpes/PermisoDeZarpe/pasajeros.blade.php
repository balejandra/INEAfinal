<div class="row">
	<div  class="col-lg-12" id="msjpasajeros"></div>
	<div class="col-lg-12">
		<div class="form-group col-sm-4 pt-4">
	    {!! Form::button('Agregar pasajero', ['class' => 'btn btn-success', 'onclick' => 'agregarPasajero("pass")']) !!}
	    </div>

	</div>	
	<div  id="pass" data-cant='1' class="col-lg-12 " style="min-height:100px">

	</div>

	<div class="col-lg-12  text-center  ">
		{!! Form::button('Guardar', ['class' => 'btn btn-success', 'onclick' => 'next()']) !!}
	</div>

</div>