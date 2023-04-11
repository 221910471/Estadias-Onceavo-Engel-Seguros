<!-- Modal del edicion de datos del usuario -->
<div>
        <!-- Button trigger modal -->
        <button type="button" class="crudButtonTable" data-bs-toggle="modal" data-bs-target="#editUser{{ $usuario->id }}">
            Editar
        </button>

        <!-- Modal -->
        <div class="modal fade" id="editUser{{ $usuario->id }}" tabindex="-1" aria-labelledby="editUserLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-7" id="editUserLabel">Editar</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <!-- Formulario para crear nuevo usuario -->
                    <form action="{{route('editUser',$usuario->id)}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        @csrf @method('PUT')

                        <div>
                        <p style="text-align: right;"><em>* Obligatorio</em></p>

                        <div class="crudFormItems">
                                <label for="dni">* Nombre:
                                    @if($errors->first('nombre'))
                                        <p class="text-danger"><em>{{ $errors->first('nombre')}}</em></p>
                                    @endif
                                </label>

                                <input type="text" name="nombre" id="nombreEditar" value="{{ $usuario->nombre }}" class="form-control" placeholder="Nombre">
                                <p id="avisoNombreEditar" class="text-danger"><em></em></p>
                            </div>
                            <div class="crudFormItems">
                                <label for="dni">* Primer Apellido:
                                    @if($errors->first('apellidoPaterno'))
                                        <p class="text-danger"><em>{{ $errors->first('apellidoPaterno')}}</em></p>
                                    @endif
                                </label>

                                <input type="text" name="apellidoPaterno" id="apellidoPaternoEditar" value="{{ $usuario->apellidoPaterno }}" class="form-control" placeholder="Primer Apellido">
                                <p id="avisoApellidoPaternoEditar" class="text-danger"><em></em></p>
                            </div>
                            <div class="crudFormItems">
                                <label for="dni">Segundo Apellido:
                                    @if($errors->first('apellidoMaterno'))
                                        <p class="text-danger"><em>{{ $errors->first('apellidoMaterno')}}</em></p>
                                    @endif
                                </label>

                                <input type="text" name="apellidoMaterno" id="apellidoMaternoEditar" value="{{ $usuario->apellidoMaterno }}" class="form-control" placeholder="Segundo Apellido">
                                <p id="avisoApellidoMaternoEditar" class="text-danger"><em></em></p>
                            </div>
                            <div class="crudFormItems">
                                <label for="dni">* Teléfono:
                                    @if($errors->first('telefono'))
                                        <p class="text-danger"><em>{{ $errors->first('telefono')}}</em></p>
                                    @endif
                                </label>

                                <input type="text" name="telefono" id="telefonoEditar" value="{{ $usuario->telefono }}" class="form-control" placeholder="Teléfono">
                                <p id="avisoTelefonoEditar" class="text-danger"><em></em></p>
                            </div>
                            <div class="crudFormItems">
                                <label for="dni">* Correo:
                                    @if($errors->first('correoElectronico'))
                                        <p class="text-danger"><em>{{ $errors->first('correoElectronico')}}</em></p>
                                    @endif
                                </label>

                                <input type="text" name="correoElectronico" id="correoElectronicoEditar" value="{{ $usuario->correoElectronico}}" class="form-control" placeholder="Correo Electrónico">
                                <p id="avisoCorreoElectronicoEditar" class="text-danger"><em></em></p>
                            </div>
                            <div class="crudFormItems">
                                <label for="dni">* Contraseña:
                                    @if($errors->first('contrasena'))
                                        <p class="text-danger"><em>{{ $errors->first('contrasena')}}</em></p>
                                    @endif
                                </label>
                                
                                <input type="password" name="contrasena" id="contrasenaEditar" value="{{ $usuario->contrasena }}" class="form-control" placeholder="Contraseña">
                                <p id="avisoContrasenaEditar" class="text-danger"><em></em></p>
                            </div>
                            <div class="crudFormItems">
                                <label for="dni">* Fecha de nacimiento:
                                    @if($errors->first('fechaDeNacimiento'))
                                        <p class="text-danger"><em>{{ $errors->first('fechaDeNacimiento')}}</em></p>
                                    @endif
                                </label>

                                <input type="date" name="fechaDeNacimiento" id="fechaDeNacimiento" value="{{ $usuario->fechaDeNacimiento }}" class="form-control" placeholder="Fecha de nacimiento">
                            </div>
                            <div class="crudFormItems">
                                <label for="dni">* Rol:
                                    @if($errors->first('rol'))
                                        <p class="text-danger"><em>{{ $errors->first('rol')}}</em></p>
                                    @endif
                                </label>
                                <select class="form-select" name="rol" id="rol" value="{{ $usuario->rol}}">
                                    <option value="{{ $usuario->rol}}" selected>Valor previo: {{ $usuario->rol}}</option>
                                    <option value="Administrador">Administrador</option>
                                    <option value="Interno">Interno</option>
                                    <option value="Cliente">Cliente</option>
                                </select>
                                <!-- <input type="text" name="rol" id="rol" value="" class="form-control" placeholder="Rol"> -->
                            </div>
                            <div class="crudFormItems">
                                <label for="dni">Identificación:
                                    @if($errors->first('identificacion'))
                                        <p class="text-danger"><em>{{ $errors->first('identificacion')}}</em></p>
                                    @endif
                                </label>

                                <input type="file" name="identificacion" id="identificacion" value="{{ $usuario->identificacion}}" class="form-control" placeholder="Identificación">
                            </div>
                            <div class="crudFormItems">
                                <label for="dni">Tarjeta de Circulación:
                                    @if($errors->first('tarjetaDeCirculacion'))
                                        <p class="text-danger"><em>{{ $errors->first('tarjetaDeCirculacion')}}</em></p>
                                    @endif
                                </label>

                                <input type="file" name="tarjetaDeCirculacion" id="tarjetaDeCirculacion" value="{{ $usuario->tarjetaDeCirculacion }}" class="form-control" placeholder="Tarjeta de Circulación">
                            </div>
                            <div class="crudFormItems">
                                <label for="dni">Comprobante de Domicilio:
                                    @if($errors->first('comprobanteDomiciliario'))
                                        <p class="text-danger"><em>{{ $errors->first('comprobanteDomiciliario')}}</em></p>
                                    @endif
                                </label>

                                <input type="file" name="comprobanteDomiciliario" id="comprobanteDomiciliario" value="{{ $usuario->comprobanteDomiciliario }}" class="form-control" placeholder="Comprobante de Domicilio">
                            </div>
                            <div class=""  style="display:none;">
                                <label for="dni">
                                    <!-- Estado Acceso: -->
                                    @if($errors->first('estadoDeSesion'))
                                        <p class="text-danger"><em>{{ $errors->first('estadoDeSesion')}}</em></p>
                                    @endif
                                </label>

                                <input type="text" name="estadoDeSesion" id="estadoDeSesion" value="{{ $usuario->estadoDeSesion }}" class="form-control" placeholder="Estado Acceso">
                            </div>
                            <div class="crudFormItems" style="display:none;">
                                <label for="dni">
                                    <!-- Activo: -->
                                    @if($errors->first('activo'))
                                        <p class="text-danger"><em>{{ $errors->first('activo')}}</em></p>
                                    @endif
                                </label>

                                <input type="text" name="activo" id="activo" value="SI" class="form-control" placeholder="Activo">
                            </div>
                            <div class="crudFormItems" style="display:none;">
                                <label for="dni">
                                    <!-- Familia: -->
                                    @if($errors->first('familiaId'))
                                        <p class="text-danger"><em>{{ $errors->first('familiaId')}}</em></p>
                                    @endif
                                </label>

                                <input type="text" name="familiaId" id="familiaId" value="1" class="form-control" placeholder="Familia">
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

    