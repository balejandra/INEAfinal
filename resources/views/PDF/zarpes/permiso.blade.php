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

        .text-center{
            text-align: center;
        }
        .text-right{
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
        @page { margin-top: 140px;}
        header {
            top: -200px;
            position: fixed;
        }
    </style>


</head>
<body>

<header class="cid-sYSK2SiKvy" >
        <div style="position:absolute; left:200pt; width:1400pt;">
            <img class="img-rounded" height="1400px" src="{{ public_path('images/venezuela.svg') }}">
        </div>
        <div style="padding-top:100pt; padding-left:130pt;">
                <p class=" text-center mbr-text display-5">
                    República Bolivariana de Venezuela<br>
                    Ministerio de Infrastructura<br>
                    INSTITUTO NACIONAL DE LOS ESPACIOS ACUATICOS<br>
                    Capitanía de Puerto<br>
                    <br>
                    <span style="color:black;">ZARPE</span><br>
                    PORT CLEARANCE
                </p>
        </div>
</header>

<main>
    <div style="clear:both; position:relative; padding-top: 210px;">
                <h4 class="mbr-section-subtitle mbr-fonts-style mb-4 display-5">ZARPE Nº: {{$zarpe->nro_solicitud}}</h4>
                <p class="mbr-text mbr-fonts-style display-7">Por cuanto el Buque {{$zarpe->matricula}} de bandera {{$zarpe->bandera}}<br>
                    <span style="color:blue;">SINCE THE VESSEL {{$zarpe->matricula}} UNDER FLAG {{$zarpe->bandera}}</span>
                </p>
                <p class="mbr-text mbr-fonts-style display-7">del porte de {{$tran->UAB}} unidades de Registro Bruto {{$tran->UAN}}<br>
                    <span style="color:blue;">OF TONNAGE {{$tran->UAB}} UNITS OF GROSS REGISTER {{$tran->UAN}}</span>
                </p>
                <p class="mbr-text mbr-fonts-style display-7"> procedente de {{$zarpe->establecimiento_nautico->nombre}} al mando del Capitán {{$trip->nombre}} {{$trip->apellido}}<br>
                    <span style="color:blue;">COMING FROM {{$zarpe->establecimiento_nautico->nombre}} UNDER COMMAND OF CAPTAIN {{$trip->nombre}} {{$trip->apellido}}</span>
                </p>
                <p class="mbr-text mbr-fonts-style display-7">que navega con una tripulación de {{$tran->id}} tripulantes y lleva a
                    bordo {{$tran->id}} pasajeros, con {{$tran->id}}<br>
                    <span style="color:blue;">SAILING WITH A CREW OF {{$tran->id}} PERSONS AND CARRYING ON BOARD {{$tran->id}}
                    PASSENGERS, WITH {{$tran->id}}</span>
                </p>
                <p class="mbr-text mbr-fonts-style display-7">toneladas de carga en tránsito y {{$tran->id}}&nbsp; toneladas de carga de este
                    puerto, ha cumplido con todos los requisitos<br>
                    <span style="color:blue;">CARGO IN TRANSIT AND {{$tran->id}}, TONS LIFTED IN THIS PORT, HAS FULFILL ALL FORMALITIES</span>
                </p>
                <p class="mbr-text mbr-fonts-style display-7">legales y reglamentarios de acuerdo con el Artículo 38 de la Ley General de Marina y Actividades
                    Conexas.<br>
                    <span style="color:blue;">AND REGULATIONS ACCORDING TO THE ARTICLE 38 OF MARINA`S GENERAL LAW.AND RELATED ACTIVITIES</span>
                </p>
                <p class="mbr-text mbr-fonts-style display-7">El suscrito Capitán de Puerto le concede el Permiso para Zarpar de este puerto, hoy a
                    las {{$tran->id}} horas<br>
                    <span style="color:blue;">THE UNDERSIGNER HARBOUR MASTER CONCEDE PERMISSION TO SAIL OUT OF FRONT THIS PORT
                    TODAY AT {{$tran->id}}&nbsp;HOURS</span>
                </p>
                <p class="mbr-text mbr-fonts-style display-7">Con destino a {{$tran->id}}<br>
                    <span style="color:blue;">WITH DESTINATION TO {{$tran->id}}</span>
                </p>
                <p class="mbr-text mbr-fonts-style display-7">Este documento tendrá validez por 24 horas después de firmado.<br>
                    <span style="color:blue;">THIS DOCUMENT WILL BE VALID UNTIL 24 HOURS AFTER BE SIGNED</span>
                </p>
                <p class="mbr-text mbr-fonts-style display-7">Este documento va sin enmiendas<br>
                    <span style="color:blue;">THIS DOCUMENT IS PROVIDED WITHOUT AMENDMENTS</span>
                </p>
                <p class="mbr-text mbr-fonts-style display-7">Lugar y fecha {{$tran->id}}<br>
                    <span style="color:blue;">PLACE AND DATE</span>
                </p>
                <p class="mbr-text text-center mbr-fonts-style display-7">Capitán de Puerto<br>
                    <span style="color:blue;">HARBOUR MASTER</span>
                </p>
                <p class="mbr-text text-right mbr-fonts-style display-7">SMTAC-FOR-SM-0005-10<br>
                </p>
            </div>
        </div>
    </div>
</main>
</body>
</html>
