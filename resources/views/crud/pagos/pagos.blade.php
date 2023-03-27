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

    <!-- <center>
        <form action="{{route('filterUsers')}}" method="GET" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="divFilters">
                <div class="divSelect">
                        <p class="selectText">Buscar:</p>
                        <input type="text" oninput="validarNombre()" name="nombre" id="nombre" value="" class="form-control" placeholder="Nombre">                
                </div>
                
                <div class="divSelect">
                        <p class="selectText">Buscar:</p>
                        <select class="form-select" name="activo" id="activo" value="1">
                            <option selected>Selecciona una opción</option>
                            <option value="1">Activos</option>
                            <option value="2">Inactivos</option>
                            <option value="3">Todos</option>
                        </select>
                </div>
                    <input type="submit" value="Filtrar" class="crudButton">
            </div>
        </form>
    </center>
    <br> -->
    
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
</body>
</html>