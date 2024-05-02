<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Bodega, App\Models\BodegaIngreso, App\Models\BodegaIngresoDetalle, App\Models\BodegaEgreso, App\Models\BodegaEgresoDetalle;
use App\Models\PesoInsumo, App\Models\Insumo, App\Models\Institucion,App\Models\Solicitud, App\Models\SolicitudDetalles, App\Models\Bitacora, App\Models\SolicitudBodegaPrimaria;
use Validator, Auth, Hash, Config, DB, Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class BodegaSocioController extends Controller
{
    public function getInsumos(){
        if(Auth::user()->rol == 0 || Auth::user()->rol == 1 ):
            $insumos = Bodega::where('tipo_bodega',1)->get();
        else:
            $insumos = Bodega::where('tipo_bodega',1)->where('id_institucion', Auth::user()->id_institucion)->get();
        endif;
        
        $insumo = new Bodega;

        $datos = [
            'insumos' => $insumos,
            'insumo' => $insumo
        ];

        return view('admin.bodega.bodega_socio.inicio', $datos);

    }

    public function postInsumoRegistrar(Request $request){
        $reglas = [

    	];
    	$mensajes = [

    	];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            $b = new Bodega;
            $b->nombre = e($request->input('nombre'));       
            $b->id_unidad_medida = $request->input('id_unidad_medida'); 
            $b->categoria = $request->input('categoria');
            $b->saldo = 0;
            $b->tipo_bodega = 1;   
            $b->id_institucion = Auth::user()->id_institucion;
            $b->observaciones = e($request->input('observaciones'));
            $b->save();
           

            $insumo = $b->nombre;
            if($request->input('categoria') == 0):
                $p = new PesoInsumo;
                $p->id_insumo = $b->id;
                $p->gramos_x_libra = 0;
                $p->gramos_x_kg = 0;
                $p->libras_x_kg = 0;
                $p->kg_x_unidad = 0;
                $p->gramos_x_unidad = 0;
                $p->libras_x_unidad = 0;
                $p->quintales_x_unidad = 0;
                $p->peso_bruto_quintales = 0;
                $p->tonelada_metrica_kg = 0;
                $p->unidades_x_tm = 0;

                if($p->save()):
                    $b = new Bitacora;
                    $b->accion = 'Registro de pesos del insumo: '.$insumo;
                    $b->id_usuario = Auth::id();
                    $b->save();
                endif;
            endif;

            if($b->save()):
                $b = new Bitacora;
                $b->accion = 'Registro de insumo '.$insumo.' en la bodega del socio '.Auth::user()->institucion->nombre.' con saldo inicial 0';
                $b->id_usuario = Auth::id();
                $b->save();

                return back()->with('messages', '¡Insumo registrado y guardado con exito!.')
                    ->with('typealert', 'success');
    		endif;
        endif;
    }

    public function getInsumoIngresosAlimentos(){
        $bodegas = Institucion::where('nivel', 2)->get();
        $insumos = Bodega::where('tipo_bodega', 1)->where('categoria', 0)->where('id_institucion', Auth::user()->id_institucion)->get();

        $datos = [
            'insumos' => $insumos,
            'bodegas' => $bodegas
        ];
        
        return view('admin.bodega.bodega_socio.movimientos.ingreso_alimentos' ,$datos);
    }

    public function postInsumoIngresosAlimentos(Request $request){
        $reglas = [

    	];
    	$mensajes = [

    	];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            DB::beginTransaction();

                $bi = new BodegaIngreso;
                $bi->fecha = $request->input('fecha_ingreso');
                $bi->id_bodega_despacho = $request->input('bodega_despacho');
                $bi->procedente = $request->input('procedente');
                $bi->tipo_documento = $request->input('tipo_documento');
                $bi->no_documento = $request->input('no_documento');
                $bi->tipo_bodega = 1;
                $bi->id_institucion = Auth::user()->id_institucion;
                $bi->save();

                $idinsumo=$request->get('idinsumo');
                $pl=$request->get('pl');
                $bubd=$request->get('bubd');
                $no_unidades=$request->get('no_unidades');
                $unidad_medida=$request->get('unidad_medida');
                $peso_total=$request->get('peso_total');
                $cont=0;

                while ($cont<count($idinsumo)) {
                    $detalle=new BodegaIngresoDetalle();
                    $detalle->id_ingreso = $bi->id;
                    $detalle->id_insumo = $idinsumo[$cont];
                    $detalle->pl = $pl[$cont];
                    $detalle->bubd = $bubd[$cont];
                    $detalle->no_unidades = $no_unidades[$cont];
                    $detalle->unidad_medida = $unidad_medida[$cont];
                    $detalle->peso_total = $peso_total[$cont];
                    $detalle->no_unidades_usadas = 0;
                    $detalle->save();
                    $cont=$cont+1;
                }

            DB::commit();

            if($bi->save()):
                $b = new Bitacora;
                $b->accion = 'Registro de ingreso de insumos a bodega';
                $b->id_usuario = Auth::id();
                $b->save();

                return back()->with('messages', '¡Ingreso registrado y guardado con exito!.')
                    ->with('typealert', 'success');
    		endif;
        endif;
    }

    public function getInsumoIngresosOtros(){
        $bodegas = Institucion::where('nivel', 2)->get();
        $insumos = Bodega::where('tipo_bodega', 1)->where('categoria', 1)->where('id_institucion', Auth::user()->id_institucion)->get();

        $datos = [
            'insumos' => $insumos,
            'bodegas' => $bodegas
        ];
        
        return view('admin.bodega.bodega_socio.movimientos.ingreso_otros' ,$datos);
    }

    public function postInsumoIngresosOtros(Request $request){
        $reglas = [

    	];
    	$mensajes = [

    	];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            DB::beginTransaction();

                $bi = new BodegaIngreso;
                $bi->fecha = $request->input('fecha_ingreso');
                $bi->id_bodega_despacho = $request->input('bodega_despacho');
                $bi->procedente = $request->input('procedente');
                $bi->tipo_documento = $request->input('tipo_documento');
                $bi->no_documento = $request->input('no_documento');
                $bi->tipo_bodega = 1;
                $bi->id_institucion = Auth::user()->id_institucion;
                $bi->save();

                $idinsumo=$request->get('idinsumo');
                $no_unidades=$request->get('no_unidades');
                $presentacion=$request->get('idpresentacion');
                $observaciones=$request->get('observaciones');
                $cont=0;

                while ($cont<count($idinsumo)) {
                    $detalle=new BodegaIngresoDetalle();
                    $detalle->id_ingreso = $bi->id;
                    $detalle->id_insumo = $idinsumo[$cont];
                    $detalle->no_unidades = $no_unidades[$cont];
                    $detalle->presentacion = $presentacion[$cont];
                    $detalle->observaciones = $observaciones[$cont];
                    $detalle->no_unidades_usadas = 0;
                    $detalle->save();
                    $cont=$cont+1;
                }

            DB::commit();

            if($bi->save()):
                $b = new Bitacora;
                $b->accion = 'Registro de ingreso de insumos a bodega';
                $b->id_usuario = Auth::id();
                $b->save();

                return back()->with('messages', '¡Ingreso registrado y guardado con exito!.')
                    ->with('typealert', 'success');
    		endif;
        endif;
    }

    public function getInsumoEgresosAlimentos(){ 
        $solicitudes = Solicitud::with(['entrega', 'detalles'])->where('id_socio', Auth::user()->id_institucion)->get();
        $insumos = Bodega::where('tipo_bodega', 1)->where('categoria', 0)->where('saldo', '>',0)->where('id_institucion', Auth::user()->id_institucion)->get();

        $datos = [
            'solicitudes' => $solicitudes,
            'insumos' => $insumos
        ];
        
        return view('admin.bodega.bodega_socio.movimientos.egreso_alimentos' ,$datos);
    }

    public function postInsumoEgresosAlimentos(Request $request){
        $reglas = [

    	];
    	$mensajes = [

    	];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            $alimentos = Bodega::whereNotIn('id', $request->get('idinsumo'))->where('categoria' , 0)->where('tipo_bodega',1)->where('id_institucion', Auth::user()->id_institucion)->orderBy('id', 'Asc')->get();
            DB::beginTransaction();

                $participantes = SolicitudDetalles::select(DB::RAW('SUM(total_de_personas) as total'))->where('id_solicitud', $request->input('id_solicitud'))
                    ->where('id_escuela', $request->input('id_escuela'))
                    ->where('tipo_de_actividad_alimentos', $request->input('tipo_racion'))
                    ->first();
                
                //return $participantes;

                $be = new BodegaEgreso;
                $be->fecha = $request->input('fecha_egreso');
                $be->tipo_documento = $request->input('tipo_documento');
                $be->no_documento = $request->input('no_documento');
                $be->id_solicitud_despacho = $request->input('id_solicitud');
                $be->id_escuela_despacho = $request->input('id_escuela');
                $be->tipo_racion = $request->input('tipo_racion');
                $be->destino = $request->input('destino');
                $be->participantes = $participantes->total;
                $be->tipo_bodega = 1;
                $be->id_institucion = Auth::user()->id_institucion;
                $be->save();

                $idinsumo=$request->get('idinsumo');
                $pl=$request->get('idpl');
                $no_unidades=$request->get('no_unidades');
                $cont=0;

                while ($cont<count($idinsumo)) {
                    $detalle=new BodegaEgresoDetalle();
                    $detalle->id_egreso = $be->id;
                    $detalle->id_insumo = $idinsumo[$cont];
                    $detalle->pl = $pl[$cont];
                    $detalle->no_unidades = $no_unidades[$cont];
                    $detalle->save();
                    $cont=$cont+1;
                }

            DB::commit();

            if($be->save()):
                $b = new Bitacora;
                $b->accion = 'Registro de egreso de insumos a bodega';
                $b->id_usuario = Auth::id();
                $b->save();

                return back()->with('messages', '¡Egreso registrado y guardado con exito!.')
                    ->with('typealert', 'success');
    		endif;
        endif;
    }

    public function getInsumoEgresosOtros(){ 
        $solicitudes = Solicitud::with(['entrega', 'detalles'])->where('id_socio', Auth::user()->id_institucion)->get();
        $insumos = Bodega::where('tipo_bodega', 1)->where('categoria', 1)->where('saldo', '>',0)->where('id_institucion', Auth::user()->id_institucion)->get();

        $datos = [
            'solicitudes' => $solicitudes,
            'insumos' => $insumos
        ];
        
        return view('admin.bodega.bodega_socio.movimientos.egreso_otros' ,$datos);
    }

    public function postInsumoEgresosOtros(Request $request){
        $reglas = [

    	];
    	$mensajes = [

    	];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            
            DB::beginTransaction();

                $be = new BodegaEgreso;
                $be->fecha = $request->input('fecha_egreso');
                $be->tipo_documento = $request->input('tipo_documento');
                $be->no_documento = $request->input('no_documento');
                $be->id_solicitud_despacho = $request->input('id_solicitud');
                $be->id_escuela_despacho = $request->input('id_escuela');
                $be->tipo_racion = $request->input('tipo_racion');
                $be->destino = $request->input('destino');
                $be->tipo_bodega = 1;
                $be->id_institucion = Auth::user()->id_institucion;
                $be->save();

                $idinsumo=$request->get('idinsumo');
                $no_unidades=$request->get('no_unidades');
                $cont=0;
                
                while ($cont<count($idinsumo)):
                    

                    $detalle=new BodegaEgresoDetalle();
                    $detalle->id_egreso = $be->id;
                    $detalle->id_insumo = $idinsumo[$cont];
                    $detalle->no_unidades = $no_unidades[$cont];
                    $detalle->save();
                    
                    $cont=$cont+1;
                endwhile;

                
                

                

            DB::commit();

            if($be->save()):
                $b = new Bitacora;
                $b->accion = 'Registro de egreso de insumos a bodega';
                $b->id_usuario = Auth::id();
                $b->save();

                return back()->with('messages', '¡Egreso registrado y guardado con exito!.')
                    ->with('typealert', 'success');
    		endif;
        endif;
    }

    public function getMovimientosIngresos(){ 
        if(Auth::user()->rol == 0 || Auth::user()->rol == 1 ):
            $ingresos = BodegaIngreso::where('tipo_bodega',1)->get();
        else:
            $ingresos = BodegaIngreso::where('tipo_bodega',1)->where('id_institucion',Auth::user()->id_institucion)->get();
        endif;
        

        $datos = [
            'ingresos' => $ingresos
        ];
        
        return view('admin.bodega.bodega_socio.movimientos.historial_ingresos' ,$datos);
    }

    public function getMovimientosIngresoDetalle($id){ 
        
        if(Auth::user()->rol == 0 || Auth::user()->rol == 1 ):
            $ingresos = BodegaIngreso::where('tipo_bodega',1)->get();
        else:
            $ingresos = BodegaIngreso::where('tipo_bodega',1)->where('id_institucion',Auth::user()->id_institucion)->get();
        endif;

        $detalles = BodegaIngresoDetalle::where('id_ingreso', $id)->get();

        $datos = [
            'ingresos' => $ingresos,
            'detalles' => $detalles
        ];
        
        return view('admin.bodega.bodega_socio.movimientos.historial_ingresos_detalles' ,$datos);
    }

    public function getMovimientosEgresos(){ 
        
        if(Auth::user()->rol == 0 || Auth::user()->rol == 1 ):
            $egresos = BodegaEgreso::where('tipo_bodega',1)->get();
        else:
            $egresos = BodegaEgreso::where('tipo_bodega',1)->where('id_institucion',Auth::user()->id_institucion)->get();
        endif;

        $datos = [
            'egresos' => $egresos
        ];
        
        return view('admin.bodega.bodega_socio.movimientos.historial_egresos' ,$datos);
    }

    public function getMovimientosEgresoDetalle($id){ 
        if(Auth::user()->rol == 0 || Auth::user()->rol == 1 ):
            $egresos = BodegaEgreso::where('tipo_bodega',1)->get();
        else:
            $egresos = BodegaEgreso::where('tipo_bodega',1)->where('id_institucion',Auth::user()->id_institucion)->get();
        endif;
        
        $detalles = BodegaEgresoDetalle::where('id_egreso', $id)->get();

        $datos = [
            'egresos' => $egresos,
            'detalles' => $detalles
        ];
        
        return view('admin.bodega.bodega_socio.movimientos.historial_egresos_detalles' ,$datos);
    }
    

    public function getInsumoEliminar($id){
        $insumo = Bodega::findOrFail($id);
        //$detalles = SolicitudDetalles::where('id_solicitud',$id)->delete();

        if($insumo->delete()):
            $b = new Bitacora;
            $b->accion = 'Eliminacion de insumo de la bodega socion, con registro (ID): '.$insumo->id;
            $b->id_usuario = Auth::id();
            $b->save();

            return back()->with('messages', '¡Insumo eliminado con exito!.')
                    ->with('typealert', 'warning');
        endif;
    }

    public function getInsumoPesos($id){

        
        /*$pesos = PesoInsumo::where('id_insumo',3)->first();
        return $pesos;*/    
        $pesos = PesoInsumo::with('alimento')->where('id_insumo',$id)->first();
        
        $insumo = Bodega::findOrFail($id); 

        $datos = [
            'id' => $id,
            'pesos' => $pesos
        ];          

        return view('admin.bodega.bodega_socio.pesos_insumos',$datos);
    }

    public function postInsumoPesos(Request $request){
        $reglas = [
    		
    	];
    	$mensajes = [
    		
    	];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            
            $i = Bodega::findOrFail($request->input('id_alimento'));
            $p = PesoInsumo::where('id_insumo',$request->input('id_alimento'))->first();

            if(empty($request->input('gramos_x_libra'))):
                $p->gramos_x_libra = $request->input('gramos_x_libra_ant');
            else:
                $p->gramos_x_libra = $request->input('gramos_x_libra');
            endif;
            
            if(empty($request->input('gramos_x_kg'))):
                $p->gramos_x_kg = $request->input('gramos_x_kg_ant');
            else:
                $p->gramos_x_kg = $request->input('gramos_x_kg');
            endif;

            if(empty($request->input('libras_x_kg'))):
                $p->libras_x_kg  = $request->input('libras_x_kg_ant');
            else:
                $p->libras_x_kg  = $request->input('libras_x_kg');
            endif;

            if(empty($request->input('kg_x_unidad'))):
                $p->kg_x_unidad = $request->input('kg_x_unidad_ant');
            else:
                $p->kg_x_unidad = $request->input('kg_x_unidad');
            endif;

            if(empty($request->input('gramos_x_unidad'))):
                $p->gramos_x_unidad = $request->input('gramos_x_unidad_ant');
            else:
                $p->gramos_x_unidad = $request->input('gramos_x_unidad');
            endif;

            if(empty($request->input('libras_x_unidad'))):
                $p->libras_x_unidad = $request->input('libras_x_unidad_ant');
            else:
                $p->libras_x_unidad = $request->input('libras_x_unidad');
            endif;

            if(empty($request->input('quintales_x_unidad'))):
                $p->quintales_x_unidad = $request->input('quintales_x_unidad_ant');
            else:
                $p->quintales_x_unidad = $request->input('quintales_x_unidad');
            endif;

            if(empty($request->input('peso_bruto_quintales'))):
                $p->peso_bruto_quintales = $request->input('peso_bruto_quintales_ant');
            else:
                $p->peso_bruto_quintales = $request->input('peso_bruto_quintales');
            endif;

            if(empty($request->input('tonelada_metrica_kg'))):
                $p->tonelada_metrica_kg = $request->input('tonelada_metrica_kg_ant');
            else:
                $p->tonelada_metrica_kg = $request->input('tonelada_metrica_kg');
            endif;
            
            if(empty($request->input('unidades_x_tm'))):
                $p->unidades_x_tm = $request->input('unidades_x_tm_ant');
            else:
                $p->unidades_x_tm = $request->input('unidades_x_tm');
            endif;

            $insumo = $i->nombre;
            if($p->save()):
                $b = new Bitacora;
                $b->accion = 'Actualizacion de pesos de insumo: '.$insumo;
                $b->id_usuario = Auth::id();
                $b->save();

                return back()->with('messages', '¡Información actualizada y guardada con exito!.')
                ->with('typealert', 'info');
            endif;
            
        endif;
    }

    public function getSolicitudesBodegaPrimaria(){
        $solicitudes = SolicitudBodegaPrimaria::where('id_socio_solicitante',Auth::user()->id_institucion )->get();
        
        $datos = [
            'solicitudes' => $solicitudes 
        ];

        return view('admin.bodega.bodega_socio.solicitudes_insumos', $datos);
    }

    public function getSolicitudesBodegaPrimariaPDF($id){
        $solicitud = SolicitudBodegaPrimaria::findOrFail($id);
        
        $datos = [
            'solicitud' => $solicitud
        ];

        $pdf = Pdf::loadView('admin.bodega.bodega_socio.solicitud_insumos_pdf', $datos)->setPaper('letter');
     
        return $pdf->stream();
    }

    

    public function getPlDisponiblesAlimento($id){
        $pls = BodegaIngresoDetalle::select('pl')
            ->where('id_insumo', $id)
            ->whereRaw('no_unidades - no_unidades_usadas >0')
            ->get();


        $datos = [
            'pls' => $pls
        ];
        return response()->json($datos);
    }

    public function getSaldoDisponiblesInsumo($id){
        $saldo = BodegaIngresoDetalle::select(DB::raw('SUM(no_unidades - no_unidades_usadas) as saldo_disponible'))
        ->where('id', $id)
        ->first();


        $datos = [
            'saldo' => $saldo
        ];
        return response()->json($datos);
    }

    public function getPlSaldoDisponibleAlimento($pl){
        $saldo = BodegaIngresoDetalle::select(DB::raw('SUM(no_unidades - no_unidades_usadas) as saldo_disponible'))
            ->where('pl', $pl)
            ->first();


        $datos = [
            'saldo' => $saldo
        ];
        return response()->json($datos);
    }

    public function getRacionesEscuelaSolicitud($idSolicitud, $idEscuela){
        $raciones = SolicitudDetalles::select(DB::raw('DISTINCT tipo_de_actividad_alimentos as id'), DB::raw('raciones.nombre as nombre'))
            ->join('raciones', 'raciones.id','=','solicitud_detalles.tipo_de_actividad_alimentos')
            ->where('id_solicitud', $idSolicitud)->where('id_escuela', $idEscuela)->get();


        $datos = [
            'raciones' => $raciones
        ];
        return response()->json($datos);
    }

    

   


    
} 
