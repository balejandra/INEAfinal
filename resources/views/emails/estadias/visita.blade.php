@component('mail::message')

    Saludos,

    Su solicitud de Estadia se le ha asignado un visitador, con el siguiente detalle:

@component('mail::panel')
    <b>Nro de Solicitud:</b> {{$solicitud}} <br>
    <b>Buque Registro Nro:</b>  {{$matricula}} <br>
    <b>Solicitante:</b>  {{$nombres_solic}} {{$apellidos_solic}} <br>
    <b>Visitador:</b>  {{$visitador}} <br>
    <b>Fecha de Visita:</b>  {{$fecha_visita}} <br>

@endcomponent
    Para más detalles ingrese a la página web:
@component('mail::button', ['url' => env('APP_URL')])
    INEA
@endcomponent

    Sugerencia: Agregue {{$from}} a sus contactos de correo electrónico para así evitar recibir correo en spam.
    Gracias,
@endcomponent
