@extends('admin.plantilla.master')
@section('title','Bodega Primaria')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href=""><i class="fa-solid fa-warehouse"></i> Bodega Primaria</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/bodega_primaria/ingresos') }}"><i class="fa-solid fa-calculator"></i> Registro de Ingresos</a></li>
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
                    {!! Form::open(['url' => '/admin/bodega_principal/insumo/ingresos', 'files' => true]) !!}
                        <h5><strong>Información de Ingreso</strong></h5>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Fecha de Ingreso: </strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                                    {!! Form::date('fecha_ingreso', \Carbon\Carbon::now(), ['class'=>'form-control']) !!}
                                </div>
                            </div>                            

                            <div class="col-md-4">
                                <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Tipo De Documento: </strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                                    {!! Form::select('tipo_documento', ['0'=>'Guia de Transporte Terrestre','1'=>'Otros'],0,['class'=>'form-select']) !!}
                                </div>
                            </div>  

                            <div class="col-md-4">
                                <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> BL: </strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('no_documento', null, ['class'=>'form-control']) !!}
                                </div>
                            </div>

                            <div class="col-md-6 mtop16">
                                <label for="name"> <strong>Procedente de (Bodega o Institucion Registrada): </strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                                    {!! Form::select('bodega_despacho', $bodegas,0,['class'=>'form-select', 'id'=>'id_bodega_despacho', 'style' => 'width: 90%']) !!}
                                </div>
                            </div>

                            <div class="col-md-6 mtop16">
                                <label for="name"> <strong>Procedente de (Otro origen): </strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                                    {!! Form::text('procedente', null, ['class'=>'form-control']) !!}
                                </div>
                            </div>

                            <div class="col-md-12 mtop16" style="text-align: center;">
                                <span style="color:red;"><b><i class="fa-solid fa-circle-exclamation"></i> Utilice uno de las dos opciones de procedencia de los insumos; Usar los dos en un mismo ingreso podria generar un error.</b></span>
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
                                <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Best Used By/Before Date: </strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                                    {!! Form::date('bubd', null, ['class'=>'form-control', 'id' => 'bubd']) !!}
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

                            <div class="col-md-1">
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
                                        <th>BUBD</th>
                                        <th>NO UNIDADES</th>
                                        <th>PESO POR UNIDAD (KG)</th>
                                        <th>PESO TOTAL (KG)</th>
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

<script>
    


    $(document).ready(function(){
        $('#bt_add').click(function(){
        agregar();
        });
    });

    var cont=0;
    total=0;
    subtotal=[];
    $("#guardar").hide();

    function agregar(){
        idinsumo=$("#idinsumo").val();
        insumo=$("#idinsumo option:selected").text();
        pl=$("#pl").val();
        bubd=$("#bubd").val();
        no_unidades=$("#no_unidades").val();
        unidad_medida=$("#unidad_medida").val();
        peso_total = no_unidades * unidad_medida;

        if (idinsumo!=""  ){
            var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="idinsumo[]" value="'+idinsumo+'">'+insumo+'</td><td><input type="number" name="pl[]" value="'+pl+'"></td><td><input type="text" name="bubd[]" value="'+bubd+'"></td><td><input type="number" name="no_unidades[]" value="'+no_unidades+'"></td><td><input type="number" name="unidad_medida[]" value="'+unidad_medida+'"></td><td><input type="number" name="peso_total[]" value="'+peso_total+'"></td></tr>';
            cont++;
            limpiar();
            evaluar();
            $('#detalles').append(fila);
        }else{
            alert("Error al ingresar el detalle del ingreso, revise los datos del insumo a registrar")
        }
        
    }

    function limpiar(){
        $("#pl").val("");
        $("#bubd").val("");
        $("#no_unidades").val("");
        $("#unidad_medida").val(""); 
    }

    function evaluar()
    {
        if (cont >0){
            $("#guardar").show();
        }else{
            $("#guardar").hide();
        }
    }

    function eliminar(index){
        $("#fila" + index).remove();
        cont--;
        evaluar();
    }



</script>

@endsection