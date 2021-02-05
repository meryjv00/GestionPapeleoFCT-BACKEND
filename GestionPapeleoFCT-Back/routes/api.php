<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CursosController;
use App\Http\Controllers\API\PersonaController;
use App\Http\Controllers\API\AnexosController;
use App\Http\Controllers\API\EmpresasController;

/*
  |--------------------------------------------------------------------------
  | API Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register API routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | is assigned the "api" middleware group. Enjoy building your API!
  |
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register_persona', [AuthController::class, 'register_persona']);
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::get('cursos', [CursosController::class, 'index']);
Route::get('cursos/{dniTutor}', [CursosController::class, 'index2']);
Route::get('alumnos/{idCurso}', [PersonaController::class, 'show']);

Route::post('insertAlumno', [PersonaController::class, 'store']);
Route::put('updateAlumno/{idAlumno}', [PersonaController::class, 'update']);
Route::delete('deleteAlumno/{idAlumno}', [PersonaController::class, 'destroy']);

Route::get('anexos', [AnexosController::class, 'index']);

Route::get('empresas', [EmpresasController::class, 'index']);

Route::post('insertEmpresa', [EmpresasController::class, 'store']);

Route::put('updateEmpresa/{id}', [EmpresasController::class, 'update']);

Route::post('deleteEmpresa/{id}', [EmpresasController::class, 'destroy']);

Route::get('getAnexo0/{id}', [AnexosController::class, 'anexo0']);

Route::group(['middleware' => 'auth:api'], function() {
});

