<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar Correos</title>
    <link rel="stylesheet" href="css/crud.css">
</head>
<body>
    @include('layouts.navbar')
    
    <h2 class="crudH2">Enviar Correo</h2>
    <hr>
    @include('mail.createCorreo')
    <br>
    <center>
        @if(Session::has('correo'))
            <div class="alert alert-danger">{{Session::get('correo')}}</div>
        @endif
        <div class="">
            <table class="crudTable">
                <tbody>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <!-- <th>Detalles</th>
                        <th>Editar</td>
                        <th>Eliminar</td> -->
                    </tr>
                    <?php
                        $contador = 0;
                    ?>
                    @foreach($prospectos as $prospecto)
                        <?php
                            $contador = $contador+1;
                        ?>
                        <tr>
                            <td>{{ $contador }}</td>
                            <td>{{ $prospecto->nombre }}</td>
                            <td>{{ $prospecto->telefono }}</td>
                            <td>{{ $prospecto->correoElectronico }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </center>
    
    @include('layouts.footer')
</body>
</html>