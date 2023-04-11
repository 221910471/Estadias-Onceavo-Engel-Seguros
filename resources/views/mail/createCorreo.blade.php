<!-- Modal para el formulario de envio de correo -->
<div>
        <!-- Button trigger modal -->
        <button type="button" class="crudButton" data-bs-toggle="modal" data-bs-target="#createCorreo">
            Enviar Correo
        </button>

        <!-- Modal -->
        <div class="modal fade" id="createCorreo" tabindex="-1" aria-labelledby="createCorreoLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-7" id="createCorreoLabel">Enviar Correo</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <!-- Formulario para crear nuevo usuario -->
                    <form action="{{route('enviarCorreo')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div>
                        <div class="crudFormItems">
                                <label for="dni">Correo:
                                    @if($errors->first('correoElectronico'))
                                        <p class="text-danger"><em>{{ $errors->first('correoElectronico')}}</em></p>
                                    @endif
                                </label>

                                <input type="text" name="correoElectronico" id="correoElectronico" value="{{ old('correoElectronico') }}" class="form-control" placeholder="Correo Electrónico">
                        </div>
                        <div class="crudFormItems">
                                <label for="dni">Titulo:
                                    @if($errors->first('titulo'))
                                        <p class="text-danger"><em>{{ $errors->first('titulo')}}</em></p>
                                    @endif
                                </label>

                                <input type="text" name="titulo" id="titulo" value="{{ old('titulo') }}" class="form-control" placeholder="Titulo">
                            </div>
                            <div class="crudFormItems">
                                <label for="dni">Asunto:
                                    @if($errors->first('asunto'))
                                        <p class="text-danger"><em>{{ $errors->first('asunto')}}</em></p>
                                    @endif
                                </label>

                                <input type="text" name="asunto" id="asunto" value="{{ old('asunto') }}" class="form-control" placeholder="Asunto">
                            </div>
                            <div class="crudFormItems">
                                <label for="dni">Mensaje:
                                    @if($errors->first('mensaje'))
                                        <p class="text-danger"><em>{{ $errors->first('mensaje')}}</em></p>
                                    @endif
                                </label>

                                <input type="textArea" name="mensaje" id="mensaje" value="{{ old('mensaje') }}" class="form-control" placeholder="Mensaje">
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