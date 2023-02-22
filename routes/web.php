<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PolizaController;

//Rutas de principales
Route::get('/',[HomeController::class,'index'])->name('home.index');

//Rutas para Inicio de sesión-------------
Route::get('/login',[LoginController::class,'login'])->name('login');
Route::post('/validar',[LoginController::class,'validar'])->name('validar');
Route::get('/home',[LoginController::class,'home'])->name('home');
Route::get('/cerrarSesion',[LoginController::class,'cerrarSesion'])->name('cerrarSesion');

//Rutas para crud de usuarios---------------

Route::get('/users',[UserController::class,'users'])->name('users');
Route::post('/createUser',[UserController::class,'createUser'])->name('createUser');
Route::put('/editUser/{id}',[UserController::class,'editUser'])->name('editUser');
Route::get('/deleteUser/{id}',[UserController::class,'delete'])->name('deleteUser');
Route::get('/activateUser/{id}',[UserController::class,'activateUser'])->name('activateUser');
Route::get('/filterUsers',[UserController::class,'filterUsers'])->name('filterUsers');

//Rutas para Polizas------------

Route::get('/polizas',[PolizaController::class,'polizas'])->name('polizas');
Route::post('/createPoliza',[PolizaController::class,'createPoliza'])->name('createPoliza');
Route::put('/editPoliza/{id}',[PolizaController::class,'editPoliza'])->name('editPoliza');
Route::get('/deletePoliza/{id}',[PolizaController::class,'deletePoliza'])->name('deletePoliza');
Route::get('/activatePoliza/{id}',[PolizaController::class,'activatePoliza'])->name('activatePoliza');
Route::get('/filterPolizas',[PolizaController::class,'filterPolizas'])->name('filterPolizas');
