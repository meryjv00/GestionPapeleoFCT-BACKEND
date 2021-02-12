<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anexo;
use PhpOffice\PhpWord\TemplateProcessor;
use App\Models\Centro;
use App\Models\Empresa;

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
    
    //------------------------------------------GENERACIÓN DE ANEXOS

    /**
     * Genera un ANEXO 0 con los datos del DIRECTOR (BD)
     * y de la EMPRESA (Request)
     * @param Request $request
     */
    public function anexo0($id) {
        //Recupera el nombre y dni del director del centro
        $consulta = \DB::select('SELECT * FROM personas WHERE dni LIKE (SELECT user_dni FROM role_user WHERE role_id=1)');
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

        //Guardar
        $fileName = "Anexo0Empresa" . $empresa->nombre;
        $templateProcessor->saveAs($fileName . '.docx');
        //return response()->download($fileName . '.docx')->deleteFileAfterSend(false);
        return response()->json(['code' => 201, 'message' => $fileName], 201);
    }
    
    

}
