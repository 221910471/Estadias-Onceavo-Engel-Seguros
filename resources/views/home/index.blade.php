@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-5 rounded">
        @auth
        <h1>Dashboard</h1>
        <p class="lead">SOLO USUARIOS LOGEADOS PUEDEN VER ESTO</p>
        <a class="btn btn-lg btn-primary" href="https://codeanddeploy.com" role="button">View more tutorials here &raquo;</a>
        @endauth

        @guest
        <h1>INICIO</h1>
        <p class="lead">Tu estas viendo el inicio. Por favor inicia sesión para ver lo demas</p>
        @endguest
    </div>
@endsection