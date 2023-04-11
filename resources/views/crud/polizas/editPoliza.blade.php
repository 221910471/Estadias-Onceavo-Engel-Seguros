<!-- Modal del edicion de datos del poliza -->
<div>
        <!-- Button trigger modal -->
        <button type="button" class="crudButtonTable" data-bs-toggle="modal" data-bs-target="#editPoliza{{ $poliza->id }}">
            Editar
        </button>

        <!-- Modal -->
        <div class="modal fade" id="editPoliza{{ $poliza->id }}" tabindex="-1" aria-labelledby="editPolizaLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-7" id="editPolizaLabel">Editar</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <!-- Formulario para crear nuevo poliza -->
                    <form action="{{route('editPoliza',$poliza->id)}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        @csrf @method('PUT')

                        <div>
                        <div class="crudFormItems">
                                <label for="dni">Clave:
                                    @if($errors->first('clave'))
                                        <p class="text-danger"><em>{{ $errors->first('clave')}}</em></p>
                                    @endif
                                </label>

                                <input type="text" name="clave" id="clave" value="{{ $poliza->clave }}" class="form-control" placeholder="Clave">
                            </div>
                            <div class="crudFormItems">
                                <label for="dni">Tipo de Poliza:
                                    @if($errors->first('tipoPoliza'))
                                        <p class="text-danger"><em>{{ $errors->first('tipoPoliza')}}</em></p>
                                    @endif
                                </label>
                                <select class="form-select" name="tipoPoliza" id="tipoPoliza" value="{{ $poliza->tipoPoliza }}">
                                <option value="{{ $poliza->tipoPoliza }}" selected>Valor previo: {{ $poliza->tipoPoliza }}</option>
                                    <option value="Daños">Seguro contra Daños</option>
                                    <option value="Vida">Seguro de Vida</option>
                                    <option value="Medico">Seguro Médico</option>
                                </select>
                            </div>
                            <div class="crudFormItems">
                                <label for="dni">Archivo de la Póliza:
                                    @if($errors->first('rutaArchivo'))
                                        <p class="text-danger"><em>{{ $errors->first('rutaArchivo')}}</em></p>
                                    @endif
                                </label>

                                <input type="file" accept=".pdf, .xlsx, .docx" name="rutaArchivo" id="rutaArchivo" value="{{ $poliza->rutaArchivo }}" class="form-control">
                            </div>
                            
                            <div class="crudFormItems">
                                <label for="dni">
                                    Cliente que tiene esta póliza:
                                    @if($errors->first('polizaId'))
                                        <p class="text-danger"><em>{{ $errors->first('polizaId')}}</em></p>
                                    @endif
                                </label>
                                <select class="form-select" name="usuarioId" id="usuarioId" value="">
                                    <option selected>Seleccione un cliente</option>
                                    @foreach($usuarios as $usuario)
                                        @if($usuario->rol == "Cliente")
                                            <option value="{{ $usuario->id }}">{{ $usuario->id }} - {{ $usuario->nombre }} {{ $usuario->apellidoPaterno }} {{ $usuario->apellidoMaterno }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="crudFormItems">
                                <label for="dni">
                                    Venta en la que se incluye esta Póliza
                                    @if($errors->first('ventaId'))
                                        <p class="text-danger"><em>{{ $errors->first('ventaId')}}</em></p>
                                    @endif
                                </label>
                                <select class="form-select" name="ventaId" id="ventaId" value="{{ $poliza->ventaId }}">
                                    <option selected>Seleccione la venta</option>
                                    @foreach($ventas as $venta)
                                        <option value="{{ $venta->id }}">{{ $venta->clave }} - {{ $venta->created_at }}</option>
                                    @endforeach
                                </select>
                            </div>                   
            
                            <div class="modal-footer">
                                <button type="button" class="crudButtonFormCancel" data-bs-dismiss="modal">Cancelar</button>
                                <input class ="crudButtonFormAccept" type="submit" value="Guardar" >
                            </div>

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