@extends('layouts.backend')

@section('content')
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <div>
                    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Actualizar Profesion</h1>
                </div>
                <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Mantenedores</li>
                        <li class="breadcrumb-item active" aria-current="page">Actualizar Profesion</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="row items-push">
            <div class="block block-rounded">
            <br>{{-- espacio de separacion para el boton crear usuario y la parte superior del block --}}
            {{-- @php
                $cargoAsignado = App\Models\CargosEscalafon::find($funcionario->id_Cargo);
            @endphp --}}
            {{-- <br> --}}
            <div class="col-md-8">
                <form method="POST" action="{{ route('profesiones.update', $profesion->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="block-content">
                        <div class="row mb-4">
                            <div class="col-12" style="text-align: center;">
                                <h4>Ingrese Nombre de Profesión</h4>
                            </div>
                            <div class="col-12">
                                <input type="text" class="form-control form-control" id="profesion" name="profesion"
                                    placeholder="Ingrese profesion" required value="{{ $profesion->profesion }}">
                                @error('profesion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-end">
                        <a type="button" class="btn btn-sm btn-alt-secondary"
                            href="{{route('profesiones.index')}}">Volver</a>
                        <button type="submit" class="btn btn-sm btn-primary">Actualizar</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
@endsection

