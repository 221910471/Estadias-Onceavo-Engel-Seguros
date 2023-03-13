<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar Correos</title>
    <link rel="stylesheet" href="css/crud.css">
</head>
<body>
    @include('layouts.navbar')
    <div>
        <h2 class="crudH2">Enviar Correo</h2>
        <hr>
        <form action="{{route('enviarCorreo')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div>
                        <div class="crudFormItems">
                                <label for="dni">Titulo:
                                    @if($errors->first('titulo'))
                                        <p class="text-danger">{{ $errors->first('titulo')}}</p>
                                    @endif
                                </label>

                                <input type="text" name="titulo" id="titulo" value="{{ old('titulo') }}" class="form-control" placeholder="Titulo">
                            </div>
                            <div class="crudFormItems">
                                <label for="dni">Asunto:
                                    @if($errors->first('asunto'))
                                        <p class="text-danger">{{ $errors->first('asunto')}}</p>
                                    @endif
                                </label>

                                <input type="text" name="asunto" id="asunto" value="{{ old('asunto') }}" class="form-control" placeholder="Asunto">
                            </div>
                            <div class="crudFormItems">
                                <label for="dni">Mensaje:
                                    @if($errors->first('mensaje'))
                                        <p class="text-danger">{{ $errors->first('mensaje')}}</p>
                                    @endif
                                </label>

                                <input type="textArea" name="mensaje" id="mensaje" value="{{ old('mensaje') }}" class="form-control" placeholder="Mensaje">
                            </div>

                            <div class="modal-footer">
                                <input class ="crudButtonFormAccept" type="submit" value="Enviar" >
                            </div>

                        </div>
                    </form>
                    <br>
                    @if(Session::has('mensaje'))
                        <div class="alert alert-danger">{{Session::get('mensaje')}}</div>
                    @endif
    </div>
    
    @include('layouts.footer')
</body>
</html>