// Script para abrir modal para crear lista
(function () {
    // Variables
    var listName = document.getElementById('inputListName'),
        listGoal = document.getElementById('inputGoal');

    $(document).ready(function () {
        // Mostrar verListas.php en #divLists
        $('#divLists').load('./verListas.php');

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
            listGoal.value = listGoal.value.trim();

            // Validar el nombre de la lista
            if (listName.value.length < 1) {
                listName.classList.add('is-invalid');
                listName.classList.remove('is-valid');
            } else {
                listName.classList.add('is-valid');
                listName.classList.remove('is-invalid');
            }

            // Validar el objetivo de la lista
            if (listGoal.value.length < 1) {
                listGoal.classList.add('is-invalid');
                listGoal.classList.remove('is-valid');
            } else {
                listGoal.classList.add('is-valid');
                listGoal.classList.remove('is-invalid');
            }

            // Enviar formulario si todos los campos son validos
            if (listName.classList.contains('is-valid') && listGoal.classList.contains('is-valid')) {
                // Redireccionar a crearLista.php con ajax
                $.ajax({
                    url: './crearLista.php',
                    type: 'POST',
                    data: {
                        listName: listName.value,
                        listGoal: listGoal.value
                    },
                    // Mostrar las listas del usuario
                    success: function (response) {
                        $('#createListModal').modal('hide');
                        $('#divLists').load('./verListas.php');
                        // Limpiar campos
                        listName.value = '';
                        listGoal.value = '';

                        // Quitar clases de validacion
                        listName.classList.remove('is-valid');
                        listName.classList.remove('is-invalid');
                        listGoal.classList.remove('is-valid');
                        listGoal.classList.remove('is-invalid');
                    }

                });
            }

        });

    });

    $(document).on('click', '#btnEliminarLista', function () {
        // Buscar el id por el name del boton
        var idLista = $(this).attr('name');

        // Recortar la cadena "lista?" de idLista
        idLista = idLista.substring(6);

        // Abrir modal al dar click en boton
        $('#deleteListModal').modal('show');

        // Si da click en el boton btnSubmitDeleteList
        $('#btnSubmitDeleteList').click(function () {
            // Redireccionar a eliminarLista con ajax
            $.ajax({
                url: './eliminarLista.php',
                type: 'POST',
                data: {
                    idLista: idLista
                },
                // Mostrar las listas del usuario
                success: function (response) {
                    $('#deleteListModal').modal('hide');
                    $('#divLists').load('./verListas.php');
                    idLista = '';
                }
            });
        });

        // Limpiar el id al cerrar el modal
        $('#deleteListModal').on('hidden.bs.modal', function () {
            idLista = '';
        });

        // Cerrar el modal al dar click en boton btnCloseDeleteList
        $('#btnCloseDeleteList').click(function () {
            $('#deleteListModal').modal('hide', function () {
                idLista = '';
            });
        });
    });


})();