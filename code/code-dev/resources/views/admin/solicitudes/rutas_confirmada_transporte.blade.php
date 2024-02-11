@extends('admin.plantilla.master')
@section('title','Informacion de Transporte')

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
                    <h2 class="card-title"><strong><i class="fa-solid fa-road-circle-exclamation"></i> Información de Transporte de la Ruta de Despacho: {{ $ruta->nombre.' - '.$ruta->ruta_base->ubicacion->nombre}}</strong></h2>

                </div>

                <div class="card-body " >  
                    {!! Form::open(['url' => '/admin/solicitud_despacho/ruta_confirmada/informacion_transporte', 'files' => true]) !!}
                        <div class="row">
                            {!! Form::hidden('idRuta', $ruta->id, ['class'=>'form-control']) !!}
                            <div class="col-md-12">
                                <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Empresa de Transporte: </strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('empresa_transporte', $ruta->empresa_transporte, ['class'=>'form-control']) !!}
                                </div>
                            </div>

                            <div class="col-md-6 mtop16">
                                <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Nombre de Piloto: </strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('nombre_piloto', $ruta->nombre_piloto, ['class'=>'form-control']) !!}
                                </div>
                            </div>

                            <div class="col-md-6 mtop16">
                                <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Número de Licencia: </strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('no_licencia', $ruta->no_licencia, ['class'=>'form-control']) !!}
                                </div>
                            </div>

                            <div class="col-md-6 mtop16">
                                <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Placa del Vehículo: </strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('placa_vehiculo', $ruta->placa_vehiculo, ['class'=>'form-control']) !!}
                                </div>
                            </div>

                            <div class="col-md-6 mtop16">
                                <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Tipo de Vehículo: </strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('tipo_vehiculo', $ruta->tipo_vehiculo, ['class'=>'form-control']) !!}
                                </div>
                            </div>
                            
                            
                        </div>

                        
                        {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}
                        <a href="{{ url('/admin/solicitud_despacho/'.$ruta->id_solicitud_despacho.'/rutas_confirmadas') }}" class="btn btn-secondary mtop16">Regresar</a>
                        
                    {!! Form::close() !!}

                </div> 

            </div>
        </div>
        

    </div>
</div>




@endsection