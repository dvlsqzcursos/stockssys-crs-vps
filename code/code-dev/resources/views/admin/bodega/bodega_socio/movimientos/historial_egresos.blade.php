@extends('admin.plantilla.master')
@section('title','Bodega Socio')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href=""><i class="fa-solid fa-warehouse"></i> Bodega Socio</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/bodega_socio/inventario') }}"><i class="fa-solid fa-calculator"></i> Inventario</a></li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">  

        <div class="col-md-6">  

            <div class="card ">

                <div class="card-header">
                    <h2 class="card-title"><strong><i class="fa-solid fa-people-carry-box"></i> Listado de Movimientos</strong></h2>
                    <ul>                                             
                        <li>
                            <a href="{{ url('/admin/bodega_socio/insumos') }}" ><i class="fa-solid fa-circle-arrow-left"></i> Regresar</a>
                        </li>
                    </ul>
                </div>

                <div class="card-body">
                    <table id="tabla" class="table table-striped table-hover mtop16">
                        <thead>
                            <tr>
                                
                                <td><strong> FECHA </strong></td>
                                <td><strong> ESCUELA/DESTINO</strong></td>
                                <td><strong> DOCUMENTO </strong></td>
                                <td><strong> RACION/KIT </strong></td>
                                <td><strong> </strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($egresos as $e)
                                <tr>
                                    
                                    <td>{{$e->fecha}}</td>
                                    <td>
                                        @if(!is_null($e->destino))
                                            {{ $e->destino }}
                                        @else
                                            {{ $e->escuela->nombre }} <br>
                                            <span><small><b>Solicitud: </b> {{'ID '.$e->solicitud->id.' '.obtenerMeses(null, $e->solicitud->entrega->mes_inicial).' - '.obtenerMeses(null, $e->solicitud->entrega->mes_final)}}</small></span>
                                        @endif
                                    </td>
                                    <td>{{ obtenerDocumentosEgreso(null, $e->tipo_documento).' - No. '.$e->no_documento }}</td>
                                    <td>{{ isset($e->racion->nombre)  }}</td>
                                    <td width="240px">
                                        <div class="opts">
                                            <a class="btn btn-outline-info" href="{{ url('/admin/bodega_socio/insumo/movimientos/egresos/detalles/'.$e->id) }}" ><i class="fa-solid fa-eye"></i> Ver Detalles</a>
                                            
                                        </div>
                                    </td>
                                </tr>
                            @endforeach                            
                        </tbody>
                    </table>
                    
                </div>

            </div>                
        </div>

        <div class="col-md-6">  

            <div class="card ">

                <div class="card-header">
                    <h2 class="card-title"><strong><i class="fa-solid fa-people-carry-box"></i> Detalle del Egreso</strong></h2>
                </div>

                <div class="card-body" style="text-align:center;">
                    <b style="color: red;">Seleccione un egreso, para visualizar su detalle o contenido.</b>
                </div>

            </div>                
        </div>
        

        
    </div>

</div>

@endsection