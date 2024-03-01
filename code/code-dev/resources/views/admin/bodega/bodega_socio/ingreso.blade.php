@extends('admin.plantilla.master')
@section('title','Bodega Socio')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href=""><i class="fa-solid fa-warehouse"></i> Bodega Socio</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/bodega_socio/ingresos') }}"><i class="fa-solid fa-calculator"></i> Registro de Ingresos</a></li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card ">

                <div class="card-header">
                    <h2 class="title"><i class="fas fa-plus-circle"></i><strong> Registro De Ingresos A Bodega</strong></h2>
                    
                </div>

                <div class="card-body">
                    {!! Form::open(['url' => '/admin/bodega_socio/insumo/ingresos', 'files' => true]) !!}
                        <h5><strong>Información de Ingreso</strong></h5>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Fecha de Ingreso: </strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                                    {!! Form::date('fecha_ingreso', null, ['class'=>'form-control']) !!}
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Bodega de Despacho: </strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                                    {!! Form::select('bodega_despacho', $bodegas,0,['class'=>'form-select']) !!}
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Tipo De Documento: </strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                                    {!! Form::select('tipo_documento', ['0'=>'Guia de Transporte Terrestre','1'=>'Otros'],0,['class'=>'form-select']) !!}
                                </div>
                            </div>  

                            <div class="col-md-3">
                                <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> No. De Documento: </strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('no_documento', null, ['class'=>'form-control']) !!}
                                </div>
                            </div>

                            

                        </div>

                        <hr />
                        <h5><strong>Detalle De La Carga</strong></h5>

                        <div class="row">
                            <div class="col-md-3">
                                <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Insumo: </strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                                    <select name="idinsumo" id="idinsumo" style="width: 90%" >
                                        @foreach($insumos as $i)
                                            <option value=""></option>
                                            <option value="{{ $i->id }}">{{ $i->nombre }}</option>
                                        @endforeach
                                    </select> 
                                </div>
                            </div>

                            <div class="col-md-2">
                                <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> PL: </strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::number('pl', null, ['class'=>'form-control', 'id' => 'pl']) !!}
                                </div>
                            </div>

                            <div class="col-md-2">
                                <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> No. Unidades: </strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::number('no_unidades', null, ['class'=>'form-control', 'id' => 'no_unidades']) !!}
                                </div> 
                            </div>

                            <div class="col-md-2">
                                <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Unidad de Medida (Libras/Cajas): </strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::number('unidad_medida', null, ['class'=>'form-control', 'id' => 'unidad_medida']) !!}
                                </div>
                            </div>

                            <div class="col-md-2">
                                <button type="button" id="bt_add" class="btn btn-primary"> Agregar</button>
                            </div>                           
                        </div>

                        <div class="row">
                            <div class="card-body table-responsive">
                                <table id="detalles" class= "table table-striped table-bordered table-condensed table-hover">
                                    <thead style="background-color: #c3f3ea">
                                        <th>ELIMINAR</th>
                                        <th>INSUMO</th>
                                        <th>PL</th>
                                        <th>NO UNIDADES</th>
                                        <th>UNIDAD DE MEDIDA (LIBRAS/CAJAS)</th>
                                        <th>PESO TOTAL (LIBRAS)</th>
                                    </thead>

                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <div class="col-md-6" id="guardar">
                            {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}
                            <a href="{{ url('/admin/escuelas') }}" class="btn btn-secondary mtop16">Regresar</a>
                        </div>

                    {!! Form::close() !!}
                </div>

            </div>
            
        </div>

    </div>

</div>

@include('admin.bodega.bodega_socio.scripts')

@endsection