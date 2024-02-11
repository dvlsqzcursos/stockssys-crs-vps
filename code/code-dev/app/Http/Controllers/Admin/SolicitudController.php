<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Solicitud, App\Models\SolicitudDetalles,App\Models\Institucion, App\Models\Bodega, App\Models\Escuela, App\Models\Entrega;
use App\Models\Ruta, App\Models\RutaEscuela,  App\Models\RutaSolicitud,  App\Models\RutaSolicitudDetalles,  App\Models\Racion, App\Models\BodegaEgreso, App\Models\BodegaEgresoDetalle;
use App\Models\AlimentoRacion, App\Models\Usuario, App\Models\Bitacora, App\Models\SolicitudBodegaPrimaria, App\Models\SolicitudBodegaPrimariaDetalle;
use DB, Validator, Auth, Hash, Config, Carbon\Carbon, Illuminate\Support\Arr;
use App\Imports\SolicitudDetallesImport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class SolicitudController extends Controller
{
    public function getInicio(){
        $solicitudes = Solicitud::with(['entrega', 'usuario'])->where('id_socio',  Auth::user()->id_institucion)->get();

        $datos = [
            'solicitudes' => $solicitudes
        ];

        return view('admin.solicitudes.inicio',$datos);
    }

    public function getSolicitudRegistrar(){
        $entregas = Entrega::get(); 

        $datos = [
            'entregas' => $entregas
        ];

        return view('admin.solicitudes.registrar',$datos);
    }

    public function postSolicitudRegistrar(Request $request){
        $s = new Solicitud;
        $s->id_entrega = $request->input('idEntrega');
        $s->id_usuario = $request->input('idUsuario');
        $s->observaciones = $request->input('observaciones');
        $s->id_socio = Auth::user()->id_institucion;
        $s->save();

        $idSolicitud = $s->id;

        $archivo = request()->file('datos');
        $solicitud = Excel::toArray(new SolicitudDetallesImport, $archivo);

        foreach($solicitud[0] as $csd):
            $escuela = Escuela::where('codigo', $csd['codigo_de_la_escuela'])->first();
            $racion = Racion::where('tipo_alimentos', $csd['tipo_de_actividad_alimentos'])->where('id_institucion',  Auth::user()->id_institucion)->get()->first();

            $sd = new SolicitudDetalles;
            $sd->id_solicitud = $idSolicitud;
            $fecha= intval($csd['fecha_de_solicitud']);
            $sd->fecha = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($fecha));
            $sd->id_escuela = $escuela->id;
            $sd->mes_de_solicitud = $csd['mes_de_solicitud'];
            $sd->dias_de_solicitud = $csd['dias_de_solicitud']; 
            $sd->ninas_pre_primaria_a_tercero_primaria = $csd['ninas_pre_primaria_a_tercero_primaria']; 
            $sd->ninos_pre_primaria_a_tercero_primaria = $csd['ninos_pre_primaria_a_tercero_primaria'];
            $sd->total_pre_primaria_a_tercero_primaria = $csd['total_pre_primaria_a_tercero_primaria'];
            $sd->ninas_cuarto_a_sexto = $csd['ninas_cuarto_a_sexto'];
            $sd->ninos_cuarto_a_sexto = $csd['ninios_cuarto_sexto'];
            $sd->total_cuarto_a_sexto = $csd['total_cuarto_a_sexto'];
            $sd->total_de_estudiantes = $csd['total_de_estudiantes'];
            $sd->total_de_raciones_de_estudiantes = $csd['total_de_raciones_de_estudiantes']; 
            $sd->total_docentes = $csd['total_docentes'];
            $sd->total_voluntarios = $csd['total_voluntarios'];
            $sd->total_de_docentes_y_voluntarios = $csd['total_de_docentes_y_voluntarios']; 
            $sd->total_de_raciones_de_docentes_y_voluntarios = $csd['total_de_raciones_de_docentes_y_voluntarios'];
            $sd->total_de_personas = $csd['total_de_personas'];
            $sd->total_de_raciones = $csd['total_de_raciones'];
            $sd->tipo_de_actividad_alimentos = $racion->id;
            $sd->numero_de_entrega = $csd['numero_de_entrega'];
            $sd->tipo = $csd['tipo'];
            $sd->save();
        endforeach;

        Solicitud::where('id',$idSolicitud)->update(['nombre_archivo'=>$archivo->getClientOriginalName()]);

        $b = new Bitacora;
        $b->accion = 'Registro de solicitud de raciones con ID '.$idSolicitud;
        $b->id_usuario = Auth::id();
        $b->save();

        return redirect('/admin/solicitudes_despachos')->with('messages', '¡Solicitud creada y guardada con exito!.')
        ->with('typealert', 'success');

    }

    public function getSolicitudMostrar($id){
        $solicitud = Solicitud::with(['entrega', 'usuario','detalles'])->where('id', $id)->first();
        $total_estudiantes = SolicitudDetalles::where('id_solicitud', $id)->sum('total_de_estudiantes');
        $total_raciones_estudiantes = SolicitudDetalles::where('id_solicitud', $id)->sum('total_de_raciones_de_estudiantes');
        $total_docentes_voluntarios = SolicitudDetalles::where('id_solicitud', $id)->sum('total_de_docentes_y_voluntarios');
        $total_raciones_docentes_voluntarios = SolicitudDetalles::where('id_solicitud', $id)->sum('total_de_raciones_de_docentes_y_voluntarios');
        $total_personas = SolicitudDetalles::where('id_solicitud', $id)->sum('total_de_personas');
        $total_raciones = SolicitudDetalles::where('id_solicitud', $id)->sum('total_de_raciones');

        $datos = [
            'solicitud' => $solicitud,
            'total_estudiantes' => $total_estudiantes,
            'total_raciones_estudiantes' => $total_raciones_estudiantes,
            'total_docentes_voluntarios' => $total_docentes_voluntarios,
            'total_raciones_docentes_voluntarios' => $total_raciones_docentes_voluntarios,
            'total_personas' => $total_personas,
            'total_raciones' => $total_raciones
        ];

        return view('admin.solicitudes.mostrar',$datos);
        
    }

    public function getSolicitudDetallesRegistrar($id){
        $detalles = new SolicitudDetalles;
        $escuelas = Escuela::pluck('nombre','id');
        $raciones = Racion::where('id_institucion', Auth::user()->id_institucion)->pluck('tipo_alimentos', 'id');
        $idSolicitud = $id;
        $registrar = 1;

        $datos = [
            'detalles' => $detalles,
            'escuelas' => $escuelas,
            'raciones' => $raciones,
            'idSolicitud' => $idSolicitud,
            'registrar' => $registrar
        ];

        return view('admin.solicitudes.detalles.registrar',$datos);
    }

    public function postSolicitudDetallesRegistrar(Request $request){
        $reglas = [
            
    	];
    	$mensajes = [
            
    	];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            $detalle = new SolicitudDetalles;
            $detalle->id_solicitud = $request->input('id_solicitud');
            $detalle->fecha = $request->input('fecha');
            $detalle->id_escuela = $request->input('id_escuela');
            $detalle->mes_de_solicitud = $request->input('mes_de_solicitud');
            $detalle->dias_de_solicitud = $request->input('dias_de_solicitud'); 
            $detalle->ninas_pre_primaria_a_tercero_primaria = $request->input('ninas_pre_primaria_a_tercero_primaria'); 
            $detalle->ninos_pre_primaria_a_tercero_primaria = $request->input('ninos_pre_primaria_a_tercero_primaria');
            $detalle->total_pre_primaria_a_tercero_primaria = $request->input('total_pre_primaria_a_tercero_primaria');
            $detalle->ninas_cuarto_a_sexto = $request->input('ninas_cuarto_a_sexto');
            $detalle->ninos_cuarto_a_sexto = $request->input('ninos_cuarto_a_sexto');
            $detalle->total_cuarto_a_sexto = $request->input('total_cuarto_a_sexto');
            $detalle->total_de_estudiantes = $request->input('total_de_estudiantes');
            $detalle->total_de_raciones_de_estudiantes = $request->input('total_de_raciones_de_estudiantes'); 
            $detalle->total_docentes = $request->input('total_docentes');
            $detalle->total_voluntarios = $request->input('total_voluntarios');
            $detalle->total_de_docentes_y_voluntarios = $request->input('total_de_docentes_y_voluntarios'); 
            $detalle->total_de_raciones_de_docentes_y_voluntarios = $request->input('total_de_raciones_de_docentes_y_voluntarios');
            $detalle->total_de_personas = $request->input('total_de_personas');
            $detalle->total_de_raciones = $request->input('total_de_raciones');
            $detalle->tipo_de_actividad_alimentos = $request->input('tipo_de_actividad_alimentos');
            $detalle->numero_de_entrega = $request->input('numero_de_entrega');
            $detalle->tipo = $request->input('tipo');
            $id = $detalle->id;
            $idSolicitud = $detalle->id_solicitud;

            if($detalle->save()):
                $b = new Bitacora;
                $b->accion = 'Registro de información de la escuela de solicitud con registro (ID): '.$id;
                $b->id_usuario = Auth::id();
                $b->save();

                return redirect('/admin/solicitud_despacho/'.$idSolicitud.'/mostrar')->with('messages', '¡Información registrar y guardada con exito!.')
                ->with('typealert', 'info');
    		endif;
        endif;
    }

    public function getSolicitudDetallesEditar($id){
        $detalles = SolicitudDetalles::findOrFail($id);
        $escuelas = Escuela::pluck('nombre','id');
        $raciones = Racion::where('id_institucion', Auth::user()->id_institucion)->pluck('tipo_alimentos', 'id');
        $registrar = 0;

        $datos = [
            'detalles' => $detalles,
            'escuelas' => $escuelas,
            'raciones' => $raciones,
            'registrar' => $registrar
        ];

        return view('admin.solicitudes.detalles.editar',$datos);
    }   

    public function postSolicitudDetallesEditar(Request $request, $id){
        $reglas = [
            
    	];
    	$mensajes = [
            
    	];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            $detalle = SolicitudDetalles::findOrFail($id);
            $detalle->id_solicitud = $request->input('id_solicitud');
            $detalle->fecha = $request->input('fecha');
            $detalle->id_escuela = $request->input('id_escuela');
            $detalle->mes_de_solicitud = $request->input('mes_de_solicitud');
            $detalle->dias_de_solicitud = $request->input('dias_de_solicitud'); 
            $detalle->ninas_pre_primaria_a_tercero_primaria = $request->input('ninas_pre_primaria_a_tercero_primaria'); 
            $detalle->ninos_pre_primaria_a_tercero_primaria = $request->input('ninos_pre_primaria_a_tercero_primaria');
            $detalle->total_pre_primaria_a_tercero_primaria = $request->input('total_pre_primaria_a_tercero_primaria');
            $detalle->ninas_cuarto_a_sexto = $request->input('ninas_cuarto_a_sexto');
            $detalle->ninos_cuarto_a_sexto = $request->input('ninos_cuarto_a_sexto');
            $detalle->total_cuarto_a_sexto = $request->input('total_cuarto_a_sexto');
            $detalle->total_de_estudiantes = $request->input('total_de_estudiantes');
            $detalle->total_de_raciones_de_estudiantes = $request->input('total_de_raciones_de_estudiantes'); 
            $detalle->total_docentes = $request->input('total_docentes');
            $detalle->total_voluntarios = $request->input('total_voluntarios');
            $detalle->total_de_docentes_y_voluntarios = $request->input('total_de_docentes_y_voluntarios'); 
            $detalle->total_de_raciones_de_docentes_y_voluntarios = $request->input('total_de_raciones_de_docentes_y_voluntarios');
            $detalle->total_de_personas = $request->input('total_de_personas');
            $detalle->total_de_raciones = $request->input('total_de_raciones');
            $detalle->tipo_de_actividad_alimentos = $request->input('tipo_de_actividad_alimentos');
            $detalle->numero_de_entrega = $request->input('numero_de_entrega');
            $detalle->tipo = $request->input('tipo');
            $idSolicitud = $detalle->id_solicitud;

            if($detalle->save()):
                $b = new Bitacora;
                $b->accion = 'Edición de información de la escuela de solicitud con registro (ID): '.$id;
                $b->id_usuario = Auth::id();
                $b->save();

                return redirect('/admin/solicitud_despacho/'.$idSolicitud.'/mostrar')->with('messages', '¡Información actualizada y guardada con exito!.')
                ->with('typealert', 'info');
    		endif;
        endif;
    }

    public function getSolicitudEliminar($id){
        $solicitud = Solicitud::findOrFail($id);
        $detalles = SolicitudDetalles::where('id_solicitud',$id)->delete();



        if($solicitud->delete()):
            $b = new Bitacora;
            $b->accion = 'Eliminacion de solicitud registro (ID): '.$solicitud->id;
            $b->id_usuario = Auth::id();
            $b->save();

            return back()->with('messages', '¡Escuela eliminada con exito!.')
                    ->with('typealert', 'warning');
        endif;
    }

    public function getSolicitudDetallesEliminar($id){
        $detalle = SolicitudDetalles::findOrFail($id);

        if($detalle->delete()):
            $b = new Bitacora;
            $b->accion = 'Eliminacion de detalle de solicitud registro (ID): '.$detalle->id;
            $b->id_usuario = Auth::id();
            $b->save();

            return back()->with('messages', '¡Escuela eliminada con exito!.')
                    ->with('typealert', 'warning');
        endif;
    }

    public function getSolicitudRutas($id){
        $rutas_principales = Ruta::with('detalles')->orderBy('id_ubicacion', 'asc')->where('id_socio', Auth::user()->id_institucion)->get();

        $idSolicitud = $id;
        $datos = [
            'rutas_principales' => $rutas_principales,
            'idSolicitud' => $idSolicitud
        ];

        return view('admin.solicitudes.detalles.rutas',$datos);
    }

    public function getSolicitudEscuelas($id){
        $escuelas_principales = Escuela::where('id_socio', Auth::user()->id_institucion)->get();

        $idSolicitud = $id;
        $datos = [
            'escuelas_principales' => $escuelas_principales,
            'idSolicitud' => $idSolicitud
        ];

        return view('admin.solicitudes.boletas_despacho.escuelas',$datos);
    }

    public function getSolicitudEscuelaDespacho($id, $idEscuela){
        
        $despachos = BodegaEgreso::with(['detalles', 'escuela'])->where('id_solicitud_despacho', $id)->where('id_escuela_despacho', $idEscuela)->get();
        $escuelas_principales = Escuela::where('id_socio', Auth::user()->id_institucion)->get();
        $idSolicitud = $id;
            
        $datos = [
            'despachos' => $despachos,
            'escuelas_principales' => $escuelas_principales,
            'idSolicitud' => $idSolicitud
        ];
          

        return view('admin.solicitudes.boletas_despacho.escuelas_despachos',$datos);
    }

    public function getSolicitudEscuelaDespachoPDF($idSolicitud, $idEscuela, $id){     
        
        $despachos = BodegaEgreso::with(['detalles', 'escuela'])->where('id', $id)->where('id_solicitud_despacho', $idSolicitud)->where('id_escuela_despacho', $idEscuela)->get();
            
        $datos = [
            'despachos' => $despachos 
        ];

        $pdf = Pdf::loadView('admin.solicitudes.boletas_despacho.pdf', $datos);
     
        return $pdf->stream();
          
    }

    public function getSolicitudRutaDetalle($id, $idRuta){
        $rutas_principales = Ruta::with('detalles')->orderBy('id_ubicacion', 'asc')->where('id_socio', Auth::user()->id_institucion)->get();
        $ruta = Ruta::where('id', $idRuta)->first();
        $detalles_ruta_escuelas = DB::table('solicitud_detalles')
                ->select(
                    DB::raw('escuelas.id as escuela_id'),
                    DB::raw("CONCAT(escuelas.nombre, ' (',escuelas.codigo,')') as escuela"),
                    DB::raw('rutas_escuelas.orden_llegada as orden_llegada'),
                    DB::raw('SUM(solicitud_detalles.total_de_raciones) as total_raciones')
                )
                ->join('escuelas', 'escuelas.id', 'solicitud_detalles.id_escuela')
                ->join('rutas_escuelas', 'rutas_escuelas.id_escuela', 'escuelas.id' )
                ->join('raciones', 'raciones.id', 'solicitud_detalles.tipo_de_actividad_alimentos')
                ->where('solicitud_detalles.id_solicitud', $id)
                ->where('rutas_escuelas.id_ruta', $idRuta)
                ->groupBy('solicitud_detalles.id_escuela', 'escuelas.id','escuelas.codigo',  'escuelas.nombre', 'rutas_escuelas.orden_llegada')
                ->orderBy('rutas_escuelas.orden_llegada', 'asc')
                ->get();
        
        $idSolicitud = $id;
        
        $escuelas = DB::table('escuelas')
                    ->join('rutas_escuelas', 'rutas_escuelas.id_escuela','escuelas.id')
                    ->where('rutas_escuelas.id_ruta', $idRuta)
                    ->get();

        $nombre_ruta = $ruta->ubicacion->nomenclatura.'0'.$ruta->correlativo;

        $ruta_despacho = RutaSolicitud::with('detalles')
            ->where('id_ruta_base', $idRuta)
            ->where('nombre',$nombre_ruta)
            ->where('deleted_at', null)
            ->first();        
        $sub_rutas = RutaSolicitud::with('detalles')
            ->where('id_ruta_base', $idRuta)
            ->whereNot('nombre',$nombre_ruta)
            ->where('deleted_at', null)
            ->get();

        $detalle_escuelas = DB::table('solicitud_detalles')
            ->select(
                DB::raw('escuelas.id as escuela_id'),
                DB::raw('solicitud_detalles.tipo_de_actividad_alimentos as racion'),
                DB::raw('( ( SUM(Distinct solicitud_detalles.dias_de_solicitud) * alimentos_racion.peso * SUM(Distinct solicitud_detalles.total_pre_primaria_a_tercero_primaria) + SUM(Distinct solicitud_detalles.dias_de_solicitud) * alimentos_racion.peso * SUM(Distinct solicitud_detalles.total_cuarto_a_sexto) + SUM(Distinct solicitud_detalles.dias_de_solicitud) * alimentos_racion.peso * SUM(Distinct solicitud_detalles.total_de_docentes_y_voluntarios)  ) ) as peso')
            )
            ->join('escuelas', 'escuelas.id', 'solicitud_detalles.id_escuela')
            ->join(DB::RAW("(SELECT id_racion, SUM(cantidad) as peso FROM alimentos_raciones GROUP BY id_racion) as alimentos_racion"), function($j){
                $j->on("alimentos_racion.id_racion","=","solicitud_detalles.tipo_de_actividad_alimentos");
            })
            ->where('solicitud_detalles.id_solicitud', $id)            
            ->where('solicitud_detalles.deleted_at', null)
            ->whereIn('solicitud_detalles.tipo_de_actividad_alimentos', [4])
            ->groupBy('escuelas.id', 'solicitud_detalles.tipo_de_actividad_alimentos','alimentos_racion.peso')
            ->get();

        $tipo_ruta;
        if(isset($ruta_despacho) ): 
            $tipo_ruta = 0;
        elseif(count($sub_rutas) > 0):
            $tipo_ruta = 1;
        else:
            $tipo_ruta = 2;    
        endif;


        if(count($detalles_ruta_escuelas) > 0):
            $idEscuelas;
            foreach($detalles_ruta_escuelas as $det):
                $idEscuelas[] = $det->escuela_id;
            endforeach;

            $raciones = Racion::where('id_institucion', Auth::user()->id_institucion)->get();

            //return $raciones; 
            
            foreach($raciones as $r):
                if($r->nombre =="Escolar"):
                    $id_escolar_racion = $r->id;
                endif;

                if($r->nombre =="Escolar2"):
                    $id_escolar2_racion = $r->id;
                endif;

                if($r->nombre =="Lideres"):
                    $id_lideres_racion = $r->id;
                endif;

                if($r->nombre =="Docentes y Voluntarios"):
                    $id_do_vo_racion = $r->id;
                endif;                
            endforeach;


            $det_escuelas_preprimaria =  DB::table('solicitud_detalles')
                ->select(
                    DB::raw('escuelas.id as escuela_id'),
                    DB::raw('SUM(Distinct solicitud_detalles.dias_de_solicitud) as dias'),
                    DB::raw('SUM(Distinct solicitud_detalles.total_pre_primaria_a_tercero_primaria) as total_ninos'),
                    DB::raw('solicitud_detalles.tipo_de_actividad_alimentos as racion'),
                    DB::raw('alimentos_racion.peso as peso_racion')
                )
                ->join('escuelas', 'escuelas.id', 'solicitud_detalles.id_escuela')
                ->join(DB::RAW("(SELECT id_racion, SUM(cantidad) as peso FROM alimentos_raciones GROUP BY id_racion) as alimentos_racion"), function($j){
                    $j->on("alimentos_racion.id_racion","=","solicitud_detalles.tipo_de_actividad_alimentos");
                })
                ->where('solicitud_detalles.id_solicitud', $id)
                ->whereIn('solicitud_detalles.id_escuela', $idEscuelas)
                ->where('solicitud_detalles.tipo_de_actividad_alimentos', $id_escolar_racion)                
                ->where('solicitud_detalles.deleted_at', null)
                ->groupBy('escuelas.id', 'solicitud_detalles.tipo_de_actividad_alimentos', 'alimentos_racion.peso')
                ->get();

                    //return $det_escuelas_preprimaria;

            if(isset($id_escolar2_racion) ):
                //return $id_escolar2_racion;
                $det_escuelas_primaria = DB::table('solicitud_detalles')
                    ->select(
                        DB::raw('escuelas.id as escuela_id'),
                        DB::raw('SUM(Distinct solicitud_detalles.dias_de_solicitud) as dias'),
                        DB::raw('SUM(Distinct solicitud_detalles.total_cuarto_a_sexto) as total_ninos'),
                        DB::raw('solicitud_detalles.tipo_de_actividad_alimentos as racion'),
                        DB::raw('alimentos_racion.peso as peso_racion')
                    )
                    ->join('escuelas', 'escuelas.id', 'solicitud_detalles.id_escuela')
                    ->join(DB::RAW("(SELECT id_racion, SUM(cantidad) as peso FROM alimentos_raciones GROUP BY id_racion) as alimentos_racion"), function($j)  use($id_escolar2_racion){
                        $j->where("alimentos_racion.id_racion","=",$id_escolar2_racion);
                    })
                    ->where('solicitud_detalles.id_solicitud', $id)
                    ->whereIn('solicitud_detalles.id_escuela', $idEscuelas)
                    ->where('solicitud_detalles.tipo_de_actividad_alimentos', $id_escolar_racion)                
                    ->where('solicitud_detalles.deleted_at', null)
                    ->groupBy('escuelas.id','solicitud_detalles.tipo_de_actividad_alimentos', 'alimentos_racion.peso')
                    ->get();
            else:
                $det_escuelas_primaria = DB::table('solicitud_detalles')
                ->select(
                    DB::raw('escuelas.id as escuela_id'),
                    DB::raw('SUM(Distinct solicitud_detalles.dias_de_solicitud) as dias'),
                    DB::raw('SUM(Distinct solicitud_detalles.total_cuarto_a_sexto) as total_ninos'),
                    DB::raw('solicitud_detalles.tipo_de_actividad_alimentos as racion'),
                    DB::raw('alimentos_racion.peso as peso_racion')
                )
                ->join('escuelas', 'escuelas.id', 'solicitud_detalles.id_escuela')
                ->join(DB::RAW("(SELECT id_racion, SUM(cantidad) as peso FROM alimentos_raciones GROUP BY id_racion) as alimentos_racion"), function($j){
                    $j->on("alimentos_racion.id_racion","=","solicitud_detalles.tipo_de_actividad_alimentos");
                })
                ->where('solicitud_detalles.id_solicitud', $id)
                ->whereIn('solicitud_detalles.id_escuela', $idEscuelas)
                ->where('solicitud_detalles.tipo_de_actividad_alimentos', $id_escolar_racion)                
                ->where('solicitud_detalles.deleted_at', null)
                ->groupBy('escuelas.id','solicitud_detalles.tipo_de_actividad_alimentos', 'alimentos_racion.peso')
                ->get();
            endif;
                //return $det_escuelas_preprimaria;
            $det_escuelas_l = DB::table('solicitud_detalles')
                ->select(
                    DB::raw('escuelas.id as escuela_id'),
                    DB::raw('SUM(Distinct solicitud_detalles.dias_de_solicitud) as dias'),
                    DB::raw('SUM(Distinct solicitud_detalles.total_de_docentes_y_voluntarios) as total_personas'),
                    DB::raw('solicitud_detalles.tipo_de_actividad_alimentos as racion'),
                    DB::raw('alimentos_racion.peso as peso_racion')
                )
                ->join('escuelas', 'escuelas.id', 'solicitud_detalles.id_escuela')
                ->join(DB::RAW("(SELECT id_racion, SUM(cantidad) as peso FROM alimentos_raciones GROUP BY id_racion) as alimentos_racion"), function($j){
                    $j->on("alimentos_racion.id_racion","=","solicitud_detalles.tipo_de_actividad_alimentos");
                })
                ->where('solicitud_detalles.id_solicitud', $id)
                ->whereIn('solicitud_detalles.id_escuela', $idEscuelas)
                ->where('solicitud_detalles.tipo_de_actividad_alimentos',$id_lideres_racion)                
                ->where('solicitud_detalles.deleted_at', null)
                ->groupBy('escuelas.id','solicitud_detalles.tipo_de_actividad_alimentos', 'alimentos_racion.peso')
                ->get();

            $det_escuelas_v_d = DB::table('solicitud_detalles')
                ->select(
                    DB::raw('escuelas.id as escuela_id'),
                    DB::raw('SUM(Distinct solicitud_detalles.dias_de_solicitud) as dias'),
                    DB::raw('SUM(Distinct solicitud_detalles.total_de_docentes_y_voluntarios) as total_personas'),
                    DB::raw('solicitud_detalles.tipo_de_actividad_alimentos as racion'),
                    DB::raw('alimentos_racion.peso as peso_racion')
                )
                ->join('escuelas', 'escuelas.id', 'solicitud_detalles.id_escuela')
                ->join(DB::RAW("(SELECT id_racion, SUM(cantidad) as peso FROM alimentos_raciones GROUP BY id_racion) as alimentos_racion"), function($j){
                    $j->on("alimentos_racion.id_racion","=","solicitud_detalles.tipo_de_actividad_alimentos");
                })
                ->where('solicitud_detalles.id_solicitud', $id)
                ->whereIn('solicitud_detalles.id_escuela', $idEscuelas)
                ->where('solicitud_detalles.tipo_de_actividad_alimentos', $id_do_vo_racion)
                ->where('solicitud_detalles.deleted_at', null)
                ->groupBy('escuelas.id','solicitud_detalles.tipo_de_actividad_alimentos', 'alimentos_racion.peso')
                ->get();

        
            
            
            $datos = [
                'rutas_principales' => $rutas_principales,
                'ruta' => $ruta,
                'ruta_despacho' => $ruta_despacho,
                'sub_rutas' => $sub_rutas,
                'tipo_ruta' => $tipo_ruta,
                'escuelas' => $escuelas,
                'idSolicitud' => $idSolicitud,
                'detalles_ruta_escuelas' => $detalles_ruta_escuelas,
                'det_escuelas_preprimaria' => $det_escuelas_preprimaria,
                'det_escuelas_primaria' => $det_escuelas_primaria,
                'det_escuelas_v_d' => $det_escuelas_v_d,
                'det_escuelas_l' => $det_escuelas_l,
                'detalle_escuelas' => $detalle_escuelas
            ];

        else:
            $datos = [
                'rutas_principales' => $rutas_principales,
                'ruta' => $ruta,
                'ruta_despacho' => $ruta_despacho,
                'sub_rutas' => $sub_rutas,
                'tipo_ruta' => $tipo_ruta,
                'escuelas' => $escuelas,
                'idSolicitud' => $idSolicitud,
                'detalles_ruta_escuelas' => $detalles_ruta_escuelas,
                'detalle_escuelas' => $detalle_escuelas
            ];

        endif;        

        return view('admin.solicitudes.detalles.rutas_desgloce',$datos);
    }

    public function postSolicitudRutaConfirmar(Request $request){
        $idSolicitud = $request->input('id_solicitud');
        $ruta_base = $request->input('ruta_base');
        $nombre_ruta = e($request->input('nombre_ruta_solicitud'));
        $escuelas = RutaEscuela::select('id_escuela', 'orden_llegada')->where('id_ruta', $ruta_base)->get();

        DB::beginTransaction();
            $ruta_solicitud = new RutaSolicitud;
            $ruta_solicitud->id_solicitud_despacho = $idSolicitud;
            $ruta_solicitud->id_ruta_base = $ruta_base;
            $ruta_solicitud->nombre = $nombre_ruta;
            $ruta_solicitud->save();

            foreach($escuelas as $escuela):
                $detalle = new RutaSolicitudDetalles;
                $detalle->id_ruta_despacho = $ruta_solicitud->id;
                $detalle->id_escuela= $escuela->id_escuela;
                $detalle->orden_llegada= $escuela->orden_llegada;
                $detalle->save();
            endforeach;

        DB::commit();
 
        if($ruta_solicitud->save()):
            $b = new Bitacora;
            $b->accion = 'Confirmación de ruta '.$nombre_ruta.' sin fraccionar';
            $b->id_usuario = Auth::id();
            $b->save();

            return back()->with('messages', '¡Confirmación de ruta sin fraccionar!.')
                ->with('typealert', 'success');
        endif;
    }

    public function getSolicitudRutaConfirmadaEliminar($id){
        $ruta = RutaSolicitud::findOrFail($id);
        $detalles = RutaSolicitudDetalles::where('id_ruta_despacho',$id)->delete();

        $nombre = $ruta->nombre;
        $solicitud = $ruta->id_solicitud;


        if($ruta->delete()):
            $b = new Bitacora;
            $b->accion = 'Eliminacion de ruta '.$nombre.' de la solicitud (ID): '.$solicitud;
            $b->id_usuario = Auth::id();
            $b->save();

            return back()->with('messages', '¡Escuela eliminada con exito!.')
                    ->with('typealert', 'warning');
        endif;

    }

    public function postSolicitudCrearSubRuta(Request $request){       
        $abecedario = range('A','Z');
        $ruta_base = $request->input('ruta_base');
        $ruta_nombre_base = e($request->input('nombre_ruta_solicitud'));
        $conteo_ruta = RutaSolicitud::where('id_ruta_base', $ruta_base)->where('deleted_at', null)->count();
        $idSolicitud = $request->input('id_solicitud');

        $ruta_solicitud = new RutaSolicitud;
        $ruta_solicitud->id_solicitud_despacho = $idSolicitud;
        $ruta_solicitud->id_ruta_base = $ruta_base;
        $ruta_solicitud->nombre = $ruta_nombre_base.$abecedario[$conteo_ruta];

        if($ruta_solicitud->save()):
            $b = new Bitacora;
            $b->accion = 'Creacion de sub-ruta con exito';
            $b->id_usuario = Auth::id();
            $b->save();

            return back()->with('messages', '¡Creacion de sub-ruta con exito!.')
                ->with('typealert', 'success');
        endif;
    }

    public function postSolicitudAsignarEscuelaSubRuta(Request $request){       

        $detalle = new RutaSolicitudDetalles;
        $detalle->id_ruta_despacho = $request->input('id_sub_ruta_despacho');
        $detalle->id_escuela= $request->input('id_escuela');
        $detalle->orden_llegada= $request->input('orden_llegada');

        if($detalle->save()):
            $b = new Bitacora;
            $b->accion = 'Asignacion de escuela a sub ruta con exito';
            $b->id_usuario = Auth::id();
            $b->save();

            return back()->with('messages', '¡Asignacion de escuela a sub ruta con exito!.')
                ->with('typealert', 'success');
        endif;
    }

    public function getSolicitudEscuelaSubRutaEliminar($id){
        $escuela_sub_ruta = RutaSolicitudDetalles::findOrFail($id);


        if($escuela_sub_ruta->delete()):
            $b = new Bitacora;
            $b->accion = 'Eliminacion de escuela a sub ruta asignada';
            $b->id_usuario = Auth::id();
            $b->save();

            return back()->with('messages', '¡Escuela eliminada de sub ruta con exito!.')
                    ->with('typealert', 'warning');
        endif;

    }

    public function getSolicitudSubRutaEliminar($id){
        $ruta = RutaSolicitud::findOrFail($id);
        $detalles = RutaSolicitudDetalles::where('id_ruta_despacho',$id)->delete();

        $nombre = $ruta->nombre;
        $solicitud = $ruta->id_solicitud;


        if($ruta->delete()):
            $b = new Bitacora;
            $b->accion = 'Eliminacion de sub ruta '.$nombre.' de la solicitud (ID): '.$solicitud;
            $b->id_usuario = Auth::id();
            $b->save();

            return back()->with('messages', '¡Sub ruta eliminada con exito!.')
                    ->with('typealert', 'warning');
        endif;

    }

    public function getSolicitudRutasConfirmadas($id){
        $idSolicitud = $id;
        $rutas = RutaSolicitud::with('ruta_base')->where('id_solicitud_despacho',$id)->get();
        $detalle_escuelas = DB::table('solicitud_detalles')
            ->select(
                DB::raw('escuelas.id as escuela_id'),
                DB::raw('solicitud_detalles.tipo_de_actividad_alimentos as racion'),
                DB::raw('( ( SUM(Distinct solicitud_detalles.dias_de_solicitud) * alimentos_racion.peso * SUM(Distinct solicitud_detalles.total_pre_primaria_a_tercero_primaria) + SUM(Distinct solicitud_detalles.dias_de_solicitud) * alimentos_racion.peso * SUM(Distinct solicitud_detalles.total_cuarto_a_sexto) + SUM(Distinct solicitud_detalles.dias_de_solicitud) * alimentos_racion.peso * SUM(Distinct solicitud_detalles.total_de_docentes_y_voluntarios)  ) ) as peso')
            )
            ->join('escuelas', 'escuelas.id', 'solicitud_detalles.id_escuela')
            ->join(DB::RAW("(SELECT id_racion, SUM(cantidad) as peso FROM alimentos_raciones GROUP BY id_racion) as alimentos_racion"), function($j){
                $j->on("alimentos_racion.id_racion","=","solicitud_detalles.tipo_de_actividad_alimentos");
            })
            ->where('solicitud_detalles.id_solicitud', $id)            
            ->where('solicitud_detalles.deleted_at', null)
            ->whereIn('solicitud_detalles.tipo_de_actividad_alimentos', [1,2,3])
            ->groupBy('escuelas.id', 'solicitud_detalles.tipo_de_actividad_alimentos','alimentos_racion.peso')
            ->get();


        

        $datos = [
            'rutas' => $rutas,
            'idSolicitud' => $idSolicitud,
            'detalle_escuelas' => $detalle_escuelas
        ];


        return view('admin.solicitudes.rutas_confirmadas',$datos);

    }

    public function getSolicitudRutasConfirmadasTransporte($id){
        $ruta = RutaSolicitud::with('ruta_base')->where('id',$id)->first();

        $datos = [
            'ruta' => $ruta,
        ];


        return view('admin.solicitudes.rutas_confirmada_transporte',$datos);

    }

    public function postSolicitudRutasConfirmadasTransporte(Request $request){
        $reglas = [
    		
    	];
    	$mensajes = [
    	];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            $r = RutaSolicitud::findOrFail($request->input('idRuta'));
            $r->empresa_transporte = $request->input('empresa_transporte');
            $r->nombre_piloto = $request->input('nombre_piloto');
            $r->no_licencia = $request->input('no_licencia');
            $r->placa_vehiculo = $request->input('placa_vehiculo');
            $r->tipo_vehiculo = $request->input('tipo_vehiculo');


            if($r->save()):
                $b = new Bitacora;
                $b->accion = 'Se agrego informacion de transporte a la ruta'.$r->nombre;
                $b->id_usuario = Auth::id();
                $b->save();

                return back()->with('messages', '¡Se agrego inforamcion de transporte y se guardo con exito!.')
                    ->with('typealert', 'info');
    		endif;
        endif;

    }

    public function getSolicitudRutaConfirmadaPDF($idSolicitud, $idRuta){     
        
        $idSolicitud = $idSolicitud;
        $ruta = RutaSolicitud::with('ruta_base')->where('id',$idRuta)->first();
        $detalle_escuelas = DB::table('solicitud_detalles')
            ->select(
                DB::raw('escuelas.id as escuela_id'),
                DB::raw('solicitud_detalles.tipo_de_actividad_alimentos as racion'),
                DB::raw('( ( SUM(Distinct solicitud_detalles.dias_de_solicitud) * alimentos_racion.peso * SUM(Distinct solicitud_detalles.total_pre_primaria_a_tercero_primaria) + SUM(Distinct solicitud_detalles.dias_de_solicitud) * alimentos_racion.peso * SUM(Distinct solicitud_detalles.total_cuarto_a_sexto) + SUM(Distinct solicitud_detalles.dias_de_solicitud) * alimentos_racion.peso * SUM(Distinct solicitud_detalles.total_de_docentes_y_voluntarios)  ) ) as peso')
            )
            ->join('escuelas', 'escuelas.id', 'solicitud_detalles.id_escuela')
            ->join(DB::RAW("(SELECT id_racion, SUM(cantidad) as peso FROM alimentos_raciones GROUP BY id_racion) as alimentos_racion"), function($j){
                $j->on("alimentos_racion.id_racion","=","solicitud_detalles.tipo_de_actividad_alimentos");
            })
            ->where('solicitud_detalles.id_solicitud', $idSolicitud)            
            ->where('solicitud_detalles.deleted_at', null)
            ->whereIn('solicitud_detalles.tipo_de_actividad_alimentos', [1,2,3])
            ->groupBy('escuelas.id', 'solicitud_detalles.tipo_de_actividad_alimentos','alimentos_racion.peso')
            ->get();
        $alimentos = Bodega::where('categoria' , 0)->where('tipo_bodega',1)->where('id_institucion', Auth::user()->id_institucion)->get();
        $solicitud = Solicitud::with(['entrega', 'usuario'])->where('id', $idSolicitud)->first();
        

        $datos = [
            'ruta' => $ruta,
            'idSolicitud' => $idSolicitud,
            'detalle_escuelas' => $detalle_escuelas,
            'alimentos' => $alimentos,
            'solicitud' => $solicitud
        ];

        $pdf = Pdf::loadView('admin.solicitudes.boleta_ruta_confirmada_pdf', $datos)->setPaper('letter');
     
        return $pdf->stream();
          
    }

    public function postActualizarOrdenLlegadaSubRutas(Request $request){
        $reglas = [

    	];
    	$mensajes = [

    	];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            

            $as = RutaSolicitudDetalles::findOrFail($request->input('id_asignacion'));
            $as->orden_llegada = e($request->input('orden'));

            if($as->save()):

                return back()->with('messages', '¡Actualizacion de orden de llegada con exito!.')
                    ->with('typealert', 'info');
    		endif;
        endif;
    }

    public function getEscuelasDespacho($id_solicitud){
        $escuelas = SolicitudDetalles::with('escuela')->select('id_escuela')->where('id_solicitud', $id_solicitud)->groupBy('id_escuela')->get();

        $datos = [
            'escuelas' => $escuelas
        ];

        return response()->json($datos);
    }

    public function getEscuelasPesosDespacho($solicitud, $escuela){
        $idRaciones;         
        $raciones = Racion::where('id_institucion', Auth::user()->id_institucion)->get();
        foreach($raciones as $r):
            $idRaciones[] = $r->id;
        endforeach;

        $detalles_escuelas = DB::table('solicitud_detalles')
            ->select(
                DB::raw('escuelas.id as escuela_id'),
                DB::raw('solicitud_detalles.tipo_de_actividad_alimentos as racion'),
                DB::raw('alimentos_racion.cantidad as cantidad_alimento'),
                DB::raw('alimentos_racion.id_alimento as alimento'),
                DB::raw('SUM(Distinct solicitud_detalles.dias_de_solicitud) as dias'),
                DB::raw('SUM(Distinct solicitud_detalles.total_pre_primaria_a_tercero_primaria) as preprimaria'),
                DB::raw('SUM(Distinct solicitud_detalles.total_cuarto_a_sexto) as primaria'),
                DB::raw('SUM(Distinct solicitud_detalles.total_de_docentes_y_voluntarios) as ldv'),

            )
            ->join('escuelas', 'escuelas.id', 'solicitud_detalles.id_escuela')
            ->join(DB::RAW("(SELECT id_racion, cantidad, id_alimento FROM alimentos_raciones GROUP BY id_racion, cantidad, id_alimento) as alimentos_racion"), function($j){
                $j->on("alimentos_racion.id_racion","=","solicitud_detalles.tipo_de_actividad_alimentos");
            })
            ->where('solicitud_detalles.id_solicitud', $solicitud)            
            ->where('solicitud_detalles.id_escuela', $escuela)  
            ->where('solicitud_detalles.deleted_at', null)
            ->whereIn('solicitud_detalles.tipo_de_actividad_alimentos', [$idRaciones])
            ->groupBy('escuelas.id', 'solicitud_detalles.tipo_de_actividad_alimentos', 'alimentos_racion.cantidad','alimentos_racion.id_alimento')
            ->get();

        $datos = [
            'detalles_escuelas' => $detalles_escuelas
        ];
        return response()->json($datos);

    }

    public function getSolicitudABodegaPrimaria($solicitud){
        $raciones = Racion::where('id_institucion', Auth::user()->id_institucion)->get();
        foreach($raciones as $r):
            if($r->nombre =="Escolar"):
                $id_escolar_racion = $r->id;
            endif;

            if($r->nombre =="Escolar2"):
                $id_escolar2_racion = $r->id;
            endif;

            if($r->nombre =="Lideres"):
                $id_lideres_racion = $r->id;
            endif;

            if($r->nombre =="Docentes y Voluntarios"):
                $id_do_vo_racion = $r->id;
            endif;                
        endforeach;

        $escuelas = DB::table('solicitud_detalles')
            ->select(
                DB::raw('escuelas.id as escuela_id'),
                DB::raw('CONCAT(escuelas.codigo,  \' / \' , escuelas.nombre)  as escuela'),
            )
            ->join('escuelas', 'escuelas.id', 'solicitud_detalles.id_escuela')
            ->where('solicitud_detalles.id_solicitud', $solicitud)            
            ->where('solicitud_detalles.deleted_at', null)
            ->groupBy('escuelas.id', 'escuelas.nombre', 'escuelas.codigo')
            ->get();

        $det_escuelas_preprimaria_enc =  DB::table('solicitud_detalles')
            ->select(
                DB::raw('solicitud_detalles.id_escuela as escuela_id'),
                DB::raw('SUM(Distinct solicitud_detalles.dias_de_solicitud) as dias'),
                DB::raw('SUM(Distinct solicitud_detalles.total_pre_primaria_a_tercero_primaria) as total_beneficiarios'),
                DB::raw('raciones.nombre as racion'),
            )
            ->join('raciones', 'raciones.id', 'solicitud_detalles.tipo_de_actividad_alimentos')
            ->where('solicitud_detalles.id_solicitud', $solicitud)  
            ->where('solicitud_detalles.tipo_de_actividad_alimentos', $id_escolar_racion)                
            ->where('solicitud_detalles.deleted_at', null)
            ->groupBy('solicitud_detalles.id_escuela', 'raciones.nombre')
            ->get();
        $det_escuelas_preprimaria =  DB::table('solicitud_detalles')
            ->select(
                DB::raw('solicitud_detalles.id_escuela as escuela_id'),
                DB::raw('SUM(Distinct solicitud_detalles.dias_de_solicitud) as dias'),
                DB::raw('SUM(Distinct solicitud_detalles.total_pre_primaria_a_tercero_primaria) as total_beneficiarios'),
                DB::raw('bodegas.id as alimento_id'),
                DB::raw('bodegas.nombre as alimento'),
                DB::raw('alimentos_racion.cantidad as alimento_peso'),
                DB::raw('solicitud_detalles.tipo_de_actividad_alimentos as racion'),
            )
            ->join(DB::RAW("(SELECT id_racion, id_alimento, cantidad FROM alimentos_raciones GROUP BY id_racion, id_alimento, cantidad) as alimentos_racion"), function($j){
                $j->on("alimentos_racion.id_racion","=","solicitud_detalles.tipo_de_actividad_alimentos");
            })
            ->join('bodegas', 'bodegas.id', 'alimentos_racion.id_alimento')
            ->where('solicitud_detalles.id_solicitud', $solicitud)  
            ->where('solicitud_detalles.tipo_de_actividad_alimentos', $id_escolar_racion)                
            ->where('solicitud_detalles.deleted_at', null)
            ->groupBy('solicitud_detalles.id_escuela', 'solicitud_detalles.tipo_de_actividad_alimentos', 'bodegas.id', 'bodegas.nombre', 'alimentos_racion.cantidad')
            ->get();
        if(isset($id_escolar2_racion)):
            $det_escuelas_primaria_enc =  DB::table('solicitud_detalles')
                ->select(
                    DB::raw('solicitud_detalles.id_escuela as escuela_id'),
                    DB::raw('SUM(Distinct solicitud_detalles.dias_de_solicitud) as dias'),
                    DB::raw('SUM(Distinct solicitud_detalles.total_cuarto_a_sexto) as total_beneficiarios'),
                    DB::raw('raciones.nombre as racion'),
                )
                ->join('raciones', 'raciones.id', 'solicitud_detalles.tipo_de_actividad_alimentos')
                ->where('solicitud_detalles.id_solicitud', $solicitud)  
                ->where('solicitud_detalles.tipo_de_actividad_alimentos', $id_escolar_racion)                
                ->where('solicitud_detalles.deleted_at', null)
                ->groupBy('solicitud_detalles.id_escuela', 'raciones.nombre')
                ->get();
            $det_escuelas_primaria = DB::table('solicitud_detalles')
                ->select(
                    DB::raw('solicitud_detalles.id_escuela as escuela_id'),
                    DB::raw('SUM(Distinct solicitud_detalles.dias_de_solicitud) as dias'),
                    DB::raw('SUM(Distinct solicitud_detalles.total_cuarto_a_sexto) as total_beneficiarios'),
                    DB::raw('bodegas.id as alimento_id'),
                    DB::raw('bodegas.nombre as alimento'),
                    DB::raw('alimentos_racion.cantidad as alimento_peso'),
                    DB::raw('solicitud_detalles.tipo_de_actividad_alimentos as racion'),
                )
                ->join(DB::RAW("(SELECT id_racion, id_alimento, cantidad FROM alimentos_raciones GROUP BY id_racion, id_alimento, cantidad) as alimentos_racion"), function($j) use($id_escolar2_racion){
                    $j->where("alimentos_racion.id_racion","=",$id_escolar2_racion);
                })
                ->join('bodegas', 'bodegas.id', 'alimentos_racion.id_alimento')
                ->where('solicitud_detalles.id_solicitud', $solicitud)  
                ->where('solicitud_detalles.tipo_de_actividad_alimentos', $id_escolar_racion)                
                ->where('solicitud_detalles.deleted_at', null)
                ->groupBy('solicitud_detalles.id_escuela', 'solicitud_detalles.tipo_de_actividad_alimentos', 'bodegas.id', 'bodegas.nombre', 'alimentos_racion.cantidad')
                ->get();
        else:
            $det_escuelas_primaria_enc =  DB::table('solicitud_detalles')
                ->select(
                    DB::raw('solicitud_detalles.id_escuela as escuela_id'),
                    DB::raw('SUM(Distinct solicitud_detalles.dias_de_solicitud) as dias'),
                    DB::raw('SUM(Distinct solicitud_detalles.total_cuarto_a_sexto) as total_beneficiarios'),
                    DB::raw('raciones.nombre as racion'),
                )
                ->join('raciones', 'raciones.id', 'solicitud_detalles.tipo_de_actividad_alimentos')
                ->where('solicitud_detalles.id_solicitud', $solicitud)  
                ->where('solicitud_detalles.tipo_de_actividad_alimentos', $id_escolar_racion)                
                ->where('solicitud_detalles.deleted_at', null)
                ->groupBy('solicitud_detalles.id_escuela', 'raciones.nombre')
                ->get();
            $det_escuelas_primaria = DB::table('solicitud_detalles')
                ->select(
                    DB::raw('solicitud_detalles.id_escuela as escuela_id'),
                    DB::raw('SUM(Distinct solicitud_detalles.dias_de_solicitud) as dias'),
                    DB::raw('SUM(Distinct solicitud_detalles.total_cuarto_a_sexto) as total_beneficiarios'),
                    DB::raw('bodegas.id as alimento_id'),
                    DB::raw('bodegas.nombre as alimento'),
                    DB::raw('alimentos_racion.cantidad as alimento_peso'),
                    DB::raw('solicitud_detalles.tipo_de_actividad_alimentos as racion'),
                )
                ->join(DB::RAW("(SELECT id_racion, id_alimento, cantidad FROM alimentos_raciones GROUP BY id_racion, id_alimento, cantidad) as alimentos_racion"), function($j) {
                    $j->on("alimentos_racion.id_racion","=","solicitud_detalles.tipo_de_actividad_alimentos");
                })
                ->join('bodegas', 'bodegas.id', 'alimentos_racion.id_alimento')
                ->where('solicitud_detalles.id_solicitud', $solicitud)  
                ->where('solicitud_detalles.tipo_de_actividad_alimentos', $id_escolar_racion)                
                ->where('solicitud_detalles.deleted_at', null)
                ->groupBy('solicitud_detalles.id_escuela', 'solicitud_detalles.tipo_de_actividad_alimentos', 'bodegas.id', 'bodegas.nombre', 'alimentos_racion.cantidad')
                ->get();

        endif;
        $det_escuelas_l_enc =  DB::table('solicitud_detalles')
            ->select(
                DB::raw('solicitud_detalles.id_escuela as escuela_id'),
                DB::raw('SUM(Distinct solicitud_detalles.dias_de_solicitud) as dias'),
                DB::raw('SUM(Distinct solicitud_detalles.total_de_docentes_y_voluntarios) as total_beneficiarios'),
                DB::raw('raciones.nombre as racion'),
            )
            ->join('raciones', 'raciones.id', 'solicitud_detalles.tipo_de_actividad_alimentos')
            ->where('solicitud_detalles.id_solicitud', $solicitud)  
            ->where('solicitud_detalles.tipo_de_actividad_alimentos', $id_lideres_racion)                
            ->where('solicitud_detalles.deleted_at', null)
            ->groupBy('solicitud_detalles.id_escuela', 'raciones.nombre')
            ->get();
        $det_escuelas_l = DB::table('solicitud_detalles')
            ->select(
                DB::raw('solicitud_detalles.id_escuela as escuela_id'),
                DB::raw('SUM(Distinct solicitud_detalles.dias_de_solicitud) as dias'),
                DB::raw('SUM(Distinct solicitud_detalles.total_de_docentes_y_voluntarios) as total_beneficiarios'),
                DB::raw('bodegas.id as alimento_id'),
                DB::raw('bodegas.nombre as alimento'),
                DB::raw('alimentos_racion.cantidad as alimento_peso'),
                DB::raw('solicitud_detalles.tipo_de_actividad_alimentos as racion'),
            ) 
            ->join(DB::RAW("(SELECT id_racion, id_alimento, cantidad FROM alimentos_raciones GROUP BY id_racion, id_alimento, cantidad) as alimentos_racion"), function($j){
                $j->on("alimentos_racion.id_racion","=","solicitud_detalles.tipo_de_actividad_alimentos");
            })
            ->join('bodegas', 'bodegas.id', 'alimentos_racion.id_alimento')
            ->where('solicitud_detalles.id_solicitud', $solicitud)  
            ->where('solicitud_detalles.tipo_de_actividad_alimentos', $id_lideres_racion)                
            ->where('solicitud_detalles.deleted_at', null)
            ->groupBy('solicitud_detalles.id_escuela', 'solicitud_detalles.tipo_de_actividad_alimentos', 'bodegas.id', 'bodegas.nombre', 'alimentos_racion.cantidad')
            ->get();

        $det_escuelas_v_d_enc =  DB::table('solicitud_detalles')
            ->select(
                DB::raw('solicitud_detalles.id_escuela as escuela_id'),
                DB::raw('SUM(Distinct solicitud_detalles.dias_de_solicitud) as dias'),
                DB::raw('SUM(Distinct solicitud_detalles.total_de_docentes_y_voluntarios) as total_beneficiarios'),
                DB::raw('raciones.nombre as racion'),
            )
            ->join('raciones', 'raciones.id', 'solicitud_detalles.tipo_de_actividad_alimentos')
            ->where('solicitud_detalles.id_solicitud', $solicitud)  
            ->where('solicitud_detalles.tipo_de_actividad_alimentos', $id_do_vo_racion)                
            ->where('solicitud_detalles.deleted_at', null)
            ->groupBy('solicitud_detalles.id_escuela', 'raciones.nombre')
            ->get();        
        $det_escuelas_v_d = DB::table('solicitud_detalles')
            ->select(
                DB::raw('solicitud_detalles.id_escuela as escuela_id'),
                DB::raw('SUM(Distinct solicitud_detalles.dias_de_solicitud) as dias'),
                DB::raw('SUM(Distinct solicitud_detalles.total_de_docentes_y_voluntarios) as total_beneficiarios'),
                DB::raw('bodegas.id as alimento_id'),
                DB::raw('bodegas.nombre as alimento'),
                DB::raw('alimentos_racion.cantidad as alimento_peso'),
                DB::raw('solicitud_detalles.tipo_de_actividad_alimentos as racion'),
            ) 
            ->join(DB::RAW("(SELECT id_racion, id_alimento, cantidad FROM alimentos_raciones GROUP BY id_racion, id_alimento, cantidad) as alimentos_racion"), function($j){
                $j->on("alimentos_racion.id_racion","=","solicitud_detalles.tipo_de_actividad_alimentos");
            })
            ->join('bodegas', 'bodegas.id', 'alimentos_racion.id_alimento')
            ->where('solicitud_detalles.id_solicitud', $solicitud)  
            ->where('solicitud_detalles.tipo_de_actividad_alimentos', $id_do_vo_racion)                
            ->where('solicitud_detalles.deleted_at', null)
            ->groupBy('solicitud_detalles.id_escuela', 'solicitud_detalles.tipo_de_actividad_alimentos', 'bodegas.id', 'bodegas.nombre', 'alimentos_racion.cantidad')
            ->get();


        $alimentos = Bodega::where('tipo_bodega', 1)
            ->where('id_institucion', Auth::user()->id_institucion)
            ->get();

        $bodegas = Institucion::where('nivel', 2)->pluck('nombre','id');
        

        $datos = [
            'escuelas' => $escuelas,
            'det_escuelas_preprimaria_enc' => $det_escuelas_preprimaria_enc,
            'det_escuelas_preprimaria' => $det_escuelas_preprimaria,
            'det_escuelas_primaria_enc' => $det_escuelas_primaria_enc,
            'det_escuelas_primaria' => $det_escuelas_primaria,
            'det_escuelas_l_enc' => $det_escuelas_l_enc,
            'det_escuelas_l' => $det_escuelas_l,
            'det_escuelas_v_d_enc' => $det_escuelas_v_d_enc,
            'det_escuelas_v_d' => $det_escuelas_v_d,
            'alimentos' => $alimentos,
            'bodegas' => $bodegas,
        ];

        return view('admin.solicitudes.solicitud_bodega',$datos);
    }

    public function postSolicitudABodegaPrimaria(Request $request){
        $reglas = [

    	];
    	$mensajes = [

    	];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            DB::beginTransaction();

                $s = new SolicitudBodegaPrimaria;
                $s->fecha = Carbon::now()->format('Y-m-d');
                $s->id_bodega_primaria = $request->input('id_bodega_primaria');
                $s->id_socio_solicitante = Auth::user()->id_institucion;
                $s->save();

                $idinsumo=$request->get('idinsumo');
                $cantidad=$request->get('cantidad');
                $idmedida=$request->get('idmedida');
                $cont=0;

                while ($cont<count($idinsumo)) {
                    $detalle=new SolicitudBodegaPrimariaDetalle();
                    $detalle->id_solicitud_bodega_primaria = $s->id;
                    $detalle->id_insumo_bodega_socio = $idinsumo[$cont];
                    $insumoBodegaSocioNombre = Bodega::where('id',$idinsumo[$cont])->where('tipo_bodega',1)->where('id_institucion', Auth::user()->id_institucion)->first();                    
                    $insumoIDBPrimaria = Bodega::where('nombre',$insumoBodegaSocioNombre->nombre)->where('tipo_bodega',0)->where('id_institucion', Auth::user()->id_institucion)->first();
                    $detalle->id_insumo_bodega_primaria = $insumoIDBPrimaria->id;
                    $detalle->no_unidades = $cantidad[$cont];
                    $detalle->id_unidad_medida = $idmedida[$cont];
                    $detalle->save();
                    $cont=$cont+1;
                }

            DB::commit();

            if($s->save()):
                $b = new Bitacora;
                $b->accion = 'Registro de solicitud de insumos a bodega primaria';
                $b->id_usuario = Auth::id();
                $b->save();

                return back()->with('messages', '¡Solicitud registrada y guardada con exito!.')
                    ->with('typealert', 'success');
    		endif;
        endif;
    }




}
