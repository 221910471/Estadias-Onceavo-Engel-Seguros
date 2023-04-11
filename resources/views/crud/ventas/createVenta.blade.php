<!-- Modal del registro de Venta -->
<div>
        <!-- Button trigger modal -->
        <button type="button" class="crudButton" data-bs-toggle="modal" data-bs-target="#createVenta">
            Registrar Venta
        </button>

        <!-- Modal -->
        <div class="modal fade" id="createVenta" tabindex="-1" aria-labelledby="createVentaLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-7" id="createVentaLabel">Registrar Venta</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <!-- Formulario para crear nuevo usuario -->
                    <form action="{{route('createVenta')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div>
                            <div class="crudFormItems">
                                <label for="dni">Clave:
                                    @if($errors->first('clave'))
                                        <p class="text-danger"><em>{{ $errors->first('clave')}}</em></p>
                                    @endif
                                </label>

                                <input type="text" name="clave" id="clave" value="{{ old('clave') }}" class="form-control" placeholder="Clave">
                                <p id="avisoClave" class="text-danger"><em></em></p>
                            </div>
                            <div class="crudFormItems">
                                <label for="dni">Comisión:
                                    @if($errors->first('comision'))
                                        <p class="text-danger"><em>{{ $errors->first('comision')}}</em></p>
                                    @endif
                                </label>

                                <input type="text" name="comision" id="comision" value="{{ old('comision') }}" class="form-control" placeholder="Comisión">
                                <p id="avisoComision" class="text-danger"><em></em></p>
                            </div>
                            <div>
                                <p>*El usuario que registra esta venta</p>
                            </div>
                            <div>
                                <p>*La póliza de esta venta se seleccionara en el registro de la póliza</p>
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