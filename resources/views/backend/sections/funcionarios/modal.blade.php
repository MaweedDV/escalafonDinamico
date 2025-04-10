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
                <form method="POST" action="{{ route('users.store') }}">
                    @csrf
                    <div class="block-content">
                        <div class="row mb-4">
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
                            <div class="col-12">
                                <label class="form-label" for="example-ltf-email2">Correo electronico</label>
                                <input type="email" class="form-control form-control" id="email" name="email"
                                    placeholder="Ingrese su correo electronico">
                            </div>
                            <div class="col-6">
                                <label class="form-label" for="example-select-floating">Rol</label>
                                <select class="form-select" id="example-select-floating" name="role"
                                    aria-label="Floating label select example">
                                    <option selected="" disabled>Seleccione un rol</option>
                                    <option value="admin">Administrador</option>
                                    <option value="usuario">Usuario Normal</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="form-label" for="example-select-floating">Calidad Juridica</label>
                                <select class="form-select" id="example-select-floating" name="calidadJuridica"
                                    aria-label="Floating label select example">
                                    <option selected="" disabled>Seleccione una calidad</option>
                                    @foreach ($calidadJuridica as $calidadJuridica)
                                    <option {{ old('rut') == $calidadJuridica->id ? 'selected' : '' }} value="{{ $calidadJuridica->id }}"> {{ $calidadJuridica->nombre_calidad }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="form-label" for="example-ltf-email2">Contraseña</label>
                                <input type="password" class="form-control form-control" id="example-ltf-email2"
                                    name="password" placeholder="Ingrese su contraseña">
                            </div>
                            <div class="col-6">
                                <label class="form-label" for="example-ltf-email2">Confirmar contraseña</label>
                                <input type="password" class="form-control form-control" id="signup-password-confirm"
                                    name="password_confirmation" placeholder="Confirme su contraseña" />
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="form-label" for="example-ltf-email2">Activo</label>
                            <input class="form-check-input" type="checkbox" value="1"
                            id="example-switch-default1" name="activo" checked=""/>
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
