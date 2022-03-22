@component('mail::message')

    Saludos,

    {{$mensaje}}

    Detalles de la embarcación:

@component('mail::panel')
    <b>Nro de Solicitud:</b> {{$solicitud}} <br>
    <b>Buque Matricula Nro:</b>  {{$matricula}} <br>
    <b>Solicitante:</b>  {{$nombres_solic}} {{$apellidos_solic}} <br>
    <b>Fecha y hora de salida:</b>  {{$fecha_salida}} <br>
    <b>Fecha y hora de regreso:</b>  {{$fecha_regreso}} <br>

@endcomponent
    Para más detalles ingrese a la página web:

@component('mail::button', ['url' => env('APP_URL')])
        INEA
@endcomponent

    Sugerencia: Agregue {{$from}} a sus contactos de correo electrónico para así evitar recibir correo en spam.
    Gracias,
@endcomponent
