@extends('layouts.backendPublic')

@section('content')
<div class="container-fluid px-8 my-4">
     <header>
        <img src=" {{ asset('images/encabezado.png') }}" style="width: 25%; display: block;" alt="Encabezado">
    </header>
    <!-- Título -->
    <div class="text-center mb-4">
        <h1 class="fw-bold">ESCALAFÓN DE MÉRITO 2026</h1>
    </div>
    <div class="row">
        <div class="col-6">
             <label style="text-align: left; display: block; font-weight: normal; font-size: 1em; margin-top: 20px;">
                    Vigente: 01-01-2026<br>
                    Periodo Calificatorio: 01-09-2024 a 31-08-2025
            </label>
        </div>
        <div class="col-6">

        <div class="d-flex justify-content-end gap-3">
            <div>
                <a href="{{ route('escalafonPDFpublic.report') }}" target="_blank" style="font-size: 50px;">
                    <i class="si si-printer"></i>
                </a>
        </div>
         <div>
            <a data-bs-toggle="modal" data-bs-target="#modal-block-fromright" href="" style="font-size: 50px;">
                <i class="si si-info"></i>
            </a>
        </div>
    </div>
</div>
    </div>

    <!-- Buscador -->
    <div class="row mb-4">
        <div class="card shadow-sm p-3 mb-2 col-6">
            <label for="buscador-funcionarios" class="form-label fw-semibold">🔎 Buscar Funcionarios</label>
            <input type="text" id="buscador-funcionarios" class="form-control" placeholder="Ejemplo: Juan Pérez o 12345678-9">
        </div>
         <!-- Botones -->
    <div class="card shadow-sm mb-2 p-3 col-6">
        <br>
    <div class="row">
        <div class="col-6">
            <button id="expandirTodoBtn" class="btn btn-success w-100">Expandir todo</button>
        </div>
        <div class="col-6">
            <button id="colapsarTodoBtn" class="btn btn-danger w-100">Contraer todo</button>
        </div>
    </div>
</div>

    </div>




    <!-- Acordeones -->
    <div class="accordion" id="accordionCargos">
        @foreach($nombresCargos as $nombreCargo)
        <div class="grupo-cargo mb-4">
            <h4 class="text-center text-primary my-3 border-bottom pb-2">
                {{ $nombreCargo->nombre_cargo }}
                <small class="text-muted"></small>
            </h4>

            @php
                $cargosPorGrado = $nombreCargo->cargos_escalafon->groupBy('grado');
            @endphp

            @foreach($cargosPorGrado as $grado => $cargos)
                @php
                    $funcionarios = $cargos->flatMap->funcionarios->sortBy([
                        ['calificacion', 'desc'],
                        ['antiguedad_cargo', 'asc'],
                        ['antiguedad_grado', 'asc'],
                        ['antiguedad_mismo_municipio', 'asc'], //despues de ingresado detalle sacar esta variable
                        ['fecha_decreto', 'asc'],
                        ['decreto', 'asc'],
                    ]);
                    $totalCargosPorGrado = $cargos->count();
                    $accordionId = 'collapse-' . $nombreCargo->id . '-' . $grado;
                @endphp

                <div class="accordion-item shadow-sm mb-2">
                    <h2 class="accordion-header" id="heading-{{ $accordionId }}">
                        <button class="accordion-button collapsed fw-semibold" type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#{{ $accordionId }}"
                                aria-expanded="false"
                                aria-controls="{{ $accordionId }}">
                            {{ $nombreCargo->nombre_cargo }} - GRADO {{ $grado }}

                        </button>
                    </h2>
                    <div id="{{ $accordionId }}" class="accordion-collapse collapse"
                        aria-labelledby="heading-{{ $accordionId }}">
                        <div class="accordion-body">

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped align-middle">
                                    <thead class="table-light">
                                        <tr>
                                        <th class="text-center" style="width: 50px; background-color: #eef4ff;">Lugar</th>
                                        <th class="text-center" style="width: 250px; background-color: #eef4ff;">Nombre</th>
                                        <th class="text-center" style="width: 150px; background-color: #eef4ff;">Rut</th>
                                        <th class="text-center" style="width: 50px; background-color: #eef4ff;">Grado</th>
                                        <th class="text-center" style="width: 50px; background-color: #eef4ff;">Calif.</th>
                                        <th class="text-center" style="width: 50px; background-color: #eef4ff;">Lista</th>
                                        <th class="text-center" style="width: 150px; background-color: #eef4ff;">Antig. Cargo</th>
                                        <th class="text-center" style="width: 150px; background-color: #eef4ff; ">Antig. Grado</th>
                                        <th class="text-center" style="width: 150px; background-color: #eef4ff; ">Antig. Mismo Municipio</th>
                                        <th class="text-center" style="width: 150px; background-color: #eef4ff; ">Antig. Mismo Municipio Detalle</th>
                                        <th class="text-center" style="width: 150px; background-color: #eef4ff; ">Antig. Estado</th>
                                        <th class="text-center" style="width: 150px; background-color: #eef4ff;">Educación Formal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $indexfunc = 0; @endphp
                                        @foreach($funcionarios as $funcionario)
                                            @php
                                                $profesion = App\Models\Profesion::find($funcionario->educacion_formal);
                                            @endphp
                                            @php
                                                $anos = 0;
                                                $meses = 0;
                                                $dias = 0;
                                                $tiempoDetalle = $funcionario->antiguedad_mismo_municipio_detalle;

                                                if($tiempoDetalle == null || $tiempoDetalle == 0){
                                                    $anos = 0;
                                                    $meses = 0;
                                                    $dias = 0;
                                                }else{
                                                    $anos = floor($tiempoDetalle / 365);
                                                    $meses = floor(($tiempoDetalle % 365) / 30);
                                                    $dias = ($tiempoDetalle % 365) % 30;
                                                }

                                            @endphp
                                            <tr>
                                                <td class="text-center" style="height: 80px;">{{ ++$indexfunc }}</td>
                                                <td>{{ $funcionario->apellido_paterno }} {{ $funcionario->apellido_materno }} {{ $funcionario->nombre }}</td>
                                                <td class="text-center">{{ $funcionario->rut }}</td>
                                                <td class="text-center">{{ $grado }}</td>
                                                <td class="text-center">{{ $funcionario->calificacion ?? '-' }}</td>
                                                <td class="text-center">{{ $funcionario->lista ?? '-' }}</td>
                                                <td class="text-center">{{ $funcionario->antiguedad_cargo ?? '-' }}</td>
                                                <td class="text-center">{{ $funcionario->antiguedad_grado ?? '-' }}</td>
                                                <td class="text-center">{{ $funcionario->antiguedad_mismo_municipio ?? '-' }}</td>
                                                <td class="text-center">{{ $anos."A-" .$meses."M-" .$dias."D"  ?? '-' }}</td>
                                                <td class="text-center">{{ $funcionario->antiguedad_administracion_estado ?? '-' }}</td>
                                                <td>{{ $profesion->profesion ?? '-' }}</td>
                                            </tr>
                                        @endforeach

                                        {{-- Vacantes --}}
                                        @for ($v = $indexfunc + 1; $v <= $totalCargosPorGrado; $v++)
                                            <tr class="table-warning">
                                               <td class="text-center">{{ $v }}</td>
                                                <td class="text-center">VACANTE</td>
                                                <td class="text-center">-</td>
                                                <td class="text-center">{{ $grado }}</td>
                                                <td class="text-center">-</td>
                                                <td class="text-center">-</td>
                                                <td class="text-center">-</td>
                                                <td class="text-center">-</td>
                                                <td class="text-center">-</td>
                                                <td class="text-center">-</td>
                                                <td class="text-center">-</td>
                                                <td class="text-center">-</td>
                                            </tr>
                                        @endfor
                                    </tbody>
                                </table>
                                <label style="text-align: right; margin-left: auto; font-weight: normal; font-size: 1em;">
                                Total Cargos: {{ $totalCargosPorGrado }}  (Provistos: {{ $funcionarios->count() }} - No Provistos: {{ $totalCargosPorGrado - $funcionarios->count() }})
                                </label>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @endforeach
    </div>
</div>
@endsection

@include('frontend.sections.escalafon.modal')

@push('scripts')
<script>

    document.addEventListener("DOMContentLoaded", function () {
        const accordions = document.querySelectorAll('#accordionCargos .accordion-collapse');
        const buttons = document.querySelectorAll('#accordionCargos .accordion-button');

        accordions.forEach(collapse => collapse.classList.add('show'));
        buttons.forEach(btn => {
            btn.classList.remove('collapsed');
            btn.setAttribute('aria-expanded', 'true');
        });
    });

    document.getElementById('buscador-funcionarios').addEventListener('input', function () {
        const valor = this.value.toLowerCase().trim();

        document.querySelectorAll('.grupo-cargo').forEach(grupo => {
            const encabezado = grupo.querySelector('h4'); // <-- CAMBIADO a h4
            const textoEncabezado = encabezado.textContent.toLowerCase();

            const coincidenciaEncabezado = textoEncabezado.includes(valor);
            let grupoCoincide = false;

            const acordeones = grupo.querySelectorAll('.accordion-item');

            acordeones.forEach(item => {
                const filas = item.querySelectorAll('tbody tr');
                let coincidencias = 0;

                filas.forEach(fila => {
                    const textoFila = fila.textContent.toLowerCase();
                    const esVacante = textoFila.includes('vacante');

                    if (valor === '' || coincidenciaEncabezado) {
                        fila.style.display = '';
                        coincidencias++;
                    } else {
                        if (!esVacante && textoFila.includes(valor)) {
                            fila.style.display = '';
                            coincidencias++;
                        } else {
                            fila.style.display = 'none';
                        }
                    }
                });

                if (coincidencias > 0 || coincidenciaEncabezado || valor === '') {
                    item.style.display = '';
                    grupoCoincide = true;
                } else {
                    item.style.display = 'none';
                }

                const collapse = item.querySelector('.accordion-collapse');
                const button = item.querySelector('.accordion-button');

                if (valor === '') {
                    collapse.classList.remove('show');
                    button.classList.add('collapsed');
                    button.setAttribute('aria-expanded', 'false');
                } else if (coincidencias > 0 || coincidenciaEncabezado) {
                    collapse.classList.add('show');
                    button.classList.remove('collapsed');
                    button.setAttribute('aria-expanded', 'true');
                } else {
                    collapse.classList.remove('show');
                    button.classList.add('collapsed');
                    button.setAttribute('aria-expanded', 'false');
                }
            });

            if (valor === '') {
                grupo.style.display = '';
                encabezado.style.display = '';
            } else {
                grupo.style.display = grupoCoincide ? '' : 'none';
                encabezado.style.display = grupoCoincide ? '' : 'none';
            }
        });
    });

    document.getElementById('colapsarTodoBtn').addEventListener('click', function () {
        const accordions = document.querySelectorAll('#accordionCargos .accordion-collapse');
        const buttons = document.querySelectorAll('#accordionCargos .accordion-button');

        accordions.forEach(collapse => collapse.classList.remove('show'));
        buttons.forEach(btn => {
            btn.classList.add('collapsed');
            btn.setAttribute('aria-expanded', 'false');
        });
    });

    document.getElementById('expandirTodoBtn').addEventListener('click', function () {
        const accordions = document.querySelectorAll('#accordionCargos .accordion-collapse');
        const buttons = document.querySelectorAll('#accordionCargos .accordion-button');

        accordions.forEach(collapse => collapse.classList.add('show'));
        buttons.forEach(btn => {
            btn.classList.remove('collapsed');
            btn.setAttribute('aria-expanded', 'true');
        });
    });
</script>
@endpush
