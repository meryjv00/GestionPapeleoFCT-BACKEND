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
use App\Http\Controllers\API\EmpresaPerfilesController;
use App\Http\Controllers\API\FctController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\RecPassword;

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


Route::post('register', [AuthController::class, 'register'])->middleware('notUser');
Route::post('register_persona', [AuthController::class, 'register_persona']);
Route::post('login', [AuthController::class, 'login']);
Route::post('isPersona', [AuthController::class, 'isPersona']);
Route::post('RecPass', [EmailController::class, 'RecPass']);
Route::put('mod_pass', [RecPassword::class, 'modPass']);
Route::post('is_us_mod_pass', [RecPassword::class, 'isUser']);

Route::group(['middleware' => 'auth:api'], function() {

    Route::post('env', [EmailController::class, 'enviar']);
    Route::post('updateCentro', [CentroController::class, 'updateCentro'])->middleware('isDirect');
    Route::get('getDirector', [CentroController::class, 'getDirector']);
    Route::get('getCentro', [CentroController::class, 'getCentro'])->middleware('isLogin');

    Route::group(['middleware' => 'isTutor'], function() {

// Relacion con cursos y empresas de prácticas
        Route::post('addEmpresaCurso', [EmpresaCursoController::class, 'store']);
        Route::delete('deleteEmpresaCurso/{idEmpresa}/{idCurso}', [EmpresaCursoController::class, 'destroy']);

// Rutas Fct
        Route::post('addAlumnoPracticas', [FctController::class, 'store']);
        Route::delete('deleteAlumnoPracticas/{dniAlumno}', [FctController::class, 'destroy']);
        Route::post('addResponsableEmpresa', [EmpresasController::class, 'addResponsable']);
        Route::post('deleteResponsableEmpresa', [EmpresasController::class, 'deleteResponsable']);

        Route::get('empresas', [EmpresasController::class, 'index']);
        Route::get('empresasNoCurso/{id}', [EmpresasController::class, 'showEmpresaNoCurso']);
        Route::get('empresasCurso/{id}', [EmpresasController::class, 'showEmpresasCurso']);
        Route::post('insertEmpresa', [EmpresasController::class, 'store']);
        Route::put('updateEmpresa/{id}', [EmpresasController::class, 'update']);
        Route::post('deleteEmpresa/{id}', [EmpresasController::class, 'destroy']);


        Route::get('cursosFamilies', [CursosController::class, 'getFamilies']);

        Route::post('insertAlumno', [PersonaController::class, 'store']);
        Route::put('updateAlumno/{idAlumno}', [PersonaController::class, 'update']);
        Route::delete('deleteAlumno/{idAlumno}', [PersonaController::class, 'destroy']);
        Route::get('alumnos/{idCurso}', [PersonaController::class, 'show']);
        Route::get('alumnosCursoSinEmpresa/{idCurso}', [PersonaController::class, 'alumnosCursoSinEmpresa']);
        Route::get('alumnosCursoPracticas/{idCurso}/{idEmpresa}', [PersonaController::class, 'alumnosCursoPracticas']);
    });
    Route::group(['middleware' => 'isProfe'], function() {
        Route::get('cursos', [CursosController::class, 'index']);
        Route::post('curso', [CursosController::class, 'store']);
        Route::put('curso/{cursoId}', [CursosController::class, 'update']);
        Route::delete('curso/{cursoId}', [CursosController::class, 'destroy']);
        Route::get('cursos/{dniTutor}', [CursosController::class, 'index2']);

//----------------------ANEXOS
        Route::get('anexos', [AnexosController::class, 'index']);

        Route::get('getAnexo0/{id}', [AnexosController::class, 'anexo0']);
        Route::get('anexos', [AnexosController::class, 'index']);

        Route::post('getAnexo1', [AnexosController::class, 'anexo1']);

        Route::post('getAnexo2', [AnexosController::class, 'anexo2']);

        Route::post('getAnexo3', [AnexosController::class, 'anexo3']);

        Route::post('getAnexo4', [AnexosController::class, 'anexo4']);

        Route::post('getAnexo5', [AnexosController::class, 'anexo5']);
        
        Route::post('getAnexo6', [AnexosController::class, 'anexo6']);
        
        Route::post('getAnexo7', [AnexosController::class, 'anexo7']);
        
// Rutas Fct
Route::get('countAlumnoPracticas/{idCurso}', [FctController::class, 'countAlumnoPracticas']);
Route::post('addAlumnoPracticas', [FctController::class, 'store']);
Route::delete('deleteAlumnoPracticas/{dniAlumno}', [FctController::class, 'destroy']);
Route::get('alumnoFct/{dniAlumno}', [FctController::class, 'getAlumntoFct']);
Route::put('updateAlumnoPracticas/{dniAlumno}', [FctController::class, 'updateAlumnoFct']);

        Route::get('descargarAnexo/{id}', [AnexosController::class, 'descargar']);
    });
// Rutas Responsables de las empresas
    Route::get('responsablesEmpresas', [EmpresaPerfilesController::class, 'index']);
    Route::get('responsablesEmpresas/{idEmpresa}', [EmpresaPerfilesController::class, 'showResponsabesEmpresa']);

//Perfil
    Route::post('cambiarFoto/{dni}', [PersonaController::class, 'cambiarFoto']);

    Route::group(['middleware' => 'isJeEst'], function() {
// ADMINISTRACION
        Route::post('generarProfesores', [AdminController::class, 'insertProfesores']);
        Route::post('generarAlumnos/{idCurso}/{cicloCurso}', [AdminController::class, 'insertAlumnos']);
        Route::post('addJefeEstudios', [CentroController::class, 'addJefeEstudios']);
        Route::get('getCuentasAdministrar', [CentroController::class, 'getCuentasAdministrar']);
        Route::put('addTutorCurso/{idCurso}', [CursosController::class, 'addTutorCurso']);
        Route::get('getTutores', [CentroController::class, 'getTutores']);
        Route::get('cursosSinTutor', [CursosController::class, 'cursosSinTutor']);
        Route::put('updateAnio', [CursosController::class, 'updateAnio']);
        Route::put('activarDesactCuenta/{dni}', [CentroController::class, 'activarDesactCuenta']);
        Route::put('denegarAccesoCuenta/{dni}', [CentroController::class, 'denegarAccesoCuenta']);
        Route::post('cambiarRol', [CentroController::class, 'cambiarRol']);
        Route::get('cursosSinAlumnos', [CursosController::class, 'cursosSinAlumnos']);
        Route::get('reiniciarAlumnos', [CursosController::class, 'reiniciarAlumnos']);
        Route::get('getCuentasActivas', [CentroController::class, 'getCuentasActivas']);
    });



// Perfil
    Route::post('mod_user', [AuthController::class, 'mod_user']); // olddni -> dni, dni -> newdni
    Route::group(['middleware' => 'isUser'], function() {
        Route::put('mod_user_email', [AuthController::class, 'mod_user_email']);
        Route::put('mod_user_pass', [AuthController::class, 'mod_user_pass']);
    });
    Route::post('cambiarFoto/{dni}', [PersonaController::class, 'cambiarFoto']);
});
