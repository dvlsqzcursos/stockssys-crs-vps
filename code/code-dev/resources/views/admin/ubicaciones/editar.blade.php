@extends('admin.plantilla.master')
@section('title','Editar Ubicación')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/ubicaciones') }}"><i class="fa-solid fa-earth-americas"></i> Ubicaciones</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/ubicacion/'.$ubicacion->id.'/editar') }}"><i class="fa-solid fa-earth-americas"></i> Editar Ubicación</a></li>
@endsection

@section('content')

<div class="container-fluid ">
    <div class="row ">
        <div class="col-md-12">
            <div class="card ">

                <div class="card-header">
                    <h2 class="title"><i class="fas fa-plus-circle"></i><strong> Editar Ubicación</strong></h2>
                    
                </div>

                <div class="card-body">
                    {!! Form::open(['url' => '/admin/ubicacion/'.$ubicacion->id.'/editar', 'files' => true]) !!}

                        <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Nombre: </strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('nombre', $ubicacion->nombre, ['class'=>'form-control']) !!}
                        </div>

                        {!! Form::submit('Editar', ['class'=>'btn btn-info mtop16']) !!}
                        <a href="{{ url('/admin/ubicaciones') }}" class="btn btn-secondary mtop16">Regresar</a>

                    {!! Form::close() !!}
                </div>

            </div>
            
        </div>

    </div>
</div>

@endsection