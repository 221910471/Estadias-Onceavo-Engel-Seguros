<!-- Modal del eliminación de notificacion-->
<div>
        <!-- Button trigger modal -->
        <button type="button" class="crudButtonTable" data-bs-toggle="modal" data-bs-target="#deleteNotificacion{{ $notificacion->id }}">
            Eliminar
        </button>

        <!-- Modal -->
        <div class="modal fade" id="deleteNotificacion{{ $notificacion->id }}" tabindex="-1" aria-labelledby="deleteNotificacionLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-7" id="deleteNotificacionLabel">Eliminar</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <!-- Formulario para conformar eliminación Notificacion -->
                        <h6>¿Desea  eliminar definitivamente la notificacion con asunto: "{{ $notificacion->asunto }}"?</h6>
                        <div class="modal-footer">
                            <button type="button" class="crudButtonFormCancel" data-bs-dismiss="modal">Cancelar</button>
                            <a href="{{ route('deleteNotificacion',['id'=> $notificacion->id]) }}"><button class="crudButtonFormAccept">Confirmar</button></a>
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