<!-- Modal de activación y restauración de pagos -->
<div>
        <!-- Button trigger modal -->
        <button type="button" class="crudButtonTable" data-bs-toggle="modal" data-bs-target="#activatePago{{ $pago->id }}">
            Restaurar
        </button>

        <!-- Modal -->
        <div class="modal fade" id="activatePago{{ $pago->id }}" tabindex="-1" aria-labelledby="activatePagoLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-7" id="activatePagoLabel">Restaurar</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <!-- Formulario para confirmar restauración de pago -->
                        <h6>¿Desea restaurar el pago {{ $pago->clave }}?</h6>
                        <div class="modal-footer">
                            <button type="button" class="crudButtonFormCancel" data-bs-dismiss="modal">Cancelar</button>
                            <a href="{{ route('activatePago',['id'=> $pago->id]) }}"><button class="crudButtonFormAccept">Confirmar</button></a>
                        </div>
                    <br>
                    @if(Session::has('mensaje'))
                        <div class="alert alert-danger">{{Session::get('mensaje')}}</div>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>