<!doctype html>
<html lang="es-MX">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Footer</title>
    <link rel="stylesheet" href="css/footer.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body>
  <div class="gridContainerFooter">
      <div class="grid-item1">
        <div class="gridContainerFooterItem1">
            <h4 class="gridContainerFooterItem1Text">Contactanos:</h4>
            <p class="gridContainerFooterItem1Text">Teléfono: 729 233 2811</p>
            <p class="gridContainerFooterItem1Text">Más información: <a href="{{ route('home.index') }}">@engelseguros.com</a></p>
        </div>
      </div>
      <div class="grid-item2">
        <div>
          <div class="gridContainerFooterItem1">
              <h5 class="gridContainerFooterItem2">Buscanos en nuestras redes sociales:</h5>
              <a href="https://www.facebook.com/engelseguros/"><img class="gridContainerFooterItem2" src="img/facebook.png" alt="Icono facebook"></a>
              <img class="gridContainerFooterItem2" src="img/whatsapp.png" alt="Icono facebook">
              <a href="https://www.instagram.com/engelseguros/"><img class="gridContainerFooterItem2" src="img/instagram.png" alt="Icono instagram"></a>
              <!-- <p>729 233 2811</p> -->

          </div>
        </div>
      </div>
      <div class="grid-item3">
        <div>
          <a href="{{ route('home.index') }}"><img class="gridContainerFooterItem3Image" src="img/logo2.png" alt="Logo Principal"></a>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>