// Script para abri modal para editar subtareas
(function(){
    $(document).ready(function () {
        // Abre modal al dar click en boton
        $('#btnEditSubtask').click(function () {
            $('#editSubtaskModal').modal('show');
        }
        );
    }
    );
})();