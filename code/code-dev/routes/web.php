<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConexionController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


//Modulo de Inicio de Sesion
Route::get('/',[ConexionController::class, 'getIniciarSesion'])->name('login');
Route::get('/iniciar_sesion',[ConexionController::class, 'getIniciarSesion']);
Route::post('/iniciar_sesion',[ConexionController::class, 'postIniciarSesion']);
Route::get('/cerrar_sesion',[ConexionController::class, 'getCerraSesion'])->name('logout');
