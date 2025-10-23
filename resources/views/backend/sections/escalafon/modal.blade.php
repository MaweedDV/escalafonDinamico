<div class="modal fade" id="modal-block-fromleft" tabindex="-1" role="dialog" aria-labelledby="modal-block-fromleft"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">CONFIRMACION.</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <form method="POST" action="{{ route('escalafon.generar') }}">
                    @csrf
                    <div class="block-content">
                        <div class="row mb-4">
                            <div class="col-12" style="text-align: center;">
                                <h4>¿Está seguro de confirmar Escalafón?</h4>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-12" style="text-align: center;">
                                <h5>Si esta seguro seleccione año de vigencia escalafón a confirmar</h5>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-12" style="text-align: center;">
                                <label>Año de vigencia escalafón:</label></br>
                                <select class="form-select" name="ano_escalafon" style="width: 40%; text-align: center; margin-left: auto; margin-right: auto" id="example-select">
                                    <option selected="">Seleccione una opción</option>
                                    @php
                                        $cont = 0;
                                    @endphp
                                @for ($i = 0; $i < 5; $i++)
                                    <option value="{{$ano_anterior + $i}}">{{$ano_anterior + $i}}</option>
                                @endfor
                                </select>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-12" style="text-align: center; color: red;">
                                <h5>Recuerde que una vez confirmado el escalafón no podrá ser modificado.</h5>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-12" style="text-align: center">
                                <button type="submit" class="btn btn-lg btn-success" data-bs-dismiss="modal">Guardar</button>
                                <button type="button" class="btn btn-lg btn-danger" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
