@extends('admin.plantilla.master')
@section('title','Editar Escuela')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/solicitudes') }}"><i class="fa-solid fa-file-invoice"></i> Solicitudes</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/solicitudes') }}"><i class="fa-solid fa-file-invoice"></i> Solicitudes</a></li>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card ">

                <div class="card-header">
                    <h2 class="title"><i class="fas fa-plus-circle"></i><strong> Registrar Detalle: </strong> </h2>
                    
                </div>

                <div class="card-body">
                    {!! Form::open(['url' => '/admin/solicitud_despacho/detalles/registrar', 'files' => true]) !!}

                        @include('admin.solicitudes.detalles.formulario')

                        {!! Form::submit('Editar', ['class'=>'btn btn-info mtop16']) !!}
                        <a href="{{ url('/admin/solicitud_despacho/'.$detalles->id_solicitud.'/mostrar') }}" class="btn btn-secondary mtop16">Regresar</a>

                    {!! Form::close() !!}
                </div>

            </div>
            
        </div>

    </div>
</div>

@endsection