<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Ruta, App\Models\RutaEscuela, App\Models\Ubicacion, App\Models\Escuela, App\Models\Bitacora;
use Validator, Auth, Hash, Config, Carbon\Carbon;

class RutaController extends Controller
{
    public function getInicio(){
        $rutas = Ruta::with(['ubicacion'])->where('id_socio',  Auth::user()->id_institucion)->get();
        $ruta = new Ruta;
        $ubicaciones = Ubicacion::with('ubicacion_superior')->where('nivel', 3)->get();

        $datos = [
            'rutas' => $rutas,
            'ruta' => $ruta,
            'ubicaciones' => $ubicaciones
        ];

        return view('admin.rutas.inicio',$datos);
    }

    public function postRutaRegistrar(Request $request){
        $reglas = [
            'id_ubicacion' => 'required'
    	];
    	$mensajes = [
            'id_ubicacion.required' => 'Se requiere la ubicacion para la ruta.'
    	];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            $correlativo = Ruta::where('id_ubicacion', $request->input('id_ubicacion'))->where('id_socio',Auth::user()->id_institucion)->count();

            //return $correlativo+1;

            $r = new Ruta;
            $r->correlativo = $correlativo+1;
            $r->id_ubicacion = $request->input('id_ubicacion');
            $r->observaciones = e($request->input('observaciones'));
            $r->estado = '0';
            $r->id_socio = Auth::user()->id_institucion;


            if($r->save()):

                return redirect('/admin/rutas')->with('messages', '¡Ruta creada y guardada con exito!.')
                    ->with('typealert', 'success');
    		endif;
        endif;
    }

    public function getRutaEliminar($id){
        $ruta = Ruta::findOrFail($id);

        if($ruta->delete()):
            $b = new Bitacora;
            $b->accion = 'Eliminación de ruta';
            $b->id_usuario = Auth::id();
            $b->save();

            return back()->with('messages', '¡Ruta eliminada con exito!.')
                    ->with('typealert', 'warning');
        endif;
    }

    public function getRutaAsignarEscuelas($id){
        $ruta = Ruta::findOrFail($id);
        $escuelas = Escuela::where('id_ubicacion', $ruta->id_ubicacion)->get();
        $asignaciones = RutaEscuela::where('id_ruta', $ruta->id)->orderBy('orden_llegada', 'asc')->get();
        

        $datos = [
            'ruta' => $ruta,
            'escuelas' => $escuelas,
            'asignaciones' => $asignaciones,
        ];

        return view('admin.rutas.asignar_escuelas',$datos);
    }

    public function postRutaAsignarEscuelas(Request $request){
        $reglas = [
            'id_escuela' => 'required'
    	];
    	$mensajes = [
            'id_escuela.required' => 'Se requiere seleccione una escuela para la ruta.'
    	];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            

            $re = new RutaEscuela;
            $re->id_ruta = $request->input('id_ruta');
            $re->id_escuela = $request->input('id_escuela');
            $re->orden_llegada = e($request->input('orden_llegada'));

            if($re->save()):

                return back()->with('messages', '¡Asignación realizada con exito!.')
                    ->with('typealert', 'success');
    		endif;
        endif;
    }

    public function postActualizarOrdenLlegada(Request $request){
        $reglas = [

    	];
    	$mensajes = [

    	];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            

            $as = RutaEscuela::findOrFail($request->input('id_asignacion'));
            $as->orden_llegada = e($request->input('orden'));

            if($as->save()):

                return back()->with('messages', '¡Actualizacion de orden de llegada con exito!.')
                    ->with('typealert', 'info');
    		endif;
        endif;
    }

    public function getRutaEliminarEscuelas($id){
        $escuela_ruta = RutaEscuela::findOrFail($id);

        if($escuela_ruta->forceDelete()):
            $b = new Bitacora;
            $b->accion = 'Eliminación de escuela asignada a ruta';
            $b->id_usuario = Auth::id();
            $b->save();

            return back()->with('messages', '¡Eliminada eliminada de esta ruta con exito!.')
                    ->with('typealert', 'warning');
        endif;
    }
}
