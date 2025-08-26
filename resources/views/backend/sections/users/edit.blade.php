@extends('layouts.backend')

@section('content')
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <div>
                    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Actualizar datos de Usuarios</h1>
                </div>
                <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Mantenedores</li>
                        <li class="breadcrumb-item active" aria-current="page">Actualizar datos de Usuarios</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="row items-push">
            <div class="block block-rounded">
                <form method="POST" action="{{ route('users.update', $user->id) }}">
                    @method('PUT')
                    @csrf
                    <div class="block-content">
                        <div class="row mb-4">
                            <div class="col-6">
                                <label class="form-label" for="example-ltf-email2">Rut</label>
                                <input type="text" class="form-control form-control" id="rut" name="rut"
                                    value="{{ old('email', $user->rut) }}" placeholder="Ingrese su Rut">
                                @error('rut')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label class="form-label" for="example-ltf-email2">Nombre/s</label>
                                <input type="text" class="form-control form-control" id="nombre" name="nombre"
                                    value="{{ old('email', $user->nombre) }}" placeholder="Ingrese su nombre">
                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label class="form-label" for="example-ltf-email2">Apellido Paterno</label>
                                <input type="text" class="form-control form-control" id="apellidoPaterno" name="apellidoPaterno"
                                    value="{{ old('email', $user->apellido_paterno) }}" placeholder="Ingrese su Apellido Paterno">
                                @error('apellidoPaterno')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label class="form-label" for="example-ltf-email2">Apellido Materno</label>
                                <input type="text" class="form-control form-control" id="apellidoMaterno" name="apellidoMaterno"
                                    value="{{ old('email', $user->apellido_materno) }}" placeholder="Ingrese su Apellido Materno">
                                @error('apellidoMaterno')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="example-ltf-email2">Correo electronico</label>
                                <input type="email" class="form-control form-control" id="email" name="email"
                                    value="{{ old('email', $user->email) }}" placeholder="Ingrese su correo electronico">
                            </div>
                            <div class="col-6">
                                <label class="form-label" for="example-select-floating">Rol</label>
                                <select class="form-select" id="example-select-floating" name="role"
                                    aria-label="Floating label select example">
                                    <option selected="" disabled>Seleccione un rol</option>
                                    <option {{ old('role', $user->role) == 'admin' ? 'selected' : ''}} value="admin">Administrador</option>
                                    <option {{ old('role', $user->role) == 'usuario' ? 'selected' : ''}} value="usuario">Usuario Normal</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="form-label" for="example-select-floating">Calidad Juridica</label>
                                <select class="form-select" id="example-select-floating" name="calidadJuridica"
                                    aria-label="Floating label select example">
                                    <option selected="" disabled>Seleccione una calidad</option>
                                    @foreach ($calidadJuridica as $calidadJuridica)
                                    <option {{ old('calidadJuridica', $user->Id_calidad) == $calidadJuridica->id ? 'selected' : ''}} value="{{ $calidadJuridica->id }}"> {{ $calidadJuridica->nombre_calidad }}</option>
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
                            <input class="form-check-input" type="checkbox" value="{{$user->estado}}"
                            id="example-switch-default1" name="activo" {{$check}}/>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-end bg-body">
                        <button type="button" class="btn btn-sm btn-alt-secondary"
                            data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection



