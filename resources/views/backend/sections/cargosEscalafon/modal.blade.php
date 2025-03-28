<div class="modal fade" id="modal-block-fromleft" tabindex="-1" role="dialog" aria-labelledby="modal-block-fromleft"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title text-center">Nuevo Nombre De Cargo</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <form method="POST" action="{{ route('cargosEscalafon.store') }}">
                    @csrf
                    <div class="block-content">
                        <div class="row mb-4">
                            <div class="col-6">
                                <label class="form-label" for="example-select-floating">Nombre Cargo</label>
                                <select class="form-select" id="example-select-floating" name="nombreCargo"
                                    aria-label="Floating label select example">
                                    <option selected="" disabled>Seleccione un nombre</option>
                                    @foreach ($nombresCargos as $nombresCargos)
                                    <option {{ old('nombreCargo') == $nombresCargos->id ? 'selected' : '' }} value="{{ $nombresCargos->id }}"> {{ $nombresCargos->nombre_cargo }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="form-label" for="example-select-floating">Grado</label>
                                <select class="form-select" id="example-select-floating" name="grado"
                                    aria-label="Floating label select example">
                                    <option selected="" disabled>Seleccione un grado</option>
                                    @foreach ($grados as $grados)
                                    <option {{ old('gado') == $grados ? 'selected' : '' }} value="{{ $grados }}"> {{ $grados }}</option>
                                    @endforeach
                                </select>
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
