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
        @foreach($usuarios as $usuario)
            <h2> Bienvenido {{ $usuario->nombre }} {{ $usuario->apellidoPaterno }} {{ $usuario->apellidoMaterno }}</h2>
            <br>
            <br>
            @foreach($usuarios_polizas as $usuario_poliza)
                @if($usuario->id == $usuario_poliza->usuarioId)
                        @foreach($polizas as $poliza)
                            @if($poliza->id == $usuario_poliza->polizaId)
                                
                                        @if( $poliza->tipoPoliza == "Daños")
                                            <!-- <div class="divContainer">
                                                <div>
                                                    <h1 class="divContainerText"> Seguro de daños </h1>
                                                    <h2 class="divContainerText">Registrado con la fecha: {{ $poliza->fechaDeRegistro }}</h2>
                                                </div> 
                                                <div>
                                                    <iframe width="400" height="400" src="{{asset('pdf/polizas/'.$poliza->rutaArchivo)}}" frameborder="0"></iframe>
                                                </div> 
                                            </div> -->
                                            <div class="wrap animate pop">
                                                    <div class="overlay">
                                                        <div class="overlay-content animate slide-left delay-2">
                                                            <h1 class="animate slide-left pop delay-4">Seguro de Daños</h1>
                                                            <p class="animate slide-left pop delay-5" style="color: white; margin-bottom: 2.5rem;">Registrado con la fecha: {{ $poliza->fechaDeRegistro }}</p>
                                                        </div>
                                                        <div class="image-content animate slide delay-5"></div>
                                                        </div>
                                                        <div class="text">
                                                            <iframe width="400" height="400" src="{{asset('pdf/polizas/'.$poliza->rutaArchivo)}}" frameborder="0"></iframe>
                                                        </div>
                                            </div>
                                        @else
                                            @if( $poliza->tipoPoliza  == "Medico")
                                                <div class="wrap animate pop">
                                                    <div class="overlay">
                                                        <div class="overlay-content animate slide-left delay-2">
                                                            <h1 class="animate slide-left pop delay-4">Seguro Médico</h1>
                                                            <p class="animate slide-left pop delay-5" style="color: white; margin-bottom: 2.5rem;">Registrado con la fecha: {{ $poliza->fechaDeRegistro }}</p>
                                                        </div>
                                                        <div class="image-content animate slide delay-5"></div>
                                                        </div>
                                                        <div class="text">
                                                            <iframe width="400" height="400" src="{{asset('pdf/polizas/'.$poliza->rutaArchivo)}}" frameborder="0"></iframe>
                                                            <!-- <p class="pText">Otorga una indemnización (reembolso) al asegurado por los gastos médicos incurridos, cubiertos en la póliza contratada.</p> -->
                                                        </div>
                                                </div>
                                            @else
                                                @if( $poliza->tipoPoliza  == "Vida")
                                                    <div class="wrap animate pop">
                                                        <div class="overlay">
                                                            <div class="overlay-content animate slide-left delay-2">
                                                                <h1 class="">Seguro de Vida</h1>
                                                                <p class="" style="color: white; margin-bottom: 2.5rem;">Registrado con la fecha: {{ $poliza->fechaDeRegistro }}</p>
                                                            </div>
                                                            <div class="image-content animate slide delay-5"></div>
                                                            </div>
                                                            <div class="text">
                                                                <iframe width="400" height="400" src="{{asset('pdf/polizas/'.$poliza->rutaArchivo)}}" frameborder="0"></iframe>
                                                            </div>
                                                    </div>
                                                @endif
                                            @endif
                                        @endif
                                        
                                    
                                
                            @endif
                        @endforeach
                @endif
                <br>
                <br>
            @endforeach
                
            
        @endforeach
    <br>
    <br>
    @include('layouts.footer')
</body>
</html>