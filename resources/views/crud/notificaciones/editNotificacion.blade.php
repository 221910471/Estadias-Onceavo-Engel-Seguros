<!-- Modal del edicion de notificacion -->
<div>
        <!-- Button trigger modal -->
        <button type="button" class="crudButtonTable" data-bs-toggle="modal" data-bs-target="#editNotificacion{{ $notificacion->id }}">
            Editar
        </button>

        <!-- Modal -->
        <div class="modal fade" id="editNotificacion{{ $notificacion->id }}" tabindex="-1" aria-labelledby="editNotificacionLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-7" id="editnotificacionLabel">Editar</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <!-- Formulario para crear nuevo notificacion -->
                    <form action="{{route('editNotificacion',$notificacion->id)}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        @csrf @method('PUT')

                        <div>
                            <div class="crudFormItems">
                                <label for="dni">Título:
                                    @if($errors->first('titulo'))
                                        <p class="text-danger">{{ $errors->first('titulo')}}</p>
                                    @endif
                                </label>

                                <input type="text" name="titulo" id="titulo" value="{{ $notificacion->titulo }}" class="form-control" placeholder="Título">
                            </div>

                            <div class="crudFormItems">
                                <label for="dni">Asunto:
                                    @if($errors->first('asunto'))
                                        <p class="text-danger">{{ $errors->first('asunto')}}</p>
                                    @endif
                                </label>

                                <input type="text" name="asunto" id="asunto" value="{{ $notificacion->asunto }}" class="form-control" placeholder="Asunto">
                            </div>

                            <div class="crudFormItems">
                                <label for="dni">Mensaje:
                                    @if($errors->first('mensaje'))
                                        <p class="text-danger">{{ $errors->first('mensaje')}}</p>
                                    @endif
                                </label>

                                <input type="text" name="mensaje" id="mensaje" value="{{ $notificacion->mensaje }}" class="form-control" placeholder="Mensaje">
                            </div>

                            <div class="crudFormItems">
                                <label for="dni">
                                    Cliente que tiene esta póliza:
                                    @if($errors->first('usuarioId'))
                                        <p class="text-danger">{{ $errors->first('usuarioId')}}</p>
                                    @endif
                                </label>
                                <select class="form-select" name="usuarioId" id="usuarioId" value="">
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
                                <input class ="crudButtonFormAccept" type="submit" value="Guardar Cambios" >
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