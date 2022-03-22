@component('mail::message')

    Estimado Ciudadano

    La notificación de Estadia N°: {{$solicitud}} registrada ha sido {{$status}}.
    @if ($idstatus==1)
    Puede verificar su documento de autorización de estadia en el archivo adjunto a este correo.
    @endif

@component('mail::panel')
    <h2>Nombre Embarcacion: {{$nombre_buque}} </h2>
    <br>
    <h2>Buque Registro Nro: {{$matricula}} </h2>
    @if ($idstatus==2)
    <br>
    <h2>Motivo Rechazo: {{$motivo}} </h2>
    @endif
@endcomponent
    Para más detalles ingrese a la página web:

@component('mail::button', ['url' => env('APP_URL')])
    INEA
@endcomponent

    Sugerencia: Agregue {{$from}} a sus contactos de correo electrónico para así evitar recibir correo en spam.
    Gracias,
@endcomponent
