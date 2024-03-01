@extends('admin.plantilla.master')
@section('title','Solicitudes a Bodega Primaria')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/escuelas') }}"><i class="fa-solid fa-route"></i> Bodega Socio</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/escuela/registrar') }}"><i class="fa-solid fa-route"></i> Solicitudes a Bodega Primaria</a></li>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card ">

                <div class="card-header">                
                    <h2 class="card-title"><strong><i class="fa-solid fa-road-circle-exclamation"></i> Listado de Solicitudes a Bodega Primaria</strong></h2>

                </div>

                <div class="card-body" >  
                    <table id="tabla" class="table table-striped table-hover mtop16" style="text-align:center;">
                        <thead>
                            <tr>
                                <td><strong> FECHA</strong></td>
                                <td><strong> BODEGA PRIMARIA </strong></td>
                                <td><strong> ESTADO</strong></td>
                                <td><strong> PDF</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($solicitudes as $s)
                                <tr>
                                    <td>{{$s->fecha}}</td>
                                    <td>{{$s->bodega_primaria->nombre}} </td>
                                    <td>{{obtenerEstadoSolicitud(null,$s->estado)}}</td>
                                                                       
                                    <td> <a href="{{ url('/admin/bodega_socio/solicitudes_bodega_principal/'.$s->id.'/imprimir') }}" target="_blank" class="btn btn-sm btn-info"><i class="fa-solid fa-print"></i> Imprimir Hoja</a></td>
                                    
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