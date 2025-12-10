<div class="modal fade" id="modal-block-fromleft" tabindex="-1" role="dialog" aria-labelledby="modal-block-fromleft"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title text-center">Nueva Profesion</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <form method="POST" action="{{ route('profesiones.store') }}">
                    @csrf
                    <div class="block-content">
                        <div class="row mb-4">
                            <div class="col-12" style="text-align: center;">
                                <h4>Ingrese Nombre de Profesión</h4>
                            </div>
                            <div class="col-12">
                                <input type="text" class="form-control form-control" id="profesion" name="profesion"
                                    placeholder="Ingrese profesion" required>
                                @error('profesion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-end bg-body">
                        <button type="button" class="btn btn-sm btn-alt-secondary"
                            data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
                    </div>
                </form>
                @if ($errors->any())
                <script>
                    var myModal = new bootstrap.Modal(document.getElementById('modal-block-fromleft'));
                    myModal.show();
                </script>
                @endif
            </div>
        </div>
    </div>
</div>
