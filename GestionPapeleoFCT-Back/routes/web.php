<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AnexosController;
use App\Http\Controllers\API\EmpresasController;

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

Route::get('/test', [AnexosController::class, 'anexo6']);