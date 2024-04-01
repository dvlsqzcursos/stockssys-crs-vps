<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use DB, Auth;
use App\Models\Racion, App\Models\Bodega;

class Reporte6Export implements FromView
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
                DB::RAW('Distinct rs.id as idruta'),
                DB::RAW('rs.nombre as ruta')
            )            
            ->join('solicitud_detalles as det', 'det.id_solicitud', 's.id')
            ->join('escuelas as e', 'e.id', 'det.id_escuela')
            ->join('bodegas_egresos as be', 'be.id_escuela_despacho', 'det.id_escuela')
            ->join('rutas_solicitudes_despachos_detalles as rsdet', 'rsdet.id_escuela', 'e.id')
            ->join('rutas_solicitudes_despachos as rs', 'rs.id', 'rsdet.id_ruta_despacho')
            ->where('s.id', $this->idSolicitud)
            ->where('s.id_socio', $this->idSocio)
            ->where('be.id_solicitud_despacho', $this->idSolicitud)
            ->whereNull('rs.deleted_at')
            ->whereNull('rsdet.deleted_at')
            ->groupBy('e.id','e.nombre','rs.id','rs.nombre')
            ->get();

        //return $solicitud;

        $alimentos = DB::table('solicitudes as s')
            ->select(
                DB::RAW('r.nombre as racion'),
                DB::RAW('a.id as idinsumo'),
                DB::RAW('a.nombre as insumo'),
                DB::RAW('be_det.no_unidades as cantidad'),
                DB::RAW('rsdet.id_ruta_despacho as idruta')
            )            
            ->join('solicitud_detalles as det', 'det.id_solicitud', 's.id')
            ->join('escuelas as e', 'e.id', 'det.id_escuela')
            ->join('bodegas_egresos as be', 'be.id_escuela_despacho', 'det.id_escuela')
            ->join('bodegas_egresos_detalles as be_det', 'be_det.id_egreso', 'be.id') 
            ->join('raciones as r', 'r.id', 'be.tipo_racion')
            ->join('bodegas as a', 'a.id', 'be_det.id_insumo')
            ->join('rutas_solicitudes_despachos_detalles as rsdet', 'rsdet.id_escuela', 'e.id')
            ->where('s.id', $this->idSolicitud)
            ->where('s.id_socio', $this->idSocio)
            ->where('be.id_solicitud_despacho', $this->idSolicitud)
            ->groupBy('e.id','e.nombre','r.nombre', 'a.nombre','be_det.no_unidades','a.id','rsdet.id_ruta_despacho')
            ->get();
        
        //return $alimentos;

        $alimentos_bodega = Bodega::where('categoria' , 0)->where('tipo_bodega',1)->where('id_institucion', Auth::user()->id_institucion)->orderBy('id', 'Asc')->get();

        //return $alimentos_bodega;
        $total_rutas = DB::table('solicitudes as s')
            ->select(
                DB::RAW('COUNT(DISTINCT rs.id) as total')
            )            
            ->join('solicitud_detalles as det', 'det.id_solicitud', 's.id')
            ->join('escuelas as e', 'e.id', 'det.id_escuela')
            ->join('bodegas_egresos as be', 'be.id_escuela_despacho', 'det.id_escuela')
            
            ->join('rutas_solicitudes_despachos_detalles as rsdet', 'rsdet.id_escuela', 'e.id')
            ->join('rutas_solicitudes_despachos as rs', 'rs.id', 'rsdet.id_ruta_despacho')
            ->where('s.id', $this->idSolicitud)
            ->where('s.id_socio', $this->idSocio)
            ->where('be.id_solicitud_despacho', $this->idSolicitud)
            ->whereNull('rs.deleted_at')
            ->whereNull('rsdet.deleted_at')
            ->get();
        
        


        $datos = [
            'solicitud' => $solicitud,
            'alimentos' => $alimentos,
            'alimentos_bodega' => $alimentos_bodega,
            'total_rutas' => $total_rutas,
            'idSolicitud' => $this->idSolicitud,
            'idSocio' => $this->idSocio,
            'numReporte' => 6
        ];

        return view('admin.reportes.pdf6', $datos);
    }
}
