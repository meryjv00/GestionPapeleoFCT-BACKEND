<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Empresa;

class EmpresasController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $empresas = Empresa::with('responsables')->get();
        //$empresas = Empresa::all();
        return response()->json(['code' => 200, 'message' => $empresas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $empresa = $request->input('empresa');

        $empresaBD = Empresa::create([
                    'nombre' => $empresa['nombre'],
                    'provincia' => $empresa['provincia'],
                    'localidad' => $empresa['localidad'],
                    'calle' => $empresa['calle'],
                    'cp' => $empresa['cp'],
                    'cif' => $empresa['cif'],
                    'tlf' => $empresa['tlf'],
                    'email' => $empresa['email'],
                    'dniRepresentante' => '',
                    'nombreRepresentante' => ''
        ]);
        if (!$empresaBD) {
            return response()->json(['errors' => array(['code' => 404, 'message' => 'No se ha podido registrar la empresa ' . $empresa])], 404);
        }

        return response()->json(['code' => 201, 'message' => 'Datos insertados correctamente'], 201);
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
        $empresa = Empresa::find($id);
        if (!$empresa) {
            return response()->json(['errors' => array(['code' => 404, 'message' => 'No se encuentra ninguna empresa con este id: ' . $id])], 404);
        }
        $empresa->update([
            'nombre' => $request->input('empresa')['nombre'],
            'provincia' => $request->input('empresa')['provincia'],
            'localidad' => $request->input('empresa')['localidad'],
            'calle' => $request->input('empresa')['calle'],
            'cp' => $request->input('empresa')['cp'],
            'cif' => $request->input('empresa')['cif'],
            'tlf' => $request->input('empresa')['tlf'],
            'email' => $request->input('empresa')['email'],
            'dniRepresentante' => $request->input('empresa')['dniRepresentante'],
            'nombreRepresentante' => $request->input('empresa')['nombreRepresentante']
        ]);
        return response()->json($empresa, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $eliminar = Empresa::destroy($id);
        if (!$eliminar) {
            return response()->json(['errors' => array(['code' => 404, 'message' => 'No se ha podido eliminar la empresa ' . $id])], 404);
        } else {
            return response()->json(['code' => 201, 'message' => 'Empresa eliminada correctamente'], 201);
        }
    }

    // Funcion para ver las empresas que no estan colaborando actualmente con las prácticas de un curso
    public function showEmpresaNoCurso($id){
        // SELECT * FROM empresas WHERE id NOT IN (SELECT idEmpresa FROM empresa_curso WHERE idCurso = $id)
        $empresas = Empresa::whereNotIn('id', function($query) use ($id){
            $query->select('idEmpresa')
                  ->from('empresa_curso')
                  ->where('idCurso', '=', $id);
        })->get();
        return response()->json(['code' => 200, 'message' => $empresas]);
    }

    // Funcion para ver las empresas que colaboran en las practicas de un curso
    public function showEmpresasCurso($id){
        // SELECT * FROM empresas INNER JOIN empresa_curso ON empresas.id = empresa_curso.idEmpresa WHERE empresa_curso.idCurso = $id;
        
        $empresas = Empresa::join('empresa_curso', 'empresas.id', '=', 'empresa_curso.idEmpresa',)
                            ->where('empresa_curso.idCurso', $id)
                            ->get();
        return response()->json(['code' => 200, 'message' => $empresas]);
    }
    
    //Añade un representante a una empresa determinada
    public function addResponsable(Request $req, $idEmpresa) {
        
    }

}
