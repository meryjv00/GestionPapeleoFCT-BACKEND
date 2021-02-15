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

Route::get('anexos', [AnexosController::class, 'index']);

Route::get('empresas', [EmpresasController::class, 'index']);

Route::post('insertEmpresa', [EmpresasController::class, 'store']);

Route::put('updateEmpresa/{id}', [EmpresasController::class, 'update']);

Route::post('deleteEmpresa/{id}', [EmpresasController::class, 'destroy']);

Route::get('getAnexo0/{id}', [AnexosController::class, 'anexo0']);

//ADMINISTRACION
Route::put('generarProfesores', [AdminController::class, 'insertProfesores']);
Route::post('generarAlumnos', [AdminController::class, 'insertAlumnos']);
Route::post('addJefeEstudios', [CentroController::class, 'addJefeEstudios']);
Route::get('getCuentasAdministrar', [CentroController::class, 'getCuentasAdministrar']);
Route::put('addTutorCurso/{idCurso}', [CursosController::class, 'addTutorCurso']);
Route::get('getTutores', [CentroController::class, 'getTutores']);
Route::get('cursosSinTutor', [CursosController::class, 'cursosSinTutor']);
Route::put('activarCuenta/{dni}', [CentroController::class, 'activarCuenta']);
Route::put('denegarAccesoCuenta/{dni}', [CentroController::class, 'denegarAccesoCuenta']);
Route::post('cambiarRol', [CentroController::class, 'cambiarRol']);

Route::group(['middleware' => 'auth:api'], function() {

});

