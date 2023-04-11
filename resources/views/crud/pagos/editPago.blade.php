<!-- Modal del edicion de Pago -->
<div>
        <!-- Button trigger modal -->
        <button type="button" class="crudButtonTable" data-bs-toggle="modal" data-bs-target="#editPago{{ $pago->id }}">
            Editar
        </button>

        <!-- Modal -->
        <div class="modal fade" id="editPago{{ $pago->id }}" tabindex="-1" aria-labelledby="editPagoLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-7" id="editPagoLabel">Editar</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <!-- Formulario para crear nuevo pago -->
                    <form action="{{route('editPago',$pago->id)}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        @csrf @method('PUT')

                        <div>
                            
                            <div class="crudFormItems">
                                <label for="dni">Frecuencia de pago:
                                    @if($errors->first('frecuenciaDePago'))
                                        <p class="text-danger"><em>{{ $errors->first('frecuenciaDePago')}}</em></p>
                                    @endif
                                </label>
                                <select class="form-select" name="frecuenciaDePago" id="frecuenciaDePago" value="{{ $pago->frecuenciaDePago }}">
                                <option value="{{ $pago->frecuenciaDePago }}" selected>Valor previo: {{ $pago->frecuenciaDePago }}</option>
                                    <option value="Mensual">Mensual</option>
                                    <option value="Bimestral">Bimestral</option>
                                    <option value="Semestral">Semestral</option>
                                    <option value="Anual">Anual</option>
                                </select>
                            </div>

                            <div class="crudFormItems">
                                <label for="dni">Fecha límite de pago:
                                    @if($errors->first('fechaLimiteDePago'))
                                        <p class="text-danger"><em>{{ $errors->first('fechaLimiteDePago')}}</em></p>
                                    @endif
                                </label>

                                <input type="date" name="fechaLimiteDePago" id="fechaLimiteDePago" value="{{ $pago->fechaLimiteDePago }}" class="form-control" placeholder="Fecha límite de pago">
                            </div>

                            <div class="crudFormItems">
                                <label for="dni">Estado:
                                    @if($errors->first('estado'))
                                        <p class="text-danger"><em>{{ $errors->first('estado')}}</em></p>
                                    @endif
                                </label>
                                <select class="form-select" name="estado" id="estado" value="{{ $pago->estado }}">
                                <option value="{{ $pago->estado }}" selected>Valor previo: {{ $pago->estado }}</option>
                                    <option value="Pagado">Pagado</option>
                                    <option value="Por pagar">Por pagar</option>
                                </select>
                            </div>

                            <div class="crudFormItems">
                                <label for="dni">Forma de Pago:
                                    @if($errors->first('formaDePago'))
                                        <p class="text-danger"><em>{{ $errors->first('formaDePago')}}</em></p>
                                    @endif
                                </label>
                                <select class="form-select" name="formaDePago" id="formaDePago" value="{{ $pago->formaDePago }}">
                                <option value="{{ $pago->formaDePago }}" selected>Valor previo: {{ $pago->formaDePago }}</option>
                                    <option value="Trajeta de crédito">Trajeta de crédito</option>
                                    <option value="Transferencia">Transferencia</option>
                                    <option value="Efectivo">Efectivo</option>
                                </select>
                            </div>

                            <div class="crudFormItems">
                                <label for="dni">Monto de pago:
                                    @if($errors->first('montoDePago'))
                                        <p class="text-danger"><em>{{ $errors->first('montoDePago')}}</em></p>
                                    @endif
                                </label>

                                <input type="number" name="montoDePago" id="montoDePago" value="{{ $pago->montoDePago}}" class="form-control" placeholder="Monto de Pago">
                            </div>

                            <div class="crudFormItems">
                                <label for="dni">
                                    Póliza a la que pertenece el pago:
                                    @if($errors->first('polizaId'))
                                        <p class="text-danger"><em>{{ $errors->first('polizaId')}}</em></p>
                                    @endif
                                </label>
                                <select class="form-select" name="polizaId" id="polizaId" value="">
                                    <option value="{{ $pago->polizaId }}" selected>Valor previo: {{ $pago->polizaId }}</option>
                                    @foreach($polizas as $poliza)
                                        <option value="{{ $poliza->id }}">{{ $poliza->id }} - {{ $poliza->clave }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="crudFormItems">
                                <label for="dni">
                                    Cliente que realizo el pago:
                                    @if($errors->first('usuarioId'))
                                        <p class="text-danger"><em>{{ $errors->first('usuarioId')}}</em></p>
                                    @endif
                                </label>
                                <select class="form-select" name="usuarioId" id="usuarioId" value="">
                                    <option value="{{ $pago->usuarioId }}" selected>Valor previo: {{ $pago->usuarioId }}</option>
                                    @foreach($usuarios as $usuario)
                                        @if($usuario->rol == "Cliente")
                                            <option value="{{ $usuario->id }}">{{ $usuario->id }} - {{ $usuario->nombre }} {{ $usuario->apellidoPaterno }} {{ $usuario->apellidoMaterno }}</option>
                                        @endif
                                    @endforeach
                                </selectstyle="display:none;"

                            <div class="crudFormItems">
                                <label for="dni">
                                    @if($errors->first('clave'))
                                        <p class="text-danger"><em>{{ $errors->first('clave')}}</em></p>
                                    @endif
                                </label>

                                <input type="text" name="clave" id="clave" value="{{ $pago->clave}}" class="form-control" placeholder="Clave" style="display:none;">
                            </div>

                            <div class="crudFormItems">
                                <label for="dni"
                                    @if($errors->first('fechaDePago'))
                                        <p class="text-danger"><em>{{ $errors->first('fechaDePago')}}</em></p>
                                    @endif
                                </label>

                                <input type="date" name="fechaDePago" id="fechaDePago" value="{{ $pago->fechaDePago }}" class="form-control" placeholder="Fecha de pago" style="display:none;">
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