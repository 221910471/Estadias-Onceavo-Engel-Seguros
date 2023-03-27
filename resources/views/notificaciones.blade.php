<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificaciones</title>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/crud.css">
</head>
<body>
    @include('layouts.navbar')
    <br>

    <h2>Notificaciones</h2>
    <div class="cardsNotification" id="vista">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($notificaciones as $notificacion)
                @foreach($usuarios as $usuario)
                    @if($usuario->id == $notificacion->usuarioId)
                        <div class="col">
                            <div class="card h-100">
                                @if( $notificacion->asunto == "Pago")
                                    <img src="img/pago.jpg" class="card-img-top" alt="..." height="200px">
                                    @else
                                        @if( $notificacion->asunto == "Cumpleaños")
                                            <img src="img/cumpleaños.jpg" class="card-img-top" alt="..." height="200px">
                                            @else
                                                @if( $notificacion->asunto == "Seguro")
                                                    <img src="img/seguro.png" class="card-img-top" alt="..." height="200px">
                                                    @else
                                                        <img src="img/notificacion.png" class="card-img-top" alt="..." height="200px">
                                                @endif
                                        @endif
                                @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $notificacion->asunto }}</h5>
                                <p class="card-text">{{ $notificacion->mensaje }}</p>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">{{ $notificacion->fechaEnvio }}</small>
                            </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endforeach

        </div>
    </div>
    <div>{{ $notificaciones->links()}}</div>


    <br><br>

    @include('layouts.footer')

</body>
</html>