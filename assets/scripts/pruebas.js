// Script para ver fraseModal al dar clic en btnFrase
(function(){
    $(document).ready(function () {
        // Abre modal al dar click en boton
        $('#btnFrase').click(function () {
            $('#fraseModal').modal('show');
        }
        );

        // Abrie el modal deleteListModal al cargar la pagina
    $('#deleteListModal').modal('show');
    }
    );

    // Cierra modal al dar click en boton
    $('#btnCloseFraseModal').click(function () {
        $('#fraseModal').modal('hide');
    }
    );

    // Abrir el modal del consejo
    $('#btnConsejo').click(function () {
       $('#consejoModal').modal('show'); 
    });

    // Abrir el modal para agregar subtareas
    $('#btnAddSubtask').click(function () {
        $('#addSubtaskModal').modal('show');
    }
    );

    


}
)();