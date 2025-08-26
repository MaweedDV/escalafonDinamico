@extends('layouts.backend')

@section('content')
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <div>
                    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Actualizar Funcionario</h1>
                </div>
                <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Mantenedores</li>
                        <li class="breadcrumb-item active" aria-current="page">Actualizar Funcionario</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="row items-push">
            <div class="block block-rounded">
            <br>{{-- espacio de separacion para el boton crear usuario y la parte superior del block --}}
            @php
                $cargoAsignado = App\Models\CargosEscalafon::find($funcionario->id_Cargo);
            @endphp
            <br>
            <div class="col-md-12">
                <form method="POST" action="{{ route('funcionarios.update', $funcionario->id) }}">
                    @method('PUT')
                    @csrf
                    <div class="block-content">
                        <div class="row mb-4">
                            <div class="col-12" style="text-align: center;">
                                <h4>DECRETO</h4>
                            </div>
                            <div class="col-4">
                                <h4>N° Decreto</h4>
                                <h4>{{$funcionario->decreto}}</h4>
                                {{-- <label class="form-label" for="example-ltf-email2">N° Decreto</label>
                                <label class="form-label" for="example-ltf-email2">{{$funcionario->decreto}}</label> --}}
                                {{-- <input type="text" class="form-control form-control" id="decreto" name="decreto"
                                    placeholder="Ingrese decreto" value="{{ old('decreto', $funcionario->decreto) }}">
                                @error('decreto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror --}}
                            </div>
                            <div class="col-4">
                                <h4>Fecha decreto</h4>
                                <h4>{{$funcionario->fecha_decreto}}</h4>
                                {{-- <label class="form-label" for="example-ltf-email2">Fecha decreto</label>
                                <label class="form-label" for="example-ltf-email2">{{$funcionario->fecha_decreto}}</label> --}}
                                {{-- <input type="date" class="form-control form-control" id="fechaDecreto" name="fechaDecreto"
                                    placeholder="Ingrese fecha decreto" value="{{ old('fechaDecreto', $funcionario->fecha_decreto) }}">
                                @error('fechaDecreto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror --}}
                            </div>
                             {{-- ID CARGOS --}}
                            <div class="col-4">
                                <h4>Cargo Escalafón</h4>
                                <h4>{{$nombresCargos->nombre_cargo." ".$cargos->grado."°"}}</h4>
                                {{-- <label class="form-label" for="example-ltf-email2">Cargo Escalafón</label>
                                <label class="form-label" for="example-ltf-email2">{{$nombresCargos->nombre_cargo." ".$cargos->grado."°"}}</label> --}}
                                {{-- <input type="text" class="form-control form-control" id="cargoEscalafon" name="cargoEscalafon"
                                    placeholder="cargo" readonly="true" value="{{ old('cargoEscalafon', $nombresCargos->nombre_cargo." ".$cargos->grado."°") }}">
                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror --}}
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-12" style="text-align: center;">
                                <h4>DATOS PERSONALES</h4>
                            </div>
                            <div class="col-6">
                                <label class="form-label" for="example-ltf-email2">Rut</label>
                                <input type="text" class="form-control form-control" id="rut" name="rut"
                                    placeholder="Ingrese su Rut" value="{{ old('rut', $funcionario->rut) }}">
                                @error('rut')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label class="form-label" for="example-ltf-email2">Nombre/s</label>
                                <input type="text" class="form-control form-control" id="nombre" name="nombre"
                                    placeholder="Ingrese su nombre" value="{{ old('nombre', $funcionario->nombre) }}">
                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label class="form-label" for="example-ltf-email2">Apellido Paterno</label>
                                <input type="text" class="form-control form-control" id="apellidoPaterno" name="apellidoPaterno"
                                    placeholder="Ingrese su Apellido Paterno" value="{{ old('apellidoPaterno', $funcionario->apellido_paterno) }}">
                                @error('apellidoPaterno')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label class="form-label" for="example-ltf-email2">Apellido Materno</label>
                                <input type="text" class="form-control form-control" id="apellidoMaterno" name="apellidoMaterno"
                                    placeholder="Ingrese su Apellido Materno" value="{{ old('apellidoMaterno', $funcionario->apellido_materno) }}">
                                @error('apellidoMaterno')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            {{-- ANTIGUEDAD EN EL CARGO EN FORMATO DE FECHA INICIAL DE INGRESO AL Cargo --}}
                            <div class="col-6">
                                <label class="form-label" for="example-ltf-email2">Antigüedad en el Cargo</label>
                                <input type="date" class="form-control form-control" id="ant_cargo" name="ant_cargo"
                                    placeholder="Ingrese Fecha de antiguedad" value="{{ old('ant_cargo', $funcionario->antiguedad_cargo) }}">
                                @error('ant_cargo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            {{-- ANTIGUEDAD EN EL GRADO EN FORMATO DE FECHA INICIAL DE INGRESO AL GRADO --}}
                            <div class="col-6">
                                <label class="form-label" for="example-ltf-email2">Antigüedad en el Grado</label>
                                <input type="date" class="form-control form-control" id="ant_grado" name="ant_grado"
                                    placeholder="Ingrese Fecha de antiguedad" value="{{ old('ant_grado', $funcionario->antiguedad_grado) }}">
                                @error('ant_grado')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                             {{-- ANTIGUEDAD EN EL MISMO MUN EN FORMATO DE FECHA INICIAL DE INGRESO AL MISMO MUN --}}
                             <div class="col-6">
                                <label class="form-label" for="example-ltf-email2">Antigüedad Mismo Municipio</label>
                                <input type="date" class="form-control form-control" id="ant_mism_mun" name="ant_mism_mun"
                                    placeholder="Ingrese Fecha de antiguedad" value="{{ old('ant_mism_mun', $funcionario->antiguedad_mismo_municipio) }}">
                                @error('ant_mism_mun')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-12" style="text-align: center;">
                                <h4>DETALLE</h4>
                            </div>
                            {{-- ANTIGUEDAD EN EL MISMO MUN DETALLE EN FORMATO DE FECHA INICIAL DE INGRESO AL MISMO MUN DETALLE --}}
                            <div class="col-6">
                                <label class="form-label" for="example-ltf-email2">Antigüedad Mismo Municipio Detalle</label>
                                <input type="text" class="form-control form-control" id="ant_mism_mun_detalle" name="ant_mism_mun_detalle"
                                    placeholder="Ingrese Total de Días" value="{{ old('ant_mism_mun_detalle', $funcionario->antiguedad_mismo_municipio_detalle) }}">
                                @error('ant_mism_mun_detalle')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            {{-- ANTIGUEDAD EN EL MISMO MUN EN FORMATO DE FECHA INICIAL DE INGRESO AL MISMO MUN --}}
                            <div class="col-6">
                                <label class="form-label" for="example-ltf-email2">Antigüedad Total Administracion del Estado</label>
                                <input type="text" class="form-control form-control" id="ant_administracion_estado" name="ant_administracion_estado"
                                    placeholder="Ingrese Total de Días" value="{{ old('ant_administracion_estado', $funcionario->antiguedad_administracion_estado) }}">
                                @error('ant_administracion_estado')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                             {{-- Educación formal --}}
                             <div class="col-6">
                                <label class="form-label" for="example-select-floating">Educacion Formal</label>
                                <select class="form-select" id="example-select-floating" name="educacionFormal"
                                    aria-label="Floating label select example">
                                    <option selected="" disabled>Seleccione una profesion</option>
                                    @foreach ($educacionFormal as $educacion)
                                        <option {{ old('educacionFormal', $funcionario->educacion_formal) == $educacion->id ? 'selected' : '' }} value="{{ $educacion->id }}"> {{ $educacion->profesion}}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- Estado --}}
                            <div class="col-6">
                                <label class="form-label" for="example-select-floating">Estado</label>
                                <select class="form-select" id="example-select-floating" name="Estado"
                                    aria-label="Floating label select example">
                                    <option selected="" disabled>Seleccione un Estado</option>
                                    <option {{ old('Estado', $funcionario->estado) == 'vigente' ? 'selected' : ''}} value="vigente">Vigente</option>
                                    <option {{ old('Estado', $funcionario->estado) == 'retirado' ? 'selected' : ''}} value="retirado">Retirado</option>
                                    <option {{ old('Estado', $funcionario->estado) == 'fallecido' ? 'selected' : ''}} value="fallecido">Fallecido</option>
                                    <option {{ old('Estado', $funcionario->estado) == 'desactivado' ? 'selected' : ''}} value="desactivado">Desactivado</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="block-content block-content-full text-end bg-body">
                        <a href="{{ route('funcionarios.index')}}" class="btn btn-sm btn-danger" >Cerrar</a>
                        <button type="submit" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Actualizar</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
@endsection

