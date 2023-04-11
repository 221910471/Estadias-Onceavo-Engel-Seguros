<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventas</title>
    <link rel="stylesheet" href="css/crud.css">
</head>

<body>

    @include('layouts.navbar')
    <div>
        <h2 class="crudH2">Ventas</h2>
        <hr>
    </div>

    <!-- <center>
        <form action="{{route('filterUsers')}}" method="GET" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="divFilters">
                <div class="divSelect">
                        <p class="selectText">Buscar:</p>
                        <input type="text" oninput="validarNombre()" name="nombre" id="nombre" value="" class="form-control" placeholder="Nombre">                
                </div>
                
                <div class="divSelect">
                        <p class="selectText">Buscar:</p>
                        <select class="form-select" name="activo" id="activo" value="1">
                            <option selected>Selecciona una opción</option>
                            <option value="1">Activos</option>
                            <option value="2">Inactivos</option>
                            <option value="3">Todos</option>
                        </select>
                </div>
                    <input type="submit" value="Filtrar" class="crudButton">
            </div>
        </form>
    </center>
    <br> -->
    
    @include('crud.ventas.createVenta')

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
                        <th>Clave</th>
                        <th>Comisión</th>
                        <th>Registrado por</th>
                        <th>Fecha de Regsitro</th>
                        <th>Editar</td>
                        <th>Eliminar</td>
                    </tr>
                    <?php
                        $contador = 0;
                    ?>
                    @foreach($ventas as $venta)
                        <?php
                            $contador = $contador+1;
                        ?>
                        <tr>
                            <td>{{ $contador }}</td>
                            <td>{{ $venta->clave }}</td>
                            <td>$ {{ $venta->comision }} MXN</td>
                            <td>
                                @foreach($usuarios as $usuario)
                                    @if($usuario->id == $venta->usuarioId)
                                    {{ $usuario->nombre }} {{ $usuario->apellidoPaterno }} {{ $usuario->apellidoMaterno }}
                                    @endif
                                @endforeach
                            </td>
                            <td>{{ $venta->fecha }}</td>
                            <td>
                                <center>
                                    @include('crud.ventas.editVenta')
                                </center>
                            </td>
                            <td>
                                <center>                                
                                    @if($venta->deleted_at)
                                        @include('crud.ventas.activateVenta')
                                    @else
                                        @include('crud.ventas.deleteVenta')
                                    @endif
                                </center>  
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </center>
    <!-- <div class="buttonsFiles">
    <a href="{{ route('pdfUsuarios') }}"><button class="crudButtonPDF">Generar PDF</button></a>
    </div> -->
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