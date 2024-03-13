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
                                <td><strong> PROCEDENCIA</strong></td>
                                <td><strong> DOCUMENTO </strong></td>
                                <td><strong> </strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ingresos as $i)
                                <tr>
                                    
                                    <td>{{$i->fecha}}</td>
                                    <td>
                                        @if(!is_null($i->procedente)):
                                            {{ $i->procedente }}
                                        @else
                                            {{ $i->institucion->nombre }}
                                        @endif
                                    </td>
                                    <td>{{ obtenerDocumentosIngreso(null, $i->tipo_documento).' - No. '.$i->no_documento }}</td>
                                    <td width="240px">
                                        <div class="opts">
                                            <a class="btn btn-outline-info" href="{{ url('/admin/bodega_socio/insumo/movimientos/ingresos/detalles/'.$i->id) }}" ><i class="fa-solid fa-eye"></i> Ver Detalles</a>
                                            
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
                    <h2 class="card-title"><strong><i class="fa-solid fa-people-carry-box"></i> Detalle del Ingreso</strong></h2>
                </div>

                <div class="card-body" style="text-align:center;">
                    <b style="color: red;">Seleccione un ingreso, para visualizar su detalle o contenido.</b>
                </div>

            </div>                
        </div>
        

        
    </div>

</div>

@endsection