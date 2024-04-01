<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use DB, Auth;
use App\Models\Racion, App\Models\Solicitud, App\Models\SolicitudDetalles;

class Reporte8Export implements FromView
{
    public $idSolicitud;
    public $idSocio;

    function __construct($idSolicitud, $idSocio){
        
        $this->idSolicitud = $idSolicitud;
        $this->idSocio = $idSocio;
    }

    public function view(): View
    {
        $raciones = Racion::where('id_institucion', Auth::user()->id_institucion)->get();

        foreach($raciones as $r):
            if($r->nombre == "Escolar"):
                $idRacion = $r->id;
            endif;
            if($r->nombre == "Docentes y Voluntarios"):
                $idRacion1 = $r->id;
            endif;

            if($r->nombre == "Lideres"):
                $idRacion2 = $r->id;
            endif;
        endforeach;

        $solicitud = Solicitud::where('id', $this->idSolicitud)->where('id_socio',$this->idSocio)->first();
        $total_ninos_pre = SolicitudDetalles::where('id_solicitud', $this->idSolicitud)->where('tipo_de_actividad_alimentos', $idRacion)->sum('ninos_pre_primaria_a_tercero_primaria');
        $total_ninas_pre = SolicitudDetalles::where('id_solicitud', $this->idSolicitud)->where('tipo_de_actividad_alimentos', $idRacion)->sum('ninas_pre_primaria_a_tercero_primaria');
        $total_pre = SolicitudDetalles::where('id_solicitud', $this->idSolicitud)->where('tipo_de_actividad_alimentos', $idRacion)->sum('total_pre_primaria_a_tercero_primaria');

        $total_ninos_pri = SolicitudDetalles::where('id_solicitud', $this->idSolicitud)->where('tipo_de_actividad_alimentos', $idRacion)->sum('ninos_cuarto_a_sexto');
        $total_ninas_pri = SolicitudDetalles::where('id_solicitud', $this->idSolicitud)->where('tipo_de_actividad_alimentos', $idRacion)->sum('ninas_cuarto_a_sexto');
        $total_pri = SolicitudDetalles::where('id_solicitud', $this->idSolicitud)->where('tipo_de_actividad_alimentos', $idRacion)->sum('total_cuarto_a_sexto');

        $total_d_v = SolicitudDetalles::where('id_solicitud', $this->idSolicitud)->where('tipo_de_actividad_alimentos', $idRacion1)->sum('total_de_docentes_y_voluntarios');
        $total_l = SolicitudDetalles::where('id_solicitud', $this->idSolicitud)->where('tipo_de_actividad_alimentos', $idRacion2)->sum('total_de_personas');

        

        $datos = [
            'solicitud' => $solicitud,
            'total_ninos_pre' => $total_ninos_pre,
            'total_ninas_pre' => $total_ninas_pre,
            'total_pre' => $total_pre,
            'total_ninos_pri' => $total_ninos_pri,
            'total_ninas_pri' => $total_ninas_pri,
            'total_pri' => $total_pri,
            'total_d_v' => $total_d_v,
            'total_l' => $total_l,
            'idSolicitud' => $this->idSolicitud,
            'idSocio' => $this->idSocio,
            'numReporte' => 8
        ];
        return view('admin.reportes.pdf8', $datos);
    }
}
