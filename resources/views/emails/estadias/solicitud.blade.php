@component('mail::message')

    Estimado Ciudadano

    {{$mensaje}}

@component('mail::panel')
    <h2>Nro de Solicitud: {{$solicitud}} </h2>
    <h2>Nombre Embarcacion: {{$nombre_buque}} </h2>
    <h2>Buque Registro Nro: {{$matricula}} </h2>
    <h2>Solicitante: {{$nombres_solic}} {{$apellidos_solic}}</h2>
@endcomponent
    Para más detalles ingrese a la página web:

@component('mail::button', ['url' => env('APP_URL')])
    INEA
@endcomponent
    Instituto Nacional de Los Espacios Acuáticos - INEA. Síguenos en: http://twitter.com/#!/INEA200

    Sugerencia: Agregue {{$from}} a sus contactos de correo electrónico para así evitar recibir correo en spam.
    Gracias,
@endcomponent
