<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use DB, Auth;
use App\Models\Racion, App\Models\Solicitud, App\Models\SolicitudDetalles;

class Reporte10Export implements FromView
{
    public $idSolicitud;
    public $idSocio;

    function __construct($idSolicitud, $idSocio){
        
        $this->idSolicitud = $idSolicitud;
        $this->idSocio = $idSocio;
    }

    public function view(): View
    {
        $solicitud = DB::table('solicitudes as s')
            ->select(
                DB::RAW('Distinct be.no_documento as no_documento'),
                DB::RAW('e.nombre as escuela'),
                DB::RAW('u.nombre as municipio'),
                DB::RAW('ra.nombre as racion')
            )            
            ->join('solicitud_detalles as det', 'det.id_solicitud', 's.id')
            ->join('escuelas as e', 'e.id', 'det.id_escuela')
            ->join('bodegas_egresos as be', 'be.id_escuela_despacho', 'det.id_escuela')
            ->join('rutas_escuelas as resc', 'resc.id_escuela', 'e.id')
            ->join('rutas as r', 'r.id', 'resc.id_ruta')
            ->join('ubicaciones as u', 'u.id', 'r.id_ubicacion')
            ->join('raciones as ra', 'ra.id', 'be.tipo_racion')
            ->where('s.id', $this->idSolicitud)
            ->where('s.id_socio', $this->idSocio)
            ->where('be.id_solicitud_despacho', $this->idSolicitud)
            ->where('be.tipo_documento', 1)
            ->get();

        $datos = [
            'solicitud' => $solicitud,
            'idSolicitud' => $this->idSolicitud,
            'idSocio' => $this->idSocio,
            'numReporte' => 10
        ];

        return view('admin.reportes.pdf10', $datos);
    }
}
