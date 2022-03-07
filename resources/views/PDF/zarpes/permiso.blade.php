<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <style>
        .display-5 {
            font-family: 'Jost', sans-serif;
            font-size: 13px;
            line-height: 1.5;
        }

        .display-7 {
            font-family: 'Jost', sans-serif;
            font-size: 11px;
            line-height: 1.5;
        }

        .cid-sYSK2SiKvy {
            padding-top: 4rem;
            padding-bottom: 3rem;
            background-color: #ffffff;
        }

        .cid-sYSK2SiKvy .image-wrap img {
            width: 100%;
        }

        .cid-sYSK2SiKvy .mbr-text {
            color: #000080;
            text-align: center;
        }

        a {
            font-style: normal;
            font-weight: 400;
            cursor: pointer;
        }

        .mbr-section-subtitle {
            line-height: 1.3;
        }

        .mbr-text {
            font-style: normal;
            line-height: 1.7;
            text-align: justify;
            text-justify: inter-word;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .display-5,
        .display-7,
        span,
        p,
        a {
            line-height: 1.3;
            word-break: break-word;
            word-wrap: break-word;
            font-weight: 400;
        }

        b,
        strong {
            font-weight: bold;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        img,
        iframe {
            display: block;
            width: 100%;
        }

        html,
        body {
            height: auto;
            min-height: 100vh;
        }

        blockquote {
            font-style: italic;
            padding: 3rem;
            font-size: 1.09rem;
            position: relative;
            border-left: 3px solid;
        }

        .mb-4 {
            margin-bottom: 2rem !important;
        }

        .cid-sYSK2SiKvy .image-wrap img {
            display: block;
            margin: auto;
        }

        @page {
            margin-top: 140px;
        }

        header {
            top: -200px;
            position: fixed;
        }

        .content-paragraph {
            text-align: justify;
            text-justify: inter-word;
            padding-left: 20px;
            padding-right: 20px;
        }
        span.content  {
            text-align: justify;
            text-justify: inter-word;
            color: blue;
        }

        .content-paragraph-rigth {
            text-align: right;
            padding-left: 20px;
            padding-right: 20px;
        }
    </style>


</head>
<body>

<header class="cid-sYSK2SiKvy">

    <div style="position:absolute; left:200pt; width:1400pt;">
        <img class="img-rounded" height="1400px" src="{{ public_path('images/venezuela.svg') }}">
    </div>

    <div style="position:fixed;padding-top: 40pt; left: 420pt;">
        @php
            $QR =
                "Nombre Embarcacion: ".$buque->nombrebuque_actual."\n".
                "Destino: " .$zarpe->capitania->nombre."\n".
                "Fecha Emision: " .$zarpe->updated_at
        @endphp

        <img src="data:image/png;base64, {!! base64_encode(QrCode::size(100)->generate($QR)) !!} ">
    </div>
    <div style="padding-top:100pt; padding-left:130pt;">
        <p class=" text-center mbr-text display-5">
            República Bolivariana de Venezuela<br>
            Ministerio del Poder Popular para el Transporte<br>
            INSTITUTO NACIONAL DE LOS ESPACIOS ACUATICOS<br>
            Capitanía de Puerto<br>
            <br>
            <span style="color:black;">NOTIFICACION DE ZARPE</span><br>
            PORT CLEARANCE
        </p>
    </div>

</header>

<main>
    <div style="clear:both; position:relative; padding-top: 210px;" class="content-paragraph">

        <h4 class="mbr-section-subtitle mbr-fonts-style mb-4 display-5 content-paragraph">ZARPE Nº: {{$zarpe->nro_solicitud}}</h4>
        <p class="mbr-text mbr-fonts-style display-7 content-paragraph">
            Por cuanto el Buque <u> {{$zarpe->matricula}} </u> de bandera
            @if ($zarpe->bandera=='nacional')
                <u>Venezolana</u>
            @elseif ($zarpe->bandera=='extranjera')
                <u>Extranjera</u>
            @endif
            <span class="content">
                (SINCE THE VESSEL <u> {{$zarpe->matricula}} </u> UNDER FLAG <u> {{$zarpe->bandera}})</u>
            </span>
            del porte de <u> {{$buque->UAB}} </u> unidades de Registro Bruto <u> {{$buque->UAN}} </u>
            <span class="content">
                (OF TONNAGE <u> {{$buque->UAB}} </u>UNITS OF GROSS REGISTER <u> {{$buque->UAN}} </u>)
            </span>
            procedente de <u> {{$zarpe->establecimiento_nautico->nombre}} </u> en <u> {{$capitania->nombre}} </u> al mando del Capitán <u> {{$trip->nombre}} {{$trip->apellido}} </u>
            <span class="content">
                (COMING FROM <u> {{$zarpe->establecimiento_nautico->nombre}} </u> IN <u> {{$capitania->nombre}} </u>
                UNDER COMMAND OF CAPTAIN <u> {{$trip->nombre}} {{$trip->apellido}} </u>)
            </span>
            que navega con una tripulación de <u> {{$cantTrip}} </u> tripulantes y lleva a bordo <u> {{$cantPas}} </u> pasajeros,
            <span class="content">
                (SAILING WITH A CREW OF <u> {{$cantTrip}} </u> PERSONS AND CARRYING ON BOARD <u> {{$cantPas}} </u>PASSENGERS,)
            </span>
            con (XXXX) toneladas de carga en tránsito y (XXXX) toneladas de carga de este puerto, ha cumplido con todos los requisitos
            <span class="content">
                WITH (XXXX) CARGO IN TRANSIT AND (XXXX), TONS LIFTED IN THIS PORT, HAS FULFILL ALL FORMALITIES
            </span>
            legales y reglamentarios de acuerdo con el Artículo 38 de la Ley General de Marina y Actividades Conexas.
            <span class="content">
                (AND REGULATIONS ACCORDING TO THE ARTICLE 38 OF MARINA`S GENERAL LAW.AND RELATED ACTIVITIES.)
            </span>
        </p>
        <p class="mbr-text mbr-fonts-style display-7 content-paragraph">
            El suscrito Capitán de Puerto le concede el Permiso para Zarpar de este puerto, hoy a las <u> {{$zarpe->fecha_hora_salida}} </u> horas
            <span class="content">
                (THE UNDERSIGNER HARBOUR MASTER CONCEDE PERMISSION TO SAIL OUT OF FRONT THIS PORT TODAY AT <u> {{$zarpe->fecha_hora_salida}} </u>&nbsp;HOURS
            </span>
            Con destino a <u> {{$zarpe->capitania->nombre}} </u>
            <span class="content">
                (WITH DESTINATION TO <u> {{$zarpe->capitania->nombre}} </u>)
            </span>
        </p>
        <p class="mbr-text mbr-fonts-style display-7 content-paragraph">
            Este documento tendrá validez por 24 horas después de firmado.
            <span class="content">
                (THIS DOCUMENT WILL BE VALID UNTIL 24 HOURS AFTER BE SIGNED)
            </span>
        </p>
        <p class="mbr-text mbr-fonts-style display-7 content-paragraph">Este documento va sin enmiendas
            <span class="content">
                (THIS DOCUMENT IS PROVIDED WITHOUT AMENDMENTS)
            </span>
        </p>
        <p class="mbr-text mbr-fonts-style display-7 content-paragraph">Lugar y fecha <u> {{$zarpe->updated_at}} </u><br>
            <span class="content">
                PLACE AND DATE <u> {{$zarpe->updated_at}} </u>
            </span>
        </p>
        <br>
        <p class="mbr-text text-center mbr-fonts-style display-7">Capitán de Puerto<br>
            <span class="content">
                HARBOUR MASTER
            </span>
        </p>
        <p class="mbr-text text-right mbr-fonts-style display-7 content-paragraph-rigth">SMTAC-FOR-SM-0005-10<br>
        </p>
    </div>
</main>
</body>
</html>
