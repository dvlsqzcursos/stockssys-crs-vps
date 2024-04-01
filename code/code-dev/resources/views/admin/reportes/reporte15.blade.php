@extends('admin.plantilla.master')
@section('title','Reportes')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/reportes') }}"><i class="fa-solid fa-file-lines"></i> Reportes</a></li>
@endsection


@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <div class="card ">

                <div class="card-header">
                    <h2 class="title"><i class="fas fa-plus-circle"></i><strong> Exportar Reporte</strong></h2>
                </div>

                <div class="card-body">
                    <a href="{{ url('/admin/reporte/exportar/pdf/formato1/'.$idSolicitud.'/'.$idSocio.'/'.$numReporte) }}" class="btn btn-outline-danger col-12"><i class="fa-solid fa-file-pdf"></i> PDF</a>
                    <a href="{{ url('/admin/reporte/exportar/excel/'.$idSolicitud.'/'.$idSocio.'/'.$numReporte) }}" class="btn btn-outline-success col-12 mtop16"><i class="fa-solid fa-file-excel"></i> Excel</a>
                    
                </div>

            </div>
            
        </div>

        <div class="col-md-10">
            <div class="card ">

                <div class="card-header">
                    <h2 class="card-title"><i class="fas fa-plus-circle"></i><strong> Generar Reporte</strong></h2>
                    <ul>                                             
                        <li>
                            <a href="{{ url('/admin/reporte/panel') }}" ><i class="fa-solid fa-circle-arrow-left"></i> Regresar</a>
                        </li>
                    </ul>
                </div>

                <div class="card-body">
                    <div style="text-align: center;">
                        <h2>
                            Reporte No. {{$numReporte}} - StocksSys 
                            
                        </h2>    
                        <b>Descripción: </b> {{ obtenerDescripcionReportes(null, $numReporte) }}
                    </div>

                    <p style="text-aling:center; color:red;"><b>Detalle del Reporte</b></p>
                        <table class="table table-striped table-hover mtop16">
                            <thead>
                                <tr>
                                    <td>NO. DOCUMENTO</td>
                                    <td>ALIMENTO</td>
                                    <td>PL</td>
                                    <td>CANT. DESCARTADA</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($saldos as $s)
                                    <tr>
                                        <td>{{ $s->no_documento }}</td>
                                        <td>{{ $s->alimento }}</td>
                                        <td>{{ $s->pl }}</td>                                            
                                        <td>{{ $s->descartado }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    
                    
                </div>

            </div>
            
        </div>


    </div>

    
</div>
@endsection