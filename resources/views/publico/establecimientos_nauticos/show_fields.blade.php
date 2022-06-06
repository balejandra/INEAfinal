
 
<div class="row">
    <dic class="col-md-2"></dic>
    <dic class="col-md-8">

<table class="table table-bordered">
    <tbody>
        <tr>
            <th width="30%" class="bg-light">Nombre</th>
            <td> {{$estNautico->nombre}} </td>
        </tr>
        <tr>
            <th class="bg-light">RIF</th>
            <td> {{$estNautico->RIF}}</td>
        </tr>
        <tr>
            <th class="bg-light">Capitanía</th>
            <td> 
            {{$estNautico->capitania}}
            </td>
        </tr>
         

    </tbody>
</table>
    </dic>
    <dic class="col-md-2"></dic>
</div>

<div class="row d-flex justify-content-center">
<div class="col-md-2"></div>
<div class="text-center col-md-8" >
 
    <div class="row mt-4">
        <div class="col-md-12 text-center">
            <a href="{{route('establecimientosNauticos.index')}}" class="btn btn-primary btncancelarZarpes">Cancelar</a>
        </div>
    </div>
</div>

<div class="col-md-2"></div>

</div>

