{!! Form::hidden('id_racion', $id, ['class'=>'form-control']) !!}

<label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Alimento: </strong></label>
<div class="input-group">
    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
    {!! Form::select('id_alimento', $alimentos, 0,['class'=>'form-select', 'id' => 'id_institucion', 'style' => 'width: 90%']) !!}
</div>

<label for="name" class="mtop16"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Cantidad de Alimento: </strong></label>
<div class="input-group">
    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
    {!! Form::number('cantidad', null, ['class'=>'form-control']) !!}
</div>

<label for="unit_id"  class="mtop16"><strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Unidad de Medida:</strong></label>
<div class="input-group">
    <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
    {!! Form::select('unidad_medida', obtenerUnidadesMedidaRaciones('list', null), 0,['class'=>'form-select']) !!}
</div>
