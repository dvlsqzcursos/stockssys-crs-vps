<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Racion, App\Models\AlimentoRacion, App\Models\Insumo, App\Models\Bodega, App\Models\Bitacora;
use Validator, Auth, Hash, Config, Carbon\Carbon;

class RacionController extends Controller
{
    public function getInicio($bodega){

        $raciones = Racion::where('tipo_bodega',$bodega)->where('id_institucion', Auth::user()->id_institucion)->get();
        $racion = new Racion;

        $datos = [
            'raciones' => $raciones,
            'racion' => $racion
        ];

        return view('admin.bodega.bodega_socio.raciones.inicio',$datos);
    } 

    public function postRacionRegistrar(Request $request){
        $reglas = [
    		'nombre' => 'required'
    	];
    	$mensajes = [
    		'nombre.required' => 'Se requiere ingrese el nombre de la ración.'
    	];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            $r = new Racion;
            $r->nombre = e($request->input('nombre'));
            $r->tipo_alimentos = e($request->input('tipo_alimentos'));
            $r->asignado_a = $request->input('asignado_a');
            $r->tipo_bodega = e($request->input('tipo_bodega'));
            $r->id_institucion = Auth::user()->id_institucion;

            if($r->save()):
                $b = new Bitacora;
                $b->accion = 'Registro de ración de alimentos: '.$r->nombre;
                $b->id_usuario = Auth::id();
                $b->save();

                return back()->with('messages', '¡Ración creada y guardada con exito!.')
                    ->with('typealert', 'success');
    		endif;
        endif;
    }

    public function getRacionEditar($id){
        $racion = Racion::findOrFail($id);

        $datos = [
            'racion' => $racion
        ]; 

        return view('admin.bodega.bodega_socio.raciones.editar', $datos);
    }

    public function postRacionEditar(Request $request, $id){
        $reglas = [
    		'nombre' => 'required'
    	];
    	$mensajes = [
    		'nombre.required' => 'Se requiere ingrese el nombre de la ración.'
    	];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            $racion = Racion::findOrFail($id);
            $racion->nombre = e($request->input('nombre'));
            $racion->tipo_alimentos = e($request->input('tipo_alimentos'));
            $racion->asignado_a = $request->input('asignado_a');

            if($racion->save()):
                $b = new Bitacora;
                $b->accion = 'Edición de racion de alimentos: '.$racion->nombre;
                $b->id_usuario = Auth::id();
                $b->save();

                return back()->with('messages', '¡Información actualizada y guardada con exito!.')
                    ->with('typealert', 'info');
    		endif;
        endif;
    }

    public function getRacionEliminar($id){
        $racion = Racion::findOrFail($id);

        if($racion->delete()):
            $b = new Bitacora;
            $b->accion = 'Eliminación de racion de alimentos: '.$racion->nombre;
            $b->id_usuario = Auth::id();
            $b->save();

            return back()->with('messages', '¡Ración eliminada con exito!.')
                    ->with('typealert', 'warning');
        endif;
    }

    public function getRacionAlimentos($id){
        $alimentos_racion = AlimentoRacion::where('id_racion',$id)->get();
        $racion = Racion::findOrFail($id);
        $alimentos = Bodega::where('categoria' , 0)->where('tipo_bodega',1)->where('id_institucion', Auth::user()->id_institucion)->pluck('nombre', 'id');
        $id = $id;

        $datos = [
            'alimentos_racion' => $alimentos_racion, 
            'racion' => $racion,
            'alimentos' => $alimentos,
            'id' => $id
        ];

        return view('admin.bodega.bodega_socio.raciones.alimentos',$datos);
    }

    public function postRacionAlimentos(Request $request){
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
            $ar = new AlimentoRacion;
            $ar->id_racion = $request->input('id_racion');
            $ar->id_alimento = $request->input('id_alimento');
            $ar->cantidad = $request->input('cantidad');
            $ar->unidad_medida = $request->input('unidad_medida');

            $alimento = Bodega::findOrFail($ar->id_alimento);
            $racion = Racion::findOrFail($ar->id_racion);


            if($ar->save()):
                $b = new Bitacora;
                $b->accion = 'Se agrego alimento '.$alimento->nombre.' a la ración '.$racion->nombre;
                $b->id_usuario = Auth::id();
                $b->save();

                return back()->with('messages', '¡Se agrego alimento y se guardo con exito!.')
                    ->with('typealert', 'info');
    		endif;
        endif;
    }

    public function getRacionAlimentosEliminar($id){
        $alimento_racion = AlimentoRacion::findOrFail($id);
        $racion = Racion::findOrFail($alimento_racion->id_racion);

        if($alimento_racion->delete()):
            $b = new Bitacora;
            $b->accion = 'Eliminación de alimento de la ración: '.$racion->nombre;
            $b->id_usuario = Auth::id();
            $b->save();

            return back()->with('messages', '¡Alimento eliminado de la ración con exito!.')
                    ->with('typealert', 'warning');
        endif;
    }
}
