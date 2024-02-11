@extends('admin.plantilla.master')
@section('title','Rutas Confirmadas')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/escuelas') }}"><i class="fa-solid fa-route"></i> Solicitud de Despacho</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/escuela/registrar') }}"><i class="fa-solid fa-route"></i> Registrar Solicitud de Despacho</a></li>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card ">

                <div class="card-header">                
                    <h2 class="card-title"><strong><i class="fa-solid fa-road-circle-exclamation"></i> Listado de Rutas Confirmadas Para El Despacho De Solicitud #{{$idSolicitud}}</strong></h2>

                </div>

                <div class="card-body " style="text-align:center;">  

                    @if(count($rutas) > 0)      
                                               
                        @foreach($rutas as $r)
                            <p class="mtop16"> <b>{{$loop->iteration}}. {{$r->ruta_base->ubicacion->nombre.' - '.$r->nombre}} </b>  </p>
                            <div class="row mtop16">
                                    <b style="color:blue;">Detalle de Ruta</b><br>
                                    @php($total_peso_ruta = 0)
                                    @foreach($r->detalles as $det)
                                            <p> 
                                                <b>Escuela: </b>  {{$det->escuela->codigo.' / '.$det->escuela->nombre}} &nbsp
                                                <b>Orden de Llegada:</b>  {{$det->orden_llegada}} &nbsp
                                                @php($total_peso_escuela = 0)   
                                                @foreach($detalle_escuelas as $det_esc)
                                                    @if($det->escuela->id == $det_esc->escuela_id)
                                                        @php($total_peso_escuela = $total_peso_escuela + ($det_esc->peso/453.59237)/100  ) 
                                                    @endif
                                                @endforeach
                                                <b >Peso Total Escuela: </b> {{number_format(  $total_peso_escuela , 2, '.', ',' ) }}
                                                @php($total_peso_ruta = $total_peso_ruta + $total_peso_escuela)
                                            </p>  

                                    @endforeach
                            </div>
                                <p>
                                    <b style="color: red;" >Peso Total Ruta: </b> {{number_format(  $total_peso_ruta, 2, '.', ',' ) }} 
                                </p>
                                <a href="{{ url('/admin/solicitud_despacho/'.$idSolicitud.'/ruta_confirmada/'.$r->id.'/boleta/impresion') }}" target="_blank" class="btn btn-sm btn-info"><i class="fa-solid fa-print"></i> Imprimir Boleta</a>
                                <a href="{{ url('/admin/solicitud_despacho/ruta_confirmada/'.$r->id.'/informacion_transporte') }}" class="btn btn-sm btn-primary"><i class="fa-solid fa-truck-moving"></i> Datos Transporte</a>
                            <hr>
                            
                            
                        @endforeach
                        
                                            
                    @else
                        <b style="color: red;">Listado sin datos,confirme o cree sub rutas de despacho para esta solicitud primero.</b>
                    @endif

                </div> 

            </div>
        </div>
        

    </div>
</div>




@endsection