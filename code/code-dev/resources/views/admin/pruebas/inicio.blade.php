@extends('admin.plantilla.master')
@section('title','Ubicaciones')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/ubicaciones') }}"><i class="fa-solid fa-earth-americas"></i> Ubicaciones</a></li>
@endsection

@section('content')

<div class="container-fluid">

    <div class="row ">
        <div class="col-md-4">
            <div class="card ">

                <div class="card-header">
                    <h2 class="title"><i class="fas fa-plus-circle"></i><strong> Importar Ubicaciones</strong></h2>
                </div>

                <div class="card-body">
                    {!! Form::open(['url' => '/admin/prueba/importar', 'files' => true]) !!}
                        <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Cargar Archivo: </strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::file('ubicaciones') !!}
                        </div>

                        {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}
                    {!! Form::close() !!}
                </div>

            </div>
            
        </div>
    </div>
</div>

@endsection