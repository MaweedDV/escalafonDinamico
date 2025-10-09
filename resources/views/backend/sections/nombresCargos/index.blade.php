@extends('layouts.backend')

@section('content')
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <div>
                    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Nombres Escalafón</h1>
                </div>
                <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Mantenedores</li>
                        <li class="breadcrumb-item active" aria-current="page">Nombres Escalafón</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="row items-push">
            <div class="block block-rounded">
            <br>{{-- espacio de separacion para el boton crear usuario y la parte superior del block --}}
            <div class="col-md-12">
                <button type="button" class="btn btn-primary push mb-md-0" data-bs-toggle="modal"
                    data-bs-target="#modal-block-fromleft">Nuevo Nombre Cargo</button>
            </div>{{-- espacio de separacion entre el boton crear usuario y los botones de exportacion del datatable --}}
            <br>
            <div class="col-md-12">
                {{ $dataTable->table() }}
            </div>
            </div>
        </div>
    </div>
@endsection

@include('backend.sections.nombresCargos.modal')

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

        $(document).on("click", ".btn-alt-danger", function(e) {
            e.preventDefault();
            let $button = $(this);

            Swal.fire({
                title: "¿Estás seguro?",
                text: "Una vez eliminado, no podrás recuperar este registro!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#6f9c40",
                cancelButtonColor: "#e04f1a",
                confirmButtonText: "Sí, eliminarlo",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    $button.closest("form").submit();
                }
            });
        });

@endpush
