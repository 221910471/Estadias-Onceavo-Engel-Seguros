<!-- Modal del registro de Pago -->
<div>
        <!-- Button trigger modal -->
        <button type="button" class="crudButton" data-bs-toggle="modal" data-bs-target="#createPago">
            Registrar      
            Pago
        </button>

        <!-- Modal -->
        <div class="modal fade" id="createPago" tabindex="-1" aria-labelledby="createPagoLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-7" id="createPagoLabel">Registrar Pago</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <!-- Formulario para crear nuevo Pago -->
                    <form action="{{route('createPago')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div>
                            <div class="crudFormItems">
                                <label for="dni">Frecuencia de pago:
                                    @if($errors->first('frecuenciaDePago'))
                                        <p class="text-danger">{{ $errors->first('frecuenciaDePago')}}</p>
                                    @endif
                                </label>
                                <select class="form-select" name="frecuenciaDePago" id="frecuenciaDePago" value="{{ old('frecuenciaDePago') }}">
                                <option selected>Seleccione una opción</option>
                                    <option value="Mensual">Mensual</option>
                                    <option value="Bimestral">Bimestral</option>
                                    <option value="Semestral">Semestral</option>
                                    <option value="Anual">Anual</option>
                                </select>
                            </div>

                            <div class="crudFormItems">
                                <label for="dni">Fecha límite de pago:
                                    @if($errors->first('fechaLimiteDePago'))
                                        <p class="text-danger">{{ $errors->first('fechaLimiteDePago')}}</p>
                                    @endif
                                </label>

                                <input type="date" name="fechaLimiteDePago" id="fechaLimiteDePago" value="{{ old('fechaLimiteDePago') }}" class="form-control" placeholder="Fecha límite de pago">
                            </div>

                            <div class="crudFormItems">
                                <label for="dni">Estado:
                                    @if($errors->first('estado'))
                                        <p class="text-danger">{{ $errors->first('estado')}}</p>
                                    @endif
                                </label>
                                <select class="form-select" name="estado" id="estado" value="{{ old('estado') }}">
                                <option selected>Seleccione una opción</option>
                                    <option value="Pagado">Pagado</option>
                                    <option value="Por pagar">Por pagar</option>
                                </select>
                            </div>

                            <div class="crudFormItems">
                                <label for="dni">Forma de Pago:
                                    @if($errors->first('formaDePago'))
                                        <p class="text-danger">{{ $errors->first('formaDePago')}}</p>
                                    @endif
                                </label>
                                <select class="form-select" name="formaDePago" id="formaDePago" value="{{ old('formaDePago') }}">
                                <option selected>Seleccione una opción</option>
                                    <option value="Trajeta de crédito">Trajeta de crédito</option>
                                    <option value="Trasnferencia">Trasnferencia</option>
                                    <option value="Efectivo">Efectivo</option>
                                </select>
                            </div>

                            <div class="crudFormItems">
                                <label for="dni">Monto de pago:
                                    @if($errors->first('montoDePago'))
                                        <p class="text-danger">{{ $errors->first('montoDePago')}}</p>
                                    @endif
                                </label>

                                <input type="number" name="montoDePago" id="montoDePago" value="{{ old('montoDePago') }}" class="form-control" placeholder="Monto de Pago">
                            <montoDePago
                            <div class="crudFormItems">
                                <label for="dni">
                                    Póliza a la que pertenece el pago:
                                    @if($errors->first('polizaId'))
                                        <p class="text-danger">{{ $errors->first('polizaId')}}</p>
                                    @endif
                                </label>
                                <select class="form-select" name="polizaId" id="polizaId" value="{{ old('polizaId') }}">
                                    <option selected>Seleccione una opción</option>
                                    @foreach($polizas as $poliza)
                                        <option value="{{ $poliza->id }}">{{ $poliza->id }} - {{ $poliza->clave }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="crudFormItems">
                                <label for="dni">
                                    Cliente que realizo el pago:
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

    