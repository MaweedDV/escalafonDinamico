@extends('layouts.backendPublic')

@section('content')
<div class="container my-4">

    <!-- Título -->
    <div class="text-center mb-4">
        <h2 class="fw-bold">Listado de Funcionarios Municipales</h2>
        <p class="text-muted">Consulta por cargo, grado o funcionario específico</p>
    </div>

    <!-- Buscador -->
    <div class="card shadow-sm p-3 mb-3">
        <label for="buscador-funcionarios" class="form-label fw-semibold">🔎 Buscar Funcionarios</label>
        <input type="text" id="buscador-funcionarios" class="form-control" placeholder="Ejemplo: Juan Pérez o 12345678-9">
    </div>

    <!-- Botones -->
    <div class="d-flex justify-content-end mb-3">
        <button id="expandirTodoBtn" class="btn btn-success me-2">Expandir todo</button>
        <button id="colapsarTodoBtn" class="btn btn-danger">Colapsar todo</button>
    </div>

    <!-- Acordeones -->
    <div class="accordion" id="accordionCargos">
        @foreach($nombresCargos as $nombreCargo)
        <div class="grupo-cargo mb-4">
            <h4 class="text-center text-primary my-3 border-bottom pb-2">
                {{ $nombreCargo->nombre_cargo }}
                <small class="text-muted">(Total: {{ $nombreCargo->cargos_escalafon->count() }})</small>
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
                        ['antiguedad_mismo_municipio', 'asc'],
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
                            ({{ $funcionarios->count() }} Funcionarios | Total Cargos: {{ $totalCargosPorGrado }})
                        </button>
                    </h2>
                    <div id="{{ $accordionId }}" class="accordion-collapse collapse"
                        aria-labelledby="heading-{{ $accordionId }}">
                        <div class="accordion-body">

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Nombre</th>
                                            <th class="text-center">RUT</th>
                                            <th class="text-center">Grado</th>
                                            <th class="text-center">Calif.</th>
                                            <th class="text-center">Lista</th>
                                            <th class="text-center">Antig. Cargo</th>
                                            <th class="text-center">Antig. Grado</th>
                                            <th class="text-center">Antig. Mismo Municipio</th>
                                            <th class="text-center">Detalle</th>
                                            <th class="text-center">Antig. Estado</th>
                                            <th>Educación Formal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $indexfunc = 0; @endphp
                                        @foreach($funcionarios as $funcionario)
                                            @php
                                                $profesion = App\Models\Profesion::find($funcionario->educacion_formal);
                                            @endphp
                                            <tr>
                                                <td class="text-center">{{ ++$indexfunc }}</td>
                                                <td>{{ $funcionario->apellido_paterno }} {{ $funcionario->apellido_materno }} {{ $funcionario->nombre }}</td>
                                                <td class="text-center">{{ $funcionario->rut }}</td>
                                                <td class="text-center">{{ $grado }}</td>
                                                <td class="text-center">{{ $funcionario->calificacion ?? '-' }}</td>
                                                <td class="text-center">{{ $funcionario->lista ?? '-' }}</td>
                                                <td class="text-center">{{ $funcionario->antiguedad_cargo ?? '-' }}</td>
                                                <td class="text-center">{{ $funcionario->antiguedad_grado ?? '-' }}</td>
                                                <td class="text-center">{{ $funcionario->antiguedad_mismo_municipio ?? '-' }}</td>
                                                <td class="text-center">{{ $funcionario->antiguedad_mismo_municipio_detalle ?? '-' }}</td>
                                                <td class="text-center">{{ $funcionario->antiguedad_administracion_estado ?? '-' }}</td>
                                                <td>{{ $profesion->profesion ?? '-' }}</td>
                                            </tr>
                                        @endforeach

                                        {{-- Vacantes --}}
                                        @for ($v = $indexfunc + 1; $v <= $totalCargosPorGrado; $v++)
                                            <tr class="table-warning">
                                                <td class="text-center">{{ $v }}</td>
                                                <td colspan="11">VACANTE</td>
                                            </tr>
                                        @endfor
                                    </tbody>
                                </table>
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

@push('scripts')
<script>
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
