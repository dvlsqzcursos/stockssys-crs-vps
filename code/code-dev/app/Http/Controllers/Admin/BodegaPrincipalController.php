<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Bodega, App\Models\BodegaIngreso, App\Models\BodegaIngresoDetalle, App\Models\BodegaEgreso, App\Models\BodegaEgresoDetalle,App\Models\PesoInsumo, App\Models\Insumo, App\Models\Institucion;
use App\Models\Bitacora, App\Models\SolicitudBodegaPrimaria, App\Models\SolicitudBodegaPrimariaDetalle;
use Validator, Auth, Hash, Config, DB, Carbon\Carbon; 

class BodegaPrincipalController extends Controller
{
    public function getInsumos(){
        $insumos = Bodega::where('tipo_bodega',0)->where('id_institucion', Auth::user()->id_institucion)->get();
        $insumo = new Bodega;

        $datos = [
            'insumos' => $insumos,
            'insumo' => $insumo
        ];

        return view('admin.bodega.bodega_principal.inicio', $datos);

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
            $b->tipo_bodega = 0;   
            $b->id_institucion = Auth::user()->id_institucion;
            $b->observaciones = e($request->input('observaciones'));

            $insumo = $b->nombre;

            if($b->save()):
                $b = new Bitacora;
                $b->accion = 'Registro de insumo '.$insumo.' en la bodega principal '.Auth::user()->institucion->nombre.' con saldo inicial 0';
                $b->id_usuario = Auth::id();
                $b->save();

                return back()->with('messages', '¡Insumo registrado y guardado con exito!.')
                    ->with('typealert', 'success');
    		endif;
        endif;
    }

    public function getInsumoIngresos(){
        $bodegas = Institucion::where('nivel', 2)->pluck('nombre','id');
        $insumos = Bodega::where('tipo_bodega', 0)->where('id_institucion', Auth::user()->id_institucion)->get();

        $datos = [
            'insumos' => $insumos,
            'bodegas' => $bodegas
        ];
        
        return view('admin.bodega.bodega_principal.movimientos.ingreso' ,$datos); 
    }

    public function postInsumoIngresos(Request $request){
        //return $request->all();
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
                $bi->tipo_bodega = 0;
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

    public function getInsumoEgresos(){ 
        $socios = Institucion::where('nivel', 0)->get();
        $insumos = Bodega::where('tipo_bodega', 0)->where('saldo', '>',0)->where('id_institucion', Auth::user()->id_institucion)->get();

        $datos = [
            'socios' => $socios,
            'insumos' => $insumos
        ];
        
        return view('admin.bodega.bodega_principal.movimientos.egreso' ,$datos);
    }

    public function postInsumoEgresos(Request $request){
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
                $be->id_socio_despacho = $request->input('id_socio');
                $be->tipo_bodega = 0;
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

    public function getMovimientosIngresos(){ 
        $ingresos = BodegaIngreso::where('id_institucion',Auth::user()->id_institucion)->get();

        $datos = [
            'ingresos' => $ingresos
        ];
        
        return view('admin.bodega.bodega_principal.movimientos.historial_ingresos' ,$datos);
    }

    public function getMovimientosIngresoDetalle($id){ 
        $ingresos = BodegaIngreso::where('id_institucion',Auth::user()->id_institucion)->get();
        $detalles = BodegaIngresoDetalle::where('id_ingreso', $id)->get();

        $datos = [
            'ingresos' => $ingresos,
            'detalles' => $detalles
        ];
        
        return view('admin.bodega.bodega_principal.movimientos.historial_ingresos_detalles' ,$datos);
    }

    public function getMovimientosEgresos(){ 
        $egresos = BodegaEgreso::where('id_institucion',Auth::user()->id_institucion)->get();

        $datos = [
            'egresos' => $egresos
        ];
        
        return view('admin.bodega.bodega_principal.movimientos.historial_egresos' ,$datos);
    }

    public function getMovimientosEgresoDetalle($id){ 
        $egresos = BodegaEgreso::where('id_institucion',Auth::user()->id_institucion)->get();
        $detalles = BodegaEgresoDetalle::where('id_egreso', $id)->get();

        $datos = [
            'egresos' => $egresos,
            'detalles' => $detalles
        ];
        
        return view('admin.bodega.bodega_principal.movimientos.historial_egresos_detalles' ,$datos);
    }

    public function getSociosSolicitudes($idSocio){
        $solicitudes = SolicitudBodegaPrimaria::where('id_socio_solicitante', $idSocio)->where('estado', 2)->get();

        $datos = [
            'solicitudes' => $solicitudes
        ];

        return response()->json($datos);
    }

    public function getPlDisponiblesInsumo($id){
        $pls = BodegaIngresoDetalle::select('pl')
            ->where('id_insumo', $id)
            ->whereRaw('no_unidades - no_unidades_usadas >0')
            ->orderBy('bubd', 'Asc')
            ->get();


        $datos = [
            'pls' => $pls
        ];
        return response()->json($datos);
    }

    public function getPlSaldoDisponibleInsumo($pl){
        $saldo = BodegaIngresoDetalle::select('bubd',DB::raw('SUM(no_unidades - no_unidades_usadas) as saldo_disponible'))
            ->where('pl', $pl)
            ->groupBy('bubd')
            ->first();


        $datos = [
            'saldo' => $saldo
        ];
        return response()->json($datos);
    }

    public function getSolicitudesSocios(){
        $solicitudes = SolicitudBodegaPrimaria::where('id_bodega_primaria',Auth::user()->id_institucion )->get();
        
        $datos = [
            'solicitudes' => $solicitudes 
        ];

        return view('admin.bodega.bodega_principal.solicitudes_socios', $datos);
    }

    public function getSolicitudeSocioDetalles($id){
        $solicitudes = SolicitudBodegaPrimaria::where('id_bodega_primaria',Auth::user()->id_institucion )->get();
        $solicitud = SolicitudBodegaPrimaria::findOrFail($id);
        $detalles = SolicitudBodegaPrimariaDetalle::where('id_solicitud_bodega_primaria', $id)->get();
        
        $datos = [
            'solicitudes' => $solicitudes,
            'solicitud' => $solicitud,
            'detalles' => $detalles 
        ];

        return view('admin.bodega.bodega_principal.solicitudes_socios_detalles', $datos);
    }

    public function getAceptarSolicitudSocio($id){
        $solicitud = SolicitudBodegaPrimaria::findOrFail($id);
        $solicitud->estado = 2;

        if($solicitud->save()):
            $b = new Bitacora;
            $b->accion = 'Actualizacion de estado \'Aceptar\' de solicitud de insumos de socio No. '.$solicitud->id;
            $b->id_usuario = Auth::id();
            $b->save();

            return back()->with('messages', '¡Solicitud actualizada con exito!.')
                    ->with('typealert', 'warning');
        endif;
        
    }

    public function getRechazarSolicitudSocio($id){
        $solicitud = SolicitudBodegaPrimaria::findOrFail($id);
        $solicitud->estado = 3;

        if($solicitud->save()):
            $b = new Bitacora;
            $b->accion = 'Actualizacion de estado \'Rechazar\' de solicitud de insumos de socio No. '.$solicitud->id;
            $b->id_usuario = Auth::id();
            $b->save();

            return back()->with('messages', '¡Solicitud actualizada con exito!.')
                    ->with('typealert', 'warning');
        endif;
    }
}
