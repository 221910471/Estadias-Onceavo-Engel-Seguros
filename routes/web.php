<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PolizaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\MailController;

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
Route::get('/pdfUsuarios',[UserController::class,'pdfUsuarios'])->name('pdfUsuarios');

//Rutas para Polizas------------

Route::get('/polizas',[PolizaController::class,'polizas'])->name('polizas');
Route::post('/createPoliza',[PolizaController::class,'createPoliza'])->name('createPoliza');
Route::put('/editPoliza/{id}',[PolizaController::class,'editPoliza'])->name('editPoliza');
Route::get('/deletePoliza/{id}',[PolizaController::class,'deletePoliza'])->name('deletePoliza');
Route::get('/activatePoliza/{id}',[PolizaController::class,'activatePoliza'])->name('activatePoliza');
Route::get('/filterPolizas',[PolizaController::class,'filterPolizas'])->name('filterPolizas');

//Rutas para Clientes------------

Route::get('/clientes',[ClienteController::class,'clientes'])->name('clientes');

//Rutas para crud de ventas---------------

Route::get('/ventas',[VentaController::class,'ventas'])->name('ventas');
Route::post('/createVenta',[VentaController::class,'createVenta'])->name('createVenta');
Route::put('/editVenta/{id}',[VentaController::class,'editVenta'])->name('editVenta');
Route::get('/deleteVenta/{id}',[VentaController::class,'deleteVenta'])->name('deleteVenta');
Route::get('/activateVenta/{id}',[VentaController::class,'activateVenta'])->name('activateVenta');
Route::get('/filtrarVentas',[VentaController::class,'filtrarVentas'])->name('filtrarVentas');
Route::get('/pdfVentas',[VentaController::class,'pdfVentas'])->name('pdfVentas');

//Rutas para las funciones de correo---------------

Route::get('/correos',[MailController::class,'correos'])->name('correos');
Route::post('/enviarCorreo',[MailController::class,'enviarCorreo'])->name('enviarCorreo');

//Rutas para crud de notificaciones---------------

Route::get('/notificaciones',[NotificacionController::class,'notificaciones'])->name('notificaciones');
Route::post('/createNotificacion',[NotificacionController::class,'createNotificacion'])->name('createNotificacion');
Route::put('/editNotificacion/{id}',[NotificacionController::class,'editNotificacion'])->name('editNotificacion');
Route::get('/deleteNotificacion/{id}',[NotificacionController::class,'deleteNotificacion'])->name('deleteNotificacion');
Route::get('/activateNotificacion/{id}',[NotificacionController::class,'activateNotificacion'])->name('activateNotificacion');
Route::get('/filtrarNotificaciones',[NotificacionController::class,'filtrarNotificaciones'])->name('filtrarNotificaciones');
Route::get('/pdfNotificaciones',[NotificacionController::class,'pdfNotificaciones'])->name('pdfNotificaciones'); 