<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    @include('layouts.navbar')
    <div class="containerLogin">
        <div class="">
            <img src="img/logo.png" class="mainImage" alt="Imagen principal">
        </div>
        <div class="centerModal">
                <h1>Inicio de sesión</h1>
                <hr>
                <form action="{{ route('validar') }}" method = "POST">
                    {{csrf_field()}}
                    <div class="">
                        <div class="itemform">
                            <label for="dni">Correo:
                                @if($errors->first('correoElectronico'))
                                    <p class="text-danger"><em>{{ $errors->first('correoElectronico')}}</em></p>
                                @endif
                            </label>

                            <input type="text" name="correoElectronico" id="correoElectronico" value="" class="form-control" placeholder="Correo Electrónico">
                        </div>
                        <div class="itemform">
                            <label for="dni">Contraseña:
                                @if($errors->first('contrasena'))
                                    <p class="text-danger"><em>{{ $errors->first('contrasena')}}</em></p>
                                @endif
                            </label>

                            <input type="password" name="contrasena" id="contrasena" value="" class="form-control" placeholder="Contraseña">
                        </div>
                        <br>
                        <div class="row">
                            <div class="itemform">
                                <input class ="cardButton" type="submit" value="Entrar" >
                            </div>
                        </div>
                    </div>

                </form>
                <br>
                <br>
                @if(Session::has('mensaje'))
                    <div class="alert alert-danger">{{Session::get('mensaje')}}</div>
                @endif
        </div>
    </div>
    @include('layouts.footer')
</body>
</html>