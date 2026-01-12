@extends('layouts.backendPublic')

@section('content')

<style>
/* --- ESTILOS RESPONSIVOS --- */

@media (max-width: 768px) {
    h1.fw-bold {
        font-size: 1.4rem !important;
    }

    header img {
        max-width: 170px !important;
    }

    .card p {
        font-size: 0.85rem;
    }

    .card-header {
        font-size: 0.9rem;
    }

    .table-responsive {
        display: none; /* Ocultar tabla en móvil */
    }

    .mobile-card {
        display: block !important; /* Mostrar cards en móvil */
    }
}

@media (min-width: 769px) {
    .mobile-card {
        display: none !important; /* Ocultar cards en escritorio */
    }
}
</style>

<div class="container-fluid px-3 px-md-5 my-4">

    <!-- Encabezado -->
    <header class="text-left mb-3">
        <img src="{{ asset('images/encabezado.png') }}"
             class="img-fluid"
             style="max-width: 250px;"
             alt="Encabezado">
    </header>

    <!-- Título -->
    <div class="text-center mb-4">
        <h1 class="fw-bold">ESCALAFÓN DE MÉRITO 2026</h1>
    </div>

    <!-- Información -->
    <div class="row mb-4">

        <div class="col-12 col-md-6 mb-3">
            <label style="font-size: 1em;">
                <strong>Vigente:</strong> 01-01-2026<br>
                <strong>Periodo Calificatorio:</strong> 01-09-2024 a 31-08-2025
            </label>
        </div>

        <div class="col-12 col-md-6 d-flex justify-content-md-end justify-content-start gap-4">
            <a href="{{ route('escalafonPDFpublic.report') }}" target="_blank">
                <i class="si si-printer fs-1"></i>
            </a>

            <a data-bs-toggle="modal" data-bs-target="#modal-block-fromright" href="">
                <i class="si si-info fs-1"></i>
            </a>
        </div>

    </div>

    <!-- Buscador -->
    <div class="row mb-4">

        <div class="card shadow-sm p-3 col-12 col-md-6 mb-2">
            <label for="buscador-funcionarios" class="form-label fw-semibold">🔎 Buscar Funcionarios</label>
            <input type="text" id="buscador-funcionarios" class="form-control" placeholder="Ejemplo: Juan Pérez o 12345678-9">
        </div>

        <div class="card shadow-sm p-3 col-12 col-md-6 mb-2">
            <div class="row">
                <div class="col-12 col-sm-6 mb-2">
                    <button id="expandirTodoBtn" class="btn btn-success w-100">Expandir todo</button>
                </div>
                <div class="col-12 col-sm-6">
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
                            ['antiguedad_mismo_municipio_detalle', 'desc'],
                            ['fecha_decreto', 'asc'],
                            ['decreto', 'asc'],
                        ]);

                        $totalCargosPorGrado = $cargos->count();
                        $accordionId = 'collapse-' . $nombreCargo->id . '-' . $grado;
                    @endphp

                    <div class="accordion-item shadow-sm mb-2">

                        <h2 class="accordion-header" id="heading-{{ $accordionId }}">
                            <button class="accordion-button collapsed fw-semibold"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#{{ $accordionId }}"
                                    aria-expanded="false"
                                    aria-controls="{{ $accordionId }}">
                                {{ $nombreCargo->nombre_cargo }} – GRADO {{ $grado }}°
                            </button>
                        </h2>

                        <div id="{{ $accordionId }}" class="accordion-collapse collapse">
                            <div class="accordion-body">

                                <!-- TABLA (ESCRITORIO) -->
                                <div class="table-responsive d-none d-md-block">
                                    <table class="table table-bordered table-striped align-middle">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="text-center">Lugar</th>
                                                <th class="text-center">Nombre</th>
                                                <th class="text-center">Rut</th>
                                                <th class="text-center">Grado</th>
                                                <th class="text-center">Calif.</th>
                                                <th class="text-center">Lista</th>
                                                <th class="text-center">Antig. Cargo</th>
                                                <th class="text-center">Antig. Grado</th>
                                                <th class="text-center">Antig. M. Municipio</th>
                                                {{-- <th class="text-center">Detalle</th> --}}
                                                <th class="text-center">Antig. Estado</th>
                                                <th class="text-center">Educación Formal</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @php $index = 0; @endphp

                                            @foreach($funcionarios as $funcionario)
                                                @php
                                                    $index++;
                                                    $profesion = App\Models\Profesion::find($funcionario->educacion_formal);
                                                    $detalle = $funcionario->antiguedad_mismo_municipio_detalle ?? 0;
                                                    $anos = floor($detalle / 365);
                                                    $meses = floor(($detalle % 365) / 30);
                                                    $dias = ($detalle % 365) % 30;
                                                @endphp

                                                <tr>
                                                    <td class="text-center">{{ $index }}</td>
                                                    <td>{{ $funcionario->apellido_paterno }} {{ $funcionario->apellido_materno }} {{ $funcionario->nombre }}</td>
                                                    <td class="text-center">{{ $funcionario->rut }}</td>
                                                    <td class="text-center">{{ $grado }}</td>
                                                    <td class="text-center">{{ $funcionario->calificacion ?? '-' }}</td>
                                                    <td class="text-center">{{ $funcionario->lista ?? '-' }}</td>
                                                    <td class="text-center">{{ date("d-m-Y", $antiguedad_cargo) ?? '-' }}</td>
                                                    <td class="text-center">{{ date("d-m-Y", $antiguedad_grado) ?? '-' }}</td>
                                                    <td class="text-center">{{ date("d-m-Y", $antiguedad_mismo_municipio) ?? '-' }}</td>
                                                    {{-- <td class="text-center">{{ "{$anos}A-{$meses}M-{$dias}D" }}</td> --}}
                                                    <td class="text-center">{{ $funcionario->antiguedad_administracion_estado ?? '-' }}</td>
                                                    <td>{{ $profesion->profesion ?? '-' }}</td>
                                                </tr>
                                            @endforeach

                                            {{-- VACANTES --}}
                                            @for ($v = $index + 1; $v <= $totalCargosPorGrado; $v++)
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
                                </div>

                                <!-- CARDS PARA MÓVIL -->
                                <div class="mobile-card">

                                    @php $index = 0; @endphp

                                    @foreach($funcionarios as $funcionario)
                                        @php
                                            $index++;
                                            $profesion = App\Models\Profesion::find($funcionario->educacion_formal);
                                            $detalle = $funcionario->antiguedad_mismo_municipio_detalle ?? 0;
                                            $anos = floor($detalle / 365);
                                            $meses = floor(($detalle % 365) / 30);
                                            $dias = ($detalle % 365) % 30;
                                        @endphp

                                        <div class="card shadow-sm mb-3">
                                            <div class="card-header bg-primary text-white py-2">
                                                <strong>{{ $index }}° — {{ $funcionario->apellido_paterno }} {{ $funcionario->apellido_materno }} {{ $funcionario->nombre }}</strong>
                                            </div>

                                            <div class="card-body">
                                                <p><strong>RUT:</strong> {{ $funcionario->rut }}</p>
                                                <p><strong>Grado:</strong> {{ $grado }}</p>
                                                <p><strong>Calificación:</strong> {{ $funcionario->calificacion ?? '-' }}</p>
                                                <p><strong>Lista:</strong> {{ $funcionario->lista ?? '-' }}</p>
                                                <hr>
                                                <p><strong>Antig. Cargo:</strong> {{ $funcionario->antiguedad_cargo ?? '-' }}</p>
                                                <p><strong>Antig. Grado:</strong> {{ $funcionario->antiguedad_grado ?? '-' }}</p>
                                                <p><strong>Antig. Municipio:</strong> {{ $funcionario->antiguedad_mismo_municipio ?? '-' }}</p>
                                                <p><strong>Detalle:</strong> {{ "{$anos}A-{$meses}M-{$dias}D" }}</p>
                                                <p><strong>Antig. Estado:</strong> {{ $funcionario->antiguedad_administracion_estado ?? '-' }}</p>
                                                <hr>
                                                <p><strong>Educación Formal:</strong> {{ $profesion->profesion ?? '-' }}</p>
                                            </div>
                                        </div>

                                    @endforeach

                                    {{-- CARDS DE VACANTES --}}
                                    @for ($v = $index + 1; $v <= $totalCargosPorGrado; $v++)
                                        <div class="card shadow-sm mb-3 border-warning">
                                            <div class="card-header bg-warning text-dark py-2">
                                                <strong>{{ $v }}° — VACANTE</strong>
                                            </div>
                                            <div class="card-body">
                                                <p><strong>Grado:</strong> {{ $grado }}</p>
                                                <p><strong>RUT:</strong> -</p>
                                                <p><strong>Calificación:</strong> -</p>
                                                <p><strong>Lista:</strong> -</p>
                                                <hr>
                                                <p><strong>Antigüedades:</strong> No aplica</p>
                                                <hr>
                                                <p><strong>Educación Formal:</strong> -</p>
                                            </div>
                                        </div>
                                    @endfor

                                </div>

                                <label class="d-block text-left mt-3">
                                    Total Cargos: {{ $totalCargosPorGrado }}
                                    (Provistos: {{ $funcionarios->count() }} —
                                    No Provistos: {{ $totalCargosPorGrado - $funcionarios->count() }})
                                </label>

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

        accordions.forEach(c => c.classList.add('show'));
        buttons.forEach(b => {
            b.classList.remove('collapsed');
            b.setAttribute('aria-expanded', 'true');
        });
    });

    // BUSCADOR
    document.getElementById('buscador-funcionarios').addEventListener('input', function () {
        const valor = this.value.toLowerCase().trim();

        document.querySelectorAll('.grupo-cargo').forEach(grupo => {
            const encabezado = grupo.querySelector('h4');
            const textoEncabezado = encabezado.textContent.toLowerCase();
            const coincideEncabezado = textoEncabezado.includes(valor);
            let visible = false;

            grupo.querySelectorAll('.accordion-item').forEach(item => {
                const filas = item.querySelectorAll('tbody tr');
                const cards = item.querySelectorAll('.mobile-card .card');

                let matches = 0;

                // TABLA
                filas.forEach(fila => {
                    if (fila.textContent.toLowerCase().includes(valor) || valor === '') {
                        fila.style.display = '';
                        matches++;
                    } else {
                        fila.style.display = 'none';
                    }
                });

                // CARDS
                cards.forEach(card => {
                    if (card.textContent.toLowerCase().includes(valor) || valor === '') {
                        card.style.display = '';
                        matches++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                // Mostrar/ocultar acordeón completo
                item.style.display = (matches > 0 || coincideEncabezado || valor === '') ? '' : 'none';

                const collapse = item.querySelector('.accordion-collapse');
                const button = item.querySelector('.accordion-button');

                if (matches > 0 || coincideEncabezado) {
                    collapse.classList.add('show');
                    button.classList.remove('collapsed');
                    button.setAttribute('aria-expanded', 'true');
                } else {
                    collapse.classList.remove('show');
                    button.classList.add('collapsed');
                    button.setAttribute('aria-expanded', 'false');
                }

                if (matches > 0) visible = true;
            });

            grupo.style.display = (visible || valor === '') ? '' : 'none';
        });
    });

    // Botones expandir / contraer
    document.getElementById('expandirTodoBtn').addEventListener('click', function () {
        document.querySelectorAll('.accordion-collapse').forEach(c => c.classList.add('show'));
        document.querySelectorAll('.accordion-button').forEach(btn => {
            btn.classList.remove('collapsed');
            btn.setAttribute('aria-expanded', 'true');
        });
    });

    document.getElementById('colapsarTodoBtn').addEventListener('click', function () {
        document.querySelectorAll('.accordion-collapse').forEach(c => c.classList.remove('show'));
        document.querySelectorAll('.accordion-button').forEach(btn => {
            btn.classList.add('collapsed');
            btn.setAttribute('aria-expanded', 'false');
        });
    });
</script>
@endpush
