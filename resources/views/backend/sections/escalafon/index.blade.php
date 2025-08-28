@extends('layouts.backend')

@section('content')
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <div>
                <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Escalafón</h1>
            </div>
            <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Administración</li>
                    <li class="breadcrumb-item active" aria-current="page">Escalafón</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

    <div class="content">
        <div class="row items-push">
            <div class="block block-rounded">
            <div class="mb-3">
            <label style="margin-top: 20px;" for="buscador-funcionarios" class="form-label">Buscar Funcionarios:</label>
            <input  type="text" id="buscador-funcionarios" class="form-control" placeholder="Buscar por nombre o RUT...">
    </div>
    <div class="mb-3 d-flex justify-content-end">
        <button id="expandirTodoBtn" class="btn btn-sm btn-success" style="display: flex; margin-right: 10px;">Expandir todo</button>
         <button id="colapsarTodoBtn" class="btn btn-sm btn-danger">Colapsar todo</button>
    </div>
    <div class="accordion" id="accordionCargos">
                    @foreach($nombresCargos as $nombreCargo)
                    <div class="grupo-cargo">
                        <h5 class="text-center my-4">
                            {{ $nombreCargo->nombre_cargo }}
                            (Total Cargos: {{ $nombreCargo->cargos_escalafon->count() }})
                        </h5>

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

                        <div class="accordion-item">
                    <h2 class="accordion-header" id="heading-{{ $accordionId }}">
                        <button class="accordion-button" type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#{{ $accordionId }}"
                                aria-expanded="true"
                                aria-controls="{{ $accordionId }}">
                            {{ $nombreCargo->nombre_cargo }} - GRADO {{ $grado }}
                            ({{ $funcionarios->count() }} Funcionarios) - Total Cargos: {{ $totalCargosPorGrado }}
                        </button>
                    </h2>
                    <div id="{{ $accordionId }}"
                        class="accordion-collapse collapse show"
                        aria-labelledby="heading-{{ $accordionId }}">
                        <div class="accordion-body">

                        <table class="table table-bordered table-vcenter">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 50px;">Lugar</th>
                                    <th class="text-center" style="width: 200px">Nombre</th>
                                    <th class="text-center" style="width: 150px">Rut</th>
                                    <th>Grado</th>
                                    <th>Calif.</th>
                                    <th>Lista</th>
                                    <th class="text-center">Antig. Cargo</th>
                                    <th class="text-center">Antig. Grado</th>
                                    <th>Antig. Mismo Municipio</th>
                                    <th>Antig. Mismo Municipio Detalle</th>
                                    <th>Antig. Estado</th>
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
                                        <td>{{ $funcionario->apellido_paterno . ' ' . $funcionario->apellido_materno . ' ' . $funcionario->nombre }}</td>
                                        <td class="text-center">{{ $funcionario->rut }}</td>
                                        <td class="text-center">{{ $grado }}</td>
                                        <td class="text-center">{{ $funcionario->calificacion ?? '-' }}</td>
                                        <td class="text-center">{{ $funcionario->lista ?? '-' }}</td>
                                        <td class="text-center">{{ $funcionario->antiguedad_cargo ?? '-' }}</td>
                                        <td class="text-center">{{ $funcionario->antiguedad_grado ?? '-' }}</td>
                                        <td class="text-center">{{ $funcionario->antiguedad_mismo_municipio ?? '-' }}</td>
                                        <td class="text-center">{{ $funcionario->antiguedad_mismo_municipio_detalle ?? '-' }}</td>
                                        <td class="text-center">{{ $funcionario->antiguedad_administracion_estado ?? '-' }}</td>
                                        <td class="text-center">{{ $profesion->profesion ?? '-' }}</td>
                                    </tr>
                                @endforeach

                                {{-- Vacantes --}}
                                @for ($v = $indexfunc + 1; $v <= $totalCargosPorGrado; $v++)
                                    <tr>
                                        <td class="text-center">{{ $v }}</td>
                                        <td colspan="11">VACANTE</td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @endforeach
</div>

    </div>
</div>




@push('scripts')
<script>
    document.getElementById('buscador-funcionarios').addEventListener('input', function () {
    const valor = this.value.toLowerCase().trim();

    document.querySelectorAll('.grupo-cargo').forEach(grupo => {
        const encabezado = grupo.querySelector('h5');
        const textoEncabezado = encabezado.textContent.toLowerCase();

        // ¿Coincide el texto buscado con el encabezado?
        const coincidenciaEncabezado = textoEncabezado.includes(valor);

        let grupoCoincide = false;

        const acordeones = grupo.querySelectorAll('.accordion-item');

        acordeones.forEach(item => {
            const filas = item.querySelectorAll('tbody tr');
            let coincidencias = 0;

            filas.forEach(fila => {
                const textoFila = fila.textContent.toLowerCase();
                const esVacante = textoFila.includes('vacante');

                // Si el encabezado coincide, mostramos TODO sin filtrar
                if (valor === '' || coincidenciaEncabezado) {
                    fila.style.display = '';
                    coincidencias++;
                } else {
                    // Sino filtramos por filas
                    if (!esVacante && textoFila.includes(valor)) {
                        fila.style.display = '';
                        coincidencias++;
                    } else {
                        fila.style.display = 'none';
                    }
                }
            });

            // Mostrar acordeón si alguna fila coincide o si coincide el encabezado
            if (coincidencias > 0 || coincidenciaEncabezado || valor === '') {
                item.style.display = '';
                grupoCoincide = true;
            } else {
                item.style.display = 'none';
            }

            // Controlar apertura/cierre del acordeón
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

        // Mostrar u ocultar grupo y encabezado
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


@endsection
