<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar Correos</title>
</head>
<body>
    @include('layouts.navbar')
    <div>
        <h2 class="crudH2">Correo</h2>
        <hr>
    </div>
    <div>
        <a href="{{ route('enviarCorreo') }}"><button>Enviar correo</button></a>
    </div>
    @include('layouts.footer')
</body>
</html>