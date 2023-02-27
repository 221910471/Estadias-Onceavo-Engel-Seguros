<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Poliza</title>
    <link rel="stylesheet" href="css/home.css">
</head>
<body>
    @include('layouts.navbar')
    <br>
    <br>
    <center>
        @foreach($usuarios as $usuario)
            <h2> Bienvenido {{ $usuario->nombre }} {{ $usuario->apellidoPaterno }} {{ $usuario->apellidoMaterno }}</h2>
            <br>
            <br>
            <div class="divCard">

                @foreach($usuarios_polizas as $usuario_poliza)
                    @if($usuario->id == $usuario_poliza->usuarioId)
                        @foreach($polizas as $poliza)
                            @if($poliza->id == $usuario_poliza->polizaId)
                                <div class="divContainer">
                                    <div>
                                        <iframe width="400" height="400" src="{{asset('pdf/polizas/'.$poliza->rutaArchivo)}}" frameborder="0"></iframe>
                                    </div>
                                    <div>
                                        <h1 class="divContainerText">Póliza: {{ $poliza->clave }}</h1>
                                        <h2 class="divContainerText">Registrado con la fecha: {{ $poliza->fechaDeRegistro }}</h2>
                                        <h2 class="divContainerText">Tipo de Poliza registrada:</h2>
                                        <h1 class="divContainerText"> {{ $poliza->tipoPoliza }} </h1>
                                    </div>  
                                </div>
                                
                            @endif
                        @endforeach
                    @endif
                @endforeach
                
            </div>
        @endforeach
    </center>
    <br>
    <br>
    <br>

    @include('layouts.footer')
</body>
</html>