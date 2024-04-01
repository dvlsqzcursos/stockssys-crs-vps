<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use DB, Auth;
use App\Models\Bodega;

class Reporte14Export implements FromView
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
                DB::RAW('be.no_documento as no_documento'),
                DB::RAW('b.nombre as alimento'),
                DB::RAW('det.pl as pl'),
                DB::RAW('det.no_unidades  as descartado')
            )            
            ->join('bodegas_egresos_detalles as det', 'det.id_insumo', 'b.id')
            ->join('bodegas_egresos as be', 'be.id', 'det.id_egreso')
            ->where('b.id_institucion', $this->idSocio)
            ->where('be.id_institucion', $this->idSocio)
            ->where('be.tipo_documento', 5)
            ->where('det.no_unidades', '>',0)
            ->get();

        $datos = [
            'saldos' => $saldos,
            'idSolicitud' => 0,
            'idSocio' => $this->idSocio,
            'numReporte' => 14
        ];

        return view('admin.reportes.pdf15', $datos);
    }
}
