<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Deportes UNA</title>

    <link href="https://aulavirtual2.unap.edu.pe/images/themes/unap/favicon.ico" rel="icon">

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet" />


    <style>
        * {
            font-family: sans-serif;
        }

        .titulo {
            text-align: center;
            font-weight: bold;
            font-size: 13px;
        }

        .escpecificacion {
            padding: 0px !important;
            margin: 3px 0px !important;
            font-size: 12px;
        }

        .escpecificacion>span {
            font-size: 12px;
            font-weight: bold;
            color: black;
        }

        .inscritos {
            text-align: center;
            font-weight: bold;
            font-size: 12px;
            margin: 5px;
        }

        .inscritos-table,
        .inscritos-table th,
        .inscritos-table td {
            border: 0.5px solid black;
            border-collapse: collapse;
        }

        .inscritos-table {
            width: 100%;
            font-size: 12px;
            text-transform: uppercase;
        }


        .inscritos-table th {
            font-weight: bold;
        }

        .inscritos-table td,
        .inscritos-table th {
            padding: 4px;
            font-size: 10px;
        }

        .inscritos-table td {

            height: 40px;
        }

        .header-image {
            width: 100%;
            margin-bottom: 10px;
        }

        .col-firma {
            width: 140px;
        }

        .col-huella {
            width: 90px;
        }

        .firmas-container {
            border: 1px solid red;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
        }

        .firmas-container .firma-cell {
            text-align: center;
            font-weight: bold;
            border: 1px solid blue;
            width: 200px;
        }


        .firmas-table {
            text-align: center;
            width: 100%;
            font-size: 12px;
            border-collapse: collapse;

        }

        .firmas-table td {
            padding-top: 100px;

        }

        .firma-cell {
            width: 30% !important;
        }

        .space-cell {
            max-width: 5% !important;
        }

        .label-firma {
            border-top: 2px solid black;
            padding: 5px 2px;
        }
    </style>
</head>


<body>
    <img class="header-image"
        src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/header.png'))) }}">
    <p class="escpecificacion"><span>Fecha:</span> {{ $date }}</p>
    <p class="escpecificacion"><span>Facultad:</span> {{ $facultad->name }}</p>
    <p class="escpecificacion"><span>Escuela:</span> {{ $escuela->name }}</p>
    <p class="escpecificacion"><span>Disciplina:</span> {{ $deporte->name }}
    </p>

    <h3 class="inscritos">INSCRITOS</h3>

    <table class="inscritos-table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Apellidos y nombres</th>
                <th scope="col">Código</th>
                <th scope="col">DNI</th>
                <th scope="col">Fecha de inscripción</th>
                <th scope="col">Firma</th>
                <th scope="col">Huella</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach ($inscritos as $inscrito)
                <tr>
                    <td>{{ $i }}
                    </td>
                    <td>
                        {{ $inscrito->ap_paterno . ' ' . $inscrito->ap_materno . ' ' . $inscrito->name }}
                    </td>
                    <td>
                        {{ $inscrito->codigo }}
                    </td>
                    <td>
                        {{ $inscrito->dni }}
                    </td>
                    <td>
                        {{ \Carbon\Carbon::parse($inscrito['created_at'])->format('d/m/Y') }}
                    </td>
                    <td class="col-firma">

                    </td>
                    <td class="col-huella">

                    </td>

                </tr>
                @php
                    $i++;
                @endphp
            @endforeach
        </tbody>
    </table>

    <!--<div class="firmas-container">
        <div class="firma-cell firma-1">
            Firma Presidente
        </div>
        <div class="firma-cell firma-2">
            Firma Presidente 1
        </div>
        <div class="firma-cell firma-3">
            Firma Presidente 2
        </div>
    </div>-->

    <table class="firmas-table">
        <tbody>
            <tr>
                <td class="firma-cell">
                    <div class="label-firma">
                        Firma Presidente 01
                    </div>
                </td>
                <td class="space-cell">

                </td>
                <td class="firma-cell">
                    <div class="label-firma">
                        Firma Presidente 01
                    </div>
                </td>
                <td class="space-cell">

                </td class="firma-cell">
                <td class="firma-cell">
                    <div class="label-firma">
                        Firma Presidente 01
                    </div>
                </td>
            </tr>
        </tbody>
    </table>

</body>

</html>
