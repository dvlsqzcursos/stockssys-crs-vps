<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Kit, App\Models\InsumoKit, App\Models\Insumo, App\Models\Bodega, App\Models\Bitacora;
use Validator, Auth, Hash, Config, Carbon\Carbon;

class KitController extends Controller
{
    public function getInicio($bodega){

        $kits = Kit::where('tipo_bodega',$bodega)->where('id_institucion', Auth::user()->id_institucion)->get();
        $kit = new Kit;

        $datos = [
            'kits' => $kits,
            'kit' => $kit
        ];

        return view('admin.bodega.bodega_socio.kits.inicio',$datos);
    } 

    public function postKitRegistrar(Request $request){
        $reglas = [
    		'nombre' => 'required'
    	];
    	$mensajes = [
    		'nombre.required' => 'Se requiere ingrese el nombre del kit.'
    	];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            $r = new Kit;
            $r->nombre = e($request->input('nombre'));
            $r->tipo_kits = e($request->input('tipo_kits'));
            $r->asignado_a = $request->input('asignado_a');
            $r->tipo_bodega = e($request->input('tipo_bodega'));
            $r->id_institucion = Auth::user()->id_institucion;

            if($r->save()):
                $b = new Bitacora;
                $b->accion = 'Registro de kit de insumos: '.$r->nombre;
                $b->id_usuario = Auth::id();
                $b->save();

                return back()->with('messages', '¡Kit creado y guardado con exito!.')
                    ->with('typealert', 'success');
    		endif;
        endif;
    }

    public function getKitEditar($id){
        $kit = Kit::findOrFail($id);

        $datos = [
            'kit' => $kit
        ]; 

        return view('admin.bodega.bodega_socio.kits.editar', $datos);
    }

    public function postKitEditar(Request $request, $id){
        $reglas = [
    		'nombre' => 'required'
    	];
    	$mensajes = [
    		'nombre.required' => 'Se requiere ingrese el nombre del kit.'
    	];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            $kit = Kit::findOrFail($id);
            $kit->nombre = e($request->input('nombre'));
            $kit->tipo_alimentos = e($request->input('tipo_alimentos'));
            $kit->asignado_a = $request->input('asignado_a');

            if($kit->save()):
                $b = new Bitacora;
                $b->accion = 'Edición de kit de insumos: '.$kit->nombre;
                $b->id_usuario = Auth::id();
                $b->save();

                return back()->with('messages', '¡Información actualizada y guardada con exito!.')
                    ->with('typealert', 'info');
    		endif;
        endif;
    }

    public function getKitEliminar($id){
        $kit = Kit::findOrFail($id);

        if($kit->delete()):
            $b = new Bitacora;
            $b->accion = 'Eliminación de kit de insumos: '.$kit->nombre;
            $b->id_usuario = Auth::id();
            $b->save();

            return back()->with('messages', '¡Kit eliminado con exito!.')
                    ->with('typealert', 'warning');
        endif;
    }

    public function getKitInsumos($id){
        $insumos_kit = InsumoKit::where('id_kit',$id)->get();
        $kit = kit::findOrFail($id);
        $insumos = Bodega::where('categoria' , 1)->where('tipo_bodega',1)->where('id_institucion', Auth::user()->id_institucion)->pluck('nombre', 'id');
        $id = $id;

        $datos = [
            'insumos_kit' => $insumos_kit, 
            'kit' => $kit,
            'insumos' => $insumos,
            'id' => $id
        ];

        return view('admin.bodega.bodega_socio.kits.insumos',$datos);
    }

    public function postKitInsumos(Request $request){
        $reglas = [
    		'cantidad' => 'required'
    	];
    	$mensajes = [
    		'cantidad.required' => 'Se requiere ingrese la cantidad de alimento para la ración.'
    	];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            $ik = new InsumoKit;
            $ik->id_kit = $request->input('id_kit');
            $ik->id_insumo = $request->input('id_insumo');
            $ik->cantidad = $request->input('cantidad');

            $insumo = Bodega::findOrFail($ik->id_insumo);
            $kit = Kit::findOrFail($ik->id_kit);


            if($ik->save()):
                $b = new Bitacora;
                $b->accion = 'Se agrego insumo '.$insumo->nombre.' a la ración '.$kit->nombre;
                $b->id_usuario = Auth::id();
                $b->save();

                return back()->with('messages', '¡Se agrego insumo y se guardo con exito!.')
                    ->with('typealert', 'info');
    		endif;
        endif;
    }

    public function getKitInsumosEliminar($id){
        $insumo_kit = InsumoKit::findOrFail($id);
        $kit = Kit::findOrFail($insumo_kit->id_kit);

        if($insumo_kit->delete()):
            $b = new Bitacora;
            $b->accion = 'Eliminación de insumo del kit: '.$kit->nombre;
            $b->id_usuario = Auth::id();
            $b->save();

            return back()->with('messages', '¡Insumo eliminado del kit con exito!.')
                    ->with('typealert', 'warning');
        endif;
    }
}
