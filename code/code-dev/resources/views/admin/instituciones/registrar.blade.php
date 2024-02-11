@extends('admin.plantilla.master')
@section('title','Registar Institución')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/instituciones') }}"><i class="fa-solid fa-building"></i> Instituciones</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/institucion/registrar') }}"><i class="fa-solid fa-building"></i> Registrar Institucion</a></li>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card ">

                <div class="card-header">
                    <h2 class="title"><i class="fas fa-plus-circle"></i><strong> Registrar Institución</strong></h2>
                    
                </div>

                <div class="card-body">
                    {!! Form::open(['url' => '/admin/institucion/registrar', 'files' => true]) !!}

                        @include('admin.instituciones.formulario')

                        {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}
                        <a href="{{ url('/admin/instituciones') }}" class="btn btn-secondary mtop16">Regresar</a>

                    {!! Form::close() !!}
                </div>

            </div>
            
        </div>

    </div>
</div>



@endsection