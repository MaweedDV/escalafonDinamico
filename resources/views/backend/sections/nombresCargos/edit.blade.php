@extends('layouts.backend')

@section('content')
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <div>
                    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Actualizar Nombre de Cargo</h1>
                </div>
                <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Mantenedores</li>
                        <li class="breadcrumb-item">Nombres Cargos</li>
                        <li class="breadcrumb-item active" aria-current="page">Actualizar Nombre de Cargo</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="row items-push">
            <div class="block block-rounded">
            <br>{{-- espacio de separacion para el boton crear usuario y la parte superior del block --}}
            {{-- <div class="col-md-12">
                <button type="button" class="btn btn-primary push mb-md-0" data-bs-toggle="modal"
                    data-bs-target="#modal-block-fromleft">Nuevo Nombre Cargo</button>
            </div>{{-- espacio de separacion entre el boton crear usuario y los botones de exportacion del datatable --}}
            {{-- <br> --}}
            <div class="col-md-12">
                <form method="POST" action="{{ route('nombresCargos.update', $nombreCargo->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="block-content">
                        <div class="row mb-4">
                            <div class="col-12" style="text-align: center;">
                                <h3>Modificación de registro</h3>
                            </div>
                            <div class="col-4">
                            </div>
                            <div class="col-4">
                                <input type="text" class="form-control form-control" id="nombreCargo" name="nombreCargo"
                                    placeholder="Ingrese Nombre de Cargo" required value="{{ $nombreCargo->nombre_cargo }}">
                                @error('nombreCargo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-4">
                            </div>
                             <div class="col-12" style="text-align: center; margin-top: 15px;">
                                <a type="button" class="btn btn-sm btn-alt-secondary" href="{{route('nombresCargos.index')}}">Volver</a>
                                <button type="submit" class="btn btn-sm btn-primary">Actualizar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
@endsection

