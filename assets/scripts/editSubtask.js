// Script para abri modal para editar subtareas
(function () {
    // Variables
    var inputNoteTitle = document.getElementById('inputNoteTitle'),
        inputNoteDescription = document.getElementById('inputNoteDescription'),
        inputTitle = document.getElementById('inputTitle'),
        inputObjective = document.getElementById('inputObjective');

    // Obtener el id de la lista a travers de la url
    var url = new URL(window.location.href);
    var idList = url.searchParams.get("lista");

    $(document).ready(function () {

        $('#divNotes').load('./verNotas.php?lista=' + idList);

        // Abre modal al dar click en boton
        $('#btnEditSubtask').click(function () {
            $('#editSubtaskModal').modal('show');
        }
        );

        // Abre modal de editar objtivo al dar click en boton
        $('#btnEditObjective').click(function () {
            $('#editModalObjective').modal('show');
            // Mostrar datos en inputs
            inputTitle.value = $('#listTitle').text().trim();
            inputObjective.value = $('#listObjective').text().trim();
        });

        // Cerrar el modal al dar click en btnCloseModalObjective
        $('#btnCloseModalObjective').click(function () {
            $('#editModalObjective').modal('hide');
        });

        // Al dar click en btnSubmitNote
        $('#btnSubmitNote').click(function () {
            // Eliminar espacios en blanco de los campos
            inputNoteTitle.value = inputNoteTitle.value.trim();
            inputNoteDescription.value = inputNoteDescription.value.trim();

            // Validar el titulo de la nota
            if (inputNoteTitle.value.length < 1) {
                inputNoteTitle.classList.add('is-invalid');
                inputNoteTitle.classList.remove('is-valid');
            } else {
                inputNoteTitle.classList.add('is-valid');
                inputNoteTitle.classList.remove('is-invalid');
            }

            // Validar la descripcion de la nota
            if (inputNoteDescription.value.length < 1) {
                inputNoteDescription.classList.add('is-invalid');
                inputNoteDescription.classList.remove('is-valid');
            } else {
                inputNoteDescription.classList.add('is-valid');
                inputNoteDescription.classList.remove('is-invalid');
            }

            // Enviar formulario si todos los campos son validos
            if (inputNoteTitle.classList.contains('is-valid') && inputNoteDescription.classList.contains('is-valid')) {
                // Remover las clases de validacion
                inputNoteTitle.classList.remove('is-valid');
                inputNoteTitle.classList.remove('is-invalid');
                inputNoteDescription.classList.remove('is-valid');
                inputNoteDescription.classList.remove('is-invalid');

                // Redireccionar a crearNota.php con ajax
                $.ajax({
                    url: './crearNota.php',
                    type: 'POST',
                    data: {
                        idList: idList,
                        inputNoteTitle: inputNoteTitle.value,
                        inputNoteDescription: inputNoteDescription.value
                    },
                    // Mostrar las notas del usuario
                    success: function (response) {
                        $('#divNotes').load('./verNotas.php?lista=' + idList);
                        // Limpiar campos
                        inputNoteTitle.value = '';
                        inputNoteDescription.value = '';
                    }
                });
            }
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
                $.ajax({
                    url: './editarObjetivo.php',
                    type: 'POST',
                    data: {
                        idList: idList,
                        inputTitle: inputTitle.value,
                        inputObjective: inputObjective.value
                    },
                    // Mostrar los nuevos datos en el HTML
                    success: function (response) {
                        $('#listTitle').text(inputTitle.value);
                        $('#listObjective').text(inputObjective.value);
                        $('#editModalObjective').modal('hide');
                        inputTitle.value = '';
                        inputObjective.value = '';

                        // Quitar clases de validacion
                        inputTitle.classList.remove('is-valid');
                        inputTitle.classList.remove('is-invalid');
                        inputObjective.classList.remove('is-valid');
                        inputObjective.classList.remove('is-invalid');
                    }
                });
            }


        });

    }
    );

    $(document).on('click', '#btnDeleteNote', function () {
        var idNota = $(this).attr('name');

        // Recortar la cadena "nota?"
        idNota = idNota.substring(5);

        $.ajax({
            url: './eliminarNota.php',
            type: 'GET',
            data: {
                idNota: idNota
            },
            // Mostrar las notas del usuario
            success: function (response) {
                // $('#divNotes').load('./verNotas.php?lista=' + idList);
                idNota = '';
            }
        });
    }
    );
})();