<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Entrega, App\Models\Bitacora;
use Validator, Auth, Hash, Config, Carbon\Carbon;

class EntregaController extends Controller
{
    public function getInicio(){

        if(Auth::user()->rol == 0 || Auth::user()->rol == 1 ):
            $entregas = Entrega::get();
        else:
            $entregas = Entrega::where('id_socio',  Auth::user()->id_institucion)->get();
        endif;
        
        $entrega = new Entrega;

        $datos = [
            'entregas' => $entregas,
            'entrega' => $entrega
        ];

        return view('admin.entregas.inicio',$datos);
    }

    public function postEntregaRegistrar(Request $request){
        $reglas = [
    		'mes_inicial' => 'required',
            'mes_final' => 'required',
            'dias_a_cubrir' => 'required'
    	];
    	$mensajes = [
    		'mes_inicial.required' => 'Se requiere seleccion el mes inicial de la entrega.',
            'mes_final.required' => 'Se requiere seleccion el mes final de la entrega.',
            'dias_a_cubrir.required' => 'Se requiere ingrese la cantidad de dias a cubir en la entrega.'
    	];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            $correlativo = Entrega::where('year', $request->input('year'))->withTrashed()->count();

            $e = new Entrega;
            $e->correlativo = $correlativo+1;
            $e->mes_inicial = $request->input('mes_inicial');
            $e->mes_final = $request->input('mes_final');
            $e->dias_a_cubrir = $request->input('dias_a_cubrir');
            $e->year = $request->input('year');
            $e->id_socio = Auth::user()->id_institucion;

            if($e->save()):
                $b = new Bitacora;
                $b->accion = 'Registro de entrega de alimentos: '.$e->correlativo.'-'.$e->year;
                $b->id_usuario = Auth::id();
                $b->save();

                return back()->with('messages', '¡Entrega creada y guardada con exito!.')
                    ->with('typealert', 'success');
    		endif;
        endif;
    }

    public function getEntregaEditar($id){
        $entrega = Entrega::findOrFail($id);

        $datos = [
            'entrega' => $entrega
        ]; 

        return view('admin.entregas.editar', $datos);
    }

    public function postEntregaEditar(Request $request, $id){
        $reglas = [
    		'mes_inicial' => 'required',
            'mes_final' => 'required',
            'dias_a_cubrir' => 'required'
    	];
    	$mensajes = [
    		'mes_inicial.required' => 'Se requiere seleccion el mes inicial de la entrega.',
            'mes_final.required' => 'Se requiere seleccion el mes final de la entrega.',
            'dias_a_cubrir.required' => 'Se requiere ingrese la cantidad de dias a cubir en la entrega.'
    	];

        $validator = Validator::make($request->all(), $reglas, $mensajes);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('messages', 'Se ha producido un error.')->with('typealert', 'danger');
        else: 
            $entrega = Entrega::findOrFail($id);
            $entrega->mes_inicial = $request->input('mes_inicial');
            $entrega->mes_final = $request->input('mes_final');
            $entrega->dias_a_cubrir = $request->input('dias_a_cubrir');
            $entrega->year = $request->input('year');

            if($entrega->save()):
                $b = new Bitacora;
                $b->accion = 'Edición de entrega de alimentos: '.$entrega->correlativo.'-'.$entrega->year;
                $b->id_usuario = Auth::id();
                $b->save();

                return back()->with('messages', '¡Información actualizada y guardada con exito!.')
                    ->with('typealert', 'info');
    		endif;
        endif;
    }

    public function getEntregaEliminar($id){
        $entrega = Entrega::findOrFail($id);

        if($entrega->delete()):
            $b = new Bitacora;
            $b->accion = 'Eliminación de entrega de alimentos: '.$entrega->correlativo.'-'.$entrega->year;
            $b->id_usuario = Auth::id();
            $b->save();

            return back()->with('messages', '¡Entrega eliminada con exito!.')
                    ->with('typealert', 'warning');
        endif;
    }
}
