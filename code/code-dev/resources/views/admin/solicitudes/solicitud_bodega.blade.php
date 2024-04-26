@extends('admin.plantilla.master')
@section('title','Solicitud A Bodega Primaria')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/escuelas') }}"><i class="fa-solid fa-route"></i> Solicitud de Despacho</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/escuela/registrar') }}"><i class="fa-solid fa-route"></i> Registrar Solicitud de Despacho</a></li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">       
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><strong><i class="fa-solid fa-file-invoice"></i> Informacion Detallada Para Realizar Solicitud A Bodega Primaria</strong></h2>
                    
                </div>

                <div class="card-body" style="text-align:center;  overflow-y: scroll; line-height: 1em; height:400px;">
                    @foreach($escuelas as $e)
                        <p style="color: blue;"><b>{{ $loop->iteration.'. '.$e->escuela }} </b></p>
                        <div class="row">
                            <div class="col-md-3" >
                                @foreach($det_escuelas_preprimaria_enc as $det_preprimaria_enc)
                                    @if($det_preprimaria_enc->escuela_id == $e->escuela_id)    
                                        <b>Racion: </b>  {{ $det_preprimaria_enc->racion}} &nbsp                                    
                                        <b>Dias: </b>  {{ $det_preprimaria_enc->dias}} &nbsp
                                        <b>Total Beneficiarios: </b>  {{ $det_preprimaria_enc->total_beneficiarios}} 
                                    @endif                                   
                                @endforeach 
                                <br>
                                <b>Desgloce: </b>  
                                <br>                           
                                @foreach($det_escuelas_preprimaria as $det_preprimaria)
                                    @if($det_preprimaria->escuela_id == $e->escuela_id)                                        
                                        <b><i class="fa-solid fa-caret-right"></i> Alimento: </b>{{ $det_preprimaria->alimento}} <b>Peso (gr.): </b>{{ $det_preprimaria->alimento_peso}} <br>
                                        <b>Gramos: </b>{{ number_format( ($det_preprimaria->dias*$det_preprimaria->total_beneficiarios*$det_preprimaria->alimento_peso), 2, '.', ',' )}} &nbsp
                                        <b>Quintales: </b>{{ number_format( ((($det_preprimaria->dias*$det_preprimaria->total_beneficiarios*$det_preprimaria->alimento_peso)/453.59237)/100), 2, '.', ',' )}} &nbsp
                                        <b>Unidades Racion: </b>{{ number_format( ((($det_preprimaria->dias*$det_preprimaria->total_beneficiarios*$det_preprimaria->alimento_peso)/1000)/50), 2, '.', ',' )}} <br>
                                    @endif
                                @endforeach 
                            </div>
                            <div class="col-md-3">
                                @foreach($det_escuelas_primaria_enc as $det_primaria_enc)
                                    @if($det_primaria_enc->escuela_id == $e->escuela_id)    
                                        <b>Racion: </b>  {{ $det_primaria_enc->racion}} &nbsp                                    
                                        <b>Dias: </b>  {{ $det_primaria_enc->dias}} &nbsp
                                        <b>Total Beneficiarios: </b>  {{ $det_primaria_enc->total_beneficiarios}} 
                                    @endif                                   
                                @endforeach 
                                <br>
                                <b>Desgloce: </b>  
                                <br>        
                                @foreach($det_escuelas_primaria as $det_primaria)
                                    @if($det_primaria->escuela_id == $e->escuela_id)                                        
                                        <b><i class="fa-solid fa-caret-right"></i> Alimento: </b>{{ $det_primaria->alimento}} <b>Peso (gr.): </b>{{ $det_primaria->alimento_peso}} <br>
                                        <b>Gramos: </b>{{ number_format( ($det_primaria->dias*$det_primaria->total_beneficiarios*$det_primaria->alimento_peso), 2, '.', ',' )}} &nbsp
                                        <b>Quintales: </b>{{ number_format( ((($det_primaria->dias*$det_primaria->total_beneficiarios*$det_primaria->alimento_peso)/453.59237)/100), 2, '.', ',' )}} &nbsp
                                        <b>Unidades Racion: </b>{{ number_format( ((($det_primaria->dias*$det_primaria->total_beneficiarios*$det_primaria->alimento_peso)/1000)/50), 2, '.', ',' )}} <br>
                                    @endif
                                @endforeach 
                            </div>
                            <div class="col-md-3">
                                @foreach($det_escuelas_l_enc as $det_l_enc)
                                    @if($det_l_enc->escuela_id == $e->escuela_id)    
                                        <b>Racion: </b>  {{ $det_l_enc->racion}} &nbsp                                    
                                        <b>Dias: </b>  {{ $det_l_enc->dias}} &nbsp
                                        <b>Total Beneficiarios: </b>  {{ $det_l_enc->total_beneficiarios}} 
                                    @endif                                   
                                @endforeach 
                                <br>
                                <b>Desgloce: </b>  
                                <br>         
                                @foreach($det_escuelas_l as $det_l)
                                    @if($det_l->escuela_id == $e->escuela_id)                                        
                                        <b><i class="fa-solid fa-caret-right"></i> Alimento: </b>{{ $det_l->alimento}} <b>Peso (lbs.): </b>{{ $det_l->alimento_peso}} <br>
                                        <b>Libras: </b>{{ number_format( ($det_l->dias*$det_l->total_beneficiarios*$det_l->alimento_peso), 2, '.', ',' )}} &nbsp
                                        <b>Quintales: </b>{{ number_format( ((($det_l->dias*$det_l->total_beneficiarios*$det_l->alimento_peso))/100), 2, '.', ',' )}} &nbsp
                                        <b>Unidades Racion: </b>{{ number_format( ((($det_l->dias*$det_l->total_beneficiarios*$det_l->alimento_peso)/110)), 2, '.', ',' )}} <br>
                                    @endif
                                @endforeach
                            </div>
                            <div class="col-md-3">
                                @foreach($det_escuelas_v_d_enc as $det_v_d_enc)
                                    @if($det_v_d_enc->escuela_id == $e->escuela_id)    
                                        <b>Racion: </b>  {{ $det_v_d_enc->racion}} &nbsp                                    
                                        <b>Dias: </b>  {{ $det_v_d_enc->dias}} &nbsp
                                        <b>Total Beneficiarios: </b>  {{ $det_v_d_enc->total_beneficiarios}} 
                                    @endif                                   
                                @endforeach 
                                <br>
                                <b>Desgloce: </b>  
                                <br>        
                                @foreach($det_escuelas_v_d as $det_v_d)
                                    @if($det_v_d->escuela_id == $e->escuela_id)                                        
                                    <b><i class="fa-solid fa-caret-right"></i> Alimento: </b>{{ $det_v_d->alimento}} <b>Peso (lbs.): </b>{{ $det_v_d->alimento_peso}} <br>
                                        <b>Libras: </b>{{ number_format( ($det_v_d->dias*$det_v_d->total_beneficiarios*$det_v_d->alimento_peso), 2, '.', ',' )}} &nbsp
                                        <b>Quintales: </b>{{ number_format( ((($det_v_d->dias*$det_v_d->total_beneficiarios*$det_v_d->alimento_peso)/100)), 2, '.', ',' )}} &nbsp
                                        <b>Unidades Racion: </b>{{ number_format( ((($det_v_d->dias*$det_v_d->total_beneficiarios*$det_v_d->alimento_peso)/110)), 2, '.', ',' )}} <br>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <br><hr>
                    @endforeach
                </div>

                <div class="card-footer clearfix">
                    
                </div>
            </div>
        </div>
    </div>

    <div class="row mtop16">     
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><strong><i class="fa-solid fa-file-invoice"></i> Saldos Actuales en Bodega</strong></h2>
                    
                </div>

                <div class="card-body" style="text-align:center;  overflow-y: scroll; line-height: 1em; height:400px;">
                    @foreach($alimentos as $a)
                        <p>
                            <b><i class="fa-solid fa-caret-right"></i> Alimento: </b> {{$a->nombre}} <br>
                            <b>Saldo Actual: </b> {{$a->saldo}} {{ obtenerUnidadesMedidaInsumos(null, $a->id_unidad_medida) }}
                            
                        </p>
                        <hr>
                    @endforeach
                </div>

                <div class="card-footer clearfix">
                    
                </div>
            </div>
        </div>   

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><strong><i class="fa-solid fa-file-invoice"></i> Resumen Para Realizar Solicitud A Bodega Primaria</strong></h4>
                    
                </div>

                <div class="card-body" style="text-align:center;  overflow-y: scroll; line-height: 1em; height:400px;">
                    <div class="row">
                        <div class="col-md-12">
                            @foreach($alimentos as $a)
                                <b><i class="fa-solid fa-caret-right"></i> Alimento: </b>{{ $a->nombre }} <br>
                                @php($total_peso_ruta = 0) 
                                @foreach($det_escuelas_preprimaria as $det_preprimaria)
                                    @if($det_preprimaria->alimento_id == $a->id)                                        
                                        @php($total_peso_ruta = $total_peso_ruta + ($det_preprimaria->dias*$det_preprimaria->total_beneficiarios*$det_preprimaria->alimento_peso)  )  
                                    @endif
                                @endforeach
                                @foreach($det_escuelas_primaria as $det_primaria)
                                    @if($det_primaria->alimento_id == $a->id)                                        
                                        @php($total_peso_ruta = $total_peso_ruta + ($det_primaria->dias*$det_primaria->total_beneficiarios*$det_primaria->alimento_peso)  )  
                                    @endif
                                @endforeach
                                @foreach($det_escuelas_l as $det_l)
                                    @if($det_l->alimento_id == $a->id)                                        
                                        @php($total_peso_ruta = $total_peso_ruta + ( ($det_l->dias*$det_l->total_beneficiarios*$det_l->alimento_peso)/453.59237)  )  
                                    @endif
                                @endforeach
                                @foreach($det_escuelas_v_d as $det_v_d)
                                    @if($det_v_d->alimento_id == $a->id)                                        
                                        @php($total_peso_ruta = $total_peso_ruta + ( ($det_v_d->dias*$det_v_d->total_beneficiarios*$det_v_d->alimento_peso)/453.59237)  )  
                                    @endif
                                @endforeach
                                <b>Total Gramos: </b>{{ number_format($total_peso_ruta , 2, '.', ',' )}} &nbsp
                                <b>Total Quintales: </b>{{ number_format( (($total_peso_ruta/100)) , 2, '.', ',' )}} 
                                <b>Total Unidades: </b>{{ number_format( (($total_peso_ruta/110)) , 2, '.', ',' )}} 
                                <hr>
                            @endforeach
                        </div>
                    </div>
                    
                </div>

                <div class="card-footer clearfix">
                    
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><strong><i class="fa-solid fa-file-invoice"></i> Realizar Solicitud A Bodega Primaria</strong></h2>
                    
                </div>

                <div class="card-body" style="text-align:center;  overflow-y: scroll; line-height: 1em; height:400px;">

                    <div class="row">
                        <div class="col-md-12">
                            <p><b>Realizar Solicitud de Alimentos A Bodega Principal</b></p>

                            
                        
                            {!! Form::open(['url' => '/admin/solicitud_despacho/solicitud_bodega_primaria', 'files' => true]) !!}
                                {!! Form::hidden('idSolicitud', $solicitud, ['class'=>'form-control']) !!}
                                <div class="col-md-12 mtop16">
                                    <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Solicitar A: </strong></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                                        {!! Form::select('id_bodega_primaria', $bodegas,0,['class'=>'form-select', 'id'=>'id_institucion', 'style' => 'width: 92%']) !!}
                                    </div>
                                </div>

                                <div class="col-md-12 mtop16">
                                    <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Tipo de Ración: </strong></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                                        <select name="tipo_racion" id="tipo_racion" style="width: 92%" >
                                            @foreach($raciones as $r)
                                                <option value=""></option>
                                                <option value="{{ $r->id }}">{{ $r->tipo_alimentos }}</option>
                                            @endforeach
                                        </select> 
                                    </div>
                                </div>

                                <div class="col-md-12 mtop16">
                                    <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Insumo: </strong></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                                        <select name="idinsumo" id="idinsumo" style="width: 92%" >
                                            @foreach($alimentos as $a)
                                                <option value=""></option>
                                                <option value="{{ $a->id }}">{{ $a->nombre }}</option>
                                            @endforeach
                                        </select> 
                                    </div>
                                </div>

                                <div class="col-md-12 mtop16">
                                    <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Cantidad a Solicitar: </strong></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                        {!! Form::number('cantidad', null, ['class'=>'form-control', 'id' => 'cantidad']) !!}
                                    </div> 
                                </div>

                                <div class="col-md-12 mtop16">
                                    <label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Unidad de Medida A Solicitar: </strong></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                        {!! Form::select('id_unidad_medida', obtenerUnidadesMedidaInsumos('list', null), 0,['class'=>'form-select', 'id'=>'id_unidad_medida', 'style' => 'width: 92%']) !!} 
                                    </div> 
                                </div>

                                <div class="col-md-2 mtop16">
                                    <button type="button" id="bt_add" class="btn btn-primary"> Agregar</button>
                                </div>                           

                                <div class="col-md-12 mtop16">
                                    <div class="card-body table-responsive">
                                        <table id="detalles" class= "table table-striped table-bordered table-condensed table-hover">
                                            <thead style="background-color: #c3f3ea">
                                                <th>ELIMINAR</th>
                                                <th>INSUMO</th>
                                                <th>CANTIDAD</th>
                                                <th>UNIDAD DE MEDIDA</th>
                                            </thead>

                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-md-6" id="guardar">
                                    {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}
                                </div>
                            </div>

                        {!! Form::close() !!}
                    </div>
                    
                </div>

                <div class="card-footer clearfix">
                    
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
        cantidad=$("#cantidad").val();
        idmedida=$("#id_unidad_medida").val();
        medida=$("#id_unidad_medida option:selected").text();

        if (idinsumo!=""   ){
            var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="idinsumo[]" value="'+idinsumo+'">'+insumo+'</td><td><input type="number" name="cantidad[]" value="'+cantidad+'"></td><td><input type="hidden" name="idmedida[]" value="'+idmedida+'">'+medida+'</td></tr>';
            cont++;
            limpiar();
            evaluar();
            $('#detalles').append(fila);
        }else{
            alert("Error al ingresar el detalle del ingreso, revise los datos del insumo a registrar")
        }
        
    }

    function limpiar(){
        $("#cantidad").val("");
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