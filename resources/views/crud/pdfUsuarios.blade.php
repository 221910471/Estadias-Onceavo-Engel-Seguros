<?php
    require_once('../connection.php');
?>
<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte</title>
    <link rel="stylesheet" href="css/crud.css">
</head>
<body>
    <h1>Reporte de usuarioActivos</h1>
    <br><br>
    <center>
        <h2>Usuarios Activos</h2>
        <table class="crudTable">
            <tbody>
                        <tr>
                            <th>#</th>
                            <th>Nombre Completo</th>
                            <th>Teléfono</th>
                            <th>Correo</th>
                            <th>Rol</th>
                            <th>Activo</th>
                        </tr>
                        <?php
                            $contador = 0;
                        ?>
                        @foreach($usuariosActivos as $usuarioActivo)
                            <?php
                                $contador = $contador+1;
                            ?>
                            <tr>
                                <!-- <td>{{ $usuarioActivo->id }}</td> -->
                                <td>{{ $contador }}</td>
                                <td>{{ $usuarioActivo->nombre }} {{ $usuarioActivo->apellidoPaterno }} {{ $usuarioActivo->apellidoMaterno }}</td>
                                <td>{{ $usuarioActivo->telefono }}</td>
                                <td>{{ $usuarioActivo->correoElectronico }}</td>
                                <td>{{ $usuarioActivo->rol }}</td>
                                <td>
                                        @if($usuarioActivo->deleted_at)
                                            Inactivo
                                        @else
                                            Activo
                                        @endif
                                </td>
                                
                            </tr>
                        @endforeach
            </tbody>
        </table>
        <br><br>
        <h2>Usuarios Inactivos</h2>
        <table class="crudTable">
            <tbody>
                        <tr>
                            <th>#</th>
                            <th>Nombre Completo</th>
                            <th>Teléfono</th>
                            <th>Correo</th>
                            <th>Rol</th>
                            <th>Activo</th>
                        </tr>
                        <?php
                            $contador = 0;
                        ?>
                        @foreach($usuariosInactivos as $usuarioInactivo)
                            <?php
                                $contador = $contador+1;
                            ?>
                            <tr>
                                <!-- <td>{{ $usuarioActivo->id }}</td> -->
                                <td>{{ $contador }}</td>
                                <td>{{ $usuarioInactivo->nombre }} {{ $usuarioInactivo->apellidoPaterno }} {{ $usuarioInactivo->apellidoMaterno }}</td>
                                <td>{{ $usuarioInactivo->telefono }}</td>
                                <td>{{ $usuarioInactivo->correoElectronico }}</td>
                                <td>{{ $usuarioInactivo->rol }}</td>
                                <td>
                                        @if($usuarioInactivo->deleted_at)
                                            Inactivo
                                        @else
                                            Activo
                                        @endif
                                </td>
                                
                            </tr>
                        @endforeach
            </tbody>
        </table>
        <br><br>
    </center>
   
</body>
</html>