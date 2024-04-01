<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use DB, Auth;
use App\Models\Racion, App\Models\Solicitud, App\Models\SolicitudDetalles;

class Reporte11Export implements FromView
{
    public $idSocio;

    function __construct( $idSocio){

        $this->idSocio = $idSocio;
    }

    public function view(): View
    {
        $solicitud = Solicitud::with('entrega')->where('id_socio',$this->idSocio)->get();
        
        $datos = [
            'solicitud' => $solicitud,
            'idSolicitud' => 0,
            'idSocio' => $this->idSocio,
            'numReporte' => 11
        ];

        return view('admin.reportes.pdf11', $datos);
    }
}
