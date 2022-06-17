// Script para abrir modal para crear lista
(function () {
    // Variables
    var listName = document.getElementById('inputListName'),
        listObjective = document.getElementById('inputObjective');

    $(document).ready(function () {
        //   Abrir modal al dar click en boton
        $('#btnCreateList').click(function () {
            $('#createListModal').modal('show');
        });

        // Cerrar modal al dar click en boton
        $('#btnCloseCreateList').click(function () {
            $('#createListModal').modal('hide');
        });

        // Validar formulario al dar click en boton btnSubmitCreateList
        $('#btnSubmitCreateList').click(function () {
            // Eliminar espacios en blanco de los campos
            listName.value = listName.value.trim();
            listObjective.value = listObjective.value.trim();

            // Validar el nombre de la lista
            if (listName.value.length < 1) {
                listName.classList.add('is-invalid');
                listName.classList.remove('is-valid');
            } else {
                listName.classList.add('is-valid');
                listName.classList.remove('is-invalid');
            }

            // Validar el objetivo de la lista
            if (listObjective.value.length < 1) {
                listObjective.classList.add('is-invalid');
                listObjective.classList.remove('is-valid');
            } else {
                listObjective.classList.add('is-valid');
                listObjective.classList.remove('is-invalid');
            }

            // Enviar formulario si todos los campos son validos
            if (listName.classList.contains('is-valid') && listObjective.classList.contains('is-valid')) {
                // Redireccionar a crearLista.php
                window.location.href = 'crearLista.php?name=' + listName.value + '&objective=' + listObjective.value;
                // Limpiar campos
                listName.value = '';
                listObjective.value = '';

                // Quitar clases de validacion
                listName.classList.remove('is-valid');
                listName.classList.remove('is-invalid');
                listObjective.classList.remove('is-valid');
                listObjective.classList.remove('is-invalid');

            }

        });

    });
})();