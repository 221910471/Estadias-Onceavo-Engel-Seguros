<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pólizas</title>
    <link rel="stylesheet" href="css/crud.css">
</head>

<body>

    <!-- @include('layouts.navbar') -->
    <div>
        <h2 class="crudH2">Pólizas</h2>
        <br>
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
    
    @include('crud.polizas.createPoliza')
    

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
                        <th>Clave</th>
                        <th>Fecha de Registro</th>
                        <th>Archivo de la Póliza</th>
                        <th>Tipo de Poliza</th>
                        <th>Cliente al que pertenece</th>
                        <th>Activo</th>
                        <th>Detalles</th>
                        <th>Editar</td>
                        <th>Eliminar</td>
                    </tr>
                    <?php
                        $contador = 0;
                    ?>
                    @foreach($polizas as $poliza)
                        <?php
                            $contador = $contador+1;
                        ?>
                        <tr>
                            <!-- <td>{{ $poliza->id }}</td> -->
                            <td>{{ $contador }}</td>
                            <td>{{ $poliza->clave }}</td>
                            <td>{{ $poliza->updated_at }}</td>
                            <td><p>!Dale un vistazo¡ <a href="pdf/polizas/{{ $poliza->rutaArchivo }}" target="_blank" rel="noopener noreferrer">{{ $poliza->rutaArchivo }}</a></p></td>
                            <td>{{ $poliza->tipoPoliza }}</td>
                            
                                @foreach($usuarios_polizas as $data)
                                    @if($poliza->id == $data->polizaId)
                                        <!-- <td>{{ $data->usuarioId }}</td> -->
                                        @foreach($usuarios as $usuario)
                                            @if($usuario->id == $data->usuarioId)
                                                <td>{{$usuario->id}}-{{ $usuario->nombre }} {{ $usuario->apellidoPaterno }} {{ $usuario->apellidoMaterno }}</td>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            
                            

                            <td>
                                    @if($poliza->deleted_at)
                                        NO
                                    @else
                                        SI
                                    @endif
                            </td>
                            <td>
                                
                            </td>
                            <td>
                                <center>
                                    @include('crud.polizas.editPoliza')
                                </center>
                            </td>
                            <td>
                                <center>
                                    @if($poliza->deleted_at)
                                        @include('crud.polizas.activatePoliza')
                                    @else
                                        @include('crud.polizas.deletePoliza')
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

    @include('layouts.footer')

    <script type="text/javascript">
        
    </script>
</body>
</html>