@extends('layouts.backend')

@section('content')
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <div>
                    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Calificaciones</h1>
                </div>
                <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Administrador</li>
                        <li class="breadcrumb-item active" aria-current="page">Calificaciones</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="row items-push">
            <div class="block block-rounded">
            <br>{{-- espacio de separacion para el boton crear usuario y la parte superior del block --}}

            <br>
                <div class="col-md-8" style="margin-left: auto; margin-right:auto">
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- LINEA PARA INVOCAR ALERTA --}}
@include('backend.sections.calificaciones.alerta')

@push('scripts')
    {{

    $dataTable->scripts()
    }}

   <script>
        $(document).on('click', '.edit-btn', function () {
            const group = $(this).closest('.calificacion-group');
            const input = group.find('.editable-input');

            input.prop('disabled', false).focus();
            group.find('.edit-btn').addClass('d-none');
            group.find('.save-btn').removeClass('d-none');
        });

        $(document).on('click', '.save-btn', function () {
            const group = $(this).closest('.calificacion-group');
            guardarCalificacion(group, false);
        });
    </script>

    <script>
        $(document).on('keydown', '.editable-input', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();

                const input = $(this);
                const group = input.closest('.calificacion-group');

                guardarCalificacion(group, true);
            }
        });

        function guardarCalificacion(group, irSiguiente = false) {
            const input = group.find('.editable-input');

            $.ajax({
                url: '/admin/calificaciones/update',
                method: 'POST',
                data: {
                    id: group.data('id'),
                    column: input.data('column'),
                    value: input.val()
                },
                success: function () {
                    // Bloquear actual
                    input.prop('disabled', true);
                    group.find('.save-btn').addClass('d-none');
                    group.find('.edit-btn').removeClass('d-none');

                    if (irSiguiente) {
                        irAlSiguienteInput(group);
                    }
                },
                error: function () {
                    alert('Error al guardar');
                    input.prop('disabled', false);
                }
            });
        }

        function irAlSiguienteInput(group) {
            const allGroups = $('.calificacion-group:visible');
            const index = allGroups.index(group);

            if (index !== -1 && index + 1 < allGroups.length) {
                const siguiente = allGroups.eq(index + 1);
                const inputSiguiente = siguiente.find('.editable-input');

                inputSiguiente.prop('disabled', false).focus();
                siguiente.find('.save-btn').removeClass('d-none');
                siguiente.find('.edit-btn').addClass('d-none');
            }
        }
</script>


@endpush
