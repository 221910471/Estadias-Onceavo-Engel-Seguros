<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>codigos</title>
    <link rel="stylesheet" href="css/crud.css">
</head>

<body>

    @include('layouts.navbar')
    <div>
        <h2 class="crudH2">Códigos de descuento</h2>
        <hr>
    </div>

    <center class="divSeparateGenerate">
        <form action="{{route('generarCodigos')}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="divFormGenerate">
                <div class="divSelectGenerateForm">
                        <p class="selectText">Cantidad de códigos:</p>
                        <input type="number" name="numero" id="numero" value="" class="form-control" placeholder="# de códigos">                
                </div>
                <div class="divSelectGenerateForm">
                        <p class="selectText">Porcentaje de descuento %:</p>
                        <input type="number" name="porcentaje" id="porcentaje" value="" class="form-control" placeholder="%">                
                </div>
                    <input type="submit" value="Generar códigos nuevos" class="crudButton">
            </div>
        </form>

    </center>

    <br>
    <center>
        @if(Session::has('mensaje'))
            <div class="alert alert-danger">{{Session::get('mensaje')}}</div>
        @endif
        <div class="">
            <table class="crudTable">
                <tbody>
                    <tr>
                        <th>#</th>
                        <th>Código</th>
                        <th>Usuario que uso el código</th>
                        <th>Porcentaje de descuento</th>
                        <th>Fecha de vencimiento</th>
                        <th>Estado</td>
                        <th>Eliminar</td>
                    </tr>
                    <?php
                        $contador = 0;
                    ?>
                    @foreach($codigos as $codigo)
                        <?php
                            $contador = $contador+1;
                        ?>
                        <tr>
                            <td>{{ $contador }}</td>
                            <td>{{ $codigo->codigo }}</td>
                            <td>
                                @foreach($usuarios as $usuario)
                                    @if($usuario->id == $codigo->usuarioId)
                                    {{ $usuario->nombre }} {{ $usuario->apellidoPaterno }} {{ $usuario->apellidoMaterno }}
                                    @endif
                                @endforeach
                            </td>
                            <td>{{ $codigo->porcentaje }}%</td>
                            <td>{{ $codigo->fechaDeVencimiento }}</td>
                            <td>
                                @if($codigo->deleted_at)
                                    Usado
                                @else
                                    No usado
                                @endif
                            </td>
                            <td>
                                <center>                                
                                    @if($codigo->deleted_at)
                                        @include('crud.codigos.activarCodigo')
                                    @else
                                        @include('crud.codigos.eliminarCodigo')
                                    @endif
                                </center>  
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </center>
    <br>
    <br>
    <br>
    @include('layouts.footer')

    <script type="text/javascript">

            const inputComision = document.getElementById('comision');

            const avisoComision = document.getElementById('avisoComision');

            const regexNumeros = /([0-9]*[.])?[0-9]+$/; // Expresión regular para permitir solo números y puntos decimales

            // Agregar un evento de escucha de teclado al input
            inputComision.addEventListener('keyup', () => {
                const valor = inputComision.value;
                if (!regexNumeros.test(valor) && valor != "") {
                    inputComision.style.border = '2px solid red'; // Cambiar el borde del input a rojo si el valor no cumple con el patrón
                    inputComision.setCustomValidity("Solo se permiten letras e inicio con una letra mayúscula"); // Envia alerta en caso de no cumplir con el patrón
                    avisoComision.innerHTML = "<p id='avisoComision' class='text-danger' style='text-align: right;'><em>Solo se permiten números y punto decimal</em></p>";
                } else {
                    inputComision.style.border = ''; // Restablecer el borde del input a su estilo predeterminado si el valor cumple con el patrón
                    inputComision.setCustomValidity(""); // Reestablecer la alerta en caso de cumplir con el patrón
                    avisoComision.innerHTML = "";
                }
            });

            const inputComisionEditar = document.getElementById('comisionEditar');

            const avisoComisionEditar = document.getElementById('avisoComisionEditar');

            // Agregar un evento de escucha de teclado al input
            inputComisionEditar.addEventListener('keyup', () => {
                const valor = inputComisionEditar.value;
                if (!regexNumeros.test(valor) && valor != "") {
                    inputComisionEditar.style.border = '2px solid red'; // Cambiar el borde del input a rojo si el valor no cumple con el patrón
                    inputComisionEditar.setCustomValidity("Solo se permiten letras e inicio con una letra mayúscula"); // Envia alerta en caso de no cumplir con el patrón
                    avisoComisionEditar.innerHTML = "<p id='avisoComisionEditar' class='text-danger' style='text-align: right;'><em>Solo se permiten números y punto decimal</em></p>";
                } else {
                    inputComisionEditar.style.border = ''; // Restablecer el borde del input a su estilo predeterminado si el valor cumple con el patrón
                    inputComisionEditar.setCustomValidity(""); // Reestablecer la alerta en caso de cumplir con el patrón
                    avisoComisionEditar.innerHTML = "";
                }
            });


            
        </script>
</body>
</html>