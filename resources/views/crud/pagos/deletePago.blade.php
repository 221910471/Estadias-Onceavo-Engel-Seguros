<!-- Modal del eliminación de pago-->
<div>
        <!-- Button trigger modal -->
        <button type="button" class="crudButtonTable" data-bs-toggle="modal" data-bs-target="#deletePago{{ $pago->id }}">
            Eliminar
        </button>

        <!-- Modal -->
        <div class="modal fade" id="deletePago{{ $pago->id }}" tabindex="-1" aria-labelledby="deletePagoLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-7" id="deletePagoLabel">Eliminar</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <!-- Formulario para conformar eliminación de pago -->
                        <h6>¿Desea  eliminar el pago con clave: "{{ $pago->clave }}"?</h6>
                        <div class="modal-footer">
                            <button type="button" class="crudButtonFormCancel" data-bs-dismiss="modal">Cancelar</button>
                            <a href="{{ route('deletePago',['id'=> $pago->id]) }}"><button class="crudButtonFormAccept">Confirmar</button></a>
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