// Script para abri modal para editar tareas y subtareas
(function(){
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

}());