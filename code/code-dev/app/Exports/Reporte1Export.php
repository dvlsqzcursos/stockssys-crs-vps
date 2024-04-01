<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use DB;
use App\Models\Bodega;

class Reporte1Export implements FromView
{
    public $idSolicitud;
    public $idSocio;

    function __construct($idSolicitud, $idSocio){
        
        $this->idSolicitud = $idSolicitud;
        $this->idSocio = $idSocio;
    }

    public function view(): View
    {
        $solicitud = DB::table('solicitudes as s')
            ->select(
                DB::RAW('Distinct e.id as escuela_id'),
                DB::RAW('e.nombre as escuela_nombre'),
                'r.nombre as racion',
                'be.id as egreso'
            )            
            ->join('solicitud_detalles as det', 'det.id_solicitud', 's.id')
            ->join('escuelas as e', 'e.id', 'det.id_escuela')
            ->join('bodegas_egresos as be', 'be.id_escuela_despacho', 'det.id_escuela')
            ->join('raciones as r', 'r.id', 'be.tipo_racion')
            ->where('s.id', $this->idSolicitud)
            ->where('s.id_socio', $this->idSocio)
            ->where('be.id_solicitud_despacho', $this->idSolicitud)
            ->get();

        $alimentos = DB::table('solicitudes as s')
            ->select(
                DB::RAW('Distinct e.id as escuela_id'),
                DB::RAW('e.nombre as escuela_nombre'),
                'r.nombre as racion',
                'a.nombre as insumo',
                'be_det.no_unidades as cantidad'
            )            
            ->join('solicitud_detalles as det', 'det.id_solicitud', 's.id')
            ->join('escuelas as e', 'e.id', 'det.id_escuela')
            ->join('bodegas_egresos as be', 'be.id_escuela_despacho', 'det.id_escuela')            
            ->join('raciones as r', 'r.id', 'be.tipo_racion')
            ->join('bodegas_egresos_detalles as be_det', 'be_det.id_egreso', 'be.id')  
            ->join('bodegas as a', 'a.id', 'be_det.id_insumo')  
            ->where('s.id', $this->idSolicitud)
            ->where('s.id_socio', $this->idSocio)
            ->where('be.id_solicitud_despacho', $this->idSolicitud)
            ->get();
            $pesos = Bodega::with(['pesos_alimento'])->where('tipo_bodega',1)->where('id_institucion', $this->idSocio)->get();

        $total_escuelas = DB::table('solicitudes as s')
            ->select(
                DB::RAW('COUNT(Distinct det.id_escuela) as total'),
            )            
            ->join('solicitud_detalles as det', 'det.id_solicitud', 's.id')
            ->join('bodegas_egresos as be', 'be.id_escuela_despacho', 'det.id_escuela')
            ->where('s.id', $this->idSolicitud)
            ->where('s.id_socio', $this->idSocio)
            ->where('be.id_solicitud_despacho', $this->idSolicitud)
            ->get();

        $datos = [
            'solicitud' => $solicitud,
            'alimentos' => $alimentos,
            'pesos' => $pesos,
            'total_escuelas' => $total_escuelas,
            'idSolicitud' => $this->idSolicitud,
            'idSocio' => $this->idSocio,
            'numReporte' => 1
        ];

        return view('admin.reportes.pdf1_formato1', $datos);
    }
}
