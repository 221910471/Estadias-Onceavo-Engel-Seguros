<!-- Modal de restauración de datos del código -->
<div>
        <!-- Button trigger modal -->
        <button type="button" class="crudButtonTable" data-bs-toggle="modal" data-bs-target="#activarCodigo{{ $codigo->id }}">
            Restaurar
        </button>

        <!-- Modal -->
        <div class="modal fade" id="activarCodigo{{ $codigo->id }}" tabindex="-1" aria-labelledby="activarCodigoLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-7" id="activarCodigoLabel">Restaurar</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <!-- Formulario para confirmar restauración de venta -->
                        <h6>¿Desea restaurar el registro del código: {{ $codigo->codigo }}?</h6>
                        <div class="modal-footer">
                            <button type="button" class="crudButtonFormCancel" data-bs-dismiss="modal">Cancelar</button>
                            <a href="{{ route('activarCodigo',['id'=> $codigo->id]) }}"><button class="crudButtonFormAccept">Confirmar</button></a>
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