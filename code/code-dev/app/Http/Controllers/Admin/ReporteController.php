<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Exports\InformeMensualExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Bodega;
use Validator, Auth, Hash, Config, Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;


class ReporteController extends Controller
{
    public function getInicio(){       

        $datos = [
            
        ];

        return view('admin.reportes.inicio',$datos);
    }

    public function postInformeMensualExport() 
    {
        $alimentos = Bodega::where('categoria' , 0)->where('tipo_bodega',1)->where('id_institucion', Auth::user()->id_institucion)->get();
        
        //return $alimentos;
        //return Excel::download(new InformeMensualExport, 'informe mensual.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
        return Excel::download(new InformeMensualExport, 'informe mensual.xlsx');
    }
}
