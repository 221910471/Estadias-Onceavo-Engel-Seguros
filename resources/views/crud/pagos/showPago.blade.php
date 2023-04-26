<!-- Datos de pago -->
<div>
        <!-- Button trigger modal -->
        <button type="button" class="crudButtonTable" data-bs-toggle="modal" data-bs-target="#showPago{{ $pago->id }}">
            Detalles
        </button>

        <!-- Modal -->
        <div class="modal fade" id="showPago{{ $pago->id }}" tabindex="-1" aria-labelledby="showPagoLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-7" id="showPagoLabel">Detalles</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <!-- Mostrar datos del pago -->
                        <div class="" style="padding: 30px;">
                            <h2>Clave del pago: {{ $pago->clave }}</h2>
                            <p style="text-align: right;"><em>Fecha de Pago: {{ $pago->fechaDePago }}</em></p>
                            <p style="text-align: right;"><em>Fecha límite del Pago: {{ $pago->fechaLimiteDePago }}</em></p>
                            <hr>
                            <div>
                                <h5 style="text-align: left;">Estado: {{ $pago->estado }}</h5>
                                <h5 style="text-align: center;">Frecuencia del pago: {{ $pago->frecuenciaDePago }}</h5>
                                <h5 style="text-align: right;">Monto total de pago: {{ $pago->montoDePago }}</h5>
                                <h5 style="text-align: right;">Subtotal de pago: {{ $pago->subtotal }}</h5>
                            </div>
                            <hr>
                            <h4 style="text-align: left;">Cliente que realizo el pago:</h4>
                            <h3 style="text-align: center;">
                                @foreach($usuarios as $usuario)
                                    @if($pago->usuarioId == $usuario->id)
                                        {{ $usuario->nombre }} {{ $usuario->apellidoPaterno }} {{ $usuario->apellidoMaterno }}
                                    @endif
                                @endforeach
                            </h3>
                            <br>
                            <h3 style="text-align: left;">Póliza a la que pertenece el pago:</h3>
                            <p style="text-align: left;">
                                @foreach($polizas as $poliza)
                                    @if($pago->polizaId == $poliza->id)
                                        @if( $poliza->tipoPoliza == "Daños")
                                            <div class="areaDetail1">
                                                <div class="textDetail">
                                                    <h1>Seguro de Daños</h1>
                                                    <p><em>Registrado con la fecha: {{ $poliza->fechaDeRegistro }}</em></p>
                                                </div>
                                                <div class="">
                                                    <img class="overlayImage" src="img/seguro-danos.jpg" alt="">
                                                </div> 
                                                <div class="">
                                                    <iframe width="400" height="400" src="{{asset('pdf/polizas/'.$poliza->rutaArchivo)}}" frameborder="0"></iframe>
                                                </div> 
                                            </div>     
                                        @else
                                            @if( $poliza->tipoPoliza  == "Medico")
                                                <div class="areaDetail2">
                                                        <div class="textDetail">
                                                            <h1>Seguro Médico</h1>
                                                            <p><em>Registrado con la fecha: {{ $poliza->fechaDeRegistro }}</em></p>
                                                        </div>
                                                        <div class="">
                                                            <img class="overlayImage" src="img/seguro-medico.jpg" alt="">
                                                        </div> 
                                                        <div class="">
                                                            <iframe width="400" height="400" src="{{asset('pdf/polizas/'.$poliza->rutaArchivo)}}" frameborder="0"></iframe>
                                                        </div> 
                                                    </div>          
                                            @else
                                                @if( $poliza->tipoPoliza  == "Vida")
                                                    <div class="areaDetail3">
                                                        <div class="textDetail">
                                                            <h1>Seguro de Vida</h1>
                                                            <p><em>Registrado con la fecha: {{ $poliza->fechaDeRegistro }}</em></p>
                                                        </div>
                                                        <div class="">
                                                            <img class="overlayImage" src="img/seguro-de-vida.jpg" alt="">
                                                        </div> 
                                                        <div class="">
                                                            <iframe width="400" height="400" src="{{asset('pdf/polizas/'.$poliza->rutaArchivo)}}" frameborder="0"></iframe>
                                                        </div> 
                                                    </div>          
                                                @endif
                                            @endif
                                        @endif
                                    @endif
                                @endforeach
                            </p>
                            <br>
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