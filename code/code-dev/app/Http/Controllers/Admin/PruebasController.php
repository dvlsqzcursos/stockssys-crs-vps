<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Ubicacion;
use Validator, Auth, Hash, Config, Carbon\Carbon;
use App\Imports\PruebasImport;
use Maatwebsite\Excel\Facades\Excel;

class PruebasController extends Controller
{
  
    public function getInicio(){
        

        $datos = [

        ];

        return view('admin.pruebas.inicio',$datos);
    }

    public function postArchivoImportar(Request $request){
        //Excel::import(new UbicacionesImport, request()->file('ubicaciones'));
        //return $ubicaciones;
        $prueba = Excel::toArray(new PruebasImport, request()->file('ubicaciones'));
        $resultados;

        foreach($prueba[0] as $p):
            $resultados[] = $p;
        endforeach;
        $ubicaciones = Ubicacion::with('ubicacion_superior')->where('nivel', 3)->get();

        $datos = [
            'resultados' => $resultados,
            'ubicaciones' => $ubicaciones
        ]; 

        return view('admin.pruebas.validar_import', $datos);
        //return back()->with('messages', '¡Ubicaciones importadas con exito!.')
                    //->with('typealert', 'info');
    }
}
