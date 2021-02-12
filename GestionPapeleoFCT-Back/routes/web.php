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

Route::get('/intento/{id}', [AnexosController::class, 'anexo0']);


//Route::get('/importarCSV',[App\Http\Controllers\miControlador::class, 'vistaImports']);
//Route::post('cambiaCurso',[App\Http\Controllers\miControlador::class, 'cambiaCurso']);
//Route::post('/subirAlumnos',[App\Http\Controllers\miControlador::class, 'subirAlumnos'])->name('subirAlumnos');
//Route::post('/subirProfesores',[App\Http\Controllers\miControlador::class, 'subirProfesores'])->name('subirProfesores');
