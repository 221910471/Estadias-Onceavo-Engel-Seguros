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
                                        <p class="text-danger">{{ $errors->first('titulo')}}</p>
                                    @endif
                                </label>

                                <input type="text" name="titulo" id="titulo" value="{{ old('titulo') }}" class="form-control" placeholder="Título">
                            </div>

                            <div class="crudFormItems">
                                <label for="dni">Asunto:
                                    @if($errors->first('asunto'))
                                        <p class="text-danger">{{ $errors->first('asunto')}}</p>
                                    @endif
                                </label>

                                <input type="text" name="asunto" id="asunto" value="{{ old('asunto') }}" class="form-control" placeholder="Asunto">
                            </div>

                            <div class="crudFormItems">
                                <label for="dni">Mensaje:
                                    @if($errors->first('mensaje'))
                                        <p class="text-danger">{{ $errors->first('mensaje')}}</p>
                                    @endif
                                </label>

                                <input type="text" name="mensaje" id="mensaje" value="{{ old('mensaje') }}" class="form-control" placeholder="Mensaje">
                            </div>

                            <div class="crudFormItems">
                                <label for="dni">
                                    Cliente que tiene esta póliza:
                                    @if($errors->first('usuarioId'))
                                        <p class="text-danger">{{ $errors->first('usuarioId')}}</p>
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