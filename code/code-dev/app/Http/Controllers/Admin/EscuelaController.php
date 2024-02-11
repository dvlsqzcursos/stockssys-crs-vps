<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Escuela, App\Models\Ubicacion, App\Models\Bitacora, App\Models\RutaEscuela;
use Validator, Auth, Hash, Config, Carbon\Carbon;
use App\Imports\EscuelasImport;
use Maatwebsite\Excel\Facades\Excel;

class EscuelaController extends Controller
{
    public function getInicio(){
        $escuelas = Escuela::with(['ubicacion', 'ruta_asignada'])->where('id_socio',  Auth::user()->id_institucion)->get();

        $datos = [
            'escuelas' => $escuelas
        ];

        return view('admin.escuelas.inicio',$datos);
    }

    public function getEscuelaRegistrar(){
        $escuela = new Escuela;
        $ubicaciones = Ubicacion::with('ubicacion_superior')->where('nivel', 3)->get();

        $datos = [
            'escuela' => $escuela,
            'ubicaciones' => $ubicaciones
        ];

        return view('admin.escuelas.registrar',$datos);
    }

    public function postEscuelaRegistrar(Request $request){
        $reglas = [
            'codigo' => 'required',
    		'nombre' => 'required',
            'direccion' => 'required',
            'id_ubicacion' => 'required',
            'director' => 'required'
    	];
    	$mensajes = [
            'codigo.required' => 'Se requiere un codigo para la escuela.',
    		'nombre.required' => 'Se requiere un nombre para la escuela.',
            'direccion.required' => 'Se requiere una direccion de la escuela.',
            'id_ubicacion.required' => 'Se requiere seleccione la ubicación de la escuela.',
            'director.required' => 'Se requiere el nombre del director de la escuela.'
    	];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            $e = new Escuela;
            $e->jornada = $request->input('jornada');
            $e->codigo = e($request->input('codigo'));
            $e->nombre = e($request->input('nombre'));
            $e->direccion = e($request->input('direccion'));
            $e->id_ubicacion = $request->input('id_ubicacion');            
            $e->director = e($request->input('director'));
            $e->contacto_no1 = e($request->input('contacto_no1'));
            $e->contacto_no2 = e($request->input('contacto_no2'));

            if($request->input('desgloce') == 0):
                $e->no_total_beneficiarios = $request->input('no_total_beneficiarios');
            else:
                $e->no_ninos_pre = $request->input('no_ninos_pre');
                $e->no_ninas_pre = $request->input('no_ninas_pre');
                $e->no_ninos_pri = $request->input('no_ninos_pri');
                $e->no_ninas_pri = $request->input('no_ninas_pri');
                $e->no_total_beneficiarios = $e->no_ninos_pre + $e->no_ninas_pre + $e->no_ninos_pri + $e->no_ninas_pri;
            endif;
            $e->no_lideres = e($request->input('no_lideres'));
            $e->no_voluntarios = e($request->input('no_voluntarios'));
            $e->observaciones = e($request->input('observaciones'));
            $e->id_socio = Auth::user()->id_institucion;
            $e->estado = '0';


            if($e->save()):
                $b = new Bitacora;
                $b->accion = 'Registro de escuela: '.$e->nombre;
                $b->id_usuario = Auth::id();
                $b->save();

                return redirect('/admin/escuelas')->with('messages', '¡Escuela creada y guardada con exito!.')
                    ->with('typealert', 'success');
    		endif;
        endif;
    }

    public function getEscuelaEditar($id){
        $escuela = Escuela::findOrFail($id);
        $ubicaciones = Ubicacion::where('nivel', 3)->get();

        $datos = [
            'escuela' => $escuela,
            'ubicaciones' => $ubicaciones
        ];

        return view('admin.escuelas.editar',$datos);
    }

    public function postEscuelaEditar(Request $request, $id){
        $reglas = [
            'codigo' => 'required',
    		'nombre' => 'required',
            'direccion' => 'required',
            'id_ubicacion' => 'required',
            'director' => 'required'
    	];
    	$mensajes = [
            'codigo.required' => 'Se requiere un codigo para la escuela.',
    		'nombre.required' => 'Se requiere un nombre para la escuela.',
            'direccion.required' => 'Se requiere una direccion de la escuela.',
            'id_ubicacion.required' => 'Se requiere seleccione la ubicación de la escuela.',
            'director.required' => 'Se requiere el nombre del director de la escuela.'
    	];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            $e = Escuela::findOrFail($id);
            $e->jornada = $request->input('jornada');
            $e->codigo = e($request->input('codigo'));
            $e->nombre = e($request->input('nombre'));
            $e->direccion = e($request->input('direccion'));
            $e->id_ubicacion = $request->input('id_ubicacion');            
            $e->director = e($request->input('director'));
            $e->contacto_no1 = e($request->input('contacto_no1'));
            $e->contacto_no2 = e($request->input('contacto_no2'));
            $e->no_ninos_pre = $request->input('no_ninos_pre');
            $e->no_ninas_pre = $request->input('no_ninas_pre');
            $e->no_ninos_pri = $request->input('no_ninos_pri');
            $e->no_ninas_pri = $request->input('no_ninas_pri');
            $e->no_total_beneficiarios = $request->input('no_total_beneficiarios');
            $e->no_lideres = e($request->input('no_lideres'));
            $e->no_voluntarios = e($request->input('no_voluntarios'));
            $e->observaciones = e($request->input('observaciones'));
            $e->estado = '0';

            if($e->save()):
                $b = new Bitacora;
                $b->accion = 'Edición de información de la escuela: '.$e->nombre;
                $b->id_usuario = Auth::id();
                $b->save();

                return redirect('/admin/escuelas')->with('messages', '¡Información actualizada y guardada con exito!.')
                ->with('typealert', 'info');
    		endif;
        endif;
    }

    public function getEscuelaEliminar($id){
        $escuela = Escuela::findOrFail($id);

        $asignada = RutaEscuela::where('id_escuela',$id)->count();


        if($asignada > 0):
            return back()->with('messages', '¡Escuela no se puede eliminar, dado que esta asignada a una ruta!.')
                        ->with('typealert', 'danger');
        else:
            if($escuela->delete()):
                $b = new Bitacora;
                $b->accion = 'Eliminación de la escuela: '.$escuela->nombre;
                $b->id_usuario = Auth::id();
                $b->save();

                return back()->with('messages', '¡Escuela eliminada con exito!.')
                        ->with('typealert', 'warning');
            endif;
        endif;
    }

    public function postEscuelaImportar(Request $request){
        /*Excel::import(new EscuelasImport, request()->file('escuelas'));
        return $ubicaciones;

        $datos = [
            'ubicaciones' => $ubicaciones
        ]; 

        return view('admin.ubicaciones.validar_import', $datos);
        return back()->with('messages', '¡Escuelas importadas con exito!.')
                    ->with('typealert', 'info');*/
        //$prueba = Excel::toArray(new EscuelasImport, request()->file('escuelas'));
        Excel::import(new EscuelasImport, request()->file('escuelas'));
        $archivo = request()->file('escuelas');

        $b = new Bitacora;
        $b->accion = 'Importacion de escuelas con archivo: '.$archivo->getClientOriginalName();
        $b->id_usuario = Auth::id();
        $b->save();

        return back()->with('messages', '¡Escuelas importadas con exito!.')
                    ->with('typealert', 'primary');
        
    }
}
