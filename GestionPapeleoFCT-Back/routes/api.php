<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CentroController;
use App\Http\Controllers\API\CursosController;
use App\Http\Controllers\API\PersonaController;
use App\Http\Controllers\API\AnexosController;
use App\Http\Controllers\API\EmpresasController;
use App\Http\Controllers\AdminController;

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

Route::post('getDirector', [CentroController::class, 'getDirector']);
Route::post('getCentro', [CentroController::class, 'getCentro']);
Route::post('updateCentro', [CentroController::class, 'updateCentro']);
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('isPersona', [AuthController::class, 'isPersona']);
Route::post('register_persona', [AuthController::class, 'register_persona']);

Route::get('cursos', [CursosController::class, 'index']);
Route::post('curso', [CursosController::class, 'store']);
Route::put('curso/{cursoId}', [CursosController::class, 'update']);
Route::delete('curso/{cursoId}', [CursosController::class, 'destroy']);
Route::get('cursos/{dniTutor}', [CursosController::class, 'index2']);
Route::get('alumnos/{idCurso}', [PersonaController::class, 'show']);

Route::get('cursosFamilies', [CursosController::class, 'getFamilies']);

Route::post('insertAlumno', [PersonaController::class, 'store']);
Route::put('updateAlumno/{idAlumno}', [PersonaController::class, 'update']);
Route::delete('deleteAlumno/{idAlumno}', [PersonaController::class, 'destroy']);


//----------------------EMPRESAS
Route::get('empresas', [EmpresasController::class, 'index']);

Route::post('insertEmpresa', [EmpresasController::class, 'store']);

Route::put('updateEmpresa/{id}', [EmpresasController::class, 'update']);

Route::post('deleteEmpresa/{id}', [EmpresasController::class, 'destroy']);

//----------------------ANEXOS
Route::get('anexos', [AnexosController::class, 'index']);

Route::get('getAnexo0/{id}', [AnexosController::class, 'anexo0']);

Route::post('getAnexo1', [AnexosController::class, 'anexo1']);

Route::post('getAnexo2', [AnexosController::class, 'anexo2']);

Route::post('getAnexo3', [AnexosController::class, 'anexo3']);

Route::post('getAnexo4', [AnexosController::class, 'anexo4']);

Route::post('getAnexo5', [AnexosController::class, 'anexo5']);

Route::get('descargarAnexo/{id}', [AnexosController::class, 'descargar']);

//ADMINISTRACION
Route::post('generarProfesores', [AdminController::class, 'insertProfesores']);
Route::post('generarAlumnos', [AdminController::class, 'insertAlumnos']);

Route::group(['middleware' => 'auth:api'], function() {
    
});