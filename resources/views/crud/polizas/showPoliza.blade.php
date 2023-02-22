<!-- Modal del registro de usuario -->
<div>
        <!-- Button trigger modal -->
        <button type="button" class="crudButtonTable" data-bs-toggle="modal" data-bs-target="#showUser{{ $usuario->id }}">
            Detalles
        </button>

        <!-- Modal -->
        <div class="modal fade" id="showUser{{ $usuario->id }}" tabindex="-1" aria-labelledby="showUserLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-7" id="showUserLabel">Detalles</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <!-- Mostrar datos del usuario -->
                        <div class="dataDetails">
                            <div class="gridContainerDetail1">
                                <p>Nombre: {{ $usuario->nombre }} {{ $usuario->apellidoPaterno }} {{ $usuario->apellidoMaterno }}</p>
                                <p>Número Telefoníco: {{ $usuario->telefono }}</p>
                                <p>Correo Electrónico: {{ $usuario->correoElectronico }}</p>
                            </div>
                            <div class="gridContainerDetail1">
                                <p>Tipo de Cuenta: {{ $usuario->rol }}</p>
                                <p>Fecha de Nacimiento: {{ $usuario->fechaDeNacimiento }}</p>
                                <p>Ingreso al Sistema: {{ $usuario->estadoDeSesion }}</p>
                            </div>
                            <div class="" style="margin-top: 20px;">
                                <p>En caso de ser Eliminado Aparecera la fecha en la que fue retirado del sistema</p>
                                <p>Elimininado el Día: {{ $usuario->deleted_at }}</p>
                            </div>
                            
                                
                        </div>
                        <br>
                        <br>
                        <!-- Apartado de imagenes -->
                        <div class="row row-cols-1 row-cols-md-3 g-4">
                            <div class="col">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="crudDetailTextImage">Identificación</h5>
                                    </div>
                                    <img src="images/identificaciones/{{ $usuario->identificacion }}" class="card-img-bottom crudDetailImage" alt="Identificación">
                                </div>
                            </div>
                            <div class="col">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="crudDetailTextImage">Tarjeta de Circulación</h5>
                                    </div>
                                    <img src="images/tarjetaCirculacion/{{ $usuario->tarjetaDeCirculacion }}" class="card-img-bottom crudDetailImage" alt="Tarjeta de Circulación">
                                    
                                </div>
                            </div>
                            <div class="col">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="crudDetailTextImage">Comprobante Domiciliario</h5>
                                    </div>
                                    <img src="images/comprobanteDomiciliario/{{ $usuario->comprobanteDomiciliario }}" class="card-img-bottom crudDetailImage" alt="Comprobante Domiciliario">
                                </div>
                            </div>
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