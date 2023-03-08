<!-- Modal de poliza -->
<div>
        <!-- Button trigger modal -->
        <button type="button" class="crudButtonTable" data-bs-toggle="modal" data-bs-target="#showPoliza{{ $poliza->id }}">
            Detalles
        </button>

        <!-- Modal -->
        <div class="modal fade" id="showPoliza{{ $poliza->id }}" tabindex="-1" aria-labelledby="showPolizaLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-7" id="showPolizaLabel">Detalles</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <!-- Mostrar datos del poliza -->
                        <div class="areaDetail">
                            
                        </div>

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



                    <br>
                    @if(Session::has('mensaje'))
                        <div class="alert alert-danger">{{Session::get('mensaje')}}</div>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>