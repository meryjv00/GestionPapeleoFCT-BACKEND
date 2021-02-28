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
use App\Http\Controllers\API\EmpresaCursoController;
use App\Http\Controllers\API\FctController;

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
Route::post('mod_user', [AuthController::class, 'mod_user']);

Route::get('cursos', [CursosController::class, 'index']);
Route::post('curso', [CursosController::class, 'store']);
Route::put('curso/{cursoId}', [CursosController::class, 'update']);
Route::delete('curso/{cursoId}', [CursosController::class, 'destroy']);
Route::get('cursos/{dniTutor}', [CursosController::class, 'index2']);

Route::get('cursosFamilies', [CursosController::class, 'getFamilies']);

Route::post('insertAlumno', [PersonaController::class, 'store']);
Route::put('updateAlumno/{idAlumno}', [PersonaController::class, 'update']);
Route::delete('deleteAlumno/{idAlumno}', [PersonaController::class, 'destroy']);
Route::get('alumnos/{idCurso}', [PersonaController::class, 'show']);
Route::get('alumnosCursoSinEmpresa/{idCurso}', [PersonaController::class, 'alumnosCursoSinEmpresa']);
Route::get('alumnosCursoPracticas/{idCurso}/{idEmpresa}', [PersonaController::class, 'alumnosCursoPracticas']);

Route::get('anexos', [AnexosController::class, 'index']);

Route::get('empresas', [EmpresasController::class, 'index']);
Route::get('empresasNoCurso/{id}', [EmpresasController::class, 'showEmpresaNoCurso']);
Route::get('empresasCurso/{id}', [EmpresasController::class, 'showEmpresasCurso']);
Route::post('insertEmpresa', [EmpresasController::class, 'store']);
Route::put('updateEmpresa/{id}', [EmpresasController::class, 'update']);
Route::post('deleteEmpresa/{id}', [EmpresasController::class, 'destroy']);
Route::post('addResponsableEmpresa/{idEmpresa}', [EmpresasController::class, 'addResponsable']);

//----------------------ANEXOS
Route::get('anexos', [AnexosController::class, 'index']);

Route::get('getAnexo0/{id}', [AnexosController::class, 'anexo0']);
Route::get('anexos', [AnexosController::class, 'index']);

Route::post('getAnexo1', [AnexosController::class, 'anexo1']);

Route::post('getAnexo2', [AnexosController::class, 'anexo2']);

Route::post('getAnexo3', [AnexosController::class, 'anexo3']);

Route::post('getAnexo4', [AnexosController::class, 'anexo4']);

Route::post('getAnexo5', [AnexosController::class, 'anexo5']);

Route::get('descargarAnexo/{id}', [AnexosController::class, 'descargar']);

//ADMINISTRACION
Route::post('generarProfesores', [AdminController::class, 'insertProfesores']);
Route::post('generarAlumnos/{idCurso}/{cicloCurso}', [AdminController::class, 'insertAlumnos']);
Route::post('addJefeEstudios', [CentroController::class, 'addJefeEstudios']);
Route::get('getCuentasAdministrar', [CentroController::class, 'getCuentasAdministrar']);
Route::put('addTutorCurso/{idCurso}', [CursosController::class, 'addTutorCurso']);
Route::get('getTutores', [CentroController::class, 'getTutores']);
Route::get('cursosSinTutor', [CursosController::class, 'cursosSinTutor']);
Route::put('activarDesactCuenta/{dni}', [CentroController::class, 'activarDesactCuenta']);
Route::put('denegarAccesoCuenta/{dni}', [CentroController::class, 'denegarAccesoCuenta']);
Route::post('cambiarRol', [CentroController::class, 'cambiarRol']);
Route::get('cursosSinAlumnos', [CursosController::class, 'cursosSinAlumnos']);
Route::get('reiniciarAlumnos', [CursosController::class, 'reiniciarAlumnos']);
Route::get('getCuentasActivas', [CentroController::class, 'getCuentasActivas']);

// Relacion con cursos y empresas de prácticas
Route::post('addEmpresaCurso', [EmpresaCursoController::class, 'store']);
Route::delete('deleteEmpresaCurso/{idEmpresa}/{idCurso}', [EmpresaCursoController::class, 'destroy']);

// Rutas Fct
Route::post('addAlumnoPracticas', [FctController::class, 'store']);
Route::delete('deleteAlumnoPracticas/{dniAlumno}', [FctController::class, 'destroy']);

Route::group(['middleware' => 'auth:api'], function() {
    
});