<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personas</title>
    <link rel="stylesheet" href="css/crud.css">
</head>
<body>
    @include('layouts.navbar')
    <div>
        <h2 class="crudH2">Personas</h2>
        <hr>
    </div>

    @include('crud.createUser')

    <center>
        @if(Session::has('mensaje'))
            <div class="alert alert-danger">{{Session::get('mensaje')}}</div>
        @endif
        <div class="">
            <table class="crudTable">
                <tbody>
                    <tr>
                        <th>#</th>
                        <th>Nombre Completo</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>Rol</th>
                        <th>Activo</th>
                        <th>Detalles</th>
                        <th>Editar</td>
                        <th>Eliminar</td>
                    </tr>
                    <?php
                        $contador = 0;
                    ?>
                    @foreach($usuarios as $usuario)
                        <?php
                            $contador = $contador+1;
                        ?>
                        <tr>
                            <!-- <td>{{ $usuario->id }}</td> -->
                            <td>{{ $contador }}</td>
                            <td>{{ $usuario->nombre }} {{ $usuario->apellidoPaterno }} {{ $usuario->apellidoMaterno }}</td>
                            <td>{{ $usuario->telefono }}</td>
                            <td>{{ $usuario->correoElectronico }}</td>
                            <td>{{ $usuario->rol }}</td>
                            <td>{{ $usuario->activo }}</td>
                            <td>
                                <center>
                                    @include('crud.editUser')
                                </center>
                            </td>
                            <td>
                                <center>
                                    @include('crud.showUser')
                                </center>
                            </td>
                            <td>
                                <center>
                                    @if($usuario->deleted_at)
                                        @include('crud.activateUser')
                                    @else
                                        @include('crud.deleteUser')
                                    @endif
                                </center>  
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </center>
    

    @include('layouts.footer')
</body>
</html>