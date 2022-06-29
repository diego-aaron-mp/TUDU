// Script para abri modal para editar tareas y subtareas
(function () {
    $(document).ready(function () {
        // Abre modal al dar click en boton
        $('#btnEditTask').click(function () {
            $('#editTaskModal').modal('show');
        });
    });

    // Abrir modal de editar nota
    $('#btnEditNote').click(function () {
        $('#editModalNote').modal('show');
    }
    );

    $(document).on('click', '#btnDeleteNote', function () {
       // Buscar el id por el name del boton
        var idNota = $(this).attr('name');

        // Recortar la cadena "nota?" de idNota
        idNota = idNota.substring(5);

        // Redireccionar a eliminarNota.php
        window.location.href = 'eliminarNota.php?idnota=' + idNota;
        idNota = '';

    });

})();  