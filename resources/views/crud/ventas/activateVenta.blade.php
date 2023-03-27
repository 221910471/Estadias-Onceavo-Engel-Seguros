<!-- Modal de restauración de datos de ventas -->
<div>
        <!-- Button trigger modal -->
        <button type="button" class="crudButtonTable" data-bs-toggle="modal" data-bs-target="#activateVenta{{ $venta->id }}">
            Restaurar
        </button>

        <!-- Modal -->
        <div class="modal fade" id="activateVenta{{ $venta->id }}" tabindex="-1" aria-labelledby="activateVentaLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-7" id="activateVentaLabel">Restaurar</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <!-- Formulario para confirmar restauración de venta -->
                        <h6>¿Desea restaurar el registro con clave: {{ $venta->clave }}?</h6>
                        <div class="modal-footer">
                            <button type="button" class="crudButtonFormCancel" data-bs-dismiss="modal">Cancelar</button>
                            <a href="{{ route('activateVenta',['id'=> $venta->id]) }}"><button class="crudButtonFormAccept">Confirmar</button></a>
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