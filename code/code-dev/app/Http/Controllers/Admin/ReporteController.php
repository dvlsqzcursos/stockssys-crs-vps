<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Exports\Reporte1Export, App\Exports\Reporte2Export, App\Exports\Reporte3Export, App\Exports\Reporte4Export, App\Exports\Reporte5Export;
use App\Exports\Reporte6Export, App\Exports\Reporte8Export, App\Exports\Reporte10Export,  App\Exports\Reporte11Export,  App\Exports\Reporte12Export;
use App\Exports\Reporte14Export, App\Exports\Reporte15Export, App\Exports\Reporte16Export,  App\Exports\Reporte17Export;
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
                //return $this->reporte6($request->input('id_solicitud'), $request->input('id_socio'));
                return view('admin.reportes.reporte6',$this->reporte6($request->input('id_solicitud'), $request->input('id_socio')));
            break;

            case 7:
                return $this->reporte7($request->input('id_solicitud'), $request->input('id_socio'));
            break;

            case 8:
                //return $this->reporte8($request->input('id_solicitud'), $request->input('id_socio'));
                return view('admin.reportes.reporte8',$this->reporte8($request->input('id_solicitud'), $request->input('id_socio')));
            break;

            case 9:
                return $this->reporte9($request->input('id_solicitud'), $request->input('id_socio'));
            break;

            case 10:
                //return $this->reporte10($request->input('id_solicitud'), $request->input('id_socio'));
                return view('admin.reportes.reporte10',  $this->reporte10($request->input('id_solicitud'), $request->input('id_socio')));
            break;

            case 11:
                //return $this->reporte11($request->input('id_socio'));
                return view('admin.reportes.reporte11',$this->reporte11( $request->input('id_socio')));
            break;

            case 12:
                //return $this->reporte12($request->input('id_socio'));
                return view('admin.reportes.reporte12',$this->reporte12($request->input('id_socio')));
            break;

            case 13:
                return $this->reporte13($request->input('id_solicitud'), $request->input('id_socio'));
            break;

            case 14:
                //return $this->reporte14($request->input('id_solicitud'), $request->input('id_socio'));
                return view('admin.reportes.reporte15',$this->reporte14($request->input('id_socio')));
            break;

            case 15:
                //return $this->reporte15( $request->input('id_socio'));
                return view('admin.reportes.reporte15',$this->reporte15($request->input('id_socio')));
            break;

            case 16:
                //return $this->reporte16( $request->input('id_socio'));
                return view('admin.reportes.reporte16',$this->reporte16($request->input('id_socio')));
            break;

            case 17:
                return $this->reporte17($request->input('id_solicitud'), $request->input('id_socio'));
            break;


        endswitch;
    }

    public function getReporteGenerarPDFFormato1($idSolicitud, $idSocio,$numReporte){     

        switch($numReporte):
            case 1:
                //$this->reporte1($request->input('id_solicitud'), $request->input('id_socio'));
                $pdf = Pdf::loadView('admin.reportes.pdf1_formato1', $this->reporte1($idSolicitud, $idSocio));     
                return $pdf->stream();
                
            break;

            case 2:
                //return $this->reporte2($request->input('id_solicitud'), $request->input('id_socio'));
                $pdf = Pdf::loadView('admin.reportes.pdf1_formato1', $this->reporte2($idSolicitud, $idSocio));     
                return $pdf->stream();
            break;

            case 3:
                //return $this->reporte3($request->input('id_solicitud'), $request->input('id_socio'));
                $pdf = Pdf::loadView('admin.reportes.pdf1_formato1', $this->reporte3($idSolicitud, $idSocio));     
                return $pdf->stream();
            break;

            case 4:
                //return $this->reporte4($request->input('id_solicitud'), $request->input('id_socio'));
                $pdf = Pdf::loadView('admin.reportes.pdf1_formato1', $this->reporte4($idSolicitud, $idSocio));     
                return $pdf->stream();
            break;

            case 5:
                //return $this->reporte5($request->input('id_solicitud'), $request->input('id_socio'));
                $pdf = Pdf::loadView('admin.reportes.pdf1_formato1', $this->reporte5($idSolicitud, $idSocio));     
                return $pdf->stream();
            break;

            case 6:
                //return $this->reporte6($request->input('id_solicitud'), $request->input('id_socio'));
                $pdf = Pdf::loadView('admin.reportes.pdf6', $this->reporte6($idSolicitud, $idSocio));     
                return $pdf->stream();
            break;

            case 7:
                return $this->reporte7($request->input('id_solicitud'), $request->input('id_socio'));
            break;

            case 8:
                //return $this->reporte8($request->input('id_solicitud'), $request->input('id_socio'));
                $pdf = Pdf::loadView('admin.reportes.pdf8', $this->reporte8($idSolicitud, $idSocio));     
                return $pdf->stream();
            break;
 
            case 9:
                return $this->reporte9($request->input('id_solicitud'), $request->input('id_socio'));
            break;

            case 10:
                //return $this->reporte10($request->input('id_solicitud'), $request->input('id_socio'));
                $pdf = Pdf::loadView('admin.reportes.pdf10', $this->reporte10($idSolicitud, $idSocio));     
                return $pdf->stream();
            break;

            case 11:
                //return $this->reporte11($request->input('id_solicitud'), $request->input('id_socio'));
                $pdf = Pdf::loadView('admin.reportes.pdf11', $this->reporte11($idSolicitud, $idSocio));     
                return $pdf->stream();
            break;

            case 12:
                //return $this->reporte12($request->input('id_socio'));
                $pdf = Pdf::loadView('admin.reportes.pdf12', $this->reporte12($idSocio));     
                return $pdf->stream();
            break;

            case 13:
                return $this->reporte13($request->input('id_solicitud'), $request->input('id_socio'));
            break;

            case 14:
                //return $this->reporte14($request->input('id_solicitud'), $request->input('id_socio'));
                $pdf = Pdf::loadView('admin.reportes.pdf15', $this->reporte14($idSocio));     
                return $pdf->stream();
            break;

            case 15:
                //return $this->reporte15( $request->input('id_socio'));
                $pdf = Pdf::loadView('admin.reportes.pdf15', $this->reporte15($idSocio));     
                return $pdf->stream();
            break;

            case 16:
                //return $this->reporte16($request->input('id_socio'));
                $pdf = Pdf::loadView('admin.reportes.pdf16', $this->reporte16($idSocio));     
                return $pdf->stream();
            break;

            case 17:
                return $this->reporte17($request->input('id_solicitud'), $request->input('id_socio'));
            break;


        endswitch;
    }

    public function getReporteGenerarExcel($idSolicitud, $idSocio,$numReporte){     

        switch($numReporte):
            case 1:
                //$this->reporte1($request->input('id_solicitud'), $request->input('id_socio'));
                return Excel::download(new Reporte1Export($idSolicitud, $idSocio), 'reporte_stockssys_no_1.xlsx');                
            break;

            case 2:
                //return $this->reporte2($request->input('id_solicitud'), $request->input('id_socio'));
                return Excel::download(new Reporte2Export($idSolicitud, $idSocio), 'reporte_stockssys_no_2.xlsx');
            break;

            case 3:
                //return $this->reporte3($request->input('id_solicitud'), $request->input('id_socio'));
                return Excel::download(new Reporte3Export($idSolicitud, $idSocio), 'reporte_stockssys_no_3.xlsx');
            break;

            case 4:
                //return $this->reporte4($request->input('id_solicitud'), $request->input('id_socio'));
                return Excel::download(new Reporte4Export($idSolicitud, $idSocio), 'reporte_stockssys_no_4.xlsx');
            break;

            case 5:
                //return $this->reporte5($request->input('id_solicitud'), $request->input('id_socio'));
                return Excel::download(new Reporte5Export($idSolicitud, $idSocio), 'reporte_stockssys_no_5.xlsx');
            break;

            case 6:
                //return $this->reporte6($request->input('id_solicitud'), $request->input('id_socio'));
                return Excel::download(new Reporte6Export($idSolicitud, $idSocio), 'reporte_stockssys_no_6.xlsx');
            break;

            case 7:
                return $this->reporte7($request->input('id_solicitud'), $request->input('id_socio'));
            break;

            case 8:
                //return $this->reporte8($request->input('id_solicitud'), $request->input('id_socio'));
                return Excel::download(new Reporte8Export($idSolicitud, $idSocio), 'reporte_stockssys_no_8.xlsx');
            break;
 
            case 9:
                return $this->reporte9($request->input('id_solicitud'), $request->input('id_socio'));
            break;

            case 10:
                //return $this->reporte10($request->input('id_solicitud'), $request->input('id_socio'));
                return Excel::download(new Reporte10Export($idSolicitud, $idSocio), 'reporte_stockssys_no_10.xlsx');
            break;

            case 11:
                //return $this->reporte11($request->input('id_solicitud'), $request->input('id_socio'));
                return Excel::download(new Reporte11Export($idSocio), 'reporte_stockssys_no_11.xlsx');
            break;

            case 12:
                //return $this->reporte12($request->input('id_socio'));
                return Excel::download(new Reporte12Export($idSocio), 'reporte_stockssys_no_12.xlsx');
            break;

            case 13:
                return $this->reporte13($request->input('id_solicitud'), $request->input('id_socio'));
            break;

            case 14:
                //return $this->reporte14($request->input('id_solicitud'), $request->input('id_socio'));
                return Excel::download(new Reporte14Export($idSocio), 'reporte_stockssys_no_14.xlsx');
            break;

            case 15:
                //return $this->reporte15( $request->input('id_socio'));
                return Excel::download(new Reporte15Export($idSocio), 'reporte_stockssys_no_15.xlsx');
            break;

            case 16:
                //return $this->reporte16($request->input('id_socio'));
                return Excel::download(new Reporte16Export($idSocio), 'reporte_stockssys_no_16.xlsx');
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
        $pesos = Bodega::with(['pesos_alimento'])->where('tipo_bodega',1)->where('id_institucion', $idSocio)->get();
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
            'pesos' => $pesos,
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
        $pesos = Bodega::with(['pesos_alimento'])->where('tipo_bodega',1)->where('id_institucion', $idSocio)->get();
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
            'pesos' => $pesos,
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
        $pesos = Bodega::with(['pesos_alimento'])->where('tipo_bodega',1)->where('id_institucion', $idSocio)->get();

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
            'pesos' => $pesos,
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
        $pesos = Bodega::with(['pesos_alimento'])->where('tipo_bodega',1)->where('id_institucion', $idSocio)->get();

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
            'pesos' => $pesos,
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
        $pesos = Bodega::with(['pesos_alimento'])->where('tipo_bodega',1)->where('id_institucion', $idSocio)->get();
        $datos = [
            'solicitud' => $solicitud,
            'solicitud1' => $solicitud1,
            'alimentos' => $alimentos,
            'alimentos1' => $alimentos1,
            'pesos' => $pesos,
            'total_escuelas' => $total_escuelas,
            'total_escuelas1' => $total_escuelas1,
            'idSolicitud' => $idSolicitud,
            'idSocio' => $idSocio,
            'numReporte' => 5
        ];

        return $datos;
    }

    public function reporte6($idSolicitud = null, $idSocio = null){
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
            ->where('s.id', $idSolicitud)
            ->where('s.id_socio', $idSocio)
            ->where('be.id_solicitud_despacho', $idSolicitud)
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
            ->where('s.id', $idSolicitud)
            ->where('s.id_socio', $idSocio)
            ->where('be.id_solicitud_despacho', $idSolicitud)
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
            ->where('s.id', $idSolicitud)
            ->where('s.id_socio', $idSocio)
            ->where('be.id_solicitud_despacho', $idSolicitud)
            ->whereNull('rs.deleted_at')
            ->whereNull('rsdet.deleted_at')
            ->get();
        
        


        $datos = [
            'solicitud' => $solicitud,
            'alimentos' => $alimentos,
            'alimentos_bodega' => $alimentos_bodega,
            'total_rutas' => $total_rutas,
            'idSolicitud' => $idSolicitud,
            'idSocio' => $idSocio,
            'numReporte' => 6
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

        $solicitud = DB::table('solicitudes as s')
            ->select(
                DB::RAW('Distinct be.no_documento as no_documento'),
                DB::RAW('e.nombre as escuela'),
                DB::RAW('u.nombre as municipio'),
                DB::RAW('ra.nombre as racion')
            )            
            ->join('solicitud_detalles as det', 'det.id_solicitud', 's.id')
            ->join('escuelas as e', 'e.id', 'det.id_escuela')
            ->join('bodegas_egresos as be', 'be.id_escuela_despacho', 'det.id_escuela')
            ->join('rutas_escuelas as resc', 'resc.id_escuela', 'e.id')
            ->join('rutas as r', 'r.id', 'resc.id_ruta')
            ->join('ubicaciones as u', 'u.id', 'r.id_ubicacion')
            ->join('raciones as ra', 'ra.id', 'be.tipo_racion')
            ->where('s.id', $idSolicitud)
            ->where('s.id_socio', $idSocio)
            ->where('be.id_solicitud_despacho', $idSolicitud)
            ->where('be.tipo_documento', 1)
            ->get();

        $datos = [
            'solicitud' => $solicitud,
            'idSolicitud' => $idSolicitud,
            'idSocio' => $idSocio,
            'numReporte' => 10
        ];

        return $datos;
    }

    public function reporte11($idSocio = null){
        $solicitud = Solicitud::with('entrega')->where('id_socio',$idSocio)->get();
        
        $datos = [
            'solicitud' => $solicitud,
            'idSolicitud' => 0,
            'idSocio' => $idSocio,
            'numReporte' => 11
        ];

        return $datos;
    }

    public function reporte12($idSocio = null){
        $alimentos = Bodega::where('tipo_bodega',1)->where('id_institucion', $idSocio)->get();

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
            ->where('b.id_institucion', $idSocio)
            ->get();

        //return $saldos;

        $datos = [
            'alimentos' => $alimentos,
            'saldos' => $saldos,
            'idSolicitud' => 0,
            'idSocio' => $idSocio,
            'numReporte' => 12
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

    public function reporte14($idSocio = null){
        $alimentos = Bodega::where('tipo_bodega',1)->where('id_institucion', $idSocio)->get();

        $saldos = DB::table('bodegas as b')
            ->select(
                DB::RAW('be.no_documento as no_documento'),
                DB::RAW('b.nombre as alimento'),
                DB::RAW('det.pl as pl'),
                DB::RAW('det.no_unidades  as descartado')
            )            
            ->join('bodegas_egresos_detalles as det', 'det.id_insumo', 'b.id')
            ->join('bodegas_egresos as be', 'be.id', 'det.id_egreso')
            ->where('b.id_institucion', $idSocio)
            ->where('be.id_institucion', $idSocio)
            ->where('be.tipo_documento', 5)
            ->where('det.no_unidades', '>',0)
            ->get();

        $datos = [
            'saldos' => $saldos,
            'idSolicitud' => 0,
            'idSocio' => $idSocio,
            'numReporte' => 14
        ];

        return $datos;
    }

    public function reporte15($idSocio = null){
        $alimentos = Bodega::where('tipo_bodega',1)->where('id_institucion', $idSocio)->get();

        $saldos = DB::table('bodegas as b')
            ->select(
                DB::RAW('be.no_documento as no_documento'),
                DB::RAW('b.nombre as alimento'),
                DB::RAW('det.pl as pl'),
                DB::RAW('det.no_unidades  as descartado')
            )            
            ->join('bodegas_egresos_detalles as det', 'det.id_insumo', 'b.id')
            ->join('bodegas_egresos as be', 'be.id', 'det.id_egreso')
            ->where('b.id_institucion', $idSocio)
            ->where('be.id_institucion', $idSocio)
            ->where('be.tipo_documento', 4)
            ->where('det.no_unidades', '>',0)
            ->get();

        $datos = [
            'saldos' => $saldos,
            'idSolicitud' => 0,
            'idSocio' => $idSocio,
            'numReporte' => 15
        ];

        return $datos;
    }

    public function reporte16($idSocio = null){
        $alimentos = Bodega::where('nombre','LIKE', 'Maiz Bio')->where('tipo_bodega',1)->where('id_institucion', $idSocio)->first();
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
            ->where('b.id_institucion', $idSocio)
            ->where('det.id_insumo', $alimentos->id)
            ->get();

        $datos = [
            'saldos' => $saldos,
            'bodegas' => $bodegas,
            'idSolicitud' => 0,
            'idSocio' => $idSocio,
            'numReporte' => 16
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
