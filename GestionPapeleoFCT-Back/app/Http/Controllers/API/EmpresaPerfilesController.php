<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmpresaPerfiles;

class EmpresaPerfilesController extends Controller
{
    // Metódo para obtener todos los perfiles de los responsables de las empresas
        public function index() {
        $responsables = EmpresaPerfiles::all();
        return response()->json(['code' => 200, 'message' => $responsables]);
    }

    // Método que muestra los responsables de una empresa
    public function showResponsabesEmpresa($idEmpresa){
        $responsables = EmpresaPerfiles::where('idEmpresa', '=', $idEmpresa)
                ->get();
        return response()->json(['code' => 200, 'message' => $responsables]);
    }

}
