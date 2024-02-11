{!! Form::hidden('id', null, ['class'=>'form-control', 'id' =>'id']) !!}
<label for="name"> <strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Nombre: </strong></label>
<div class="input-group">
    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
    {!! Form::text('nombre', null, ['class'=>'form-control', 'id' =>'nombre']) !!}
</div>

<label for="unit_id"  class="mtop16"><strong><sup ><i class="fa-solid fa-triangle-exclamation"></i></sup> Nivel / Tipo:</strong></label>
<div class="input-group">
    <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
    {!! Form::select('nivel', ['1'=>'País'],1,['class'=>'form-select']) !!}
</div>

