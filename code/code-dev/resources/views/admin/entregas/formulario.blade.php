<label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Mes Inicial: </strong></label>
<div class="input-group">
    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
    {!! Form::select('mes_inicial', obtenerMeses('list', null), $entrega->mes_inicial,['class'=>'form-select']) !!} 
</div>

<label for="name" class="mtop16"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Mes Final: </strong></label>
<div class="input-group">
    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
    {!! Form::select('mes_final', obtenerMeses('list', null), $entrega->mes_final,['class'=>'form-select']) !!}
</div>

<label for="unit_id"  class="mtop16"><strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Dias a Cubrir:</strong></label>
<div class="input-group">
    <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
    {!! Form::number('dias_a_cubrir', $entrega->dias_a_cubrir, ['class'=>'form-control', 'min'=>'1']) !!}
</div>

<label for="unit_id"  class="mtop16"><strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Año:</strong></label>
<div class="input-group">
    <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
    {!! Form::number('year', (isset($entrega->year))  ? $entrega->year : now()->year  , ['class'=>'form-control', 'min'=>'2023', 'max'=>'2099', 'step'=>'1']) !!}
</div>
