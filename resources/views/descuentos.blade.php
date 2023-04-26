<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descuentos</title>
    <link rel="stylesheet" href="css/code.css">
</head>

<body>
    @include('layouts.navbar')
    <br>
    <br>
    <center class="">
        <form action="{{route('ingresarCodigo')}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
         
            <div class="container">
	<div class="row">
			<h1>Ingresa un código</h1>
	</div>
	<!-- <div class="row">
			<h4 style="text-align:center">We'd love to hear from you!</h4>
	</div> -->
	<div class="row input-container">
			<div class="col-xs-12">
				<div class="styled-input wide">
					<input type="text" name="codigo" id="codigo" required />
					<label>Código</label> 
				</div>
			</div>	
			<div class="col-xs-12">
                <input type="submit" value="Enviar" class="btn-lrg submit-btn">
			</div>
            
	</div>

        </form>
        @if(Session::has('mensaje'))
            <div class="alert alert-danger">{{Session::get('mensaje')}}</div>
        @endif
    </center>

    <br>
    <br>
    <br>
    <br>
    @include('layouts.footer')
</body>
</html>