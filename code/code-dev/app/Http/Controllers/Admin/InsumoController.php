<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Insumo, App\Models\PesoInsumo, App\Models\Bitacora;
use Validator, Auth, Hash, Config, Carbon\Carbon;

class InsumoController extends Controller
{
    public function getInicio(){
        $insumos = Insumo::get();
        $insumo = new Insumo;

        $datos = [
            'insumos' => $insumos,
            'insumo' => $insumo
        ];

        return view('admin.insumos.inicio',$datos); 
    }


    public function postInsumoBodegaSocioRegistrar(Request $request){
        $reglas = [
    		'nombre' => 'required'
    	];
    	$mensajes = [
    		'nombre.required' => 'Se requiere un nombre para el insumo.'
    	];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            $i = new Insumo;
            $i->nombre = e($request->input('nombre'));       
            $i->id_unidad_medida = $request->input('id_unidad_medida'); 
            $i->categoria = $request->input('categoria');
            $i->saldo = 0;
            $i->tipo_bodega = 0;   
            $i->id_institucion = Auth::user()->id_institucion;
            $i->observaciones = e($request->input('observaciones'));
            
            if($i->save()):
                $b = new Bitacora;
                $b->accion = 'Registro de insumo '.$i->nombre.' en bodega socio con saldo inicial 0';
                $b->id_usuario = Auth::id();
                $b->save();


                return redirect('/admin/insumos')->with('messages', '¡insumo creado y guardado con exito!.')
                    ->with('typealert', 'success');
    		endif;
        endif;
    }

    public function getInsumoEditar($id){
        $insumo = Insumo::findOrFail($id);
        
        $datos = [
            'insumo' => $insumo
        ];

        return view('admin.insumos.editar',$datos);
    }

    public function postInsumoEditar(Request $request, $id){
        $reglas = [
    		'nombre' => 'required'
    	];
    	$mensajes = [
    		'nombre.required' => 'Se requiere un nombre para el insumo.'
    	];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            $i = Insumo::findOrFail($id);
            $i->nombre = e($request->input('nombre'));
            $i->id_unidad_medida = $request->input('id_unidad_medida');
            $i->categoria = $request->input('categoria');
            $i->observaciones = e($request->input('observaciones'));

            if($i->save()):
                $b = new Bitacora;
                $b->accion = 'Edición de información de insumo: '.$i->nombre;
                $b->id_usuario = Auth::id();
                $b->save();

                return redirect('/admin/insumos')->with('messages', '¡Información actualizada y guardada con exito!.')
                ->with('typealert', 'info');
    		endif;
        endif;
    }

    public function getInsumoEliminar($id){
        $insumo = Insumo::findOrFail($id);

        if($insumo->delete()):
            $b = new Bitacora;
            $b->accion = 'Eliminación de insumo: '.$insumo->nombre;
            $b->id_usuario = Auth::id();
            $b->save();

            return back()->with('messages', '¡insumo eliminado con exito!.')
                    ->with('typealert', 'warning');
        endif;
    }

    public function getInsumoPesos($id){
        $pesos_existen = PesoInsumo::where('id_insumo',$id)->count();
        if($pesos_existen == 0):
            $pesos = new PesoInsumo;
        else:
            $pesos = PesoInsumo::findOrFail($id);
        endif;
        $insumo = Insumo::findOrFail($id);

        $datos = [
            'id' => $id,
            'pesos' => $pesos,
            'insumo' => $insumo
        ];

        return view('admin.insumos.pesos',$datos);
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
            $datos_ant = PesoInsumo::where('id_insumo',$request->input('id_insumo'))->count();
            if($datos_ant == 0):
                $i = Insumo::findOrFail($request->input('id_insumo'));
                $p = new PesoInsumo;
                $p->id_insumo = $request->input('id_insumo');
                $p->gramos_x_libra = $request->input('gramos_x_libra');
                $p->gramos_x_kg = $request->input('gramos_x_kg');
                $p->libras_x_kg = $request->input('libras_x_kg');
                $p->kg_x_unidad = $request->input('kg_x_unidad');
                $p->gramos_x_unidad = $request->input('gramos_x_unidad');
                $p->libras_x_unidad = $request->input('libras_x_unidad');
                $p->quintales_x_unidad = $request->input('quintales_x_unidad');
                $p->peso_bruto_quintales = $request->input('peso_bruto_quintales');
                $p->tonelada_metrica_kg = $request->input('tonelada_metrica_kg');
                $p->unidades_x_tm = $request->input('unidades_x_tm');

                if($p->save()):
                    $b = new Bitacora;
                    $b->accion = 'Registro de peso de insumo: '.$i->nombre;
                    $b->id_usuario = Auth::id();
                    $b->save();

                    return back()->with('messages', '¡Pesos de insumo creados y guardados con exito!.')
                    ->with('typealert', 'success');
                endif;
            endif;

            if($datos_ant == 1):
                $i = Insumo::findOrFail($request->input('id_insumo'));
                $p = PesoInsumo::findOrFail($request->input('id_insumo'));

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

                if($p->save()):
                    $b = new Bitacora;
                    $b->accion = 'Actualización de pesos de insumo: '.$i->nombre;
                    $b->id_usuario = Auth::id();
                    $b->save();

                    return back()->with('messages', '¡Información actualizada y guardada con exito!.')
                    ->with('typealert', 'info');
                endif;
            endif;
            
        endif;
    }
}
