<script>
    $(document).ready(function(){

        var desgloce = document.getElementById('desgloce');



        var total_beneficiarios = document.getElementById('div-total-beneficiarios');
        total_beneficiarios.hidden = false;

        var desgloce_beneficiarios_niños_pre = document.getElementById('div-beneficiarios-desgloce-niños-pre');
        desgloce_beneficiarios_niños_pre.hidden = true;

        var desgloce_beneficiarios_niñas_pre = document.getElementById('div-beneficiarios-desgloce-niñas-pre');
        desgloce_beneficiarios_niñas_pre.hidden = true;

        var desgloce_beneficiarios_niños_pri = document.getElementById('div-beneficiarios-desgloce-niños-pri');
        desgloce_beneficiarios_niños_pri.hidden = true;

        var desgloce_beneficiarios_niñas_pri = document.getElementById('div-beneficiarios-desgloce-niñas-pri');
        desgloce_beneficiarios_niñas_pri.hidden = true;

        $('#desgloce').change(function(){

            if(desgloce.value  == 0){
                total_beneficiarios.hidden = false;
            }else{
                total_beneficiarios.hidden = true;
            }

            if(desgloce.value  == 1){
                desgloce_beneficiarios_niños_pre.hidden = false;
                desgloce_beneficiarios_niñas_pre.hidden = false;
                desgloce_beneficiarios_niños_pri.hidden = false;
                desgloce_beneficiarios_niñas_pri.hidden = false;
            }else{
                desgloce_beneficiarios_niños_pre.hidden = true;
                desgloce_beneficiarios_niñas_pre.hidden = true;
                desgloce_beneficiarios_niños_pri.hidden = true;
                desgloce_beneficiarios_niñas_pri.hidden = true;
            }


        });
    });




</script>