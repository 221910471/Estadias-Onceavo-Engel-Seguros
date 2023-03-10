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
                        <div class="crudFormItems">
                                <label for="dni">Nombre:
                                    @if($errors->first('nombre'))
                                        <p class="text-danger">{{ $errors->first('nombre')}}</p>
                                    @endif
                                </label>

                                <input type="text" name="nombre" id="nombre" value="{{ $usuario->nombre }}" class="form-control" placeholder="Nombre">
                            </div>
                            <div class="crudFormItems">
                                <label for="dni">Primer Apellido:
                                    @if($errors->first('apellidoPaterno'))
                                        <p class="text-danger">{{ $errors->first('apellidoPaterno')}}</p>
                                    @endif
                                </label>

                                <input type="text" name="apellidoPaterno" id="apellidoPaterno" value="{{ $usuario->apellidoPaterno }}" class="form-control" placeholder="Primer Apellido">
                            </div>
                            <div class="crudFormItems">
                                <label for="dni">Segundo Apellido:
                                    @if($errors->first('apellidoMaterno'))
                                        <p class="text-danger">{{ $errors->first('apellidoMaterno')}}</p>
                                    @endif
                                </label>

                                <input type="text" name="apellidoMaterno" id="apellidoMaterno" value="{{ $usuario->apellidoMaterno }}" class="form-control" placeholder="Segundo Apellido">
                            </div>
                            <div class="crudFormItems">
                                <label for="dni">Tel??fono:
                                    @if($errors->first('telefono'))
                                        <p class="text-danger">{{ $errors->first('telefono')}}</p>
                                    @endif
                                </label>

                                <input type="text" name="telefono" id="telefono" value="{{ $usuario->telefono }}" class="form-control" placeholder="Tel??fono">
                            </div>
                            <div class="crudFormItems">
                                <label for="dni">Correo:
                                    @if($errors->first('correoElectronico'))
                                        <p class="text-danger">{{ $errors->first('correoElectronico')}}</p>
                                    @endif
                                </label>

                                <input type="text" name="correoElectronico" id="correoElectronico" value="{{ $usuario->correoElectronico}}" class="form-control" placeholder="Correo Electr??nico">
                            </div>
                            <div class="crudFormItems">
                                <label for="dni">Contrase??a:
                                    @if($errors->first('contrasena'))
                                        <p class="text-danger">{{ $errors->first('contrasena')}}</p>
                                    @endif
                                </label>
                                
                                <input type="password" name="contrasena" id="contrasena" value="{{ $usuario->contrasena }}" class="form-control" placeholder="Contrase??a">
                            </div>
                            <div class="crudFormItems">
                                <label for="dni">Fecha de nacimiento:
                                    @if($errors->first('fechaDeNacimiento'))
                                        <p class="text-danger">{{ $errors->first('fechaDeNacimiento')}}</p>
                                    @endif
                                </label>

                                <input type="date" name="fechaDeNacimiento" id="fechaDeNacimiento" value="{{ $usuario->fechaDeNacimiento }}" class="form-control" placeholder="Fecha de nacimiento">
                            </div>
                            <div class="crudFormItems">
                                <label for="dni">Rol:
                                    @if($errors->first('rol'))
                                        <p class="text-danger">{{ $errors->first('rol')}}</p>
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
                                <label for="dni">Identificaci??n:
                                    @if($errors->first('identificacion'))
                                        <p class="text-danger">{{ $errors->first('identificacion')}}</p>
                                    @endif
                                </label>

                                <input type="file" name="identificacion" id="identificacion" value="{{ $usuario->identificacion}}" class="form-control" placeholder="Identificaci??n">
                            </div>
                            <div class="crudFormItems">
                                <label for="dni">Tarjeta de Circulaci??n:
                                    @if($errors->first('tarjetaDeCirculacion'))
                                        <p class="text-danger">{{ $errors->first('tarjetaDeCirculacion')}}</p>
                                    @endif
                                </label>

                                <input type="file" name="tarjetaDeCirculacion" id="tarjetaDeCirculacion" value="{{ $usuario->tarjetaDeCirculacion }}" class="form-control" placeholder="Tarjeta de Circulaci??n">
                            </div>
                            <div class="crudFormItems">
                                <label for="dni">Comprobante de Domicilio:
                                    @if($errors->first('comprobanteDomiciliario'))
                                        <p class="text-danger">{{ $errors->first('comprobanteDomiciliario')}}</p>
                                    @endif
                                </label>

                                <input type="file" name="comprobanteDomiciliario" id="comprobanteDomiciliario" value="{{ $usuario->comprobanteDomiciliario }}" class="form-control" placeholder="Comprobante de Domicilio">
                            </div>
                            <div class="">
                                <label for="dni">
                                    <!-- Estado Acceso: -->
                                    @if($errors->first('estadoDeSesion'))
                                        <p class="text-danger">{{ $errors->first('estadoDeSesion')}}</p>
                                    @endif
                                </label>

                                <input type="text" name="estadoDeSesion" id="estadoDeSesion" value="{{ $usuario->estadoDeSesion }}" class="form-control" placeholder="Estado Acceso">
                            </div>
                            <div class="crudFormItems" style="display:none;">
                                <label for="dni">
                                    <!-- Activo: -->
                                    @if($errors->first('activo'))
                                        <p class="text-danger">{{ $errors->first('activo')}}</p>
                                    @endif
                                </label>

                                <input type="text" name="activo" id="activo" value="SI" class="form-control" placeholder="Activo">
                            </div>
                            <div class="crudFormItems" style="display:none;">
                                <label for="dni">0000
                                    <!-- Familia: -->
                                    @if($errors->first('familiaId'))
                                        <p class="text-danger">{{ $errors->first('familiaId')}}</p>
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