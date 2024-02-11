<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Bodega, App\Models\BodegaIngreso, App\Models\BodegaIngresoDetalle, App\Models\Insumo, App\Models\Institucion, App\Models\Bitacora;
use Validator, Auth, Hash, Config, DB, Carbon\Carbon;

class BodegaController extends Controller
{
    public function getBodegaSocioInsumos(){
        $insumos = Insumo::get();
        $insumo = new Insumo;

        $datos = [
            'insumos' => $insumos,
            'insumo' => $insumo
        ];

        return view('admin.bodega.bodega_socio.insumos', $datos);

    }

    public function postBodegaSocioInsumoRegistrar(Request $request){
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



            if($b->save()):
                $b = new Bitacora;
                $b->accion = 'Registro de insumo '.$insumo->nombre.' en bodega socio con saldo inicial 0';
                $b->id_usuario = Auth::id();
                $b->save();

                return back()->with('messages', '¡Insumo registrado y guardado con exito!.')
                    ->with('typealert', 'success');
    		endif;
        endif;
    }

    public function getBodegaSocioIngreso(){
        $bodegas = Institucion::where('nivel', 2)->pluck('nombre','id');
        $insumos = Bodega::with(['insumo'])->where('id_institucion', Auth::user()->id_institucion)->get();

        $datos = [
            'insumos' => $insumos,
            'bodegas' => $bodegas
        ];
        
        return view('admin.bodega.bodega_socio.ingreso' ,$datos);
    }

    public function postBodegaSocioIngreso(Request $request){
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
                $bi->bodega_despacho = $request->input('bodega_despacho');
                $bi->tipo_documento = $request->input('tipo_documento');
                $bi->no_documento = $request->input('no_documento');
                $bi->tipo_bodega = 1;
                $bi->id_institucion = Auth::user()->id_institucion;
 
                $idinsumo=$request->get('idinsumo');
                $pl=$request->get('pl');
                $no_unidades=$request->get('no_unidades');
                $unidad_medida=$request->get('unidad_medida');
                $peso_total=$request->get('peso_total');
                $cont=0;

                while ($cont<count($idinsumo)) {
                    $detalle=new BodegaIngresoDetalle();
                    $detalle->id_ingreso = $bi->id;
                    $detalle->id_insumo = $idinsumo[$cont];
                    $detalle->pl = $pl[$cont];
                    $detalle->no_unidades = $no_unidades[$cont];
                    $detalle->unidad_medida = $unidad_medida[$cont];
                    $detalle->peso_total = $peso_total[$cont];
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

    public function getBodegaSocioEgreso(){ 
        
    }
} 
