{!! Form::hidden('id_kit', $id, ['class'=>'form-control']) !!}

<label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Inusmo: </strong></label>
<div class="input-group">
    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
    {!! Form::select('id_insumo', $insumos, 0,['class'=>'form-select', 'id' => 'id_institucion', 'style' => 'width: 88%']) !!}
</div>

<label for="name" class="mtop16"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Cantidad de Unidades del Insumo: </strong></label>
<div class="input-group">
    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
    {!! Form::number('cantidad', null, ['class'=>'form-control']) !!}
</div>
