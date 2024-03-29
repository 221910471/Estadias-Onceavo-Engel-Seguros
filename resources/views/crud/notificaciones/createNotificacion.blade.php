<!-- Modal del registro de Notificacion -->
<div>
        <!-- Button trigger modal -->
        <button type="button" class="crudButton" data-bs-toggle="modal" data-bs-target="#createNotificacion">
            Registrar Notificación
        </button>

        <!-- Modal -->
        <div class="modal fade" id="createNotificacion" tabindex="-1" aria-labelledby="createNotificacionLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-7" id="createNotificacionLabel">Registrar Notificación</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <!-- Formulario para crear nueva notificacion -->
                    <form action="{{route('createNotificacion')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div>
                            <div class="crudFormItems">
                                <label for="dni">Título:
                                    @if($errors->first('titulo'))
                                        <p class="text-danger"><em>{{ $errors->first('titulo')}}</em></p>
                                    @endif
                                </label>

                                <input type="text" name="titulo" id="titulo" value="{{ old('titulo') }}" class="form-control" placeholder="Título">
                            </div>

                            <!-- <div class="crudFormItems">
                                <label for="dni">Asunto:
                                    @if($errors->first('asunto'))
                                        <p class="text-danger"><em>{{ $errors->first('asunto')}}</em></p>
                                    @endif
                                </label>

                                <input type="text" name="asunto" id="asunto" value="{{ old('asunto') }}" class="form-control" placeholder="Asunto">
                            </div> -->
                            <div class="crudFormItems">
                                <label for="dni">Asunto:
                                    @if($errors->first('asunto'))
                                        <p class="text-danger"><em>{{ $errors->first('asunto')}}</em></p>
                                    @endif
                                </label>
                                <select class="form-select" name="asunto" id="asunto" value="{{ old('asunto') }}" onchange="cambiarInputAsuntoSelect()">
                                <option selected>Seleccione un asunto de la lista</option>
                                    <option value="Pago">Pago</option>
                                    <option value="Cumpleaños">Cumpleaños</option>
                                    <option value="Seguro">Seguro</option>
                                </select>

                                <label for="dni">Otro asunto:
                                    @if($errors->first('asunto2'))
                                        <p class="text-danger"><em>{{ $errors->first('asunto2')}}</em></p>
                                    @endif
                                </label>

                                <input type="text" name="asunto2" id="asunto2" value="{{ old('asunto2') }}" class="form-control" placeholder="Asunto" onchange="cambiarInputAsunto()">
                            </div>

                            <div class="crudFormItems">
                                <label for="dni">Mensaje:
                                    @if($errors->first('mensaje'))
                                        <p class="text-danger"><em>{{ $errors->first('mensaje')}}</em></p>
                                    @endif
                                </label>
                                <select class="form-select" name="mensaje" id="mensaje" value="{{ old('mensaje') }}" onchange="cambiarInputMensajeSelect()">
                                <option selected>Seleccione un mensaje de la lista</option>
                                    <option value="Recordatorio de pago, se recomienda revisar sus notifiaciones y registro de pago en el área de notificaciones.">Recordatorio de pago, se recomienda revisar sus notifiaciones y registro de pago en el área de notificaciones.</option>
                                    <option value="Le deseamos un feliz cumpleaños, que viva esta fecha con mucha alegría.">Le deseamos un feliz cumpleaños, que viva esta fecha con mucha alegría.</option>
                                    <option value="Le recomendamos revisar nuestras distintas pólizas y seguros que ofrecemos, porque lo más valio que podemos tener es la seguridad de usted y su familia.">Le recomendamos revisar nuestras distintas pólizas y seguros que ofrecemos, porque lo más valio que podemos tener es la seguridad de usted y su familia.</option>
                                </select>

                                <label for="dni">Otro mensaje:
                                    @if($errors->first('mensaje2'))
                                        <p class="text-danger"><em>{{ $errors->first('mensaje2')}}</em></p>
                                    @endif
                                </label>

                                <input type="text" name="mensaje2" id="mensaje2" value="{{ old('mensaje2') }}" class="form-control" placeholder="Mensaje" onchange="cambiarInputMensaje()">
                            </div>

                            <div class="crudFormItems">
                                <label for="dni">
                                    Cliente que tiene esta póliza:
                                    @if($errors->first('usuarioId'))
                                        <p class="text-danger"><em>{{ $errors->first('usuarioId')}}</em></p>
                                    @endif
                                </label>
                                <select class="form-select" name="usuarioId" id="usuarioId" value="{{ old('usuarioId') }}">
                                    <option selected>Seleccione al destinatario</option>
                                    @foreach($usuarios as $usuario)
                                        @if($usuario->rol == "Cliente")
                                            <option value="{{ $usuario->id }}">{{ $usuario->id }} - {{ $usuario->nombre }} {{ $usuario->apellidoPaterno }} {{ $usuario->apellidoMaterno }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="crudButtonFormCancel" data-bs-dismiss="modal">Cancelar</button>
                                <input class ="crudButtonFormAccept" type="submit" value="Guardar" >
                            </div>

                        </div>
                    </form>
                    <br>
                    @if(Session::has('mensaje'))
                        <div class="alert alert-danger">{{Session::get('mensaje')}}</div>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    