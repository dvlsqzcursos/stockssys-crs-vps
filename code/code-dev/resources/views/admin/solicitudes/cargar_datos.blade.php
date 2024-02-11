@extends('admin.plantilla.master')
@section('title','Inicio de Solicitud')

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
                    <h2 class="title"><i class="fas fa-plus-circle"></i><strong> Carga De Datos Para Solicitud De Despacho</strong></h2>
                    
                </div>

                <div class="card-body">
                    {!! Form::open(['url' => '/admin/solicitud_despacho/importar', 'files' => true]) !!}

                        <div class="row">
                            <div class="col-md-3">
                                <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> ID Solicitud: </strong></label>
                                <div class="input-group">           
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('id_solicitud', $solicitud->id, ['class'=>'form-control', 'readonly']) !!}
                                            
                                </div>
                            </div>  

                            <div class="col-md-3">
                                <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Fecha de Inicio de Solicitud: </strong></label>
                                <div class="input-group">           
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::date('fecha', $solicitud->created_at, ['class'=>'form-control', 'readonly']) !!}            
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Entrega A Procesar: </strong></label>
                                <div class="input-group">           
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('entrega', obtenerMeses(null, $solicitud->entrega->mes_inicial).' / '.obtenerMeses(null, $solicitud->entrega->mes_final), ['class'=>'form-control', 'readonly']) !!}
                                            
                                </div>
                            </div>  

                            <div class="col-md-3">
                                <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Días A Cubrir En Esta Entrega: </strong></label>
                                <div class="input-group">           
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('entrega', $solicitud->entrega->dias_a_cubrir, ['class'=>'form-control', 'readonly']) !!}
                                            
                                </div>
                            </div>  

                            <div class="col-md-12 mtop16">
                                <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Usuario Que Inicia La Solicitud: </strong></label>
                                <div class="input-group">           
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('usuario', $solicitud->usuario->nombres.' '.$solicitud->usuario->apellidos, ['class'=>'form-control', 'readonly']) !!}            
                                </div>
                            </div>    
                            
                            <div class="col-md-12 mtop16">
                                <label for="name"> <strong> Observaciones: </strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::textarea('observaciones', $solicitud->observaciones, ['class'=>'form-control','rows'=>'2', 'readonly']) !!}
                                </div>
                            </div>
                        </div>

                        <hr />
                        <h5><strong>Cargar Archivo Con Datos De La Solicitud</strong></h5>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Cargar Archivo: </strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::file('datos_solicitud') !!}
                                </div>
                            </div>                            
                        </div>

                        {!! Form::submit('Cargar Datos', ['class'=>'btn btn-info mtop16']) !!}
                    {!! Form::close() !!}
                </div>

            </div>
            
        </div>

    </div>
</div>



@endsection