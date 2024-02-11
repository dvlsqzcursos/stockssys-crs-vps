@extends('admin.plantilla.master')
@section('title','Editar Kit')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/raciones') }}"><i class="fa-solid fa-people-carry-box"></i> Kits</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/racion/'.$racion->id.'/editar') }}"><i class="fa-solid fa-people-carry-box"></i> Editar Kit</a></li>
@endsection

@section('content')

<div class="container-fluid ">
    <div class="row ">
        <div class="col-md-3">
            <div class="card ">

                <div class="card-header">
                    <h2 class="title"><i class="fas fa-plus-circle"></i><strong> Editar Kit</strong></h2>
                    
                </div>

                <div class="card-body">
                    {!! Form::open(['url' => '/admin/bodega_socion/kit/'.$kit->id.'/editar', 'files' => true]) !!}
                        @include('admin.bodega.bodega_socio.kits.formulario')                        

                        {!! Form::submit('Editar', ['class'=>'btn btn-info mtop16']) !!}
                        <a href="{{ url('/admin/bodega_socio/kits') }}" class="btn btn-secondary mtop16">Regresar</a>

                    {!! Form::close() !!}
                </div>

            </div>
            
        </div>

    </div>
</div>

@endsection