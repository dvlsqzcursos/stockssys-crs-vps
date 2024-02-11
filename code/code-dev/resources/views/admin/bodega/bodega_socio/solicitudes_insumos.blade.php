@extends('admin.plantilla.master')
@section('title','Inicio de Solicitud')

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
                                <td><strong> DETALLES</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($solicitudes as $s)
                                <tr>
                                    <td>{{$s->fecha}}</td>
                                    <td>{{$s->id_bodega_primaria}} </td>
                                    <td>{{$s->estado}}</td>
                                                                       
                                        <td>
                                            @foreach($s->detalles as $det) 
                                                <span><b>Alimento: </b></span>{{$det->alimento_bodega_socio->nombre}} &nbsp
                                                <span><b>No. Unidades: </b></span>{{$det->no_unidades}} <br>
                                            @endforeach
                                        </td>
                                    
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