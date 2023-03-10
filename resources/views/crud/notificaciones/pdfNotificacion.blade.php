<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte</title>
</head>
<body>
    <h2>Lista de usuarios</h2>
    <table>
        @foreach($usuarios as $usuario)
        <tr>
        
            <td>{{ $usuario->nombre }} {{ $usuario->apellidoPaterno }} {{ $usuario->apellidoMaterno }}</td>
        
        </tr>
        @endforeach
    </table>

</body>
</html>