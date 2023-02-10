@extends('layouts.auth-master')

@section('content')
    <form method="post" action="{{ route('register.perform') }}" class="container w-25">

        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        
        <h1 class="h3 mb-3 fw-normal">Register</h1>

        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" placeholder="nombre" required="required" autofocus>
            <label for="floatingEmail">nombre</label>
            @if ($errors->has('nombre'))
                <span class="text-danger text-left">{{ $errors->first('name') }}</span>
            @endif
        </div>
        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="apellidoPaterno" value="{{ old('apellidoPaterno') }}" placeholder="apellido" required="required" autofocus>
            <label for="floatingEmail">apellidoPaterno</label>
            @if ($errors->has('apellidoPaterno'))
                <span class="text-danger text-left">{{ $errors->first('apellidoPaterno') }}</span>
            @endif
        </div>
        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="apellidoMaterno" value="{{ old('apellidoMaterno') }}" placeholder="apellidoMaterno" required="required" autofocus>
            <label for="floatingEmail">apellidoMaterno</label>
            @if ($errors->has('apellidoMaterno'))
                <span class="text-danger text-left">{{ $errors->first('apellidoMaterno') }}</span>
            @endif
        </div>
        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="telefono" value="{{ old('telefono') }}" placeholder="telefono" required="required" autofocus>
            <label for="floatingEmail">telefono</label>
            @if ($errors->has('telefono'))
                <span class="text-danger text-left">{{ $errors->first('telefono') }}</span>
            @endif
        </div>
        <div class="form-group form-floating mb-3">
            <input type="password" class="form-control" name="contrasena" value="{{ old('contrasena') }}" placeholder="Contraseña" required="required">
            <label for="floatingPassword">contrasena</label>
            @if ($errors->has('contrasena'))
                <span class="text-danger text-left">{{ $errors->first('contrasena') }}</span>
            @endif
        </div>
        <div class="form-group form-floating mb-3">
            <input type="email" class="form-control" name="correoElectronico" value="{{ old('correoElectronico') }}" placeholder="name@example.com" required="required" autofocus>
            <label for="floatingEmail">correoElectronico</label>
            @if ($errors->has('correoElectronico'))
                <span class="text-danger text-left">{{ $errors->first('correoElectronico') }}</span>
            @endif
        </div>
        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="rol" value="Administrador" placeholder="rol" required="required" autofocus>
            <label for="floatingName">rol</label>
            @if ($errors->has('rol'))
                <span class="text-danger text-left">{{ $errors->first('rol') }}</span>
            @endif
        </div>
        <div class="form-group form-floating mb-3">
            <input type="date" class="form-control" name="fechaDeNacimiento" value="{{ old('fechaDeNacimiento') }}" placeholder="fechaDeNacimiento" required="required" autofocus>
            <label for="floatingName">fechaDeNacimiento</label>
            @if ($errors->has('fechaDeNacimiento'))
                <span class="text-danger text-left">{{ $errors->first('fechaDeNacimiento') }}</span>
            @endif
        </div>
        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="identificacion" value="1" placeholder="identificacion" required="required" autofocus>
            <label for="floatingName">identificacion</label>
            @if ($errors->has('identificacion'))
                <span class="text-danger text-left">{{ $errors->first('identificacion') }}</span>
            @endif
        </div>
        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="tarjetaDeCirculacion" value="1" placeholder="tarjetaDeCirculacion" required="required" autofocus>
            <label for="floatingName">tarjetaDeCirculacion</label>
            @if ($errors->has('tarjetaDeCirculacion'))
                <span class="text-danger text-left">{{ $errors->first('tarjetaDeCirculacion') }}</span>
            @endif
        </div>
        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="comprobanteDomiciliario" value="1" placeholder="comprobanteDomiciliario" required="required" autofocus>
            <label for="floatingName">comprobanteDomiciliario</label>
            @if ($errors->has('comprobanteDomiciliario'))
                <span class="text-danger text-left">{{ $errors->first('comprobanteDomiciliario') }}</span>
            @endif
        </div>
        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="identificacion" value="1" placeholder="identificacion" required="required" autofocus>
            <label for="floatingName">identificacion</label>
            @if ($errors->has('identificacion'))
                <span class="text-danger text-left">{{ $errors->first('identificacion') }}</span>
            @endif
        </div>
        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="estadoDeSesion" value="1" placeholder="estadoDeSesion" required="required" autofocus>
            <label for="floatingName">estadoDeSesion</label>
            @if ($errors->has('estadoDeSesion'))
                <span class="text-danger text-left">{{ $errors->first('estadoDeSesion') }}</span>
            @endif
        </div>
        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="estado" value="1" placeholder="estado" required="required" autofocus>
            <label for="floatingName">estado</label>
            @if ($errors->has('estado'))
                <span class="text-danger text-left">{{ $errors->first('estado') }}</span>
            @endif
        </div>
        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="familiaId" value="1" placeholder="familiaId" required="required" autofocus>
            <label for="floatingName">familiaId</label>
            @if ($errors->has('familiaId'))
                <span class="text-danger text-left">{{ $errors->first('familiaId') }}</span>
            @endif
        </div>
        
        

        <button class="w-100 btn btn-lg btn-primary" type="submit">Registrar</button>
        
        @include('auth.partials.copy')
    </form>
@endsection