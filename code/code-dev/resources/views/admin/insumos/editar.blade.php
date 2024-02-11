@extends('admin.plantilla.master')
@section('title','Editar Alimento')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/alimentos') }}"><i class="fa-solid fa-wheat-awn"></i> Alimentos</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/alimentos') }}"><i class="fa-solid fa-wheat-awn"></i> Pesos Alimento</a></li>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="card ">

                <div class="card-header">
                    <h2 class="title"><i class="fas fa-plus-circle"></i><strong> Editar Alimento</strong></h2>
                    
                </div>

                <div class="card-body">
                    {!! Form::open(['url' => '/admin/alimento/'.$alimento->id.'/editar', 'files' => true]) !!}

                        @include('admin.alimentos.formulario')

                        {!! Form::submit('Editar', ['class'=>'btn btn-info mtop16']) !!}
                        <a href="{{ url('/admin/alimentos') }}" class="btn btn-secondary mtop16">Regresar</a>

                    {!! Form::close() !!}
                </div>

            </div>
            
        </div>

    </div>
</div>

@endsection