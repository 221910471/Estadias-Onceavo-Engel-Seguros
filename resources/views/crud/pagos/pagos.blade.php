<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagos</title>
    <link rel="stylesheet" href="css/crud.css">
</head>
<body>
    @include('layouts.navbar')
    <div>
        <h2 class="crudH2">Pagos</h2>
        <hr>
    </div>

    <center class="divSeparateFilters">

        <form action="{{route('filterFechaPago')}}" method="GET" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="divFilterUnique">
                <div class="divSelect2">
                        <p class="selectText">Buscar:</p>
                        <input type="date" name="fecha" id="fecha" class="form-control" placeholder="Clave">                
                </div>
                    <input type="submit" value=">" class="crudButton">
            </div>
        </form>

        <form action="{{route('filterEstadoPago')}}" method="GET" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="divFilterUnique">
                <div class="divSelect2">
                        <p class="selectText">Buscar:</p>
                        <select class="form-select" name="estado" id="estado" value="1" placeholder="Estado del pago">
                            <option selected>Estado del pago</option>
                            <option value="1">Pagado</option>
                            <option value="2">Por pagar</option>
                            <option value="3">Todos</option>
                        </select>
                </div>
                    <input type="submit" value=">" class="crudButton">
            </div>
        </form>

        <form action="{{route('filterActivoPago')}}" method="GET" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="divFilterUnique">
                <div class="divSelect2">
                        <p class="selectText">Buscar:</p>
                        <select class="form-select" name="activo" id="activo" value="1" placeholder="Estado del registro">
                            <option selected>Estado del registro</option>
                            <option value="1">Activos</option>
                            <option value="2">Inactivos</option>
                            <option value="3">Todos</option>
                        </select>
                </div>
                    <input type="submit" value=">" class="crudButton">
            </div>
        </form>
    </center>
    <br>
    
    @include('crud.pagos.createPago')

    <br>
    <center>
        @if(Session::has('mensaje'))
            <div class="alert alert-danger">{{Session::get('mensaje')}}</div>
        @endif
        <div class="">
            <table class="crudTable">
                <tbody>
                    <tr>
                        <th>#</th>
                        <!-- <th>Clave</th> -->
                        <th>Fecha de pago</th>
                        <th>Fecha Límite</th>
                        <th>Estado</th>
                        <th>Monto</th>
                        <th>Póliza del pago</th>
                        <th>Editar</td>
                        <th>Detalle</td>
                        <th>Eliminar</td>
                    </tr>
                    <?php
                        $contador = 0;
                    ?>
                    @foreach($pagos as $pago)
                        <?php
                            $contador = $contador+1;
                        ?>
                        <tr>
                            <!-- <td>{{ $pago->id }}</td> -->
                            <td>{{ $contador }}</td>
                            <td>{{ $pago->fechaDePago }}</td>
                            <td>{{ $pago->fechaLimiteDePago }}</td>
                            <td>{{ $pago->estado }}</td>
                            <td>{{ $pago->montoDePago }}</td>
                            <td>
                                @foreach($polizas as $poliza)
                                    @if($pago->polizaId == $poliza->id)
                                        {{ $poliza->id }} - {{ $poliza->clave }}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                <center>
                                    @include('crud.pagos.editPago')
                                </center>
                            </td>
                            <td>
                                <center>
                                    @include('crud.pagos.showPago')
                                </center>
                            </td>
                            <td>
                                <center>
                                    @if($pago->deleted_at)
                                        @include('crud.pagos.activatePago')
                                    @else
                                        @include('crud.pagos.deletePago')
                                    @endif
                                </center>  
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </center>
    
    <br>
    <br>
    <br>
    @include('layouts.footer')

    <script type="text/javascript">

        function calcularSubtotal() {
            const monto = document.getElementById('montoDePago');
            const descuento = document.getElementById('descuentoRealizado');
            const subtotal = document.getElementById('subtotal');
            const subtotalInput = document.getElementById('subtotalInput');

            var valorMonto = monto.value;
            var valorDescuento = descuento.value;
            var porcentajeDescuento = valorDescuento/100;
            var valorDelDescuento = valorMonto*porcentajeDescuento;
            var valorSubtotal = valorMonto-valorDelDescuento;
            if(valorMonto != '' && valorDescuento != 'Ninguno'){
                document.getElementById("subtotal").style.display = "block";
                document.getElementById("subtotalInput").value = valorSubtotal;
            }
            else{
                // document.getElementById("subtotal").style.display = "none";
                document.getElementById("subtotalInput").value = valorMonto;
            }

            
        }
    </script>
</body>
</html>