<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Institucion, App\Models\Ubicacion,  App\Models\Bitacora;
use Validator, Auth, Hash, Config, Carbon\Carbon;

class InstitucionController extends Controller
{
    public function getInicio(){
        $instituciones = Institucion::with(['ubicacion'])->get();

        $datos = [
            'instituciones' => $instituciones
        ];

        return view('admin.instituciones.inicio',$datos);
    }

    public function getInstitucionRegistrar(){
        $institucion = new Institucion;
        $ubicaciones = Ubicacion::with('ubicacion_superior')->where('nivel', 3)->get();

        $datos = [
            'institucion' => $institucion,
            'ubicaciones' => $ubicaciones
        ];

        return view('admin.instituciones.registrar',$datos);
    }

    public function postInstitucionRegistrar(Request $request){
        $reglas = [
    		'nombre' => 'required',
            'direccion' => 'required',
            'nivel' => 'required',
            'id_ubicacion' => 'required'
    	];
    	$mensajes = [
    		'nombre.required' => 'Se requiere un nombre para la institución.',
            'direccion.required' => 'Se requiere una direccion de la institución.',
            'nivel.required' => 'Se requiere seleccione el tipo o nivel de la institución.',
            'id_ubicacion.required' => 'Se requiere seleccione la ubicación de la institución.'
    	];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            $i = new Institucion;
            $i->nombre = e($request->input('nombre'));
            $i->direccion = e($request->input('direccion'));
            $i->nivel = $request->input('nivel');
            $i->id_ubicacion = $request->input('id_ubicacion');
            $i->encargado = e($request->input('encargado'));
            $i->contacto = e($request->input('contacto'));
            $i->correo = e($request->input('correo'));
            $i->observaciones = e($request->input('observaciones'));
            $i->estado = '0';


            if($i->save()):
                $b = new Bitacora;
                $b->accion = 'Registro de institución con nombre: '.$i->nombre;
                $b->id_usuario = Auth::id();
                $b->save();

                return redirect('/admin/instituciones')->with('messages', '¡Institución creada y guardada con exito!.')
                    ->with('typealert', 'success');
    		endif;
        endif;
    }

    public function getInstitucionEditar($id){
        $institucion = Institucion::findOrFail($id);
        $ubicaciones = Ubicacion::with('ubicacion_superior')->where('nivel', 3)->get();

        $datos = [
            'institucion' => $institucion,
            'ubicaciones' => $ubicaciones
        ];

        return view('admin.instituciones.editar',$datos);
    }

    public function postInstitucionEditar(Request $request, $id){
        $reglas = [
    		'nombre' => 'required',
            'direccion' => 'required',
            'nivel' => 'required',
            'id_ubicacion' => 'required'
    	];
    	$mensajes = [
    		'nombre.required' => 'Se requiere un nombre para la institución.',
            'direccion.required' => 'Se requiere una direccion de la institución.',
            'nivel.required' => 'Se requiere seleccione el tipo o nivel de la institución.',
            'id_ubicacion.required' => 'Se requiere seleccione la ubicación de la institución.'
    	];
        
        $validator = Validator::make($request->all(), $reglas, $mensajes);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            $i = Institucion::findOrFail($id);
            $i->nombre = e($request->input('nombre'));
            $i->direccion = e($request->input('direccion'));
            $i->nivel = $request->input('nivel');
            $i->id_ubicacion = $request->input('id_ubicacion');
            $i->encargado = e($request->input('encargado'));
            $i->contacto = e($request->input('contacto'));
            $i->correo = e($request->input('correo'));
            $i->observaciones = e($request->input('observaciones'));
            $i->estado = '0';


            if($i->save()):
                $b = new Bitacora;
                $b->accion = 'Edición de información de la institución con nombre: '.$i->nombre;
                $b->id_usuario = Auth::id();
                $b->save();

                return redirect('/admin/instituciones')->with('messages', '¡Información actualizada y guardada con exito!.')
                    ->with('typealert', 'info');
    		endif;
        endif;
    }

    

    public function getInstitucionEliminar($id){
        $institucion = Institucion::findOrFail($id);

        if($institucion->delete()):
            $b = new Bitacora;
            $b->accion = 'Eliminación de la institución: '.$institucion->nombre;
            $b->id_usuario = Auth::id();
            $b->save();

            return back()->with('messages', '¡Institución eliminada con exito!.')
                    ->with('typealert', 'warning');
        endif;
    }

}
