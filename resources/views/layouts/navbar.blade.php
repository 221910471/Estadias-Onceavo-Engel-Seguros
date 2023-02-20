<?php
    $sessionUsuario = session('sessionUsuario');
    $sessionTipo = session('sessionTipo');
    $sessionId = session('sessionId');
?>
<!doctype html>
<html lang="es-MX">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Footer</title>
    <link rel="stylesheet" href="css/nav.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body>
    <nav>
      <a href="{{ route('home.index') }}"><img class="imageNavBar" src="img/logo.png" alt="logo empresarial"></a>
      <!-- validación de lo que ve cada uno de los usuarios en la barra de navegacion superior -->
      @if($sessionTipo == '')
      <!-- <a href="#"><p>usted NO TIENE SESION ACTIVA</p></a> -->
      <a href="" class="linkNav"><p class="navItem">Conocer más</p></a>
      <a href="" class="linkNav"><p class="navItem">Póliticas y Términos</p></a>
      <a href="{{ route('login') }}"><button class="navButton">Iniciar sesión</button></a>
      @else
        @if($sessionTipo == 'Administrador' || $sessionTipo == 'Interno')
        <!-- <a href="#"><p>usted es un ADMIN</p></a> -->
        <a href="{{ route('home') }}" class="linkNav"><p class="navItem">Inicio</p></a>
        <a href="{{ route('users') }}" class="linkNav"><p class="navItem">Personas</p></a>
        <a href="" class="linkNav"><p class="navItem">Pólizas</p></a>
        <a href="" class="linkNav"><p class="navItem">Ventas</p></a>
        <a href="{{ route('cerrarSesion') }}"><button class="navButton">Cerrar sesión</button></a>
        @else
          @if($sessionTipo == 'Cliente')
          <!-- <a href="#"><p>usted es un cliente</p></a> -->
          <a href="{{ route('cerrarSesion') }}"><button class="navButton">Cerrar sesión</button></a>
          @else
            <!-- <a href="#"><p>usted NO TIENE SESION ACTIVA</p></a> -->
            <a href="{{ route('login') }}"><button class="navButton">Iniciar sesión</button></a>
          @endif
        @endif
      @endif

    </nav>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>