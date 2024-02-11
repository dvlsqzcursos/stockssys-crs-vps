<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Alimento, App\Models\PesoAlimento, App\Models\Bitacora;
use Validator, Auth, Hash, Config, Carbon\Carbon;

class AlimentoController extends Controller
{
    public function getInicio(){
        $alimentos = Alimento::get();
        $alimento = new Alimento;

        $datos = [
            'alimentos' => $alimentos,
            'alimento' => $alimento
        ];

        return view('admin.alimentos.inicio',$datos);
    }


    public function postAlimentoRegistrar(Request $request){
        $reglas = [
    		'nombre' => 'required'
    	];
    	$mensajes = [
    		'nombre.required' => 'Se requiere un nombre para el alimento.'
    	];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            $a = new Alimento;
            $a->nombre = e($request->input('nombre'));       
            $a->id_unidad_medida = $request->input('id_unidad_medida');
            $a->saldo_bodega_principal = 0;     
            $a->saldo_bodega_socio = 0;   
            $a->observaciones = e($request->input('observaciones'));
            $a->id_institucion = Auth::user()->id_institucion;

            if($a->save()):
                $b = new Bitacora;
                $b->accion = 'Registro de alimento: '.$a->nombre.' con saldo inicial 0';
                $b->id_usuario = Auth::id();
                $b->save();

                return redirect('/admin/alimentos')->with('messages', '¡Alimento creado y guardado con exito!.')
                    ->with('typealert', 'success');
    		endif;
        endif;
    }

    public function getAlimentoEditar($id){
        $alimento = Alimento::findOrFail($id);
        
        $datos = [
            'alimento' => $alimento
        ];

        return view('admin.alimentos.editar',$datos);
    }

    public function postAlimentoEditar(Request $request, $id){
        $reglas = [
    		'nombre' => 'required'
    	];
    	$mensajes = [
    		'nombre.required' => 'Se requiere un nombre para el alimento.'
    	];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            $a = Alimento::findOrFail($id);
            $a->nombre = e($request->input('nombre'));
            $a->id_unidad_medida = $request->input('id_unidad_medida');
            $a->observaciones = e($request->input('observaciones'));

            if($a->save()):
                $b = new Bitacora;
                $b->accion = 'Edición de información de alimento: '.$a->nombre;
                $b->id_usuario = Auth::id();
                $b->save();

                return redirect('/admin/alimentos')->with('messages', '¡Información actualizada y guardada con exito!.')
                ->with('typealert', 'info');
    		endif;
        endif;
    }

    public function getAlimentoEliminar($id){
        $alimento = Alimento::findOrFail($id);

        if($alimento->delete()):
            $b = new Bitacora;
            $b->accion = 'Eliminación de alimento: '.$alimento->nombre;
            $b->id_usuario = Auth::id();
            $b->save();

            return back()->with('messages', '¡Alimento eliminado con exito!.')
                    ->with('typealert', 'warning');
        endif;
    }

    public function getAlimentoPesos($id){
        $pesos_existen = PesoAlimento::where('id_alimento',$id)->count();
        if($pesos_existen == 0):
            $pesos = new PesoAlimento;
        else:
            $pesos = PesoAlimento::findOrFail($id);
        endif;
        $alimento = Alimento::findOrFail($id);

        $datos = [
            'id' => $id,
            'pesos' => $pesos,
            'alimento' => $alimento
        ];

        return view('admin.alimentos.pesos',$datos);
    }

    public function postAlimentoPesos(Request $request){
        $reglas = [
    		
    	];
    	$mensajes = [
    		
    	];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            $datos_ant = PesoAlimento::where('id_alimento',$request->input('id_alimento'))->count();
            if($datos_ant == 0):
                $a = Alimento::findOrFail($request->input('id_alimento'));
                $p = new PesoAlimento;
                $p->id_alimento = $request->input('id_alimento');
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
                    $b->accion = 'Registro de peso de alimento: '.$a->nombre;
                    $b->id_usuario = Auth::id();
                    $b->save();

                    return back()->with('messages', '¡Pesos de alimento creados y guardados con exito!.')
                    ->with('typealert', 'success');
                endif;
            endif;

            if($datos_ant == 1):
                $a = Alimento::findOrFail($request->input('id_alimento'));
                $p = PesoAlimento::findOrFail($request->input('id_alimento'));

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
                    $b->accion = 'Actualización de pesos de alimento: '.$a->nombre;
                    $b->id_usuario = Auth::id();
                    $b->save();

                    return back()->with('messages', '¡Información actualizada y guardada con exito!.')
                    ->with('typealert', 'info');
                endif;
            endif;
            
        endif;
    }
}
