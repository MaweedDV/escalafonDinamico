@extends('layouts.backend')

@section('content')
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <div>
                    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Profesiones</h1>
                </div>
                <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Mantenedores</li>
                        <li class="breadcrumb-item active" aria-current="page">Profesiones</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="row items-push">
            <div class="block block-rounded">
            <br>{{-- espacio de separacion para el boton crear usuario y la parte superior del block --}}
            <div class="col-md-6">
                <button type="button" class="btn btn-primary push mb-md-0" data-bs-toggle="modal"
                    data-bs-target="#modal-block-fromleft">Ingresar Profesión</button>
            </div>{{-- espacio de separacion entre el boton crear usuario y los botones de exportacion del datatable --}}
            <br>
            {{-- <div class="mb-3 d-flex gap-2 flex-wrap">
                <strong>Filtrar por Estado:</strong>
                <button class="btn btn-sm btn-outline-primary filtro" data-columna="estado" data-valor="">Todos</button>
                @foreach($estado as $item)
                    <button class="btn btn-sm btn-outline-primary filtro" data-columna="estado" data-valor="{{ $item->estado }}">
                        {{ ucfirst($item->estado) }}
                    </button>
                @endforeach
            </div> --}}

            <div class="col-md-12">
                      {{ $dataTable->table() }}
            </div>
            </div>
        </div>
    </div>
@endsection

@include('backend.sections.profesiones.modal')

@push('scripts')
    {!! $dataTable->scripts() !!}

   <script>
        document.addEventListener("click", function (e) {
            const btn = e.target.closest(".btn-alt-danger");

            if (btn) {
                e.preventDefault();

                const form = btn.closest("form");

                Swal.fire({
                    title: "¿Estás seguro?",
                    text: "Una vez eliminado no podrás recuperarlo",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sí, eliminar",
                    cancelButtonText: "Cancelar"
                }).then((result) => {

                    console.log("Resultado SweetAlert:", result);  // 👈 DEPURACIÓN DIRECTA

                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            }
        });
    </script>

@endpush


