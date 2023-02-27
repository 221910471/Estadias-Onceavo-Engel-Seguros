<!-- Modal del eliminación de datos del poliza -->
<div>
        <!-- Button trigger modal -->
        <button type="button" class="crudButtonTable" data-bs-toggle="modal" data-bs-target="#deletePoliza{{ $poliza->id }}">
            Eliminar
        </button>

        <!-- Modal -->
        <div class="modal fade" id="deletePoliza{{ $poliza->id }}" tabindex="-1" aria-labelledby="deletePolizaLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-7" id="deletePolizaLabel">Eliminar</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <!-- Formulario para conformar eliminación poliza -->
                        <h6>¿Desea guardar como inactivo la poliza {{ $poliza->clave }}?</h6>
                        <div class="modal-footer">
                            <button type="button" class="crudButtonFormCancel" data-bs-dismiss="modal">Cancelar</button>
                            <a href="{{ route('deletePoliza',['id'=> $poliza->id]) }}"><button class="crudButtonFormAccept">Confirmar</button></a>
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