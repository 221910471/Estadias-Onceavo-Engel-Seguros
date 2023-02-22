<!-- Modal del registro de usuario -->
<div>
        <!-- Button trigger modal -->
        <button type="button" class="crudButton" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Registrar Usuario
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-7" id="exampleModalLabel">Registrar Usuario</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <!-- Formulario para crear nuevo usuario -->
                    <form action="{{route('createUser')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div>
                        <div class="crudFormItems">
                                <label for="dni">Nombre:
                                    @if($errors->first('nombre'))
                                        <p class="text-danger">{{ $errors->first('nombre')}}</p>
                                    @endif
                                </label>

                                <input type="text" name="nombre" id="nombre" value="" class="form-control" placeholder="Nombre">
                            </div>
                            <div class="crudFormItems">
                                <label for="dni">Primer Apellido:
                                    @if($errors->first('apellidoPaterno'))
                                        <p class="text-danger">{{ $errors->first('apellidoPaterno')}}</p>
                                    @endif
                                </label>

                                <input type="text" name="apellidoPaterno" id="apellidoPaterno" value="" class="form-control" placeholder="Primer Apellido">
                            </div>
                            <div class="crudFormItems">
                                <label for="dni">Segundo Apellido:
                                    @if($errors->first('apellidoMaterno'))
                                        <p class="text-danger">{{ $errors->first('apellidoMaterno')}}</p>
                                    @endif
                                </label>

                                <input type="text" name="apellidoMaterno" id="apellidoMaterno" value="" class="form-control" placeholder="Segundo Apellido">
                            </div>
                            <div class="crudFormItems">
                                <label for="dni">Teléfono:
                                    @if($errors->first('telefono'))
                                        <p class="text-danger">{{ $errors->first('telefono')}}</p>
                                    @endif
                                </label>

                                <input type="text" name="telefono" id="telefono" value="" class="form-control" placeholder="Teléfono">
                            </div>
                            <div class="crudFormItems">
                                <label for="dni">Correo:
                                    @if($errors->first('correoElectronico'))
                                        <p class="text-danger">{{ $errors->first('correoElectronico')}}</p>
                                    @endif
                                </label>

                                <input type="text" name="correoElectronico" id="correoElectronico" value="" class="form-control" placeholder="Correo Electrónico">
                            </div>
                            <div class="crudFormItems">
                                <label for="dni">Contraseña:
                                    @if($errors->first('contrasena'))
                                        <p class="text-danger">{{ $errors->first('contrasena')}}</p>
                                    @endif
                                </label>

                                <input type="text" name="contrasena" id="contrasena" value="" class="form-control" placeholder="Contraseña">
                            </div>
                            <div class="crudFormItems">
                                <label for="dni">Fecha de nacimiento:
                                    @if($errors->first('fechaDeNacimiento'))
                                        <p class="text-danger">{{ $errors->first('fechaDeNacimiento')}}</p>
                                    @endif
                                </label>

                                <input type="date" name="fechaDeNacimiento" id="fechaDeNacimiento" value="" class="form-control" placeholder="Fecha de nacimiento">
                            </div>
                            <div class="crudFormItems">
                                <label for="dni">Rol:
                                    @if($errors->first('rol'))
                                        <p class="text-danger">{{ $errors->first('rol')}}</p>
                                    @endif
                                </label>
                                <select class="form-select" name="rol" id="rol" value="">
                                <option selected>Seleccione un rol</option>
                                    <option value="Administrador">Administrador</option>
                                    <option value="Interno">Interno</option>
                                    <option value="Cliente">Cliente</option>
                                </select>
                                <!-- <input type="text" name="rol" id="rol" value="" class="form-control" placeholder="Rol"> -->
                            </div>
                            <div class="crudFormItems">
                                <label for="dni">Identificación:
                                    @if($errors->first('identificacion'))
                                        <p class="text-danger">{{ $errors->first('identificacion')}}</p>
                                    @endif
                                </label>

                                <input type="file" name="identificacion" id="identificacion" value="" class="form-control" placeholder="Identificación">
                            </div>
                            <div class="crudFormItems">
                                <label for="dni">Tarjeta de Circulación:
                                    @if($errors->first('tarjetaDeCirculacion'))
                                        <p class="text-danger">{{ $errors->first('tarjetaDeCirculacion')}}</p>
                                    @endif
                                </label>

                                <input type="file" name="tarjetaDeCirculacion" id="tarjetaDeCirculacion" value="" class="form-control" placeholder="Tarjeta de Circulación">
                            </div>
                            <div class="crudFormItems">
                                <label for="dni">Comprobante de Domicilio:
                                    @if($errors->first('comprobanteDomiciliario'))
                                        <p class="text-danger">{{ $errors->first('comprobanteDomiciliario')}}</p>
                                    @endif
                                </label>

                                <input type="file" name="comprobanteDomiciliario" id="comprobanteDomiciliario" value="" class="form-control" placeholder="Comprobante de Domicilio">
                            </div>
                            <div class="" style="display:none;">
                                <label for="dni">
                                    <!-- Estado Acceso: -->
                                    @if($errors->first('estadoDeSesion'))
                                        <p class="text-danger">{{ $errors->first('estadoDeSesion')}}</p>
                                    @endif
                                </label>

                                <input type="text" name="estadoDeSesion" id="estadoDeSesion" value="1" class="form-control" placeholder="Estado Acceso">
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
                                <label for="dni">
                                    <!-- Familia: -->
                                    @if($errors->first('familiaId'))
                                        <p class="text-danger">{{ $errors->first('familiaId')}}</p>
                                    @endif
                                </label>

                                <input type="text" name="familiaId" id="familiaId" value="1" class="form-control" placeholder="Familia">
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