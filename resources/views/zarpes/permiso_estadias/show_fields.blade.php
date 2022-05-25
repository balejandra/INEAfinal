<strong>Detalle de la Solicitud de Estadía</strong>

<div class="container">
    <br>
    <div class="row">
        <div class="col-sm-12">
            <div class="row border">
                <div class="col-md-3 col-sm-3 bg-light p-2 text-th">
                    Nro. de Solicitud
                </div>
                <div class="col-md-3 col-sm-3 p-2">
                    {{ $permisoEstadia->nro_solicitud }}
                </div>
                <div class="col-md-3 col-sm-3 bg-light p-2 text-th">
                    Fecha de la Solicitud
                </div>
                <div class="col-md-3 col-sm-3 p-2">
                    {{ date_format($permisoEstadia->created_at,'d-m-Y')}}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="row border">
                <div class="col-md-3 col-sm-3 bg-light p-2 text-th">
                    Nombre del Solicitante
                </div>
                <div class="col-md-3 col-sm-3 p-2">
                    {{ $permisoEstadia->user->nombres}} {{ $permisoEstadia->user->apellidos}}
                </div>
                <div class="col-md-3 col-sm-3 bg-light p-2 text-th">
                    Nombre del Buque
                </div>
                <div class="col-md-3 col-sm-3 p-2">
                    {{ $permisoEstadia->nombre_buque }}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="row border">
                <div class="col-md-3 col-sm-3 bg-light p-2 text-th">
                    Número del Registro
                </div>
                <div class="col-md-3 col-sm-3 p-2">
                    {{ $permisoEstadia->nro_registro }}
                </div>
                <div class="col-md-3 col-sm-3 bg-light p-2 text-th">
                    Tipo del Buque
                </div>
                <div class="col-md-3 col-sm-3 p-2">
                    {{ $permisoEstadia->tipo_buque }}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="row border">
                <div class="col-md-3 col-sm-3 bg-light p-2 text-th">
                    Nacionalidad del Buque
                </div>
                <div class="col-md-3 col-sm-3 p-2">
                    {{ $permisoEstadia->nacionalidad_buque }}
                </div>
                <div class="col-md-3 col-sm-3 bg-light p-2 text-th">
                    Propietario
                </div>
                <div class="col-md-3 col-sm-3 p-2">
                    {{ $permisoEstadia->nombre_propietario }}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="row border">
                <div class="col-md-3 col-sm-3 bg-light p-2 text-th">
                    Nombres Completos del Capitán
                </div>
                <div class="col-md-3 col-sm-3 p-2">
                    {{ $permisoEstadia->nombre_capitan }}
                </div>
                <div class="col-md-3 col-sm-3 bg-light p-2 text-th">
                    Pasaporte del Capitán
                </div>
                <div class="col-md-3 col-sm-3 p-2">
                    {{ $permisoEstadia->pasaporte_capitan }}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="row border">
                <div class="col-md-3 col-sm-3 bg-light p-2 text-th">
                    Número de Tripulantes
                </div>
                <div class="col-md-3 col-sm-3 p-2">
                    {{ $permisoEstadia->cant_tripulantes }}
                </div>
                <div class="col-md-3 col-sm-3 bg-light p-2 text-th">
                    Número de Pasajeros
                </div>
                <div class="col-md-3 col-sm-3 p-2">
                    {{ $permisoEstadia->cant_pasajeros }}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="row border">
                <div class="col-md-3 col-sm-3 bg-light p-2 text-th">
                    Arqueo Bruto
                </div>
                <div class="col-md-3 col-sm-3 p-2">
                    {{ $permisoEstadia->arqueo_bruto }}
                </div>
                <div class="col-md-3 col-sm-3 bg-light p-2 text-th">
                    Eslora
                </div>
                <div class="col-md-3 col-sm-3 p-2">
                    {{ $permisoEstadia->eslora }}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="row border">
                <div class="col-md-3 col-sm-3 bg-light p-2 text-th">
                    Potencia KW
                </div>
                <div class="col-md-3 col-sm-3 p-2">
                    {{ $permisoEstadia->potencia_kw }}
                </div>
                <div class="col-md-3 col-sm-3 bg-light p-2 text-th">
                    Actividades que Realizará
                </div>
                <div class="col-md-3 col-sm-3 p-2">
                    {{ $permisoEstadia->actividades }}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="row border">
                <div class="col-md-3 col-sm-3 bg-light p-2 text-th">
                    Puerto de Origen / País
                </div>
                <div class="col-md-3 col-sm-3 p-2">
                    {{ $permisoEstadia->puerto_origen }}
                </div>
                <div class="col-md-3 col-sm-3 bg-light p-2 text-th">
                    Circunscripción Acuática de Arribo
                </div>
                <div class="col-md-3 col-sm-3 p-2">
                    {{ $permisoEstadia->capitania->nombre }}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="row border">
                <div class="col-md-3 col-sm-3 bg-light p-2 text-th">
                    Tiempo de Estadía
                </div>
                <div class="col-md-3 col-sm-3 p-2">
                    {{ $permisoEstadia->tiempo_estadia }}
                </div>
                <div class="col-md-3 col-sm-3 bg-light p-2 text-th">
                    Fecha de Vencimiento
                </div>
                <div class="col-md-3 col-sm-3 p-2">
                    {{ $permisoEstadia->vencimiento }}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="row border">
                <div class="col-md-3 col-sm-3 bg-light p-2 text-th">
                    Cantidad de Solicitudes
                </div>
                <div class="col-md-3 col-sm-3 p-2">
                    {{ $permisoEstadia->cantidad_solicitud }} vez
                </div>
                <div class="col-md-3 col-sm-3 bg-light p-2 text-th">
                    Estatus
                </div>
                <div class="col-md-3 col-sm-3 p-2">
                    {{ $permisoEstadia->status->nombre}}
                </div>
            </div>
        </div>
    </div>
    <br>
    <strong>Documentos Adjuntos</strong>
<div class="container">
<div class="row">

    @foreach($documentos as $documento)
        <div class="col-sm-6">
            <a class="document-link" href="{{asset('documentos/permisoestadia/'.$documento->documento)}}" target="_blank">
                {{$documento->recaudo }}</a>
        </div>
    @endforeach
</div>
</div>
<br>

