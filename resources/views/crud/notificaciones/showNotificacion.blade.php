<!-- Datos de notificación -->
<div>
        <!-- Button trigger modal -->
        <button type="button" class="crudButtonTable" data-bs-toggle="modal" data-bs-target="#showNotificacion{{ $notificacion->id }}">
            Detalles
        </button>

        <!-- Modal -->
        <div class="modal fade" id="showNotificacion{{ $notificacion->id }}" tabindex="-1" aria-labelledby="showNotificacionLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-7" id="showNotificacionLabel">Detalles</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <!-- Mostrar datos del notificación -->
                        <div class="" style="padding: 30px;">
                            <h2>{{ $notificacion->titulo }}</h2>
                            <p style="text-align: right;"><em>Fecha de envio: {{ $notificacion->fechaEnvio }}</em></p>
                            <hr>
                            <h5 style="text-align: left;">Asunto: {{ $notificacion->asunto }}</h5>
                            <hr>
                            <p style="text-align: left;">Mensaje:</p>
                            <p style="text-align: left;">{{ $notificacion->mensaje }}</p>
                        </div>
                        <br>
                        <br>
                        
                    <br>
                    @if(Session::has('mensaje'))
                        <div class="alert alert-danger">{{Session::get('mensaje')}}</div>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>