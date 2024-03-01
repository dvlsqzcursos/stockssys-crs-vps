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
        no_unidades=$("#no_unidades").val();
        unidad_medida=$("#unidad_medida").val();
        peso_total = no_unidades * unidad_medida;

        if (idinsumo!=""  ){
            var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="idinsumo[]" value="'+idinsumo+'">'+insumo+'</td><td><input type="number" name="pl[]" value="'+pl+'"></td><td><input type="number" name="no_unidades[]" value="'+no_unidades+'"></td><td><input type="number" name="unidad_medida[]" value="'+unidad_medida+'"></td><td><input type="number" name="peso_total[]" value="'+peso_total+'"></td></tr>';
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