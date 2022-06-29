// Script para abrir modal de editar objetivo
(function(){
    // Variables
    var inputTitle = document.getElementById('inputTitle'),
        inputObjective = document.getElementById('inputObjective');

    $(document).ready(function () {
        
        // Abre modal al dar click en boton
        $('#btnEditObjective').click(function () {
            $('#editModalObjective').modal('show');
        });


        // Validar el formulario al dar click en boton btnSubmitEditObjective
        $('#btnSubmitEditObjective').click(function () {
            // Eliminar espacios en blanco de los campos
            inputTitle.value = inputTitle.value.trim();
            inputObjective.value = inputObjective.value.trim();

            // Validar el titulo del objetivo
            if (inputTitle.value.length < 1) {
                inputTitle.classList.add('is-invalid');
                inputTitle.classList.remove('is-valid');
            } else {
                inputTitle.classList.add('is-valid');
                inputTitle.classList.remove('is-invalid');
            }

            // Validar el objetivo del objetivo
            if (inputObjective.value.length < 1) {
                inputObjective.classList.add('is-invalid');
                inputObjective.classList.remove('is-valid');
            }
            else {
                inputObjective.classList.add('is-valid');
                inputObjective.classList.remove('is-invalid');
            }

            // Enviar formulario si todos los campos son validos
            if (inputTitle.classList.contains('is-valid') && inputObjective.classList.contains('is-valid')) {
                // Redireccionar a editObjective.php
                // window.location.href = 'editObjective.php?title=' + inputTitle.value + '&objective=' + inputObjective.value;
                // Limpiar campos
                inputTitle.value = '';
                inputObjective.value = '';

                // Quitar clases de validacion
                inputTitle.classList.remove('is-valid');
                inputTitle.classList.remove('is-invalid');
                inputObjective.classList.remove('is-valid');
                inputObjective.classList.remove('is-invalid');

            }


        });


    });
    


}());

