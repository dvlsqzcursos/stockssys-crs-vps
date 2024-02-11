@extends('admin.plantilla.master')
@section('title','Registar Ruta')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/rutas') }}"><i class="fa-solid fa-route"></i> Rutas</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/ruta/registrar') }}"><i class="fa-solid fa-route"></i> Registrar Ruta</a></li>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card ">

                <div class="card-header">
                    <h2 class="title"><i class="fas fa-plus-circle"></i><strong> Registrar Ruta</strong></h2>
                    
                </div>

                <div class="card-body">
                    {!! Form::open(['url' => '/admin/ruta/registrar', 'files' => true]) !!}

                        @include('admin.rutas.formulario')

                        {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}
                        <a href="{{ url('/admin/rutas') }}" class="btn btn-secondary mtop16">Regresar</a>

                    {!! Form::close() !!}
                </div>

            </div>
            
        </div>

    </div>
</div>



@endsection