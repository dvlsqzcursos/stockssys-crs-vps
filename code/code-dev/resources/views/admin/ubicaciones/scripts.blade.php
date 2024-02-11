<script type="text/javascript">
    $('body').on('click', '#formularioEditar', function (event) {
        
        event.preventDefault();
        var id = $(this).data('id');
        console.log(id);

        $.get('/admin/ubicacion/' + id + '/editar', function (data) {
            $('#id').val(data.ubicacion.id);
            $('#nombre').val(data.ubicacion.nombre);
     })

    });
</script>
