
<div class="row">
	<div  class="col-lg-12" id="msjresmarinos"></div>
	<div class="col-lg-12">
		<div class="form-group col-sm-4 pt-4">
	    {!! Form::button('Agregar tripulante', ['class' => 'btn btn-success', 'onclick' => 'agregarPasajero("tripulacion")']) !!}
	    </div>

	</div>	
	<div  id="tripulacion" data-cant='1' class="col-lg-12 " style="min-height:100px">

	</div>

	<div class="col-lg-12  text-center  ">
		{!! Form::button('Validar Marinos', ['class' => 'btn btn-success', 'onclick' => 'ValidarMarinos()']) !!}
	</div>

</div>