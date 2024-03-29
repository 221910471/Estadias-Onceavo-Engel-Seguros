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

    <center class="divSeparateFilters">
        <form action="{{route('filterAsuntoNotificacion')}}" method="GET" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="divFilterUnique">
                <div class="divSelect2">
                        <p class="selectText">Buscar:</p>
                        <input type="search" name="asunto" id="asunto" value="" class="form-control" placeholder="Asunto">                
                </div>
                    <input type="submit" value=">" class="crudButton">
            </div>
        </form>

        <form action="{{route('filterFechaNotificacion')}}" method="GET" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="divFilterUnique">
                <div class="divSelect2">
                        <p class="selectText">Buscar:</p>
                        <input type="date" name="fecha" id="fecha" class="form-control" placeholder="Fecha Envio">                
                </div>
                    <input type="submit" value=">" class="crudButton">
            </div>
        </form>

        <form action="{{route('filterRemitenteNotificacion')}}" method="GET" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="divFilterUnique">
                <div class="divSelect2">
                        <p class="selectText">Buscar:</p>
                        <select class="form-select" name="remitente" id="remitente" value="" placeholder="Dirigido a">
                            <option selected>Dirigido a</option>
                            @foreach($usuarios as $usuario)
                                @if($usuario->rol == "Cliente")
                                    <option value="{{ $usuario->id }}">{{ $usuario->id }} - {{ $usuario->nombre }} {{ $usuario->apellidoPaterno }} {{ $usuario->apellidoMaterno }}</option>
                                @endif
                            @endforeach
                        </select>
                </div>
                    <input type="submit" value=">" class="crudButton">
            </div>
        </form>
    </center>
    <br>
    
    @include('crud.notificaciones.createNotificacion')

    <br>
    <div class="divNotificacionDsiplay">
        <div>
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
        </div>
        <div class="verticalLine">  
            <center>
                <table class="crudTable">
                    <h5 style="text-align:center;">Próximos Cumpleaños</h5>
                    <tr>
                        <th>Fecha</th>
                        <th>Cumpleañero</th>
                    </tr>
                    @foreach($usuarios as $usuario)
                        <tr>
                            <?php
                                $hoy = date('Y-m-d');

                                $fecha_en_un_mes = date('Y-m-d', strtotime('+1 month'));

                                if (strtotime($usuario->fechaDeNacimiento) >= strtotime($hoy) && strtotime( $usuario->fechaDeNacimiento ) <= strtotime($fecha_en_un_mes)) {
                                        ?>
                                            <td>{{ $usuario->fechaDeNacimiento }}</td>
                                            <td>{{ $usuario->nombre }} {{ $usuario->apellidoPaterno }} {{ $usuario->apellidoMaterno }}</td>
                                        <?php
                                }
                                ?>   
                        </tr>
                    @endforeach
                </table>
            </center>
        </div>
    </div>
    <!-- <div class="buttonsFiles">
    <a href="{{ route('pdfUsuarios') }}"><button class="crudButtonPDF">Generar PDF</button></a>
    </div> -->
    <br>
    <br>
    <br>
    @include('layouts.footer')

    <script type="text/javascript">
        function cambiarInputAsunto() {
            var asunto2 = document.getElementById("asunto2");
            // document.getElementById("asunto").innerHTML = "El texto inicial es: ";
            document.getElementById("asunto").value = "Seleccione un asunto de la lista";
        }

        function cambiarInputAsuntoSelect() {
            var asunto = document.getElementById("asunto");
            // document.getElementById("asunto").innerHTML = "El texto inicial es: ";
            document.getElementById("asunto2").value = "";
        }

        function cambiarInputMensaje() {
            var mensaje2 = document.getElementById("mensaje2");
            // document.getElementById("asunto").innerHTML = "El texto inicial es: ";
            document.getElementById("mensaje").value = "Seleccione un mensaje de la lista";
        }

        function cambiarInputMensajeSelect() {
            var mensaje = document.getElementById("mensaje");
            // document.getElementById("asunto").innerHTML = "El texto inicial es: ";
            document.getElementById("mensaje2").value = "";
        }
    </script>
</body>
</html>