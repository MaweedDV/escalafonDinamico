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
                <div class="col-md-12">
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

    $dataTable->scripts(attributes: ['type' => 'module'])
    }}

    <script>
      $(document).ready(function () {
            $('#calificacion-table').on('click', '.save-btn', function () {
                let button = $(this);
                let group = button.closest('.calificacion-group');
                let id = group.data('id');
                let input = group.find('input');
                let column = input.data('column');
                let value = input.val();
                let editBtn = group.find('.edit-btn');
                let originalIcon = button.html();

                console.log(id, column, value)

                $.ajax({
                    url: '{{ route("calificaciones.updateCampo") }}',
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        id: id,
                        column: column,
                        value: value
                    },
                    success: function () {
                        button.html('✔️').removeClass('btn-primary').addClass('btn-success');
                        input.addClass('border-success').prop('disabled', true);
                        editBtn.removeClass('d-none');
                        button.hide();

                        // Mostrar toast
                        const toast = new bootstrap.Toast(document.getElementById('toastGuardado'));
                        toast.show();

                        setTimeout(() => {
                            button.html(originalIcon).removeClass('btn-success').addClass('btn-primary');
                            input.removeClass('border-success');
                        }, 2000);
                    },
                    error: function () {
                        button.html('❌').removeClass('btn-primary').addClass('btn-danger');
                        input.addClass('border-danger');

                        setTimeout(() => {
                            button.html(originalIcon).removeClass('btn-danger').addClass('btn-primary');
                            input.removeClass('border-danger');
                        }, 2000);
                    }
                });
            });

            $('#calificacion-table').on('click', '.edit-btn', function () {
                let button = $(this);
                let group = button.closest('.calificacion-group');
                let input = group.find('input');
                let saveBtn = group.find('.save-btn');

                input.prop('disabled', false);
                saveBtn.show();
                button.addClass('d-none');
                input.focus();
            });
        });
    </script>
@endpush
