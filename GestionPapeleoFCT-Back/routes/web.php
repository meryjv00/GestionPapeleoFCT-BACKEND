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
<<<<<<< HEAD
Route::get('/intentoFilas', [AnexosController::class, 'anexo1']);
Route::get('/intento1', [AnexosController::class, 'anexo1']);
Route::get('/intento3', [AnexosController::class, 'anexo3']);
=======


//Route::get('/importarCSV',[App\Http\Controllers\miControlador::class, 'vistaImports']);
//Route::post('cambiaCurso',[App\Http\Controllers\miControlador::class, 'cambiaCurso']);
//Route::post('/subirAlumnos',[App\Http\Controllers\miControlador::class, 'subirAlumnos'])->name('subirAlumnos');
//Route::post('/subirProfesores',[App\Http\Controllers\miControlador::class, 'subirProfesores'])->name('subirProfesores');
>>>>>>> develop
