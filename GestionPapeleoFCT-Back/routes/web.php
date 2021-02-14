<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AnexosController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Para descargar un anexo
Route::get('/descargar/{id}', [AnexosController::class, 'descargar']);

//Rutas para pruebas, eliminar en produccion
Route::get('/intento/{id}', [AnexosController::class, 'anexo0']);
Route::get('/intentoFilas', [AnexosController::class, 'anexo1']);
Route::get('/intento1', [AnexosController::class, 'anexo1']);