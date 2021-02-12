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
        $empresas = Empresa::all();
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
            'email' => $request->input('empresa')['email']
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

}
