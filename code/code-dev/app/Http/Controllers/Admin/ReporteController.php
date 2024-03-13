<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Exports\InformeMensualExport;
use App\Models\Bodega, App\Models\Institucion, App\Models\Solicitud, App\Models\Racion, App\Models\SolicitudDetalles;
use DB, Validator, Auth, Hash, Config, Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteController extends Controller
{
    public function getInicio(){       
        


        $datos = [
        ];

        return view('admin.reportes.inicio',$datos);
    }

    public function postInformeMensualExport(){
        $alimentos = Bodega::where('categoria' , 0)->where('tipo_bodega',1)->where('id_institucion', Auth::user()->id_institucion)->get();
        
        //return $alimentos;
        //return Excel::download(new InformeMensualExport, 'informe mensual.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
        return Excel::download(new InformeMensualExport, 'informe mensual.xlsx');
    }

    public function getPanelReporte(){       
        if(Auth::user()->rol == 0):
            $socio = Institucion::where('nivel', 1)->get();
        else:
            $socio = Institucion::where('id', Auth::user()->id_institucion)->get();
        endif;


        $datos = [
            'socio' => $socio
        ];

        return view('admin.reportes.panel',$datos);
    }

    public function postPanelReporteGenerar(Request $request){     

        switch($request->input('num_reporte')):
            case 1:
                //return $request->input('id_solicitud').'-'.$request->input('id_socio');
                //$this->reporte1($request->input('id_solicitud'), $request->input('id_socio'));
                return view('admin.reportes.reporte1',$this->reporte1($request->input('id_solicitud'), $request->input('id_socio')));
            break;

            case 2:
                //return $this->reporte2($request->input('id_solicitud'), $request->input('id_socio'));
                return view('admin.reportes.reporte1',$this->reporte2($request->input('id_solicitud'), $request->input('id_socio')));
            break;

            case 3:
                //return $this->reporte3($request->input('id_solicitud'), $request->input('id_socio'));
                return view('admin.reportes.reporte1',$this->reporte3($request->input('id_solicitud'), $request->input('id_socio')));
            break;

            case 4:
                //return $this->reporte4($request->input('id_solicitud'), $request->input('id_socio'));
                return view('admin.reportes.reporte1',$this->reporte4($request->input('id_solicitud'), $request->input('id_socio')));
            break;

            case 5:
                //return $this->reporte5($request->input('id_solicitud'), $request->input('id_socio'));
                return view('admin.reportes.reporte1',$this->reporte5($request->input('id_solicitud'), $request->input('id_socio')));
            break;

            case 6:
                return $this->reporte6($request->input('id_solicitud'), $request->input('id_socio'));
            break;

            case 7:
                return $this->reporte7($request->input('id_solicitud'), $request->input('id_socio'));
            break;

            case 8:
                //return $this->reporte8($request->input('id_solicitud'), $request->input('id_socio'));
                return view('admin.reportes.reporte2',$this->reporte8($request->input('id_solicitud'), $request->input('id_socio')));
            break;

            case 9:
                return $this->reporte9($request->input('id_solicitud'), $request->input('id_socio'));
            break;

            case 10:
                return $this->reporte10($request->input('id_solicitud'), $request->input('id_socio'));
            break;

            case 11:
                //return $this->reporte11($request->input('id_socio'));
                return view('admin.reportes.reporte11',$this->reporte11( $request->input('id_socio')));
            break;

            case 12:
                return $this->reporte12($request->input('id_solicitud'), $request->input('id_socio'));
            break;

            case 13:
                return $this->reporte13($request->input('id_solicitud'), $request->input('id_socio'));
            break;

            case 14:
                return $this->reporte14($request->input('id_solicitud'), $request->input('id_socio'));
            break;

            case 15:
                return $this->reporte15($request->input('id_solicitud'), $request->input('id_socio'));
            break;

            case 16:
                return $this->reporte16($request->input('id_solicitud'), $request->input('id_socio'));
            break;

            case 17:
                return $this->reporte17($request->input('id_solicitud'), $request->input('id_socio'));
            break;


        endswitch;
    }

    public function getReporteGenerarPDF($idSolicitud, $idSocio,$numReporte){     

        switch($numReporte):
            case 1:
                //$this->reporte1($request->input('id_solicitud'), $request->input('id_socio'));
                $pdf = Pdf::loadView('admin.reportes.pdf1', $this->reporte1($idSolicitud, $idSocio));     
                return $pdf->stream();
            break;

            case 2:
                //return $this->reporte2($request->input('id_solicitud'), $request->input('id_socio'));
                $pdf = Pdf::loadView('admin.reportes.pdf1', $this->reporte2($idSolicitud, $idSocio));     
                return $pdf->stream();
            break;

            case 3:
                //return $this->reporte3($request->input('id_solicitud'), $request->input('id_socio'));
                $pdf = Pdf::loadView('admin.reportes.pdf1', $this->reporte3($idSolicitud, $idSocio));     
                return $pdf->stream();
            break;

            case 4:
                //return $this->reporte4($request->input('id_solicitud'), $request->input('id_socio'));
                $pdf = Pdf::loadView('admin.reportes.pdf1', $this->reporte4($idSolicitud, $idSocio));     
                return $pdf->stream();
            break;

            case 5:
                $pdf = Pdf::loadView('admin.reportes.pdf1', $this->reporte5($idSolicitud, $idSocio));     
                return $pdf->stream();
            break;

            case 6:
                return $this->reporte6($request->input('id_solicitud'), $request->input('id_socio'));
            break;

            case 7:
                return $this->reporte7($request->input('id_solicitud'), $request->input('id_socio'));
            break;

            case 8:
                return $this->reporte8($request->input('id_solicitud'), $request->input('id_socio'));
            break;
 
            case 9:
                return $this->reporte9($request->input('id_solicitud'), $request->input('id_socio'));
            break;

            case 10:
                return $this->reporte10($request->input('id_solicitud'), $request->input('id_socio'));
            break;

            case 11:
                return $this->reporte11($request->input('id_solicitud'), $request->input('id_socio'));
            break;

            case 12:
                return $this->reporte12($request->input('id_solicitud'), $request->input('id_socio'));
            break;

            case 13:
                return $this->reporte13($request->input('id_solicitud'), $request->input('id_socio'));
            break;

            case 14:
                return $this->reporte14($request->input('id_solicitud'), $request->input('id_socio'));
            break;

            case 15:
                return $this->reporte15($request->input('id_solicitud'), $request->input('id_socio'));
            break;

            case 16:
                return $this->reporte16($request->input('id_solicitud'), $request->input('id_socio'));
            break;

            case 17:
                return $this->reporte17($request->input('id_solicitud'), $request->input('id_socio'));
            break;


        endswitch;
    }

    public function reporte1($idSolicitud = null, $idSocio = null){
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
            ->where('s.id', $idSolicitud)
            ->where('s.id_socio', $idSocio)
            ->where('be.id_solicitud_despacho', $idSolicitud)
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
            ->where('s.id', $idSolicitud)
            ->where('s.id_socio', $idSocio)
            ->where('be.id_solicitud_despacho', $idSolicitud)
            ->get();

        $total_escuelas = DB::table('solicitudes as s')
            ->select(
                DB::RAW('COUNT(Distinct det.id_escuela) as total'),
            )            
            ->join('solicitud_detalles as det', 'det.id_solicitud', 's.id')
            ->join('bodegas_egresos as be', 'be.id_escuela_despacho', 'det.id_escuela')
            ->where('s.id', $idSolicitud)
            ->where('s.id_socio', $idSocio)
            ->where('be.id_solicitud_despacho', $idSolicitud)
            ->get();

        $datos = [
            'solicitud' => $solicitud,
            'alimentos' => $alimentos,
            'total_escuelas' => $total_escuelas,
            'idSolicitud' => $idSolicitud,
            'idSocio' => $idSocio,
            'numReporte' => 1
        ];

        return $datos;
    }

    public function reporte2($idSolicitud = null, $idSocio = null){
        $alimento = 'Maiz USDA';
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
            ->join('bodegas_egresos_detalles as be_det', 'be_det.id_egreso', 'be.id')  
            ->join('bodegas as a', 'a.id', 'be_det.id_insumo')  
            ->where('a.nombre','LIKE',"%{$alimento}%")
            ->where('be_det.no_unidades', '>', 0)
            ->where('s.id', $idSolicitud)
            ->where('s.id_socio', $idSocio)
            ->where('be.id_solicitud_despacho', $idSolicitud)
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
            ->where('a.nombre','LIKE',"%{$alimento}%")
            ->where('be_det.no_unidades', '>', 0)
            ->where('s.id', $idSolicitud)
            ->where('s.id_socio', $idSocio)
            ->where('be.id_solicitud_despacho', $idSolicitud)
            ->get();

        $total_escuelas = DB::table('solicitudes as s')
            ->select(
                DB::RAW('COUNT(Distinct det.id_escuela) as total'),
            )            
            ->join('solicitud_detalles as det', 'det.id_solicitud', 's.id')
            ->join('escuelas as e', 'e.id', 'det.id_escuela')
            ->join('bodegas_egresos as be', 'be.id_escuela_despacho', 'det.id_escuela')            
            ->join('raciones as r', 'r.id', 'be.tipo_racion')
            ->join('bodegas_egresos_detalles as be_det', 'be_det.id_egreso', 'be.id')  
            ->join('bodegas as a', 'a.id', 'be_det.id_insumo')  
            ->where('a.nombre','LIKE',"%{$alimento}%")
            ->where('be_det.no_unidades', '>', 0)
            ->where('s.id', $idSolicitud)
            ->where('s.id_socio', $idSocio)
            ->where('be.id_solicitud_despacho', $idSolicitud)
            ->get();

        $datos = [
            'solicitud' => $solicitud,
            'alimentos' => $alimentos,
            'total_escuelas' => $total_escuelas,
            'idSolicitud' => $idSolicitud,
            'idSocio' => $idSocio,
            'numReporte' => 2
        ];

        return $datos;
    }

    public function reporte3($idSolicitud = null, $idSocio = null){
        $alimento = 'Maiz bio';
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
            ->join('bodegas_egresos_detalles as be_det', 'be_det.id_egreso', 'be.id')  
            ->join('bodegas as a', 'a.id', 'be_det.id_insumo')  
            ->where('a.nombre','LIKE',"%{$alimento}%")
            ->where('be_det.no_unidades', '>', 0)
            ->where('s.id', $idSolicitud)
            ->where('s.id_socio', $idSocio)
            ->where('be.id_solicitud_despacho', $idSolicitud)
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
            ->where('a.nombre','LIKE',"%{$alimento}%")
            ->where('be_det.no_unidades', '>', 0)
            ->where('s.id', $idSolicitud)
            ->where('s.id_socio', $idSocio)
            ->where('be.id_solicitud_despacho', $idSolicitud)
            ->get();

        $total_escuelas = DB::table('solicitudes as s')
            ->select(
                DB::RAW('COUNT(Distinct det.id_escuela) as total'),
            )            
            ->join('solicitud_detalles as det', 'det.id_solicitud', 's.id')
            ->join('escuelas as e', 'e.id', 'det.id_escuela')
            ->join('bodegas_egresos as be', 'be.id_escuela_despacho', 'det.id_escuela')            
            ->join('raciones as r', 'r.id', 'be.tipo_racion')
            ->join('bodegas_egresos_detalles as be_det', 'be_det.id_egreso', 'be.id')  
            ->join('bodegas as a', 'a.id', 'be_det.id_insumo')  
            ->where('a.nombre','LIKE',"%{$alimento}%")
            ->where('be_det.no_unidades', '>', 0)
            ->where('s.id', $idSolicitud)
            ->where('s.id_socio', $idSocio)
            ->where('be.id_solicitud_despacho', $idSolicitud)
            ->get();

        $datos = [
            'solicitud' => $solicitud,
            'alimentos' => $alimentos,
            'total_escuelas' => $total_escuelas,
            'idSolicitud' => $idSolicitud,
            'idSocio' => $idSocio,
            'numReporte' => 3
        ];

        return $datos;
    }

    public function reporte4($idSolicitud = null, $idSocio = null){
        $racion_estudiante = Racion::where('tipo_alimentos', 'solicitud_comida_escolar')->where('id_institucion', Auth::user()->id_institucion)->first();
        
        $solicitud = DB::table('solicitudes as s')
            ->select(
                DB::RAW('e.id as escuela_id'),
                DB::RAW('e.nombre as escuela_nombre'),
                DB::RAW('SUM(det.total_de_estudiantes) as total_estudiantes'),
                DB::RAW('r.nombre as racion'),
                DB::RAW('be.id as egreso')
            )            
            ->join('solicitud_detalles as det', 'det.id_solicitud', 's.id')
            ->join('escuelas as e', 'e.id', 'det.id_escuela')
            ->join('bodegas_egresos as be', 'be.id_escuela_despacho', 'det.id_escuela')
            ->join('raciones as r', 'r.id', 'be.tipo_racion')
            ->where('det.tipo_de_actividad_alimentos',$racion_estudiante->id)
            ->where('be.tipo_racion',$racion_estudiante->id)
            ->where('s.id', $idSolicitud)
            ->where('s.id_socio', $idSocio)
            ->where('be.id_solicitud_despacho', $idSolicitud)
            ->groupBy('e.id','e.nombre','r.nombre', 'be.id')
            ->get();


        $alimentos = DB::table('solicitudes as s')
            ->select(
                DB::RAW('e.id as escuela_id'),
                DB::RAW('e.nombre as escuela_nombre'),
                DB::RAW('r.nombre as racion'),
                DB::RAW('a.nombre as insumo'),
                DB::RAW('be_det.no_unidades as cantidad'),
                DB::RAW('SUM(det.total_de_estudiantes) as total_estudiantes')
            )            
            ->join('solicitud_detalles as det', 'det.id_solicitud', 's.id')
            ->join('escuelas as e', 'e.id', 'det.id_escuela')
            ->join('bodegas_egresos as be', 'be.id_escuela_despacho', 'det.id_escuela')
            ->join('bodegas_egresos_detalles as be_det', 'be_det.id_egreso', 'be.id') 
            ->join('raciones as r', 'r.id', 'be.tipo_racion')
            ->join('bodegas as a', 'a.id', 'be_det.id_insumo')  
            ->where('det.tipo_de_actividad_alimentos',$racion_estudiante->id)
            ->where('be.tipo_racion',$racion_estudiante->id)
            ->where('s.id', $idSolicitud)
            ->where('s.id_socio', $idSocio)
            ->where('be.id_solicitud_despacho', $idSolicitud)
            ->groupBy('e.id','e.nombre','r.nombre', 'a.nombre','be_det.no_unidades')
            ->get();

        $total_escuelas = DB::table('solicitudes as s')
            ->select(
                DB::RAW('COUNT(DISTINCT det.id_escuela) as total'),
            )            
            ->join('solicitud_detalles as det', 'det.id_solicitud', 's.id')
            ->join('escuelas as e', 'e.id', 'det.id_escuela')
            ->join('bodegas_egresos as be', 'be.id_escuela_despacho', 'det.id_escuela')
            ->join('raciones as r', 'r.id', 'be.tipo_racion')
            ->where('det.tipo_de_actividad_alimentos',$racion_estudiante->id)
            ->where('be.tipo_racion',$racion_estudiante->id)
            ->where('s.id', $idSolicitud)
            ->where('s.id_socio', $idSocio)
            ->where('be.id_solicitud_despacho', $idSolicitud)
            ->get();

        

        $datos = [
            'solicitud' => $solicitud,
            'alimentos' => $alimentos,
            'total_escuelas' => $total_escuelas,
            'idSolicitud' => $idSolicitud,
            'idSocio' => $idSocio,
            'numReporte' => 4
        ];

        return $datos;
    }

    public function reporte5($idSolicitud = null, $idSocio = null){
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
            ->where('s.id', $idSolicitud)
            ->where('s.id_socio', $idSocio)
            ->where('be.id_solicitud_despacho', $idSolicitud)
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
            ->where('s.id', $idSolicitud)
            ->where('s.id_socio', $idSocio)
            ->where('be.id_solicitud_despacho', $idSolicitud)
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
            ->where('s.id', $idSolicitud)
            ->where('s.id_socio', $idSocio)
            ->where('be.id_solicitud_despacho', $idSolicitud)
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
            ->where('s.id', $idSolicitud)
            ->where('s.id_socio', $idSocio)
            ->where('be.id_solicitud_despacho', $idSolicitud)
            ->groupBy('e.id','e.nombre','r.nombre', 'a.nombre','be_det.no_unidades')
            ->get();

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
            ->where('s.id', $idSolicitud)
            ->where('s.id_socio', $idSocio)
            ->where('be.id_solicitud_despacho', $idSolicitud)
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
            ->where('s.id', $idSolicitud)
            ->where('s.id_socio', $idSocio)
            ->where('be.id_solicitud_despacho', $idSolicitud)
            ->get();        

        $datos = [
            'solicitud' => $solicitud,
            'solicitud1' => $solicitud1,
            'alimentos' => $alimentos,
            'alimentos1' => $alimentos1,
            'total_escuelas' => $total_escuelas,
            'total_escuelas1' => $total_escuelas1,
            'idSolicitud' => $idSolicitud,
            'idSocio' => $idSocio,
            'numReporte' => 5
        ];

        return $datos;
    }

    public function reporte6($idSolicitud = null, $idSocio = null){
        $solicitud = Solicitud::with('detalles')->where('id', $idSolicitud)->where('id_socio',$idSocio)->first();

        $datos = [
            'solicitud' => $solicitud
        ];

        return $datos;
    }

    public function reporte7($idSolicitud = null, $idSocio = null){
        $solicitud = Solicitud::with('detalles')->where('id', $idSolicitud)->where('id_socio',$idSocio)->first();

        $datos = [
            'solicitud' => $solicitud
        ];

        return $datos;
    }

    public function reporte8($idSolicitud = null, $idSocio = null){
        $raciones = Racion::where('id_institucion', Auth::user()->id_institucion)->get();

        foreach($raciones as $r):
            if($r->nombre == "Escolar"):
                $idRacion = $r->id;
            endif;
            if($r->nombre == "Docentes y Voluntarios"):
                $idRacion1 = $r->id;
            endif;

            if($r->nombre == "Lideres"):
                $idRacion2 = $r->id;
            endif;
        endforeach;

        $solicitud = Solicitud::where('id', $idSolicitud)->where('id_socio',$idSocio)->first();
        $total_ninos_pre = SolicitudDetalles::where('id_solicitud', $idSolicitud)->where('tipo_de_actividad_alimentos', $idRacion)->sum('ninos_pre_primaria_a_tercero_primaria');
        $total_ninas_pre = SolicitudDetalles::where('id_solicitud', $idSolicitud)->where('tipo_de_actividad_alimentos', $idRacion)->sum('ninas_pre_primaria_a_tercero_primaria');
        $total_pre = SolicitudDetalles::where('id_solicitud', $idSolicitud)->where('tipo_de_actividad_alimentos', $idRacion)->sum('total_pre_primaria_a_tercero_primaria');

        $total_ninos_pri = SolicitudDetalles::where('id_solicitud', $idSolicitud)->where('tipo_de_actividad_alimentos', $idRacion)->sum('ninos_cuarto_a_sexto');
        $total_ninas_pri = SolicitudDetalles::where('id_solicitud', $idSolicitud)->where('tipo_de_actividad_alimentos', $idRacion)->sum('ninas_cuarto_a_sexto');
        $total_pri = SolicitudDetalles::where('id_solicitud', $idSolicitud)->where('tipo_de_actividad_alimentos', $idRacion)->sum('total_cuarto_a_sexto');

        $total_d_v = SolicitudDetalles::where('id_solicitud', $idSolicitud)->where('tipo_de_actividad_alimentos', $idRacion1)->sum('total_de_docentes_y_voluntarios');
        $total_l = SolicitudDetalles::where('id_solicitud', $idSolicitud)->where('tipo_de_actividad_alimentos', $idRacion2)->sum('total_de_personas');

        

        $datos = [
            'solicitud' => $solicitud,
            'total_ninos_pre' => $total_ninos_pre,
            'total_ninas_pre' => $total_ninas_pre,
            'total_pre' => $total_pre,
            'total_ninos_pri' => $total_ninos_pri,
            'total_ninas_pri' => $total_ninas_pri,
            'total_pri' => $total_pri,
            'total_d_v' => $total_d_v,
            'total_l' => $total_l,
            'idSolicitud' => $idSolicitud,
            'idSocio' => $idSocio,
            'numReporte' => 8
        ];

        return $datos;
    }

    public function reporte9($idSolicitud = null, $idSocio = null){
        $solicitud = Solicitud::with('detalles')->where('id', $idSolicitud)->where('id_socio',$idSocio)->first();

        $datos = [
            'solicitud' => $solicitud
        ];

        return $datos;
    }

    public function reporte10($idSolicitud = null, $idSocio = null){
        $solicitud = Solicitud::with('detalles')->where('id', $idSolicitud)->where('id_socio',$idSocio)->first();

        $datos = [
            'solicitud' => $solicitud
        ];

        return $datos;
    }

    public function reporte11($idSocio = null){
        $solicitud = Solicitud::with('entrega')->where('id_socio',$idSocio)->get();
        
        $datos = [
            'solicitud' => $solicitud
        ];

        return $datos;
    }

    public function reporte12($idSolicitud = null, $idSocio = null){
        $solicitud = Solicitud::with('detalles')->where('id', $idSolicitud)->where('id_socio',$idSocio)->first();

        $datos = [
            'solicitud' => $solicitud
        ];

        return $datos;
    }

    public function reporte13($idSolicitud = null, $idSocio = null){
        $solicitud = Solicitud::with('detalles')->where('id', $idSolicitud)->where('id_socio',$idSocio)->first();

        $datos = [
            'solicitud' => $solicitud
        ];

        return $datos;
    }

    public function reporte14($idSolicitud = null, $idSocio = null){
        $solicitud = Solicitud::with('detalles')->where('id', $idSolicitud)->where('id_socio',$idSocio)->first();

        $datos = [
            'solicitud' => $solicitud
        ];

        return $datos;
    }

    public function reporte15($idSolicitud = null, $idSocio = null){
        $solicitud = Solicitud::with('detalles')->where('id', $idSolicitud)->where('id_socio',$idSocio)->first();

        $datos = [
            'solicitud' => $solicitud
        ];

        return $datos;
    }

    public function reporte16($idSolicitud = null, $idSocio = null){
        $solicitud = Solicitud::with('detalles')->where('id', $idSolicitud)->where('id_socio',$idSocio)->first();

        $datos = [
            'solicitud' => $solicitud
        ];

        return $datos;
    }

    public function reporte17($idSolicitud = null, $idSocio = null){
        $solicitud = Solicitud::with('detalles')->where('id', $idSolicitud)->where('id_socio',$idSocio)->first();

        $datos = [
            'solicitud' => $solicitud
        ];

        return $datos;
    }

    public function getSociosSolicitudes($id){       
        $solicitudes = Solicitud::where('id_socio', $id)->get();


        $datos = [
            'solicitudes' => $solicitudes
        ];

        return response()->json($datos);
    }
}
