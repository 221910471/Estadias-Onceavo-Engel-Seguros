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
            @foreach($usuarios_polizas as $usuario_poliza)
                @if($usuario->id == $usuario_poliza->usuarioId)
                    <div class="divCard">
                        @foreach($polizas as $poliza)
                            @if($poliza->id == $usuario_poliza->polizaId)
                                
                                        @if( $poliza->tipoPoliza == "Daños")
                                            <div class="divContainer">
                                                <div>
                                                    <h1 class="divContainerText"> Seguro de daños </h1>
                                                    <h2 class="divContainerText">Registrado con la fecha: {{ $poliza->fechaDeRegistro }}</h2>
                                                </div> 
                                                <div>
                                                    <iframe width="400" height="400" src="{{asset('pdf/polizas/'.$poliza->rutaArchivo)}}" frameborder="0"></iframe>
                                                </div> 
                                            </div>
                                        @else
                                            @if( $poliza->tipoPoliza  == "Medico")
                                                <div class="divContainer">
                                                    <div>
                                                        <h1 class="divContainerText"> Seguro Médico </h1>
                                                        <h2 class="divContainerText">Registrado con la fecha: {{ $poliza->fechaDeRegistro }}</h2>
                                                    </div>      
                                                    <div>
                                                        <iframe width="400" height="400" src="{{asset('pdf/polizas/'.$poliza->rutaArchivo)}}" frameborder="0"></iframe>
                                                    </div>
                                                </div>
                                            @else
                                                @if( $poliza->tipoPoliza  == "Vida")
                                                    <div class="divContainer">
                                                        <div>
                                                            <h1 class="divContainerText"> Seguro de Vida </h1>
                                                            <h2 class="divContainerText">Registrado con la fecha: {{ $poliza->fechaDeRegistro }}</h2>
                                                        </div>     
                                                        <div>
                                                            <iframe width="400" height="400" src="{{asset('pdf/polizas/'.$poliza->rutaArchivo)}}" frameborder="0"></iframe>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif
                                        @endif
                                        
                                    
                                
                            @endif
                        @endforeach
                    </div>
                @endif
                <br>
                <br>
            @endforeach
                
            
        @endforeach
    </center>
    <br>
    <br>
    <br>

    @include('layouts.footer')
</body>
</html>