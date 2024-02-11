@extends('admin.plantilla.master')
@section('title','Pesos Alimento')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/insumos') }}"><i class="fa-solid fa-wheat-awn"></i> Insumos</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/insumos') }}"><i class="fa-solid fa-wheat-awn"></i> Pesos Alimento</a></li>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">

        <div class="col-md-3"> 
            <div class="card ">

                <div class="card-header">
                    <h2 class="card-title"><strong><i class="fa-solid fa-wheat-awn"></i> Listado de Pesos: </strong>{{ $insumo->nombre }}</h2>
                </div>

                <div class="card-body">
                   <strong><i class="fa-solid fa-angles-right"></i> Gramos por libra: </strong> {{ $pesos->gramos_x_libra }} <br>
                   <strong><i class="fa-solid fa-angles-right"></i> Gramos por Kg: </strong> {{ $pesos->gramos_x_kg }} <br>
                   <strong><i class="fa-solid fa-angles-right"></i> Libras por KG: </strong> {{ $pesos->libras_x_kg }} <br>
                   <strong><i class="fa-solid fa-angles-right"></i> Kilogramos por unidad (Caneca/Saco): </strong> {{ $pesos->kg_x_unidad }} <br>
                   <strong><i class="fa-solid fa-angles-right"></i> Gramos x unidad: </strong> {{ $pesos->gramos_x_unidad }} <br>
                   <strong><i class="fa-solid fa-angles-right"></i> Libras Netas por Unidad: </strong> {{ $pesos->libras_x_unidad }} <br>
                   <strong><i class="fa-solid fa-angles-right"></i> Quintales x unidad:  </strong> {{ $pesos->quintales_x_unidad }} <br>
                   <strong><i class="fa-solid fa-angles-right"></i> Peso bruto en quintales: </strong> {{ $pesos->peso_bruto_quintales }} <br>
                   <strong><i class="fa-solid fa-angles-right"></i> Tonelada Metrica Kg: </strong> {{ $pesos->tonelada_metrica_kg }} <br>
                   <strong><i class="fa-solid fa-angles-right"></i> Unidades por TM:  </strong> {{ $pesos->unidades_x_tm }} <br> 
                </div>

            </div>                
        </div>
        
        <div class="col-md-9"> 
            <div class="card ">

                <div class="card-header">
                    <h2 class="card-title"><strong><i class="fa-solid fa-wheat-awn"></i> Edición de Pesos: </strong>{{ $insumo->nombre }}</h2>
                </div>

                <div class="card-body">
                    {!! Form::open(['url' => '/admin/insumo/pesos', 'files' => true]) !!}
                        @include('admin.insumos.formulario_pesos')

                        {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}
                        <a href="{{ url('/admin/insumos') }}" class="btn btn-secondary mtop16">Regresar</a>
                    {!! Form::close() !!}
                </div>

            </div>                
        </div>

    </div>

</div>

@endsection