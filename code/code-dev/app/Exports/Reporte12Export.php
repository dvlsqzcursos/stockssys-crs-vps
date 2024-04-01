<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use DB, Auth;
use App\Models\Bodega;

class Reporte12Export implements FromView
{
    public $idSocio;

    function __construct( $idSocio){

        $this->idSocio = $idSocio;
    }

    public function view(): View
    {
        $alimentos = Bodega::where('tipo_bodega',1)->where('id_institucion', $this->idSocio)->get();

        $saldos = DB::table('bodegas as b')
            ->select(
                DB::RAW('det.id_insumo as idinsumo'),
                DB::RAW('det.pl as pl'),
                DB::RAW('det.bubd as bubd'),
                DB::RAW('det.no_unidades  as ingresado'),
                DB::RAW('det.no_unidades_usadas as usado'),
                DB::RAW('(det.no_unidades - det.no_unidades_usadas) as existencia')
            )            
            ->join('bodegas_ingresos_detalles as det', 'det.id_insumo', 'b.id')
            ->where('b.id_institucion', $this->idSocio)
            ->get();

        //return $saldos;

        $datos = [
            'alimentos' => $alimentos,
            'saldos' => $saldos,
            'idSolicitud' => 0,
            'idSocio' => $this->idSocio,
            'numReporte' => 12
        ];

        return view('admin.reportes.pdf12', $datos);
    }
}
