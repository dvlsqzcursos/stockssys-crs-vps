const http = new XMLHttpRequest();
const csrfToken = document.getElementsByName('csrf-token')[0].getAttribute('content');
var base = location.protocol+'//'+location.host;
var route = document.getElementsByName('routeName')[0].getAttribute('content');

window.onload = function(){
    loader.style.display = 'none'
}

document.addEventListener('DOMContentLoaded', function(){
    

    btn_eliminar = document.getElementsByClassName('btn-eliminar');
    btn_detalle = document.getElementsByClassName('btn-detalle');
    var btn_generar_usuario = document.getElementById('btn_generar_usuario');
    var btn_buscar_escuelas_despacho = document.getElementById('btn_buscar_escuelas_despacho');
    var btn_buscar_socios_solicitudes_despacho = document.getElementById('btn_buscar_socios_solicitudes_despacho');
    var btn_buscar_socio_solicitudes_despacho = document.getElementById('btn_buscar_socio_solicitudes_despacho');

    if(route == 'bodega_socio_egresos'){
        plsSociosInsumosDisponibles();
        //var msg_det_escuelas = document.getElementById('div-msg-det-escuelas');
        //msg_det_escuelas.hidden = false;
        //var res_det_escuelas = document.getElementById('div-res-det-escuelas'); 
        //res_det_escuelas.hidden = true;
    }

    if(route == 'bodega_principal_egresos'){
        plsPrincipalInsumosDisponibles();
        var msg_det_escuelas = document.getElementById('div-msg-det-escuelas');
        msg_det_escuelas.hidden = false;
        var res_det_escuelas = document.getElementById('div-res-det-escuelas');
        res_det_escuelas.hidden = true;
    }
    

    for(i=0; i < btn_eliminar.length; i++){
        btn_eliminar[i].addEventListener('click', delete_object);
    }

    for(i=0; i < btn_detalle.length; i++){
        btn_detalle[i].addEventListener('click', detalle_object);
        
    }

    if(btn_generar_usuario){
        btn_generar_usuario.addEventListener('click', function(e){
            e.preventDefault();
            setGenerarUsuario();
        });
    } 

    if(btn_buscar_escuelas_despacho){
        btn_buscar_escuelas_despacho.addEventListener('click', function(e){
            e.preventDefault();
            obtenerEscuelas();
        });
    }

    if(btn_buscar_socios_solicitudes_despacho){
        btn_buscar_socios_solicitudes_despacho.addEventListener('click', function(e){
            e.preventDefault();
            obtenerSociosSolicitudes();
        });
    }

    if(btn_buscar_socio_solicitudes_despacho){
        btn_buscar_socio_solicitudes_despacho.addEventListener('click', function(e){
            e.preventDefault();
            obtenerSociosSolicitudesDespacho();
        });
    }

    

    
    $('#tabla').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        language: {
            "decimal": "",
            "emptyTable": "No hay registros",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Registros",
            "infoEmpty": "Mostrando 0 to 0 of 0 Registros",
            "infoFiltered": "(Filtrado de _MAX_ total registros)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Registros",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
    });     

    $('#tabla-carga-datos').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        scrollX: true,
        "autoWidth": false,
        "columnDefs": [
            {"className": "dt-center", "targets": "_all"},
          {
            targets: 1,
            width: 1,
          }
        ],
        language: {
            "decimal": "",
            "emptyTable": "No hay registros",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Registros",
            "infoEmpty": "Mostrando 0 to 0 of 0 Registros",
            "infoFiltered": "(Filtrado de _MAX_ total registros)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Registros",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
    });     
 
    
    $("#id_ubicacion").select2({
        placeholder: "Seleccione una Opción",
        allowClear: true
    });

    $("#id_institucion").select2({
        placeholder: "Seleccione una Opción",
        allowClear: true
    });

    $("#id_escuela").select2({
        placeholder: "Seleccione una Opción",
        allowClear: true
    });

    $("#id_solicitud").select2({
        placeholder: "Seleccione una Opción",
        allowClear: true
    });

    $("#rol").select2({
        placeholder: "Seleccione una Opción",
        allowClear: true
    });

    $("#idinsumo").select2({
        placeholder: "Seleccione una Opción",
        allowClear: true
    });

    $("#idinsumoEgresos").select2({
        placeholder: "Seleccione una Opción",
        allowClear: true
    });
    
    $("#idEntrega").select2({
        placeholder: "Seleccione una Opción",
        allowClear: true
    });

    $("#pl_disponible").select2({
        placeholder: "Seleccione una Opción",
        allowClear: true
    });

    $("#id_unidad_medida").select2({
        placeholder: "Seleccione una Opción",
        allowClear: true
    });

    $("#id_socio").select2({
        placeholder: "Seleccione una Opción",
        allowClear: true
    });

    $("#tipo_racion").select2({
        placeholder: "Seleccione una Opción",
        allowClear: true
    }); 

    $("#id_bodega_despacho").select2({
        placeholder: "Seleccione una Opción",
        allowClear: true
    });

    $(document).on('click', '.dropdown-menu', function (e) {
        e.stopPropagation();
      });
      
      // make it as accordion for smaller screens
      if ($(window).width() < 992) {
        $('.dropdown-menu a').click(function(e){
          e.preventDefault();
            if($(this).next('.submenu').length){
              $(this).next('.submenu').toggle();
            }
            $('.dropdown').on('hide.bs.dropdown', function () {
           $(this).find('.submenu').hide();
        })
        });
      }


    

});

function delete_object(e){
    e.preventDefault();
    var object = this.getAttribute('data-object');
    var action = this.getAttribute('data-action');
    var path = this.getAttribute('data-path');     
    var url = base + '/' + path + '/' + object + '/' + action;
    var url1 = base + '/' + path + '/' + action;
    var title, text, icon;

    var contra_prede = document.getElementById('contra_prede');
    var pin_prede = document.getElementById('pin_prede');

    //console.log(url);

    if(action == "eliminar"){
        title = "¿Esta seguro de eliminar este elemento?";
        text = "Recuerde que esta acción enviara este elemento a la papelera o lo eliminara de forma definitiva.";
        icon = "warning";
    
        Swal.fire({
            title: title,
            text: text,
            icon: icon,
            showCancelButton: true,
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#22B81C',
            cancelButtonColor: '#CC2D04',
        }).then((result) =>{
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }else if(action == "rest-contra"){
        title = "¿Esta seguro de restablecer la Contraseña de Inicio de Sesión a este usuario?";
        text = "Si acepta la contraseña sera: "+contra_prede.value;
        icon = "warning";
    
        Swal.fire({
            title: title,
            text: text,
            icon: icon,
            showCancelButton: true,
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#22B81C',
            cancelButtonColor: '#CC2D04',
        }).then((result) =>{
            if (result.isConfirmed) {
                //console.log(url);
                window.location.href = url;
            }
        });
    }else if(action == "rest-pin"){
        title = "¿Esta seguro de restablecer el Pin de Autorizaciones a este usuario?";
        text = "Si acepta el pin sera: "+pin_prede.value;
        icon = "warning";
    
        Swal.fire({
            title: title,
            text: text,
            icon: icon,
            showCancelButton: true,
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#22B81C',
            cancelButtonColor: '#CC2D04',
        }).then((result) =>{
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }else if(action == "egresos"){
        title = "¿Que tipo de egreso desea realizar?";
        text = " "
        icon = "warning";
    
        Swal.fire({
            title: title,
            text: text,
            icon: icon,
            showCancelButton: true,
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Alimentos",
            denyButtonText: "Otros Insumos",
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#85c1e9',
            denyButtonColor: '  #85929e',
            cancelButtonColor: '#CC2D04',
        }).then((result) =>{
            if (result.isConfirmed) {
                //console.log(url1+'/alimentos');
                window.location.href =url1+'/alimentos';
            } else if (result.isDenied) {
                //console.log(url1+'/otros_insumos');
                window.location.href =url1+'/otros_insumos';
            }
        });
    }else if(action == "ingresos"){
        title = "¿Que tipo de ingreso desea realizar?";
        text = ""
        icon = "warning";
    
        Swal.fire({
            title: title,
            text: text,
            icon: icon,
            showCancelButton: true,
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Alimentos",
            denyButtonText: "Otros Insumos",
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#85c1e9',
            denyButtonColor: '  #85929e',
            cancelButtonColor: '#CC2D04',
        }).then((result) =>{
            if (result.isConfirmed) {
                //console.log(url1+'/alimentos');
                window.location.href =url1+'/alimentos';
            } else if (result.isDenied) {
                //console.log(url1+'/otros_insumos');
                window.location.href =url1+'/otros_insumos';
            }
        });
    }else if(action == "movimientos"){
        title = "¿Que tipo de movimientos desea visualizar?";
        text = ""
        icon = "warning";
    
        Swal.fire({
            title: title,
            text: text,
            icon: icon,
            showCancelButton: true,
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Ingresos",
            denyButtonText: "Egresos",
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#85c1e9',
            denyButtonColor: '  #85929e',
            cancelButtonColor: '#CC2D04',
        }).then((result) =>{
            if (result.isConfirmed) {
                //console.log(url1+'/alimentos');
                window.location.href =url1+'/ingresos';
            } else if (result.isDenied) {
                //console.log(url1+'/otros_insumos');
                window.location.href =url1+'/egresos';
            }
        });
    }else if(action == "aceptar"){
        title = "¿Esta seguro de aceptar la solicitud de insumo de socios?";
        text = "Si acepta podra utilizar la solicitud para realizar despachos al socio ";
        icon = "warning";
    
        Swal.fire({
            title: title,
            text: text,
            icon: icon,
            showCancelButton: true,
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#22B81C',
            cancelButtonColor: '#CC2D04',
        }).then((result) =>{
            if (result.isConfirmed) {
                //console.log(url);
                window.location.href = url;
            }
        });
    }
    else if(action == "rechazar"){
        title = "¿Esta seguro de rechazar la solicitud de insumo de socios?";
        text = "Si rechaza no podra utilizar la solicitud para realizar despachos al socio ";
        icon = "warning";
    
        Swal.fire({
            title: title,
            text: text,
            icon: icon,
            showCancelButton: true,
            confirmButtonText: 'Rechazar',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#22B81C',
            cancelButtonColor: '#CC2D04',
        }).then((result) =>{
            if (result.isConfirmed) {
                //console.log(url);
                window.location.href = url;
            }
        });
    }



}

function setGenerarUsuario(){
    var p_nombre = document.getElementById('p_nombre');
    var s_nombre  = document.getElementById('s_nombre');
    var p_apellido = document.getElementById('p_apellido');
    var frm_usuario = document.getElementById('frm_usuario');

    var seg_nombre = s_nombre.value;
    var inicial_seg_nombre = seg_nombre.charAt(0);

    var usuario = p_nombre.value+'.'+p_apellido.value;

    var usuario_opcional = p_nombre.value + inicial_seg_nombre + '.' + p_apellido.value;

    frm_usuario.value = usuario.toLowerCase();

    //console.log(usuario_opcional.toLowerCase());


}

function obtenerEscuelas(){   
    var id_solicitud = document.getElementById('id_solicitud').value;    
    select = document.getElementById('id_escuela');
    select.innerHTML = "";
    //var url = base + '/agem/public/admin/agem/api/load/studies/'+exam;
    var url = base + '/stocksys/api/escuelas/'+id_solicitud;
    http.open('GET', url, true);
    http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    http.send();
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            var data = this.responseText;
            data = JSON.parse(data);            

            if('escuelas' in data){ 
                for(i=0; i<data.escuelas.length; i++){
                    select.innerHTML += "<option value=\""+data.escuelas[i].escuela.id+"\" selected>"+data.escuelas[i].escuela.codigo+" / "+data.escuelas[i].escuela.nombre+"</option>";
                }

            }

             

        }
    }

    var escuela=document.getElementById('id_escuela');
    //var msg_det_escuelas = document.getElementById('div-msg-det-escuelas');
    //var res_det_escuelas = document.getElementById('div-res-det-escuelas');

    $('#id_escuela').change(function(){        
        
        if(escuela.value){              
            //msg_det_escuelas.hidden = true;
            //res_det_escuelas.hidden = false;
            RacionesEscuelaSolicitud(id_solicitud, escuela.value);
            //cálculosEscuelasSolicitud(id_solicitud, escuela.value)
        }else{
            //msg_det_escuelas.hidden = false;
            //res_det_escuelas.hidden = true;  
        }
       


    });

    
}

function obtenerSociosSolicitudes(){
    var id_socio = document.getElementById('id_socio').value;    
    select = document.getElementById('id_solicitud');
    select.innerHTML = "";
    //var url = base + '/agem/public/admin/agem/api/load/studies/'+exam;
    var url = base + '/stocksys/api/solicitudes/socios/'+id_socio;
    http.open('GET', url, true);
    http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    http.send();
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            var data = this.responseText;
            data = JSON.parse(data);            

            if('solicitudes' in data){ 
                for(i=0; i<data.solicitudes.length; i++){
                    select.innerHTML += "<option value=\""+data.solicitudes[i].id+"\" selected>"+"No."+data.solicitudes[i].id+"- Fecha: "+data.solicitudes[i].fecha+"</option>";
                }

            }

            

        }
    }    
}

function obtenerSociosSolicitudesDespacho(){
    var id_socio = document.getElementById('id_socio').value;    
    select = document.getElementById('id_solicitud');
    select.innerHTML = "";
    //var url = base + '/agem/public/admin/agem/api/load/studies/'+exam;
    var url = base + '/stocksys/api/solicitudes_despacho/socios/'+id_socio;
    http.open('GET', url, true);
    http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    http.send();
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            var data = this.responseText;
            data = JSON.parse(data);        

            if('solicitudes' in data){ 
                for(i=0; i<data.solicitudes.length; i++){
                    select.innerHTML += "<option value=\""+data.solicitudes[i].id+"\" selected>"+"No."+data.solicitudes[i].id+"</option>";
                }

            }

            

        }
    }    
}

function RacionesEscuelaSolicitud(solicitud, escuela){
    select = document.getElementById('tipo_racion');
    select.innerHTML = "";
    var url = base + '/stocksys/api/bodega_socio/solicitud_id/'+solicitud+'/escuela/'+escuela+'/raciones';
    http.open('GET', url, true);
    http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    http.send();
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            var data = this.responseText;
            data = JSON.parse(data);

            if('raciones' in data){ 
                for(i=0; i<data.raciones.length; i++){
                    select.innerHTML += "<option value=\""+data.raciones[i].id+"\" selected>"+data.raciones[i].nombre+"</option>";
                }

            }
        }
    }  
}

function cálculosEscuelasSolicitud(solicitud, escuela){
    var url = base + '/stocksys/api/escuelas/pesos/solicitud/'+solicitud+'/'+escuela;
    http.open('GET', url, true);
    http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    http.send();
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            var data = this.responseText;
            data = JSON.parse(data);            

            //data.forEach(function(element){
                //console.log(element);
            //});

            
        }
    }
}

function plsSociosInsumosDisponibles(){
    var tipo_egreso = document.getElementById('tipo_egreso');
    console.log(tipo_egreso.value);
        
    


    if(tipo_egreso.value == 0){
        select1 = document.getElementById('pl_disponible');    
        select1.innerHTML = "";   
        var no_unidades_disponibles = document.getElementById('no_unidades_disponibles');     
    
        $('#idinsumoEgresos').change(function(){
            select1.innerHTML = "";
            no_unidades_disponibles.value = "";
            var alimento = document.getElementById('idinsumoEgresos').value;      
            var url = base + '/stocksys/api/bodega_socio/insumo/pl_disponibles/'+alimento;
            http.open('GET', url, true);
            http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
            http.send();
            http.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    var data = this.responseText;
                    data = JSON.parse(data);
                    if('pls' in data){ 
                        for(i=0; i<data.pls.length; i++){
                            select1.innerHTML += "<option value=\""+data.pls[i].pl+"\" selected>"+data.pls[i].pl+"</option>";
                        }    
                    }
                }
            }    
        });

        $('#pl_disponible').change(function(){
            var pl = document.getElementById('pl_disponible').value; 
            var url1 = base + '/stocksys/api/bodega_socio/insumo/pl/saldo_disponible/'+pl;
            http.open('GET', url1, true);
            http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
            http.send();
            http.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    var data = this.responseText;
                    data = JSON.parse(data);
                    if('saldo' in data){ 
                        no_unidades_disponibles.value = data.saldo.saldo_disponible;
                    }
                }
            }    
        });
    }else if(tipo_egreso.value == 1){
        var no_unidades_disponibles = document.getElementById('no_unidades_disponibles');
        $('#idinsumoEgresos').change(function(){
            
            no_unidades_disponibles.value = "";
            var insumo = document.getElementById('idinsumoEgresos').value;      
            var url = base + '/stocksys/api/bodega_socio/insumo/disponibles/'+insumo;
            http.open('GET', url, true);
            http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
            http.send();
            http.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    var data = this.responseText;
                    data = JSON.parse(data);
                    if('saldo' in data){ 
                        no_unidades_disponibles.value = data.saldo.saldo_disponible;
                    }
                }
            }    
        });
    }

    
    

}

function plsPrincipalInsumosDisponibles(){
        
    var no_unidades_disponibles = document.getElementById('no_unidades_disponibles'); 
    var bubd_pl = document.getElementById('bubd'); 
    select1 = document.getElementById('pl_disponible');    
    select1.innerHTML = "";   
    
    $('#idinsumoEgresos').change(function(){
        select1.innerHTML = "";
        no_unidades_disponibles.value = "";
        var alimento = document.getElementById('idinsumoEgresos').value;      
        var url = base + '/stocksys/api/bodega_principal/insumo/pl_disponibles/'+alimento;
        http.open('GET', url, true);
        http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
        http.send();
        http.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                var data = this.responseText;
                data = JSON.parse(data);
                if('pls' in data){ 
                    for(i=0; i<data.pls.length; i++){
                        select1.innerHTML += "<option value=\""+data.pls[i].pl+"\" selected>"+data.pls[i].pl+"</option>";
                    }    
                }
            }
        }    
    });


    $('#pl_disponible').change(function(){
        var pl = document.getElementById('pl_disponible').value; 
        var url1 = base + '/stocksys/api/bodega_principal/insumo/pl/saldo_disponible/'+pl;
        http.open('GET', url1, true);
        http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
        http.send();
        http.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                var data = this.responseText;
                data = JSON.parse(data);
                if('saldo' in data){ 
                    bubd_pl.value = data.saldo.bubd;
                    no_unidades_disponibles.value = data.saldo.saldo_disponible;
                }
            }
        }    
    });
    

}



