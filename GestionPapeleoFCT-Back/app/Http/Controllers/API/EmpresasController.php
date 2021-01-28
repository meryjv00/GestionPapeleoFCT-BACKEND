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
        ]);
        if (!$empresaBD) {
            return response()->json(['errors' => array(['code' => 404, 'message' => 'No se ha podido registrar al usuario ' . $persona])], 404);
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

}
