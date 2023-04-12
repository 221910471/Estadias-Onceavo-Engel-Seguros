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
use App\Http\Controllers\PagoController;

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
Route::get('/filterActivo',[PolizaController::class,'filterActivo'])->name('filterActivo');
Route::get('/filterTipoPoliza',[PolizaController::class,'filterTipoPoliza'])->name('filterTipoPoliza');
Route::get('/filterClave',[PolizaController::class,'filterClave'])->name('filterClave');

//Rutas para Clientes------------

Route::get('/clientes',[ClienteController::class,'clientes'])->name('clientes');

//Rutas para crud de ventas---------------

Route::get('/ventas',[VentaController::class,'ventas'])->name('ventas');
Route::post('/createVenta',[VentaController::class,'createVenta'])->name('createVenta');
Route::put('/editVenta/{id}',[VentaController::class,'editVenta'])->name('editVenta');
Route::get('/deleteVenta/{id}',[VentaController::class,'deleteVenta'])->name('deleteVenta');
Route::get('/activateVenta/{id}',[VentaController::class,'activateVenta'])->name('activateVenta');
Route::get('/pdfVentas',[VentaController::class,'pdfVentas'])->name('pdfVentas');
Route::get('/filterClaveVenta',[VentaController::class,'filterClaveVenta'])->name('filterClaveVenta');
Route::get('/filterActivoVenta',[VentaController::class,'filterActivoVenta'])->name('filterActivoVenta');
Route::get('/filterFechaVenta',[VentaController::class,'filterFechaVenta'])->name('filterFechaVenta');



//Rutas para las funciones de correo---------------

Route::get('/correos',[MailController::class,'correos'])->name('correos');
Route::post('/enviarCorreo',[MailController::class,'enviarCorreo'])->name('enviarCorreo');

//Rutas para crud de notificaciones---------------

Route::get('/notificaciones',[NotificacionController::class,'notificaciones'])->name('notificaciones');
Route::get('/notificacionesCliente',[NotificacionController::class,'notificacionesCliente'])->name('notificacionesCliente');
Route::post('/createNotificacion',[NotificacionController::class,'createNotificacion'])->name('createNotificacion');
Route::put('/editNotificacion/{id}',[NotificacionController::class,'editNotificacion'])->name('editNotificacion');
Route::get('/deleteNotificacion/{id}',[NotificacionController::class,'deleteNotificacion'])->name('deleteNotificacion');
Route::get('/activateNotificacion/{id}',[NotificacionController::class,'activateNotificacion'])->name('activateNotificacion');
Route::get('/filterAsuntoNotificacion',[NotificacionController::class,'filterAsuntoNotificacion'])->name('filterAsuntoNotificacion');
Route::get('/filterFechaNotificacion',[NotificacionController::class,'filterFechaNotificacion'])->name('filterFechaNotificacion');
Route::get('/filterRemitenteNotificacion',[NotificacionController::class,'filterRemitenteNotificacion'])->name('filterRemitenteNotificacion');
Route::get('/pdfNotificaciones',[NotificacionController::class,'pdfNotificaciones'])->name('pdfNotificaciones');

//Rutas para módulo de pagos---------------

Route::get('/pagos',[PagoController::class,'pagos'])->name('pagos');
Route::get('/pagosCliente',[PagoController::class,'pagosCliente'])->name('pagosCliente');
Route::post('/createPago',[PagoController::class,'createPago'])->name('createPago');
Route::put('/editPago/{id}',[PagoController::class,'editPago'])->name('editPago');
Route::get('/deletePago/{id}',[PagoController::class,'deletePago'])->name('deletePago');
Route::get('/activatePago/{id}',[PagoController::class,'activatePago'])->name('activatePago');
Route::get('/filterFechaPago',[PagoController::class,'filterFechaPago'])->name('filterFechaPago');
Route::get('/filterEstadoPago',[PagoController::class,'filterEstadoPago'])->name('filterEstadoPago');
Route::get('/filterActivoPago',[PagoController::class,'filterActivoPago'])->name('filterActivoPago');
Route::get('/pdfPagos',[PagoController::class,'pdfPagos'])->name('pdfPagos');