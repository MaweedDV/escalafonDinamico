<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
       @page {
            margin: 30px 0px 30px 0px;
        }
        body {
            font-family: sans-serif;
            font-size: 12px;
            margin: 6%;
            padding: 0;
        }

        header {
            position: fixed;
            top: -10px;
            left: 40px;
            right: 0;
            height: 30px;
            text-align: left;
        }

        footer {
            position: fixed;
            bottom: 10px;
            left: 0;
            right: 0;
            height: 30px;
            text-align: center;
        }

        .content {
            margin-top: 20px;
            margin: 0;
            padding: 0;
        }

        .page-break {
            page-break-after: always;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            page-break-inside: auto;
        }

        th, td {
            border: 1px solid #000;
            padding: 3px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Repite encabezado y pie en cada página */
        thead {
            display: table-header-group;
        }

        tfoot {
            display: table-footer-group;
        }

        /* Evita cortar filas */
        tr, td, th {
            page-break-inside: avoid !important;
        }

        /* Evita que título + tabla se separen */
        .bloque-tabla {
            page-break-inside: avoid;
            margin-bottom: 20px;
        }

        h3 {
            margin: 0;
            padding: 4px 0;
        }

        /* Estilo para título dentro del encabezado */
        thead tr:first-child th {
            background-color: #dbe5ff !important;
            font-weight: bold;
            text-align: left;
            font-size: 14px;
            padding: 6px;
            border-bottom: 2px solid #000;
        }
    </style>
</head>
<body>

    <!-- Encabezado -->
    <header>
        <img src="{{ public_path('media/reportPDF/encabezado.png') }}" style="width: 25%; display: block;" alt="Encabezado">
    </header>

    <!-- Pie de página -->
    <footer>
        <img src="{{ public_path('media/reportPDF/piepagina.png') }}" style="width: 100%; display: block;" alt="Pie de página">
    </footer>

   <!-- Contenido principal -->
<div class="content">
   <!-- Título general centrado -->
<div style="position: relative; text-align: center; margin-bottom: 10px;">
    <h1 style="margin: 0;">ESCALAFÓN DE MÉRITO {{$ano_vigencia}}</h1>
    <img src="{{ public_path('media/escalafon/leyendaCargos.png')}}"
         style="position: absolute; right: 0; top: 50%; transform: translateY(-300%); width: 20%; height: 20%;">
</div>

<label style="text-align: left; display: block; font-weight: normal; font-size: 1em; margin-top: 5px;">
    Vigente: {{ date('01-01-'.$ano_vigencia) }} <br>
    Periodo Calificatorio: {{date('01-09-'.$ano_periodo_desde)}} a {{date('31-08-'.$ano_periodo_hasta)}}
</label>

    @foreach($nombresCargos as $nombreCargo)
        <div class="grupo-cargo">
            @php
                $cargosPorGrado = $nombreCargo->cargos_escalafon->groupBy('grado');
            @endphp

            @foreach($cargosPorGrado as $grado => $cargos)
                @php
                    $funcionarios = $cargos->flatMap->funcionarios->sortBy([
                        ['calificacion', 'desc'],
                        ['antiguedad_cargo', 'asc'],
                        ['antiguedad_grado', 'asc'],
                        ['antiguedad_mismo_municipio_detalle', 'desc'],
                        ['fecha_decreto', 'asc'],
                        ['decreto', 'asc'],
                    ]);
                    $totalCargosPorGrado = $cargos->count();
                @endphp

                <div class="bloque-tabla">
                    <table class="table table-bordered table-vcenter">
                        <thead>
                            <tr>
                                <th colspan="11">
                                    {{ $nombreCargo->nombre_cargo }} - GRADO {{ $grado }}
                                </th>
                            </tr>
                            <tr>
                                <th style="width: 50px; background-color: #eef4ff;">Lugar</th>
                                <th style="width: 140px; background-color: #eef4ff;">Nombre</th>
                                <th style="width: 70px; background-color: #eef4ff;">Rut</th>
                                <th style="background-color: #eef4ff;">Grado</th>
                                <th style="background-color: #eef4ff;">Calif.</th>
                                <th style="background-color: #eef4ff;">Lista</th>
                                <th style="width: 70px; background-color: #eef4ff;">Antig. Cargo</th>
                                <th style="width: 70px; background-color: #eef4ff;">Antig. Grado</th>
                                <th style="width: 70px; background-color: #eef4ff;">Antig. Mismo Municipio</th>
                                {{-- <th style="width: 70px;background-color: #eef4ff;">Antig. Mismo Municipio Detalle</th> --}}
                                <th style="width: 70px;background-color: #eef4ff;">Antig. Estado</th>
                                <th style="width: 180px;background-color: #eef4ff;">Educación Formal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $indexfunc = 0; @endphp
                            @foreach($funcionarios as $funcionario)
                                @php
                                    $profesion = App\Models\Profesion::find($funcionario->educacion_formal);
                                    switch ($funcionario->id_Cargo) {
                                        case 2: case 6: case 7: case 8:
                                            $COLOR = '#55e5f2'; break;
                                        case 3: case 4: case 5: case 9: case 10: case 11: case 554: case 555:
                                            $COLOR = '#fc981e'; break;
                                        default:
                                            $COLOR = '#2a68f7'; break;
                                    }

                                    $antiguedad_cargo = strtotime($funcionario->antiguedad_cargo);
                                    $antiguedad_grado = strtotime($funcionario->antiguedad_grado);
                                    $antiguedad_mismo_municipio = strtotime($funcionario->antiguedad_mismo_municipio);
                                @endphp
                                <tr>
                                    <td style="background-color: {{$COLOR}}">{{ ++$indexfunc }}</td>
                                    <td style="height: 50px">{{ $funcionario->apellido_paterno . ' ' . $funcionario->apellido_materno . ' ' . $funcionario->nombre }}</td>
                                    <td>{{ $funcionario->rut }}</td>
                                    <td>{{ $grado }}</td>
                                    <td>{{ $funcionario->calificacion ?? '-' }}</td>
                                    <td>{{ $funcionario->lista ?? '-' }}</td>
                                    <td class="text-center">{{ date("d-m-Y", $antiguedad_cargo) ?? '-' }}</td>
                                    <td class="text-center">{{ date("d-m-Y", $antiguedad_grado) ?? '-' }}</td>
                                    <td class="text-center">{{ date("d-m-Y", $antiguedad_mismo_municipio) ?? '-' }}</td>
                                    {{-- <td>3A-2M-10D</td> --}}
                                    <td> </td>
                                    <td>{{ $profesion->profesion ?? '-' }}</td>
                                </tr>
                            @endforeach

                            {{-- Vacantes --}}
                            @for ($v = $indexfunc + 1; $v <= $totalCargosPorGrado; $v++)
                                <tr>
                                    <td style="height: 50px; background-color: #2a68f7 ">{{ $v }}</td>
                                    <td>VACANTE</td>
                                    <td>-</td>
                                    <td>{{ $grado }}</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    {{-- <td>-</td> --}}
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>

                    <label style="text-align: left; display: block; font-weight: normal; font-size: 1em; margin-top: 5px;">
                        ({{ $funcionarios->count() }} Funcionarios) - Total Cargos: {{ $totalCargosPorGrado }}
                    </label>
                </div>
            @endforeach
        </div>
    @endforeach
</div>

</body>
</html>
