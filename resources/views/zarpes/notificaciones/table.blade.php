<style>
    table.dataTable {
        margin: 0 auto;
    }
</style>
<table class="table table-striped table-bordered table-grow" id="generic-table" style="width:90%">
    <thead>
    <th>Título</th>
    <th>Tipo</th>
    <th>Fecha</th>
    <th>Acciones</th>
    </thead>
    <tbody>
<<<<<<< HEAD
    @foreach($notificacionesNacionales as $notificacion)
=======
    @foreach($notificacionesNacional as $notificacion)
>>>>>>> 39147d39ee4de5d45dea19c5df350c6aede8741b
        @if($notificacion->visto==false)
        <tr style="background-color:#FCF4D4;">
        @else
        <tr>
        @endif
            <td>{{ $notificacion->titulo }}</td>
            <td>
                {{$notificacion->tipo}}
            </td>
            <td>
                @php
                    $fecha=explode(' ',$notificacion->created_at);
                    list($ano, $mes, $dia) =explode('-',$fecha[0]);

                    $fechaCreado=$dia."/".$mes."/".$ano." ".$fecha[1];

                @endphp
            {{ $fechaCreado }}</td>
            <td>
            @can('consultar-notificaciones')
                <a class="btn btn-sm btn-primary" href=" {{route('notificaciones.show',$notificacion->id)}}">
                        <i class="fa fa-search"></i>
                </a>
            @endcan
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
