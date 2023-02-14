<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;

//Rutas de principales
Route::get('/',[HomeController::class,'index'])->name('home.index');

//Rutas para Inicio de sesión
Route::get('/login',[LoginController::class,'login'])->name('login');
Route::post('/validar',[LoginController::class,'validar'])->name('validar');
Route::get('/home',[LoginController::class,'home'])->name('home');
Route::get('/cerrarSesion',[LoginController::class,'cerrarSesion'])->name('cerrarSesion');
