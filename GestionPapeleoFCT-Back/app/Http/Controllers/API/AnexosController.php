<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anexo;


class AnexosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $anexos = Anexo::all();
        return response()->json(['code' => 200, 'message' => $anexos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


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
        $consulta = \DB::select('SELECT * FROM centro');
        $nombreCentro;
        $codigoCentro;
        $localidadCentro;
        $provinciaCentro;
        $calleCentro;
        $cpCentro;
        $cifCentro;
        $tlfCentro;
        $emailCentro;
        foreach ($consulta as $datos) {
            $codigoCentro = $datos->codigo;
            $nombreCentro = $datos->nombre;
            $provinciaCentro = $datos->provincia;
            $localidadCentro = $datos->localidad;
            $calleCentro = $datos->calle;
            $cpCentro = $datos->cp;
            $cifCentro = $datos->cif;
            $tlfCentro = $datos->tlf;
            $emailCentro = $datos->email;
        }

        //Recupera los datos del REPRESENTANTE de la empresa (próximamente)
        $nombreRepresentante = 'Pepito';
        $dniRepresentante = '123A';

        //Recupera los datos de la empresa
        $consulta = \DB::select('SELECT * FROM empresas WHERE id=' . $id);
        $nombreEmpresa;
        $localidadEmpresa;
        $provinciaEmpresa;
        $calleEmpresa;
        $cpEmpresa;
        $cifEmpresa;
        $tlfEmpresa;
        $emailEmpresa;
        foreach ($consulta as $datos) {
            $nombreEmpresa = $datos->nombre;
            $localidadEmpresa = $datos->localidad;
            $provinciaEmpresa = $datos->provincia;
            $calleEmpresa = $datos->calle;
            $cpEmpresa = $datos->cp;
            $cifEmpresa = $datos->cif;
            $tlfEmpresa = $datos->tlf;
            $emailEmpresa = $datos->email;
        }

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
        $templateProcessor->setValue('correoCentro', $emailCentro);
        $templateProcessor->setValue('nombreRepresentante', $nombreRepresentante);
        $templateProcessor->setValue('dniRepresentante', $dniRepresentante);
        $templateProcessor->setValue('nombreEmpresa', $nombreEmpresa);
        $templateProcessor->setValue('localidadEmpresa', $localidadEmpresa);
        $templateProcessor->setValue('provinciaEmpresa', $provinciaEmpresa);
        $templateProcessor->setValue('calleEmpresa', $calleEmpresa);
        $templateProcessor->setValue('cpEmpresa', $cpEmpresa);
        $templateProcessor->setValue('cifEmpresa', $cifEmpresa);
        $templateProcessor->setValue('tlfEmpresa', $tlfEmpresa);
        $templateProcessor->setValue('emailEmpresa', $emailEmpresa);
        
        //Guardar
        $fileName = "Anexo0Empresa" . $nombreEmpresa;
        $templateProcessor->saveAs($fileName . '.docx');
        //return response()->download($fileName . '.docx')->deleteFileAfterSend(false);
        return response()->json(['code' => 201, 'message' => 'HOLA'], 201);
    }

}
