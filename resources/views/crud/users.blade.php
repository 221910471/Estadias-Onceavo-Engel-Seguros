<?php
    require_once('../connection.php');
?>
<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personas</title>
    <link rel="stylesheet" href="css/crud.css">
</head>

<body>

    @include('layouts.navbar')
    <div>
        <h2 class="crudH2">Personas</h2>
        <hr>
    </div>

    <center>
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
    <br>
    
    @include('crud.createUser')

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
                        <th>Nombre Completo</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>Rol</th>
                        <th>Activo</th>
                        <th>Detalles</th>
                        <th>Editar</td>
                        <th>Eliminar</td>
                    </tr>
                    <?php
                        $contador = 0;
                    ?>
                    @foreach($usuarios as $usuario)
                        <?php
                            $contador = $contador+1;
                        ?>
                        <tr>
                            <!-- <td>{{ $usuario->id }}</td> -->
                            <td>{{ $contador }}</td>
                            <td>{{ $usuario->nombre }} {{ $usuario->apellidoPaterno }} {{ $usuario->apellidoMaterno }}</td>
                            <td>{{ $usuario->telefono }}</td>
                            <td>{{ $usuario->correoElectronico }}</td>
                            <td>{{ $usuario->rol }}</td>
                            <td>
                                    @if($usuario->deleted_at)
                                        NO
                                    @else
                                        SI
                                    @endif
                            </td>
                            <td>
                                <center>
                                    @include('crud.editUser')
                                </center>
                            </td>
                            <td>
                                <center>
                                    @include('crud.showUser')
                                </center>
                            </td>
                            <td>
                                <center>
                                    @if($usuario->deleted_at)
                                        @include('crud.activateUser')
                                    @else
                                        @include('crud.deleteUser')
                                    @endif
                                </center>  
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </center>
    <div class="buttonsFiles">
    <a href="{{ route('pdfUsuarios') }}"><button class="crudButtonPDF">Generar PDF</button></a>
    </div>
    <br>
    <br>
    <br>
    @include('layouts.footer')

    <script type="text/javascript">
        function validarNombre() {
            const inputNombre = document.getElementById("nombre");
            const nombreRegex = /^[a-zA-Z]+$/; // Expresión regular para validar solo letras

            if (!nombreRegex.test(inputNombre.value)) {
                inputNombre.setCustomValidity("Solo se permiten letras");
            } else {
                inputNombre.setCustomValidity("");
            }
        }
    </script>

    <script type="text/javascript">
        function filtrarFecha() {
            const inputFecha = document.getElementById("nombre");

            
        }
    </script>
</body>
</html>