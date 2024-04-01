<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use DB, Auth;
use App\Models\Bodega, App\Models\Institucion;

class Reporte16Export implements FromView
{
    public $idSocio;

    function __construct( $idSocio){

        $this->idSocio = $idSocio;
    }

    public function view(): View
    {
        $alimentos = Bodega::where('nombre','LIKE', 'Maiz Bio')->where('tipo_bodega',1)->where('id_institucion', $this->idSocio)->first();
        $bodegas = Institucion::where('nivel', 2)->get();

        $saldos = DB::table('bodegas as b')
            ->select(
                DB::RAW('bi.tipo_documento as tipo_documento'),
                DB::RAW('bi.no_documento as no_documento'),
                DB::RAW('bi.fecha as fecha_ingreso'),
                DB::RAW('bi.id_bodega_despacho as bodega_primaria'),
                DB::RAW('bi.procedente as procedente'),
                DB::RAW('b.nombre as alimento'),
                DB::RAW('det.pl as pl'),
                DB::RAW('det.bubd as bubd'),
                DB::RAW('det.no_unidades  as ingresado')
            )            
            ->join('bodegas_ingresos_detalles as det', 'det.id_insumo', 'b.id')
            ->join('bodegas_ingresos as bi', 'bi.id', 'det.id_ingreso')
            ->where('b.id_institucion', $this->idSocio)
            ->where('det.id_insumo', $alimentos->id)
            ->get();

        $datos = [
            'saldos' => $saldos,
            'bodegas' => $bodegas,
            'idSolicitud' => 0,
            'idSocio' => $this->idSocio,
            'numReporte' => 16
        ];

        return view('admin.reportes.pdf16', $datos);
    }
}
