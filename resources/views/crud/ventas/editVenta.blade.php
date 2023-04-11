<!-- Modal del edicion de venta -->
<div>
        <!-- Button trigger modal -->
        <button type="button" class="crudButtonTable" data-bs-toggle="modal" data-bs-target="#editVenta{{ $venta->id }}">
            Editar
        </button>

        <!-- Modal -->
        <div class="modal fade" id="editVenta{{ $venta->id }}" tabindex="-1" aria-labelledby="editVentaLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-7" id="editVentaLabel">Editar</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <!-- Formulario para crear nuevo venta -->
                    <form action="{{route('editVenta',$venta->id)}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        @csrf @method('PUT')

                        <div>
                            <div class="crudFormItems">
                                <label for="dni">Clave:
                                    @if($errors->first('clave'))
                                        <p class="text-danger"><em>{{ $errors->first('clave')}}</em></p>
                                    @endif
                                </label>

                                <input type="text" name="clave" id="claveEditar" value="{{ $venta->clave }}" class="form-control" placeholder="Clave">
                                <p id="avisoClaveEditar" class="text-danger"><em></em></p>
                            </div>

                            <div class="crudFormItems">
                                <label for="dni">Comisión:
                                    @if($errors->first('comision'))
                                        <p class="text-danger"><em>{{ $errors->first('comision')}}</em></p>
                                    @endif
                                </label>

                                <input type="text" name="comision" id="comisionEditar" value="{{ $venta->comision }}" class="form-control" placeholder="Comisión">
                                <p id="avisoComisionEditar" class="text-danger"><em></em></p>
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