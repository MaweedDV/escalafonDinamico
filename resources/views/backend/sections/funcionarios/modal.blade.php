<div class="modal fade" id="modal-block-fromleft" tabindex="-1" role="dialog" aria-labelledby="modal-block-fromleft"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title text-center">Nuevo Funcionario</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <form method="POST" action="{{ route('funcionarios.store') }}">
                    @csrf
                    <div class="block-content">
                        <div class="row mb-4">
                            <div class="col-12" style="text-align: center;">
                                <h4>DECRETO</h4>
                            </div>
                            <div class="col-6">
                                <label class="form-label" for="example-ltf-email2">N° Decreto</label>
                                <input type="text" class="form-control form-control" id="decreto" name="decreto"
                                    placeholder="Ingrese decreto">
                                @error('decreto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label class="form-label" for="example-ltf-email2">Fecha decreto</label>
                                <input type="date" class="form-control form-control" id="fechaDecreto" name="fechaDecreto"
                                    placeholder="Ingrese fecha decreto">
                                @error('fechaDecreto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-12" style="text-align: center;">
                                <h4>DATOS PERSONALES</h4>
                            </div>
                            <div class="col-6">
                                <label class="form-label" for="example-ltf-email2">Rut</label>
                                <input type="text" class="form-control form-control" id="rut" name="rut"
                                    placeholder="Ingrese su Rut">
                                @error('rut')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label class="form-label" for="example-ltf-email2">Nombre/s</label>
                                <input type="text" class="form-control form-control" id="nombre" name="nombre"
                                    placeholder="Ingrese su nombre">
                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label class="form-label" for="example-ltf-email2">Apellido Paterno</label>
                                <input type="text" class="form-control form-control" id="apellidoPaterno" name="apellidoPaterno"
                                    placeholder="Ingrese su Apellido Paterno">
                                @error('apellidoPaterno')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label class="form-label" for="example-ltf-email2">Apellido Materno</label>
                                <input type="text" class="form-control form-control" id="apellidoMaterno" name="apellidoMaterno"
                                    placeholder="Ingrese su Apellido Materno">
                                @error('apellidoMaterno')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            {{-- ID CARGOS --}}
                            <div class="col-6">
                                <label class="form-label" for="example-select-floating">Cargo Escalafón</label>
                                <select class="form-select" id="example-select-floating" name="cargoEscalafon"
                                    aria-label="Floating label select example">
                                    <option selected="" disabled>Seleccione un cargo</option>
                                    @foreach ($cargosEscalafon as $cargosEscalafon)
                                    <option {{ old('cargoEscalafon') == $cargosEscalafon->id ? 'selected' : '' }} value="{{ $cargosEscalafon->id }}"> {{ $cargosEscalafon->nombreCargo." ".$cargosEscalafon->grado."°" }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- ANTIGUEDAD EN EL CARGO EN FORMATO DE FECHA INICIAL DE INGRESO AL Cargo --}}
                            <div class="col-6">
                                <label class="form-label" for="example-ltf-email2">Antigüedad en el Cargo</label>
                                <input type="date" class="form-control form-control" id="ant_cargo" name="ant_cargo"
                                    placeholder="Ingrese Fecha de antiguedad">
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
                                    placeholder="Ingrese Fecha de antiguedad">
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
                                    placeholder="Ingrese Fecha de antiguedad">
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
                                    placeholder="Ingrese Total de Días">
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
                                    placeholder="Ingrese Total de Días">
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
                                    @foreach ($educacionFormal as $educacionFormal)
                                    <option {{ old('educacionFormal') == $educacionFormal->profesion ? 'selected' : '' }} value="{{ $educacionFormal->profesion }}"> {{ $educacionFormal->profesion}}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- Estado --}}
                            <div class="col-6">
                                <label class="form-label" for="example-select-floating">Estado</label>
                                <select class="form-select" id="example-select-floating" name="Estado"
                                    aria-label="Floating label select example">
                                    <option selected="" disabled>Seleccione un Estado</option>
                                    <option value="vigente">Vigente</option>
                                    <option value="retirado">Retirado</option>
                                    <option value="fallecido">Fallecido</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="block-content block-content-full text-end bg-body">
                        <button type="button" class="btn btn-sm btn-alt-secondary"
                            data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
