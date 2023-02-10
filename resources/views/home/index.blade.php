<!doctype html>
<html lang="es-MX">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inicio</title>
    <link rel="stylesheet" href="css/nav.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body>
    @include('layouts/navbar')
    
    <!-- Bloque de código del carrusel principal con bootstrap -->
    <div id="carouselExampleRide" class="carousel slide" data-bs-ride="true">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="img/_designed_with_EDIT.org (1).jpg" class="d-block w-100 sizeCarousel" alt="...">
        </div>
        <div class="carousel-item">
          <img src="img/_designed_with_EDIT.org.jpg" class="d-block w-100 sizeCarousel" alt="...">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
    <!-- conjunto de cartas en el inicio --> 
    <div class="grid-container">
      <div class="grid-item1">
        <div class="cardTextSize">
          <div>
            <h2 class="cardTitle">Seguro de Vida y Gastos Médicos</h2>
            <span class="cardMessage">El seguro es un contrato que permite cubrir una contingencia pagando por ello una prima (el asegurado) a la compañía aseguradora o reaseguradora.</span>  
          </div>
        </div>
      </div>
      <div class="grid-item2">
        <img class="cardImageSize" src="https://imgs.search.brave.com/S00THftaiv0FrtGP_7EWntleLGL8ueXFcSnNTrXNtV8/rs:fit:711:225:1/g:ce/aHR0cHM6Ly90c2U0/Lm1tLmJpbmcubmV0/L3RoP2lkPU9JUC5X/NjV2UFFwZTNhRFMy/c0dfR2RfTEJBSGFF/OCZwaWQ9QXBp" alt="Imagen seguro contra daños">
      </div>
    </div>
    <div class="grid-container2">
      <div class="grid-item2">
        <img class="cardImageSize" src="https://imgs.search.brave.com/0rVhnCAgFN2-5ZEO4Y3F0jJl-H6USkIVx-qLfKSRsGQ/rs:fit:854:225:1/g:ce/aHR0cHM6Ly90c2Ux/LmV4cGxpY2l0LmJp/bmcubmV0L3RoP2lk/PU9JUC5zdUhKMllJ/QzdqT0RTV0s4NkdK/MnZBSGFFSCZwaWQ9/QXBp" alt="Imagen seguro médico">
      </div>
      <div class="grid-item1">
        <div class="cardTextSize">
          <div>
            <h2 class="cardTitle">Seguro de Contra daños</h2>
            <span class="cardMessage">El seguro es un contrato que permite cubrir una contingencia pagando por ello una prima (el asegurado) a la compañía aseguradora o reaseguradora.</span>  
          </div>
        </div>
      </div>
    </div>
    <div class="grid-container">
      <div class="grid-item1">
        <div class="cardTextSize">
          <div>
            <h2 class="cardTitle">Seguro de Auto</h2>
            <span class="cardMessage">El seguro es un contrato que permite cubrir una contingencia pagando por ello una prima (el asegurado) a la compañía aseguradora o reaseguradora.</span>  
          </div>
        </div>
      </div>
      <div class="grid-item2">
        <img class="cardImageSize" src="https://imgs.search.brave.com/jRdCznxY-mL0Ubdsos2xUwFFPtWEr6ppcuWdYqEGtjA/rs:fit:1054:225:1/g:ce/aHR0cHM6Ly90c2Ux/Lm1tLmJpbmcubmV0/L3RoP2lkPU9JUC55/cExVOGx3SEEzWjlB/RzdjZTJjekZRSGFE/ViZwaWQ9QXBp" alt="Imagen seguro de auto">
      </div>
    </div>


    @include('layouts/footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>