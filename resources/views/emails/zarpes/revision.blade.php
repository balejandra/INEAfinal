@component('mail::message')

    Estimado {{$nombres_solic}} {{$apellidos_solic}}

    Reciba un cordial saludo de INEA. Nos complace informarle que su solicitud de Zarpe ha sido {{$status}},
    con el siguiente detalle:

@component('mail::panel')
    <h2>Nro de Solicitud: {{$solicitud}} </h2>
    <br>
    <h2>Buque Matricula Nro: {{$matricula}} </h2>
@endcomponent
    Para más detalles ingrese a la página web:

@component('mail::button', ['url' => env('APP_URL')])
        INEA
@endcomponent

    Sugerencia: Agregue {{$from}} a sus contactos de correo electrónico para así evitar recibir correo en spam.
    Gracias,
@endcomponent
