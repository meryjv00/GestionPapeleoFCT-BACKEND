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
        $consulta = \DB::select('SELECT * FROM personas WHERE dni LIKE (SELECT dni FROM users WHERE id=(SELECT user_id FROM role_user WHERE role_id=1))');
        $nombre;
        $apellidos;
        $dniDirector;
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

        //Recupera los datos del REPRESENTANTE de la empresa (hay que modificar la estructura de la BD)
        $nombreRepresentante = 'Pepito';
        $dniRepresentante = '123A';

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
        $templateProcessor->setValue('nombreRepresentante', $nombreRepresentante);
        $templateProcessor->setValue('dniRepresentante', $dniRepresentante);
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
        $convenio = Convenio::find($req->input('datos')['numConvenio']);
        if (!$convenio) {
            return response()->json(['errors' => array(['code' => 404, 'message' => 'No se ha podido encontrar el convenio.'])], 404);
        }
        
        //Curso
        $curso = Curso::find($req->input('datos')['idCurso']);
        if (!$curso) {
            return response()->json(['errors' => array(['code' => 404, 'message' => 'No se ha podido encontrar el curso.'])], 404);
        }
        
        //Tutor
        $tutor = Persona::where('dni','LIKE',$curso->dniTutor)->first();

        //Centro
        $centro = Centro::all()->last();

        //Empresa
        $empresa = Empresa::find($convenio->idEmpresa);

        //Alumnos-fct (filas)
        $alumnosfct = [];
        $consulta = \DB::select('SELECT personas.nombre, personas.apellidos, personas.dni, personas.localidad, fct_alumno.fechaComienzo, fct_alumno.fechaFin, fct_alumno.nombreResponsable, fct_alumno.horarioDiario, fct_alumno.nHoras '
                        . 'FROM personas INNER JOIN fct_alumno ON personas.dni = fct_alumno.dniAlumno '
                        . 'WHERE fct_alumno.idEmpresa = 1 AND personas.dni IN (SELECT dniAlumno FROM curso_alumno WHERE idCurso = 1)');
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

        //Guardar
        $templateProcessor->saveAs('PruebaFilas.docx');
        return response()->json(['code' => 201, 'message' => 'HOLA, todo ha ido bien'], 201);

        //Descargar (pruebas)
        //return response()->download('PruebaFilas.docx')->deleteFileAfterSend(false);
    }

}
