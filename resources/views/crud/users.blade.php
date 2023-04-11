<?php
    require_once('../connection.php');
?>
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

    <center>
        <form action="{{route('filterUsers')}}" method="GET" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="divFilters">
                <div class="divSelect">
                        <p class="selectText">Buscar:</p>
                        <input type="text" oninput="validarNombre()" name="nombre" id="nombre2" value="" class="form-control" placeholder="Nombre">                
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
    <br>
    
    @include('crud.createUser')

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
                            <td>
                                    @if($usuario->deleted_at)
                                        NO
                                    @else
                                        SI
                                    @endif
                            </td>
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
    <div class="buttonsFiles">
    <a href="{{ route('pdfUsuarios') }}"><button class="crudButtonPDF">Generar PDF</button></a>
    </div>
    <br>
    <br>
    <br>
    @include('layouts.footer')

        <script type="text/javascript">
            function validarNombre() {
                const inputNombreFiltro = document.getElementById("nombre2");
                const nombreRegex = /^[a-zA-Z]+$/; // Expresión regular para validar solo letras

                if (!nombreRegex.test(inputNombre.value)) {
                    inputNombreFiltro.setCustomValidity("Solo se permiten letras");
                } else {
                    inputNombreFiltro.setCustomValidity("");
                }
            }

            const inputNombre = document.getElementById('nombre');
            const inputApellidoPaterno = document.getElementById('apellidoPaterno');
            const inputApellidoMaterno = document.getElementById('apellidoMaterno');
            const inputTelefono = document.getElementById('telefono');
            const inputCorreoElectronico = document.getElementById('correoElectronico');
            const inputContrasena = document.getElementById('contrasena');

            const avisoNombre = document.getElementById('avisoNombre');
            const avisoApellidoPaterno = document.getElementById('avisoApellidoPaterno');
            const avisoApellidoMaterno = document.getElementById('avisoApellidoMaterno');
            const avisoTelefono = document.getElementById('avisoTelefono');
            const avisoCorreoElectronico = document.getElementById('avisoCorreoElectronico');
            const avisoContrasena = document.getElementById('avisoContrasena');

            const regexTexto = /[A-Z][A-Z,a-z, ,á,é,í,ó,ú]+$/; // Expresión regular para permitir solo letras
            const regexTelefono = /^\d{10}$/; //Expresión regular para validar un número de 10 dígitos
            const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Expresión regular para validar un correo electrónico
            const regexPassword = /^(?=.*[!@#$%^&*]).{8,}$/; // Expresión regular para validar mínimo 8 caracteres que incluyan mínimo un caracter especial


            // Agregar un evento de escucha de teclado al input
            inputNombre.addEventListener('keyup', () => {
                const valor = inputNombre.value;
                if (!regexTexto.test(valor) && valor != "") {
                    inputNombre.style.border = '2px solid red'; // Cambiar el borde del input a rojo si el valor no cumple con el patrón
                    inputNombre.setCustomValidity("Solo se permiten letras e inicio con una letra mayúscula"); // Envia alerta en caso de no cumplir con el patrón
                    avisoNombre.innerHTML = "<p id='avisoNombre' class='text-danger' style='text-align: right;'><em>Solo se permiten letras e inicio con una letra mayúscula</em></p>";
                } else {
                    inputNombre.style.border = ''; // Restablecer el borde del input a su estilo predeterminado si el valor cumple con el patrón
                    inputNombre.setCustomValidity(""); // Reestablecer la alerta en caso de cumplir con el patrón
                    avisoNombre.innerHTML = "";
                }
            });

            inputApellidoPaterno.addEventListener('keyup', () => {
                const valor = inputApellidoPaterno.value;
                if (!regexTexto.test(valor) && valor != "") {
                    inputApellidoPaterno.style.border = '2px solid red'; // Cambiar el borde del input a rojo si el valor no cumple con el patrón
                    inputApellidoPaterno.setCustomValidity("Solo se permiten letras e inicio con una letra mayúscula"); // Envia alerta en caso de no cumplir con el patrón
                    avisoApellidoPaterno.innerHTML = "<p id='avisoApellidoPaterno' class='text-danger' style='text-align: right;'><em>Solo se permiten letras e inicio con una letra mayúscula</em></p>";
                } else {
                    inputApellidoPaterno.style.border = ''; // Restablecer el borde del input a su estilo predeterminado si el valor cumple con el patrón
                    inputApellidoPaterno.setCustomValidity(""); // Reestablecer la alerta en caso de cumplir con el patrón
                    avisoApellidoPaterno.innerHTML = "";
                }
            });

            inputApellidoMaterno.addEventListener('keyup', () => {
                const valor = inputApellidoMaterno.value;
                if (!regexTexto.test(valor) && valor != "") {
                    inputApellidoMaterno.style.border = '2px solid red'; // Cambiar el borde del input a rojo si el valor no cumple con el patrón
                    inputApellidoMaterno.setCustomValidity("Solo se permiten letras e inicio con una letra mayúscula"); // Envia alerta en caso de no cumplir con el patrón
                    avisoApellidoMaterno.innerHTML = "<p id='avisoApellidoMaterno' class='text-danger' style='text-align: right;'><em>Solo se permiten letras e inicio con una letra mayúscula</em></p>";
                } else {
                    inputApellidoMaterno.style.border = ''; // Restablecer el borde del input a su estilo predeterminado si el valor cumple con el patrón
                    inputApellidoMaterno.setCustomValidity(""); // Reestablecer la alerta en caso de cumplir con el patrón
                    avisoApellidoMaterno.innerHTML = "";
                }
            });

            inputTelefono.addEventListener('keyup', () => {
                const valor = inputTelefono.value;
                if (!regexTelefono.test(valor) && valor != "") {
                    inputTelefono.style.border = '2px solid red'; // Cambiar el borde del input a rojo si el valor no cumple con el patrón
                    inputTelefono.setCustomValidity("Ingresar número telefónico de 10 dígitos"); // Envia alerta en caso de no cumplir con el patrón
                    avisoTelefono.innerHTML = "<p id='avisoTelefono' class='text-danger' style='text-align: right;'><em>Ingresar número telefónico de 10 dígitos</em></p>";
                } else {
                    inputTelefono.style.border = ''; // Restablecer el borde del input a su estilo predeterminado si el valor cumple con el patrón
                    inputTelefono.setCustomValidity(""); // Reestablecer la alerta en caso de cumplir con el patrón
                    avisoTelefono.innerHTML = "";
                }
            });

            inputCorreoElectronico.addEventListener('keyup', () => {
                const valor = inputCorreoElectronico.value;
                if (!regexEmail.test(valor) && valor != "") {
                    inputCorreoElectronico.style.border = '2px solid red'; // Cambiar el borde del input a rojo si el valor no cumple con el patrón
                    inputCorreoElectronico.setCustomValidity("Ingrese una dirección de correo electrónico válida"); // Envia alerta en caso de no cumplir con el patrón
                    avisoCorreoElectronico.innerHTML = "<p id='avisoCorreoElectronico' class='text-danger' style='text-align: right;'><em>Ingrese una dirección de correo electrónico válida</em></p>";
                } else {
                    inputCorreoElectronico.style.border = ''; // Restablecer el borde del input a su estilo predeterminado si el valor cumple con el patrón
                    inputCorreoElectronico.setCustomValidity(""); // Reestablecer la alerta en caso de cumplir con el patrón
                    avisoCorreoElectronico.innerHTML = "";
                }
            });

            inputContrasena.addEventListener('keyup', () => {
                const valor = inputContrasena.value;
                if (!regexPassword.test(valor) && valor != "") {
                    inputContrasena.style.border = '2px solid red'; // Cambiar el borde del input a rojo si el valor no cumple con el patrón
                    inputContrasena.setCustomValidity("La contraseña debe tener al menos 8 caracteres y contener al menos un cataracter especial (!,@,#,$,%,^,&,*)"); // Envia alerta en caso de no cumplir con el patrón
                    avisoContrasena.innerHTML = "<p id='avisoContrasena' class='text-danger' style='text-align: right;'><em>La contraseña debe tener al menos 8 caracteres y contener al menos un cataracter especial (!,@,#,$,%,^,&,*)</em></p>";
                } else {
                    inputContrasena.style.border = ''; // Restablecer el borde del input a su estilo predeterminado si el valor cumple con el patrón
                    inputContrasena.setCustomValidity(""); // Reestablecer la alerta en caso de cumplir con el patrón
                    avisoContrasena.innerHTML = "";
                }
            });

            // Agregar constantes de los elementos del formulario de editar usuario
            const inputNombreEditar = document.getElementById('nombreEditar');
            const inputApellidoPaternoEditar = document.getElementById('apellidoPaternoEditar');
            const inputApellidoMaternoEditar = document.getElementById('apellidoMaternoEditar');
            const inputTelefonoEditar = document.getElementById('telefonoEditar');
            const inputCorreoElectronicoEditar = document.getElementById('correoElectronicoEditar');
            const inputContrasenaEditar = document.getElementById('contrasenaEditar');

            const avisoNombreEditar = document.getElementById('avisoNombreEditar');
            const avisoApellidoPaternoEditar = document.getElementById('avisoApellidoPaternoEditar');
            const avisoApellidoMaternoEditar = document.getElementById('avisoApellidoMaternoEditar');
            const avisoTelefonoEditar = document.getElementById('avisoTelefonoEditar');
            const avisoCorreoElectronicoEditar = document.getElementById('avisoCorreoElectronicoEditar');
            const avisoContrasenaEditar = document.getElementById('avisoContrasenaEditar');

            // Agregar un evento de escucha de teclado al input
            inputNombreEditar.addEventListener('keyup', () => {
                const valor = inputNombreEditar.value;
                if (!regexTexto.test(valor) && valor != "") {
                    inputNombreEditar.style.border = '2px solid red'; // Cambiar el borde del input a rojo si el valor no cumple con el patrón
                    inputNombreEditar.setCustomValidity("Solo se permiten letras e inicio con una letra mayúscula"); // Envia alerta en caso de no cumplir con el patrón
                    avisoNombreEditar.innerHTML = "<p id='avisoNombreEditar' class='text-danger' style='text-align: right;'><em>Solo se permiten letras e inicio con una letra mayúscula</em></p>";
                } else {
                    inputNombreEditar.style.border = ''; // Restablecer el borde del input a su estilo predeterminado si el valor cumple con el patrón
                    inputNombreEditar.setCustomValidity(""); // Reestablecer la alerta en caso de cumplir con el patrón
                    avisoNombreEditar.innerHTML = "";
                }
            });

            inputApellidoPaternoEditar.addEventListener('keyup', () => {
                const valor = inputApellidoPaternoEditar.value;
                if (!regexTexto.test(valor) && valor != "") {
                    inputApellidoPaternoEditar.style.border = '2px solid red'; // Cambiar el borde del input a rojo si el valor no cumple con el patrón
                    inputApellidoPaternoEditar.setCustomValidity("Solo se permiten letras e inicio con una letra mayúscula"); // Envia alerta en caso de no cumplir con el patrón
                    avisoApellidoPaternoEditar.innerHTML = "<p id='avisoApellidoPaternoEditar' class='text-danger' style='text-align: right;'><em>Solo se permiten letras e inicio con una letra mayúscula</em></p>";
                } else {
                    inputApellidoPaternoEditar.style.border = ''; // Restablecer el borde del input a su estilo predeterminado si el valor cumple con el patrón
                    inputApellidoPaternoEditar.setCustomValidity(""); // Reestablecer la alerta en caso de cumplir con el patrón
                    avisoApellidoPaternoEditar.innerHTML = "";
                }
            });

            inputApellidoMaternoEditar.addEventListener('keyup', () => {
                const valor = inputApellidoMaternoEditar.value;
                if (!regexTexto.test(valor) && valor != "") {
                    inputApellidoMaternoEditar.style.border = '2px solid red'; // Cambiar el borde del input a rojo si el valor no cumple con el patrón
                    inputApellidoMaternoEditar.setCustomValidity("Solo se permiten letras e inicio con una letra mayúscula"); // Envia alerta en caso de no cumplir con el patrón
                    avisoApellidoMaternoEditar.innerHTML = "<p id='avisoApellidoMaternoEditar' class='text-danger' style='text-align: right;'><em>Solo se permiten letras e inicio con una letra mayúscula</em></p>";
                } else {
                    inputApellidoMaternoEditar.style.border = ''; // Restablecer el borde del input a su estilo predeterminado si el valor cumple con el patrón
                    inputApellidoMaternoEditar.setCustomValidity(""); // Reestablecer la alerta en caso de cumplir con el patrón
                    avisoApellidoMaternoEditar.innerHTML = "";
                }
            });

            inputTelefonoEditar.addEventListener('keyup', () => {
                const valor = inputTelefonoEditar.value;
                if (!regexTelefono.test(valor) && valor != "") {
                    inputTelefonoEditar.style.border = '2px solid red'; // Cambiar el borde del input a rojo si el valor no cumple con el patrón
                    inputTelefonoEditar.setCustomValidity("Ingresar número telefónico de 10 dígitos"); // Envia alerta en caso de no cumplir con el patrón
                    avisoTelefonoEditar.innerHTML = "<p id='avisoTelefonoEditar' class='text-danger' style='text-align: right;'><em>Ingresar número telefónico de 10 dígitos</em></p>";
                } else {
                    inputTelefonoEditar.style.border = ''; // Restablecer el borde del input a su estilo predeterminado si el valor cumple con el patrón
                    inputTelefonoEditar.setCustomValidity(""); // Reestablecer la alerta en caso de cumplir con el patrón
                    avisoTelefonoEditar.innerHTML = "";
                }
            });

            inputCorreoElectronicoEditar.addEventListener('keyup', () => {
                const valor = inputCorreoElectronicoEditar.value;
                if (!regexEmail.test(valor) && valor != "") {
                    inputCorreoElectronicoEditar.style.border = '2px solid red'; // Cambiar el borde del input a rojo si el valor no cumple con el patrón
                    inputCorreoElectronicoEditar.setCustomValidity("Ingrese una dirección de correo electrónico válida"); // Envia alerta en caso de no cumplir con el patrón
                    avisoCorreoElectronicoEditar.innerHTML = "<p id='avisoCorreoElectronicoEditar' class='text-danger' style='text-align: right;'><em>Ingrese una dirección de correo electrónico válida</em></p>";
                } else {
                    inputCorreoElectronicoEditar.style.border = ''; // Restablecer el borde del input a su estilo predeterminado si el valor cumple con el patrón
                    inputCorreoElectronicoEditar.setCustomValidity(""); // Reestablecer la alerta en caso de cumplir con el patrón
                    avisoCorreoElectronicoEditar.innerHTML = "";
                }
            });

            inputContrasenaEditar.addEventListener('keyup', () => {
                const valor = inputContrasenaEditar.value;
                if (!regexPassword.test(valor) && valor != "") {
                    inputContrasenaEditar.style.border = '2px solid red'; // Cambiar el borde del input a rojo si el valor no cumple con el patrón
                    inputContrasenaEditar.setCustomValidity("La contraseña debe tener al menos 8 caracteres y contener al menos un cataracter especial (!,@,#,$,%,^,&,*)"); // Envia alerta en caso de no cumplir con el patrón
                    avisoContrasenaEditar.innerHTML = "<p id='avisoContrasenaEditar' class='text-danger' style='text-align: right;'><em>La contraseña debe tener al menos 8 caracteres y contener al menos un cataracter especial (!,@,#,$,%,^,&,*)</em></p>";
                } else {
                    inputContrasenaEditar.style.border = ''; // Restablecer el borde del input a su estilo predeterminado si el valor cumple con el patrón
                    inputContrasenaEditar.setCustomValidity(""); // Reestablecer la alerta en caso de cumplir con el patrón
                    avisoContrasenaEditar.innerHTML = "";
                }
            });

            
        </script>

        
</body>
</html>