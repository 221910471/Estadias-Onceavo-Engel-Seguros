<?php
    $sessionUsuario = session('sessionUsuario');
    $sessionTipo = session('sessionTipo');
    $sessionId = session('sessionId');
?>
<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio Administrador</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    @include('layouts.navbar')
    <br><br>
    <h2>Bienvenido 
        <?php
            echo $sessionUsuario;
            // echo $sessionTipo;
            // echo $sessionId;
        ?>
    </h2>
    <br>
    @include('layouts.footer')
</body>
</html>