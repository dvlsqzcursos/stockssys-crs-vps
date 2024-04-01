<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use DB, Auth;
use App\Models\Racion, App\Models\Bodega;

class Reporte5Export implements FromView
{
    public $idSolicitud;
    public $idSocio;

    function __construct($idSolicitud, $idSocio){
        
        $this->idSolicitud = $idSolicitud;
        $this->idSocio = $idSocio;
    }

    public function view(): View
    {
        $racion_estudiante = Racion::where('tipo_alimentos', 'solicitud_comida_escolar')->where('id_institucion', Auth::user()->id_institucion)->get();
               
        foreach($racion_estudiante as $r):
            if($r->nombre == "Escolar"):
                $idRacion = $r->id;
            else:
                $idRacion1 = $r->id;
            endif;
        endforeach;

            
        $solicitud = DB::table('solicitudes as s')
            ->select(
                DB::RAW('e.id as escuela_id'),
                DB::RAW('e.nombre as escuela_nombre'),
                DB::RAW('r.nombre as racion'),
                DB::RAW('be.id as egreso'),
                DB::RAW('SUM(det.total_pre_primaria_a_tercero_primaria) as total_estudiantes')
            )            
            ->join('solicitud_detalles as det', 'det.id_solicitud', 's.id')
            ->join('escuelas as e', 'e.id', 'det.id_escuela')
            ->join('bodegas_egresos as be', 'be.id_escuela_despacho', 'det.id_escuela')
            ->join('raciones as r', 'r.id', 'be.tipo_racion')
            ->where('det.tipo_de_actividad_alimentos',$idRacion)
            ->where('be.tipo_racion',$idRacion)
            ->where('s.id', $this->idSolicitud)
            ->where('s.id_socio', $this->idSocio)
            ->where('be.id_solicitud_despacho', $this->idSolicitud)
            ->groupBy('e.id','e.nombre','r.nombre', 'be.id')
            ->get();

        $solicitud1 = DB::table('solicitudes as s')
            ->select(
                DB::RAW('e.id as escuela_id'),
                DB::RAW('e.nombre as escuela_nombre'),
                DB::RAW('r.nombre as racion'),
                DB::RAW('be.id as egreso'),
                DB::RAW('SUM(det.total_cuarto_a_sexto) as total_estudiantes')
            )            
            ->join('solicitud_detalles as det', 'det.id_solicitud', 's.id')
            ->join('escuelas as e', 'e.id', 'det.id_escuela')
            ->join('bodegas_egresos as be', 'be.id_escuela_despacho', 'det.id_escuela')
            ->join('raciones as r', 'r.id', 'be.tipo_racion')
            ->where('det.tipo_de_actividad_alimentos',$idRacion1)
            ->where('be.tipo_racion',$idRacion1)
            ->where('s.id', $this->idSolicitud)
            ->where('s.id_socio', $this->idSocio)
            ->where('be.id_solicitud_despacho', $this->idSolicitud)
            ->groupBy('e.id','e.nombre','r.nombre', 'be.id')
            ->get();

        $alimentos = DB::table('solicitudes as s')
            ->select(
                DB::RAW('e.id as escuela_id'),
                DB::RAW('e.nombre as escuela_nombre'),
                DB::RAW('r.nombre as racion'),
                DB::RAW('a.nombre as insumo'),
                DB::RAW('be_det.no_unidades as cantidad'),
                DB::RAW('SUM(det.total_pre_primaria_a_tercero_primaria) as total_estudiantes')
            )            
            ->join('solicitud_detalles as det', 'det.id_solicitud', 's.id')
            ->join('escuelas as e', 'e.id', 'det.id_escuela')
            ->join('bodegas_egresos as be', 'be.id_escuela_despacho', 'det.id_escuela')
            ->join('bodegas_egresos_detalles as be_det', 'be_det.id_egreso', 'be.id') 
            ->join('raciones as r', 'r.id', 'be.tipo_racion')
            ->join('bodegas as a', 'a.id', 'be_det.id_insumo')
            ->where('det.tipo_de_actividad_alimentos',$idRacion)
            ->where('be.tipo_racion',$idRacion)
            ->where('s.id', $this->idSolicitud)
            ->where('s.id_socio', $this->idSocio)
            ->where('be.id_solicitud_despacho', $this->idSolicitud)
            ->groupBy('e.id','e.nombre','r.nombre', 'a.nombre','be_det.no_unidades')
            ->get();
        
        $alimentos1 = DB::table('solicitudes as s')
            ->select(
                DB::RAW('e.id as escuela_id'),
                DB::RAW('e.nombre as escuela_nombre'),
                DB::RAW('r.nombre as racion'),
                DB::RAW('a.nombre as insumo'),
                DB::RAW('be_det.no_unidades as cantidad'),
                DB::RAW('SUM(det.total_cuarto_a_sexto) as total_estudiantes')
            )            
            ->join('solicitud_detalles as det', 'det.id_solicitud', 's.id')
            ->join('escuelas as e', 'e.id', 'det.id_escuela')
            ->join('bodegas_egresos as be', 'be.id_escuela_despacho', 'det.id_escuela')
            ->join('bodegas_egresos_detalles as be_det', 'be_det.id_egreso', 'be.id') 
            ->join('raciones as r', 'r.id', 'be.tipo_racion')
            ->join('bodegas as a', 'a.id', 'be_det.id_insumo')
            ->where('det.tipo_de_actividad_alimentos',$idRacion1)
            ->where('be.tipo_racion',$idRacion1)
            ->where('s.id', $this->idSolicitud)
            ->where('s.id_socio', $this->idSocio)
            ->where('be.id_solicitud_despacho', $this->idSolicitud)
            ->groupBy('e.id','e.nombre','r.nombre', 'a.nombre','be_det.no_unidades')
            ->get();
            $pesos = Bodega::with(['pesos_alimento'])->where('tipo_bodega',1)->where('id_institucion', $this->idSocio)->get();
        $total_escuelas = DB::table('solicitudes as s')
            ->select(
                DB::RAW('COUNT(DISTINCT det.id_escuela) as total'),
            )            
            ->join('solicitud_detalles as det', 'det.id_solicitud', 's.id')
            ->join('escuelas as e', 'e.id', 'det.id_escuela')
            ->join('bodegas_egresos as be', 'be.id_escuela_despacho', 'det.id_escuela')
            ->join('raciones as r', 'r.id', 'be.tipo_racion')
            ->where('det.tipo_de_actividad_alimentos',$idRacion)
            ->where('be.tipo_racion',$idRacion)
            ->where('s.id', $this->idSolicitud)
            ->where('s.id_socio', $this->idSocio)
            ->where('be.id_solicitud_despacho', $this->idSolicitud)
            ->get();

        $total_escuelas1 = DB::table('solicitudes as s')
            ->select(
                DB::RAW('COUNT(DISTINCT det.id_escuela) as total'),
            )            
            ->join('solicitud_detalles as det', 'det.id_solicitud', 's.id')
            ->join('escuelas as e', 'e.id', 'det.id_escuela')
            ->join('bodegas_egresos as be', 'be.id_escuela_despacho', 'det.id_escuela')
            ->join('raciones as r', 'r.id', 'be.tipo_racion')
            ->where('det.tipo_de_actividad_alimentos',$idRacion1)
            ->where('be.tipo_racion',$idRacion1)
            ->where('s.id', $this->idSolicitud)
            ->where('s.id_socio', $this->idSocio)
            ->where('be.id_solicitud_despacho', $this->idSolicitud)
            ->get();        

        $datos = [
            'solicitud' => $solicitud,
            'solicitud1' => $solicitud1,
            'alimentos' => $alimentos,
            'alimentos1' => $alimentos1,
            'pesos' => $pesos,
            'total_escuelas' => $total_escuelas,
            'total_escuelas1' => $total_escuelas1,
            'idSolicitud' => $this->idSolicitud,
            'idSocio' => $this->idSocio,
            'numReporte' => 5
        ];

        return view('admin.reportes.pdf1_formato1', $datos);
    }
}
