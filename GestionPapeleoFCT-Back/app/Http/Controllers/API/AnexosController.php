<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;
use App\Models\Anexo;
use App\Models\AnexosGenerados;
use App\Models\Centro;
use App\Models\Empresa;
use App\Models\Persona;
use App\Models\Convenio;
use App\Models\Curso;
use App\Models\Fct;

class AnexosController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $anexos = Anexo::all();
        return response()->json(['code' => 200, 'message' => $anexos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    //------------------------------------------DESCARGA DE ANEXOS

    /**
     * Manda descargar un anexo definido por su id (tabla anexosgenerados) y luego lo elimina
     * @param type $id
     */
    public function descargar($id) {
        $anexo = AnexosGenerados::find($id);
        //Lo define como 'guardado'
        $anexo->update([
            'descargado' => 1
        ]);
        //Lo manda descargar y eliminar
        $anexo = $anexo->nombre;
        return response()->download($anexo . '.docx')->deleteFileAfterSend(true);
    }

    //------------------------------------------GENERACIÓN DE ANEXOS

    /**
     * Genera un ANEXO 0 con los datos del DIRECTOR (BD)
     * y de la EMPRESA (Request)
     * @param Request $request
     */
    public function anexo0($id) {
        //Recupera el nombre y dni del director del centro
        $consulta = \DB::select('SELECT * FROM personas WHERE dni LIKE (SELECT user_dni FROM role_user WHERE role_id=1)');
        
        foreach ($consulta as $datos) {
            $nombre = $datos->nombre;
            $apellidos = $datos->apellidos;
            $dniDirector = $datos->dni;
        }
        $nombreDirector = $nombre . ' ' . $apellidos;

        //Recupera los datos del centro
        foreach (Centro::all() as $centro) {
            $codigoCentro = $centro->codigo;
            $nombreCentro = $centro->nombre;
            $provinciaCentro = $centro->provincia;
            $localidadCentro = $centro->localidad;
            $calleCentro = $centro->calle;
            $cpCentro = $centro->cp;
            $cifCentro = $centro->cif;
            $tlfCentro = $centro->tlf;
            $emailCentro = $centro->email;
        }

        //Recupera los datos de la empresa
        $empresa = Empresa::find($id);

        //Pinta el archivo .docx
        $templateProcessor = new TemplateProcessor('word-template/anexo0_convenio.docx');
        $templateProcessor->setValue('nombreDirector', $nombreDirector);
        $templateProcessor->setValue('dniDirector', $dniDirector);
        $templateProcessor->setValue('nombreCentro', $nombreCentro);
        $templateProcessor->setValue('codigoCentro', $codigoCentro);
        $templateProcessor->setValue('localidadCentro', $localidadCentro);
        $templateProcessor->setValue('provinciaCentro', $provinciaCentro);
        $templateProcessor->setValue('calleCentro', $calleCentro);
        $templateProcessor->setValue('cpCentro', $cpCentro);
        $templateProcessor->setValue('cifCentro', $cifCentro);
        $templateProcessor->setValue('tlfCentro', $tlfCentro);
        $templateProcessor->setValue('emailCentro', $emailCentro);
        $templateProcessor->setValue('nombreRepresentante', $empresa->nombreRepresentante);
        $templateProcessor->setValue('dniRepresentante', $empresa->dniRepresentante);
        $templateProcessor->setValue('nombreEmpresa', $empresa->nombre);
        $templateProcessor->setValue('localidadEmpresa', $empresa->localidad);
        $templateProcessor->setValue('provinciaEmpresa', $empresa->provincia);
        $templateProcessor->setValue('calleEmpresa', $empresa->calle);
        $templateProcessor->setValue('cpEmpresa', $empresa->cp);
        $templateProcessor->setValue('cifEmpresa', $empresa->cif);
        $templateProcessor->setValue('tlfEmpresa', $empresa->tlf);
        $templateProcessor->setValue('emailEmpresa', $empresa->email);

        //Nombre del archivo
        $fileName = "Anexo0Empresa" . $empresa->nombre;

        //Guardar registro en BD
        $anexoGen = AnexosGenerados::create([
                    'nombre' => $fileName,
                    'descargado' => 0
        ]);
        $idAnexo = $anexoGen->id;

        //Guardar
        $templateProcessor->saveAs($fileName . '.docx');

        //Devuelve el CÓDIGO del anexo generado para su posterior descarga
        return response()->json(['code' => 201, 'message' => $idAnexo], 201);
    }

    /**
     * Genera un anexo 1
     * Recibe el OBJETO datos{numConvenio, idCurso}
     * Utiliza Persona, Fct, Convenio
     * @param Request $req
     * @return type
     */
    public function anexo1(Request $req) {
        //--------------------------DATOS
        //Convenio
        $convenio = Convenio::where('numConvenio', 'LIKE', $req->input('datos')['numConvenio'])->first();
        if (!$convenio) {
            return response()->json(['errors' => array(['code' => 404, 'message' => 'No se ha podido encontrar el convenio.'])], 404);
        }

        //Curso
        $curso = Curso::find($req->input('datos')['idCurso']);
        if (!$curso) {
            return response()->json(['errors' => array(['code' => 404, 'message' => 'No se ha podido encontrar el curso.'])], 404);
        }

        //Tutor
        $tutor = Persona::where('dni', 'LIKE', $curso->dniTutor)->first();

        //Centro
        $centro = Centro::all()->last();

        //Empresa
        $empresa = Empresa::find($convenio->idEmpresa);

        //Alumnos-fct (filas)
        $alumnosfct = [];
        $consulta = \DB::select('SELECT personas.nombre, personas.apellidos, personas.dni, personas.localidad, fct_alumno.fechaComienzo, fct_alumno.fechaFin, fct_alumno.nombreResponsable, fct_alumno.horarioDiario, fct_alumno.nHoras '
                        . 'FROM personas INNER JOIN fct_alumno ON personas.dni = fct_alumno.dniAlumno '
                        . 'WHERE fct_alumno.idEmpresa = ' . $empresa->id . ' AND personas.dni IN (SELECT dniAlumno FROM curso_alumno WHERE idCurso = ' . $curso->id . ')');
        $nombreResponsable;
        foreach ($consulta as $datos) {
            $nombreCompleto = $datos->nombre . ' ' . $datos->apellidos;
            $alumno = array(
                'nombreCompleto' => $nombreCompleto,
                'dni' => $datos->dni,
                'localidad' => $datos->localidad,
                'horarioDiario' => $datos->horarioDiario,
                'nHoras' => $datos->nHoras,
                'fechaComienzo' => $datos->fechaComienzo,
                'fechaFin' => $datos->fechaFin
            );
            $alumnosfct[] = $alumno;
            $nombreResponsable = $datos->nombreResponsable;
        }


        //--------------------------PROCESO
        $templateProcessor = new TemplateProcessor('word-template/anexo1_relacion_alumnos.docx');

        //Se insertan los datos en el archivo
        $templateProcessor->setValue('numConvenio', $convenio->numConvenio);
        $templateProcessor->setValue('nombreCentro', $centro->nombre);
        $templateProcessor->setValue('nombreEmpresa', $empresa->nombre);

        //Nota: El centro de trabajo se supone es la dirección de la empresa (direccion, poblacion)
        $centroTrabajo = $empresa->calle . ', ' . $empresa->localidad;
        $templateProcessor->setValue('centroTrabajo', $centroTrabajo);

        $templateProcessor->setValue('nombreCiclo', $curso->cicloFormativo);

        $nombreTutor = $tutor->apellidos . ', ' . $tutor->nombre;
        $templateProcessor->setValue('nombreTutor', $nombreTutor);

        $templateProcessor->setValue('nombreResponsable', $nombreResponsable);

        //Inserta las filas de los alumnos de la FCT
        $templateProcessor->cloneRowAndSetValues('nombreCompleto', $alumnosfct);

        //Nombre del archivo
        $fileName = "Anexo1Alumnos" . $empresa->nombre;

        //Guardar registro en BD
        $anexoGen = AnexosGenerados::create([
                    'nombre' => $fileName,
                    'descargado' => 0
        ]);
        $idAnexo = $anexoGen->id;

        //Guardar
        $templateProcessor->saveAs($fileName . '.docx');
        return response()->json(['code' => 201, 'message' => $idAnexo], 201);
    }

    /**
     * Genera un anexo 2
     * Recibe el OBJETO datos {idAlumno, idEmpresa, idCurso}
     */
    public function anexo2(Request $req) {
        //--------------------------DATOS
        //Curso
        $curso = Curso::find($req->get('datos')['idCurso']);

        //Empresa
        $empresa = Empresa::find($req->get('datos')['idEmpresa']);

        //Alumno
        $alumno = Persona::find($req->get('datos')['idAlumno']);

        //FCT
        $fct = Fct::where('idEmpresa', '=', $empresa->id)
                ->where('dniAlumno', 'LIKE', $alumno->dni)
                ->first();

        //Centro
        $centro = Centro::all()->last();

        //Tutor
        $tutor = Persona::where('dni', 'LIKE', $centro->dniTutor)->first();

        //--------------------------PROCESO
        //Plantilla
        $templateProcessor = new TemplateProcessor('word-template/anexo2_programa_formativo.docx');

        //----Se inserta los datos en el archivo
        //Datos del centro
        $templateProcessor->setValue('nombreCentro', $centro->nombre);
        $templateProcessor->setValue('codigoCentro', $centro->codigo);

        //Tutor
        $nombreTutor = $tutor->nombre . ' ' . $tutor->apellidos;
        $templateProcessor->setValue('nombreTutor', $nombreTutor);

        //Centro de trabajo
        $centroTrabajo = $empresa->calle . ', ' . $empresa->localidad;
        $templateProcessor->setValue('centroTrabajo', $centroTrabajo);

        //Datos de la fct del alumno
        $templateProcessor->setValue('nombreResponsable', $fct->nombreResponsable);
        $templateProcessor->setValue('fechaComienzo', $fct->fechaComienzo);
        $templateProcessor->setValue('fechaFin', $fct->fechaFin);
        $templateProcessor->setValue('nHoras', $fct->nHoras);

        //Datos del curso
        $templateProcessor->setValue('familiaProfesional', $curso->familiaProfesional);
        $templateProcessor->setValue('cicloFormativo', $curso->cicloFormativo);
        $templateProcessor->setValue('nombreResponsable', $fct->nombreResponsable);

        //Nombre del archivo
        $fileName = "Anexo2ProgramaFormativo-" . $alumno->nombre . $alumno->apellidos;

        //Guardar registro en BD
        $anexoGen = AnexosGenerados::create([
                    'nombre' => $fileName,
                    'descargado' => 0
        ]);
        $idAnexo = $anexoGen->id;

        //Guardar
        $templateProcessor->saveAs($fileName . '.docx');
        return response()->json(['code' => 201, 'message' => $idAnexo], 201);
    }

    /**
     * Genera un anexo 3
     * Recibe el OBJETO datos {idAlumno, idEmpresa, idCurso}
     * @param Request $req
     */
    public function anexo3(Request $req) {
        //--------------------------DATOS
        //Curso
        $curso = Curso::find($req->get('datos')['idCurso']);

        //Empresa
        $empresa = Empresa::find($req->get('datos')['idEmpresa']);

        //Alumno
        $alumno = Persona::find($req->get('datos')['idAlumno']);

        //FCT
        $fct = Fct::where('idEmpresa', '=', $empresa->id)
                ->where('dniAlumno', 'LIKE', $alumno->dni)
                ->first();

        //Centro
        $centro = Centro::all()->last();

        //Tutor
        $tutor = Persona::where('dni', 'LIKE', $centro->dniTutor)->first();

        //--------------------------PROCESO
        //Plantilla
        $templateProcessor = new TemplateProcessor('word-template/anexo3_hoja_semanal.docx');

        //----Se inserta los datos en el archivo
        //Datos del centro
        $templateProcessor->setValue('nombreCentro', $centro->nombre);
        $templateProcessor->setValue('codigoCentro', $centro->codigo);

        //Tutor
        $nombreTutor = $tutor->nombre . ' ' . $tutor->apellidos;
        $templateProcessor->setValue('nombreTutor', $nombreTutor);

        //Centro de trabajo
        $centroTrabajo = $empresa->calle . ', ' . $empresa->localidad;
        $templateProcessor->setValue('centroTrabajo', $centroTrabajo);

        //Datos de la fct del alumno
        $templateProcessor->setValue('nombreResponsable', $fct->nombreResponsable);
        $templateProcessor->setValue('fechaComienzo', $fct->fechaComienzo);
        $templateProcessor->setValue('fechaFin', $fct->fechaFin);
        $templateProcessor->setValue('nHoras', $fct->nHoras);

        //Datos del curso
        $templateProcessor->setValue('familiaProfesional', $curso->familiaProfesional);
        $templateProcessor->setValue('cicloFormativo', $curso->cicloFormativo);
        $templateProcessor->setValue('nombreResponsable', $fct->nombreResponsable);

        //Alumno
        $nombreAlumno = $alumno->nombre . ' ' . $alumno->apellidos;
        $templateProcessor->setValue('nombreAlumno', $nombreAlumno);

        //Nombre del archivo
        $fileName = "Anexo3HojaSemanal-" . $alumno->nombre . $alumno->apellidos;

        //Guardar registro en BD
        $anexoGen = AnexosGenerados::create([
                    'nombre' => $fileName,
                    'descargado' => 0
        ]);
        $idAnexo = $anexoGen->id;

        //Guardar
        $templateProcessor->saveAs($fileName . '.docx');
        return response()->json(['code' => 201, 'message' => $idAnexo], 201);
    }

    /**
     * Genera un anexo 4
     * Recibe el OBJETO datos {idAlumno, idEmpresa, idCurso}
     * @param Request $req
     */
    public function anexo4(Request $req) {
        //--------------------------DATOS
        //Curso
        $curso = Curso::find($req->get('datos')['idCurso']);

        //Empresa
        $empresa = Empresa::find($req->get('datos')['idEmpresa']);

        //Alumno
        $alumno = Persona::find($req->get('datos')['idAlumno']);

        //FCT
        $fct = Fct::where('idEmpresa', '=', $empresa->id)
                ->where('dniAlumno', 'LIKE', $alumno->dni)
                ->first();

        //Centro
        $centro = Centro::all()->last();

        //Tutor
        $tutor = Persona::where('dni', 'LIKE', $centro->dniTutor)->first();

        //--------------------------PROCESO
        //Plantilla
        $templateProcessor = new TemplateProcessor('word-template/anexo4_evaluacion.docx');

        //----Se inserta los datos en el archivo
        //Datos del centro
        $templateProcessor->setValue('nombreCentro', $centro->nombre);
        $templateProcessor->setValue('codigoCentro', $centro->codigo);

        //Tutor
        $nombreTutor = $tutor->nombre . ' ' . $tutor->apellidos;
        $templateProcessor->setValue('nombreTutor', $nombreTutor);

        //Centro de trabajo
        $centroTrabajo = $empresa->calle . ', ' . $empresa->localidad;
        $templateProcessor->setValue('centroTrabajo', $centroTrabajo);

        //Datos de la fct del alumno
        $templateProcessor->setValue('nombreResponsable', $fct->nombreResponsable);
        $templateProcessor->setValue('fechaComienzo', $fct->fechaComienzo);
        $templateProcessor->setValue('fechaFin', $fct->fechaFin);
        $templateProcessor->setValue('nHoras', $fct->nHoras);

        //Datos del curso
        $templateProcessor->setValue('familiaProfesional', $curso->familiaProfesional);
        $templateProcessor->setValue('cicloFormativo', $curso->cicloFormativo);
        $templateProcessor->setValue('nombreResponsable', $fct->nombreResponsable);

        //Alumno
        $nombreAlumno = $alumno->nombre . ' ' . $alumno->apellidos;
        $templateProcessor->setValue('nombreAlumno', $nombreAlumno);

        //Nombre del archivo
        $fileName = "Anexo4Evaluacion-" . $alumno->nombre . $alumno->apellidos;

        //Guardar registro en BD
        $anexoGen = AnexosGenerados::create([
                    'nombre' => $fileName,
                    'descargado' => 0
        ]);
        $idAnexo = $anexoGen->id;

        //Guardar
        $templateProcessor->saveAs($fileName . '.docx');
        return response()->json(['code' => 201, 'message' => $idAnexo], 201);
    }

    /**
     * Genera un anexo 5
     * Recibe el OBJETO datos {idAlumno, idEmpresa, idCurso}
     * @param Request $req
     */
    public function anexo5(Request $req) {
        //--------------------------DATOS
        //Curso
        $curso = Curso::find($req->get('datos')['idCurso']);

        //Empresa
        $empresa = Empresa::find($req->get('datos')['idEmpresa']);

        //Alumno
        $alumno = Persona::find($req->get('datos')['idAlumno']);

        //FCT
        $fct = Fct::where('idEmpresa', '=', $empresa->id)
                ->where('dniAlumno', 'LIKE', $alumno->dni)
                ->first();

        //Centro
        $centro = Centro::all()->last();

        //Tutor
        $tutor = Persona::where('dni', 'LIKE', $centro->dniTutor)->first();

        //--------------------------PROCESO
        //Plantilla
        $templateProcessor = new TemplateProcessor('word-template/anexo5_recibi.docx');

        //----Se inserta los datos en el archivo
        //Datos del centro
        $templateProcessor->setValue('nombreCentro', $centro->nombre);
        $templateProcessor->setValue('localidadCentro', $centro->localidad);
        $templateProcessor->setValue('codigoCentro', $centro->codigo);

        //Tutor
        $nombreTutor = $tutor->nombre . ' ' . $tutor->apellidos;
        $templateProcessor->setValue('nombreTutor', $nombreTutor);

        //Datos de la fct del alumno
        $templateProcessor->setValue('fechaComienzo', $fct->fechaComienzo);
        $templateProcessor->setValue('fechaFin', $fct->fechaFin);
        $templateProcessor->setValue('nHoras', $fct->nHoras);

        //Datos del curso
        $templateProcessor->setValue('familiaProfesional', $curso->familiaProfesional);
        $templateProcessor->setValue('cicloFormativo', $curso->cicloFormativo);

        //Alumno
        $nombreAlumno = $alumno->nombre . ' ' . $alumno->apellidos;
        $templateProcessor->setValue('nombreAlumno', $nombreAlumno);
        
        //Empresa
        $templateProcessor->setValue('nombreEmpresa', $empresa->nombre);
        $templateProcessor->setValue('localidadEmpresa', $empresa->localidad);
        $direccionEmpresa = $empresa->calle . ', ' . $empresa->cp . ' ' . $empresa->localidad;
        $templateProcessor->setValue('direccionEmpresa', $direccionEmpresa);        

        //Nombre del archivo
        $fileName = "Anexo5Recibi-" . $alumno->nombre . $alumno->apellidos;

        //Guardar registro en BD
        $anexoGen = AnexosGenerados::create([
                    'nombre' => $fileName,
                    'descargado' => 0
        ]);
        $idAnexo = $anexoGen->id;

        //Guardar
        $templateProcessor->saveAs($fileName . '.docx');
        return response()->json(['code' => 201, 'message' => $idAnexo], 201);
    }

}
