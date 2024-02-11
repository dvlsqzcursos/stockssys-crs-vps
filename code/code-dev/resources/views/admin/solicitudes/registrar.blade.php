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
                    <h2 class="title"><i class="fas fa-plus-circle"></i><strong> Registrar Solicitud de Despacho</strong></h2>
                    
                </div>

                <div class="card-body">
                    {!! Form::open(['url' => '/admin/solicitud_despacho/registrar', 'files' => true]) !!}

                        <div class="row">
                            <div class="col-md-6">
                                <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Fecha de Inicio de Solicitud: </strong></label>
                                <div class="input-group">           
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::date('fecha', \Carbon\Carbon::now(), ['class'=>'form-control']) !!}            
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Seleccionar Entrega: </strong></label>
                                <div class="input-group">           
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    <select name="idEntrega" id="idEntrega" style="width: 95%" >
                                        @foreach($entregas as $e)
                                            <option value="{{ $e->id }}">{{ $e->correlativo.'-'.$e->year.' => '.obtenerMeses(null, $e->mes_inicial).' / '.obtenerMeses(null, $e->mes_final) }}</option>
                                        @endforeach
                                    </select>            
                                </div>
                            </div>  

                            <div class="col-md-12 mtop16">
                                <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Usuario Que Inicia La Solicitud: </strong></label>
                                <div class="input-group">           
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::hidden('idUsuario', Auth::user()->id, ['class'=>'form-control', 'readonly']) !!} 
                                    {!! Form::text('usuario', Auth::user()->nombres.' '.Auth::user()->apellidos, ['class'=>'form-control', 'readonly']) !!}            
                                </div>
                            </div>

                            <div class="col-md-12 mtop16">
                                <label for="name"> <strong> Observaciones: </strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::textarea('observaciones', null, ['class'=>'form-control','rows'=>'2']) !!}
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
                                    {!! Form::file('datos') !!}
                                </div>
                            </div>                            
                        </div>

                        {!! Form::submit('Iniciar Proceso', ['class'=>'btn btn-info mtop16']) !!}
                    {!! Form::close() !!}
                </div>

            </div>
            
        </div>

    </div>
</div>



@endsection