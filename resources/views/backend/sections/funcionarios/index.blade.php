@extends('layouts.backend')

@section('content')
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <div>
                    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Funcionarios</h1>
                </div>
                <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Mantenedores</li>
                        <li class="breadcrumb-item active" aria-current="page">Funcionarios</li>
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
                    data-bs-target="#modal-block-fromleft">Ingresar Funcionario</button>
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

@include('backend.sections.funcionarios.modal')


@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    <script type="module">
        document.addEventListener('DOMContentLoaded', () => {
            const table = window.LaravelDataTables["funcionarios-table"];

            document.querySelectorAll('.filtro').forEach(boton => {
                boton.addEventListener('click', () => {
                    const columna = boton.dataset.columna.toLowerCase();
                    const valor = boton.dataset.valor;

                    const headers = table.columns().header().toArray();
                    const index = headers.findIndex(th =>
                        th.textContent.trim().toLowerCase().includes(columna)
                    );

                    if (index !== -1) {
                        table.column(index).search(valor).draw();
                    }
                });
            });
        });
    </script>
@endpush
