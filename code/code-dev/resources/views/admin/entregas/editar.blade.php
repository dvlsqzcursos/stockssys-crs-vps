@extends('admin.plantilla.master')
@section('title','Editar Entrega')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/entregas') }}"><i class="fa-solid fa-people-carry-box"></i> Entregas</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/entrega/'.$entrega->id.'/editar') }}"><i class="fa-solid fa-people-carry-box"></i> Editar Entrega</a></li>
@endsection

@section('content')

<div class="container-fluid ">
    <div class="row ">
        <div class="col-md-3">
            <div class="card ">

                <div class="card-header">
                    <h2 class="title"><i class="fas fa-plus-circle"></i><strong> Editar Entrega</strong></h2>
                    
                </div>

                <div class="card-body">
                    {!! Form::open(['url' => '/admin/entrega/'.$entrega->id.'/editar', 'files' => true]) !!}
                        @include('admin.entregas.formulario')                        

                        {!! Form::submit('Editar', ['class'=>'btn btn-info mtop16']) !!}
                        <a href="{{ url('/admin/entregas') }}" class="btn btn-secondary mtop16">Regresar</a>

                    {!! Form::close() !!}
                </div>

            </div>
            
        </div>

    </div>
</div>

@endsection