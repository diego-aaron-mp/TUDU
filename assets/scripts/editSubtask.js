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
        $('#divTasks').load('./verTareas.php?lista=' + idList);

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

        // Crear Nota
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

        // Crear Tarea
        // Al dar click en btnSubmitTask
        $('#btnSubmitTask').click(function () {
            // Eliminar espacios en blanco de los campos
            inputTaskTitle.value = inputTaskTitle.value.trim();
            inputTaskDescription.value = inputTaskDescription.value.trim();

            // Validar el titulo de la tarea
            if (inputTaskTitle.value.length < 1) {
                inputTaskTitle.classList.add('is-invalid');
                inputTaskTitle.classList.remove('is-valid');
            } else {
                inputTaskTitle.classList.add('is-valid');
                inputTaskTitle.classList.remove('is-invalid');
            } 
            // Validar la descripcion de la tarea
            if (inputTaskDescription.value.length < 1) {
                inputTaskDescription.classList.add('is-invalid');
                inputTaskDescription.classList.remove('is-valid');
            }
            else {
                inputTaskDescription.classList.add('is-valid');
                inputTaskDescription.classList.remove('is-invalid');
            }

            // Enviar formulario si todos los campos son validos
            if (inputTaskTitle.classList.contains('is-valid') && inputTaskDescription.classList.contains('is-valid')) {
                // Remover las clases de validacion
                inputTaskTitle.classList.remove('is-valid');
                inputTaskTitle.classList.remove('is-invalid');
                inputTaskDescription.classList.remove('is-valid');
                inputTaskDescription.classList.remove('is-invalid');

                // Redireccionar a crearTarea.php con ajax
                $.ajax({
                    url: './crearTarea.php',
                    type: 'POST',
                    data: {
                        idList: idList,
                        inputTaskTitle: inputTaskTitle.value,
                        inputTaskDescription: inputTaskDescription.value
                    },
                    // Mostrar las tareas del usuario
                    success: function (response) {
                        $('#divTasks').load('./verTareas.php?lista=' + idList);
                        // Limpiar campos
                        inputTaskTitle.value = '';
                        inputTaskDescription.value = '';
                    }
                });
            }
        });


        // Editar objetivo
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

    // Editar tarea
    $(document).on('click', '#btnEditTask', function () {
        // Obtener los valores de los campos ocultos
        var idTask = $(this).attr('name');
        
        // Recortar "tarea?" de la cadena
        idTask = idTask.substring(6);

        // Consulta sql para obtener los datos de la tarea
        $.ajax({
            url: './obtenerTarea.php',
            type: 'POST',
            data: {
                idTask: idTask
            },
            success: function (response) {
                // Obtener los datos de la tarea
                var task = JSON.parse(response);

                // Mostrar los datos en los campos del formulario
                $('#inputEditTitleTask').val(task.title.trim());
                $('#inputEditTaskDescription').val(task.description.trim());
                // Mostrar el modal
                $('#editTaskModal').modal('show');
            }
        });
        
        // Abrir modal de editar tarea
        // $('#editTaskModal').modal('show');


        // Mostrar los datos en los inputs
        // editTaskTitle = $('#editTaskTitle');
        // editTaskDescription = $('#editTaskDescription');

    });


    // Eliminar nota al dar click en boton
    $(document).on('click', '#btnDeleteNote', function () {
        var idNota = $(this).attr('name');

        // Recortar la cadena "nota?"
        idNota = idNota.substring(5);

        $.ajax({
            url: './eliminarNota.php?idNota=' + idNota,
            type: 'GET',
            data: {
                idNota: idNota
            },
            // Mostrar las notas del usuario
            success: function (response) {
                $('#divNotes').load('./verNotas.php?lista=' + idList);
                idNota = '';
            }
        });
    }
    );

})();