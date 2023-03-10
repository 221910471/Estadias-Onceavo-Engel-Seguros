<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificaciones</title>
    <link rel="stylesheet" href="css/crud.css">
</head>

<body>

    @include('layouts.navbar')
    <div>
        <h2 class="crudH2">Notificaciones</h2>
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
    
    @include('crud.notificaciones.createNotificacion')

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
                        <th>Fecha de envio</th>
                        <th>Titulo</th>
                        <th>Asunto</th>
                        <!-- <th>Mensaje</td> -->
                        <th>Dirigido a</td>
                        <th>Editar</td>
                        <th>Detalles</td>
                        <th>Eliminar</td>
                    </tr>
                    <?php
                        $contador = 0;
                    ?>
                    @foreach($notificaciones as $notificacion)
                        <?php
                            $contador = $contador+1;
                        ?>
                        <tr>
                            <td>{{ $contador }}</td>
                            <td>{{ $notificacion->fechaEnvio }}</td>
                            <td>{{ $notificacion->titulo }}</td>
                            <td>{{ $notificacion->asunto }}</td>
                            <!-- <td>{{ $notificacion->mensaje }}</td> -->
                            <td>
                                @foreach($usuarios as $usuario)
                                    @if($usuario->id == $notificacion->usuarioId)
                                    {{ $usuario->nombre }} {{ $usuario->apellidoPaterno }} {{ $usuario->apellidoMaterno }}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                <center>
                                    @include('crud.notificaciones.editNotificacion')
                                </center>
                            </td>
                            <td>
                                <center>
                                    @include('crud.notificaciones.showNotificacion')
                                </center>
                            </td>
                            <td>
                                <center>
                                    @include('crud.notificaciones.deleteNotificacion')
                                </center>  
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </center>
    <!-- <div class="buttonsFiles">
    <a href="{{ route('pdfUsuarios') }}"><button class="crudButtonPDF">Generar PDF</button></a>
    </div> -->
    <br>
    <br>
    <br>
    @include('layouts.footer')
</body>
</html>