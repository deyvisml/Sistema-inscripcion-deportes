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
            padding: 1px 0px;
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
            margin: 10px;
        }

        table,
        th,
        td {
            border: 0.5px solid black;
            border-collapse: collapse;
        }

        table {
            width: 100%;
            font-size: 12px;
        }


        table th {
            font-weight: bold;
        }

        td,
        th {
            padding: 4px;
            font-size: 10px;
        }

        td {
            text-transform: uppercase;
        }
    </style>
</head>


<body>
    <h2 class="titulo">Universidad Nacional del Altiplano - Puno</h2>
    <p class="escpecificacion"><span>Fecha:</span> {{ $date }}</p>
    <p class="escpecificacion"><span>Facultad:</span> {{ $facultad->name }}</p>
    <p class="escpecificacion"><span>Escuela:</span> {{ $escuela->name }}</p>
    <p class="escpecificacion"><span>Disciplina:</span> {{ $deporte->name }}
    </p>

    <h3 class="inscritos">Inscritos</h3>

    <table>
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Apellidos y nombres</th>
                <th scope="col">Código</th>
                <th scope="col">Fecha de inscripción</th>
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
                        {{ $inscrito->codigo }}</td>
                    <td>
                        {{ \Carbon\Carbon::parse($inscrito['created_at'])->format('d/m/Y') }}
                    </td>
                </tr>
                @php
                    $i++;
                @endphp
            @endforeach
        </tbody>
    </table>

</body>

</html>
