// Script para abri modal para editar subtareas
(function () {
    // Variables
    var inputNoteTitle = document.getElementById('inputNoteTitle'),
        inputNoteDescription = document.getElementById('inputNoteDescription'),
        inputTitle = document.getElementById('inputTitle'),
        inputGoal = document.getElementById('inputGoal');
    var idTask = '';

    // Obtener el id de la lista a travers de la url
    var url = new URL(window.location.href);
    var idList = url.searchParams.get("lista");

    $(document).ready(function () {

        $('#divNotes').load('./verNotas.php?lista=' + idList);
        $('#divTasks').load('./verTareas.php?lista=' + idList);

        // Abre modal de editar objtivo al dar click en boton
        $('#btnEditGoal').click(function () {
            $('#editModalGoal').modal('show');
            // Mostrar datos en inputs
            inputTitle.value = $('#listTitle').text().trim();
            inputGoal.value = $('#listGoal').text().trim();
        });

        // Cerrar el modal al dar click en btnCloseModalGoal
        $('#btnCloseModalGoal').click(function () {
            $('#editModalGoal').modal('hide');
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
        // Validar el formulario al dar click en boton btnSubmitEditGoal
        $('#btnSubmitEditGoal').click(function () {
            // Eliminar espacios en blanco de los campos
            inputTitle.value = inputTitle.value.trim();
            inputGoal.value = inputGoal.value.trim();

            // Validar el titulo del objetivo
            if (inputTitle.value.length < 1) {
                inputTitle.classList.add('is-invalid');
                inputTitle.classList.remove('is-valid');
            } else {
                inputTitle.classList.add('is-valid');
                inputTitle.classList.remove('is-invalid');
            }

            // Validar el objetivo del objetivo
            if (inputGoal.value.length < 1) {
                inputGoal.classList.add('is-invalid');
                inputGoal.classList.remove('is-valid');
            }
            else {
                inputGoal.classList.add('is-valid');
                inputGoal.classList.remove('is-invalid');
            }

            // Enviar formulario si todos los campos son validos
            if (inputTitle.classList.contains('is-valid') && inputGoal.classList.contains('is-valid')) {
                $.ajax({
                    url: './editarObjetivo.php',
                    type: 'POST',
                    data: {
                        idList: idList,
                        inputTitle: inputTitle.value,
                        inputGoal: inputGoal.value
                    },
                    // Mostrar los nuevos datos en el HTML
                    success: function (response) {
                        $('#listTitle').text(inputTitle.value);
                        $('#listGoal').text(inputGoal.value);
                        $('#editModalGoal').modal('hide');
                        inputTitle.value = '';
                        inputGoal.value = '';

                        // Quitar clases de validacion
                        inputTitle.classList.remove('is-valid');
                        inputTitle.classList.remove('is-invalid');
                        inputGoal.classList.remove('is-valid');
                        inputGoal.classList.remove('is-invalid');
                    }
                });
            }


        });


    }
    );

    // Editar tarea
    // Al dar click en boton btnEditTask
    $(document).on('click', '#btnEditTask', function () {
        // Obtener los valores de los campos ocultos
        idTask = $(this).attr('name');

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
        // Al dar click en boton btnSubmitEditTask
        $('#btnSubmitEditTask').click(function () {
            // Eliminar espacios en blanco de los campos
            inputEditTitleTask.value = inputEditTitleTask.value.trim();
            inputEditTaskDescription.value = inputEditTaskDescription.value.trim();

            // Validar el titulo de la tarea
            if (inputEditTitleTask.value.length < 1) {
                inputEditTitleTask.classList.add('is-invalid');
                inputEditTitleTask.classList.remove('is-valid');
            } else {
                inputEditTitleTask.classList.add('is-valid');
                inputEditTitleTask.classList.remove('is-invalid');
            }
            // Validar la descripcion de la tarea
            if (inputEditTaskDescription.value.length < 1) {
                inputEditTaskDescription.classList.add('is-invalid');
                inputEditTaskDescription.classList.remove('is-valid');
            }
            else {
                inputEditTaskDescription.classList.add('is-valid');
                inputEditTaskDescription.classList.remove('is-invalid');
            }

            // Enviar formulario si todos los campos son validos
            if (inputEditTitleTask.classList.contains('is-valid') && inputEditTaskDescription.classList.contains('is-valid')) {
                // Remover las clases de validacion
                inputEditTitleTask.classList.remove('is-valid');
                inputEditTitleTask.classList.remove('is-invalid');
                inputEditTaskDescription.classList.remove('is-valid');
                inputEditTaskDescription.classList.remove('is-invalid');

                // Redireccionar a editarTarea.php con ajax
                $.ajax({
                    url: './editarTarea.php',
                    type: 'POST',
                    data: {
                        idTask: idTask,
                        inputEditTitleTask: inputEditTitleTask.value,
                        inputEditTaskDescription: inputEditTaskDescription.value
                    },
                    // Mostrar las tareas del usuario
                    success: function (response) {
                        $('#divTasks').load('./verTareas.php?lista=' + idList);
                        // Limpiar campos
                        inputEditTitleTask.value = '';
                        inputEditTaskDescription.value = '';
                        idTask = '';

                        // Cerrar el modal
                        $('#editTaskModal').modal('hide', function () {
                            // Quitar clases de validacion
                            inputTaskTitle.classList.remove('is-valid');
                            inputTaskTitle.classList.remove('is-invalid');
                            inputTaskDescription.classList.remove('is-valid');
                            inputTaskDescription.classList.remove('is-invalid');
                            idTask = '';
                        });
                    }

                });
            }
        });

        $('#btnCloseEditTaskModal').click(function () {
            // Cerrar el modal
            $('#editTaskModal').modal('hide', function () {
                // Quitar clases de validacion
                inputTaskTitle.classList.remove('is-valid');
                inputTaskTitle.classList.remove('is-invalid');
                inputTaskDescription.classList.remove('is-valid');
                inputTaskDescription.classList.remove('is-invalid');
                idTask = '';
            });
        });

    });

    // Editar nota
    // Al dar click en boton btnEditNote
    $(document).on('click', '#btnEditNote', function () {
        // Obtener los valores de los campos ocultos
        idNote = $(this).attr('name');

        // Recortar "nota?" de la cadena
        idNote = idNote.substring(5);

        // Consulta sql para obtener los datos de la nota
        $.ajax({
            url: './obtenerNota.php',
            type: 'POST',
            data: {
                idNote: idNote
            },
            success: function (response) {
                // Obtener los datos de la nota
                var note = JSON.parse(response);

                // Mostrar los datos en los campos del formulario
                $('#inputEditTitleNote').val(note.title.trim());
                $('#inputEditDescriptionNote').val(note.description.trim());
                // Mostrar el modal
                $('#editModalNote').modal('show');
            }
        });
        // Al dar click en boton btnSubmitEditNote
        $('#btnSubmitEditNote').click(function () {
            // Eliminar espacios en blanco de los campos
            inputEditTitleNote.value = inputEditTitleNote.value.trim();
            inputEditDescriptionNote.value = inputEditDescriptionNote.value.trim();

            // Validar el titulo de la nota
            if (inputEditTitleNote.value.length < 1) {
                inputEditTitleNote.classList.add('is-invalid');
                inputEditTitleNote.classList.remove('is-valid');
            } else {
                inputEditTitleNote.classList.add('is-valid');
                inputEditTitleNote.classList.remove('is-invalid');
            }
            // Validar la descripcion de la nota
            if (inputEditDescriptionNote.value.length < 1) {
                inputEditDescriptionNote.classList.add('is-invalid');
                inputEditDescriptionNote.classList.remove('is-valid');
            }
            else {
                inputEditDescriptionNote.classList.add('is-valid');
                inputEditDescriptionNote.classList.remove('is-invalid');
            }

            // Enviar formulario si todos los campos son validos
            if (inputEditTitleNote.classList.contains('is-valid') && inputEditDescriptionNote.classList.contains('is-valid')) {
                // Remover las clases de validacion
                inputEditTitleNote.classList.remove('is-valid');
                inputEditTitleNote.classList.remove('is-invalid');
                inputEditDescriptionNote.classList.remove('is-valid');
                inputEditDescriptionNote.classList.remove('is-invalid');

                // Redireccionar a editarNota.php con ajax
                $.ajax({
                    url: './editarNota.php',
                    type: 'POST',
                    data: {
                        idNote: idNote,
                        inputEditTitleNote: inputEditTitleNote.value,
                        inputEditDescriptionNote: inputEditDescriptionNote.value
                    },
                    // Mostrar las notas del usuario
                    success: function (response) {
                        $('#divNotes').load('./verNotas.php?lista=' + idList);
                        // Limpiar campos
                        inputEditTitleNote.value = '';
                        inputEditDescriptionNote.value = '';
                        idNote = '';

                        // Cerrar el modal
                        $('#editModalNote').modal('hide', function () {
                            // Quitar clases de validacion
                            inputEditTitleNote.classList.remove('is-valid');
                            inputEditTitleNote.classList.remove('is-invalid');
                            inputEditDescriptionNote.classList.remove('is-valid');
                            inputEditDescriptionNote.classList.remove('is-invalid');
                            idNote = '';
                        });
                    }

                });
            }
        });

        $('#btnCloseEditNoteModal').click(function () {
            // Cerrar el modal
            $('#editModalNote').modal('hide', function () {
                // Quitar clases de validacion
                inputEditTitleNote.classList.remove('is-valid');
                inputEditTitleNote.classList.remove('is-invalid');
                inputEditDescriptionNote.classList.remove('is-valid');
                inputEditDescriptionNote.classList.remove('is-invalid');
                idNote = '';
            });
        });

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

    // Eliminar tarea al dar click en boton
    $(document).on('click', '#btnDeleteTask', function () {
        var idTarea = $(this).attr('name');

        // Recortar la cadena "tarea?"
        idTarea = idTarea.substring(6);

        $.ajax({
            url: './eliminarTarea.php?idTarea=' + idTarea,
            type: 'GET',
            data: {
                idTarea: idTarea
            },
            // Mostrar las tareas del usuario
            success: function (response) {
                $('#divTasks').load('./verTareas.php?lista=' + idList);
                idTarea = '';
            }
        });


    });

    // Abrir modal de agregar subtarea al dar click en boton btnAddSubtask
    $(document).on('click', '#btnAddSubtask', function () {
        // Obtener el id de la tarea
        idTask = $(this).attr('name');
        // Recortar la cadena "tarea?"
        idTask = idTask.substring(6);
        // Mostrar el modal
        $('#addSubtaskModal').modal('show');

        // Al dar click en btnSubmitAddTask
        $('#btnSubmitAddSubtask').click(function () {
            // Obtener el valor del campo inputAddSubtask
            var inputAddSubtask = document.getElementById('inputAddSubtask');

            // Eliminar espacios en blanco de los campos
            inputAddSubtask.value = inputAddSubtask.value.trim();
            // Validar el titulo de la tarea
            if (inputAddSubtask.value.length < 1) {
                inputAddSubtask.classList.add('is-invalid');
                inputAddSubtask.classList.remove('is-valid');
            } else {
                inputAddSubtask.classList.add('is-valid');
                inputAddSubtask.classList.remove('is-invalid');
            }
            // Enviar formulario si todos los campos son validos
            if (inputAddSubtask.classList.contains('is-valid')) {
                // Remover las clases de validacion
                inputAddSubtask.classList.remove('is-valid');
                inputAddSubtask.classList.remove('is-invalid');
                // Redireccionar a editarTarea.php con ajax
                $.ajax({
                    url: './crearSubtarea.php',
                    type: 'POST',
                    data: {
                        idTask: idTask,
                        inputAddSubtask: inputAddSubtask.value
                    },
                    // Mostrar las tareas del usuario
                    success: function (response) {
                        $('#divTasks').load('./verTareas.php?lista=' + idList);
                        // Limpiar campos
                        inputAddSubtask.value = '';
                        idTask = '';
                        // Cerrar el modal
                        $('#addSubtaskModal').modal('hide', function () {
                            // Quitar clases de validacion
                            inputAddSubtask.classList.remove('is-valid');
                            inputAddSubtask.classList.remove('is-invalid');
                            idTask = '';
                        });
                    }
                });
            }
        });


    });

    // Eliminar subtarea al dar click en boton
    $(document).on('click', '#btnDeleteSubtask', function () {
        var idSubtarea = $(this).attr('name');

        // Recortar la cadena "subtarea?"
        idSubtarea = idSubtarea.substring(9);

        $.ajax({
            url: './eliminarSubtarea.php?idSubtarea=' + idSubtarea,
            type: 'GET',
            data: {
                idSubtarea: idSubtarea
            },
            // Mostrar las tareas del usuario
            success: function (response) {
                $('#divTasks').load('./verTareas.php?lista=' + idList);
                idSubtarea = '';
            }
        });
    });

    // Abrir el modal para editar subtarea al dar click en boton
    $(document).on('click', '#btnEditSubtask', function () {
        // Obtener el id de la subtarea
        idSubtask = $(this).attr('name');
        // Recortar la cadena "subtarea?"
        idSubtask = idSubtask.substring(9);

        // Consultar la base de datos para obtener la informacion de la subtarea
        $.ajax({
            url: './obtenerSubtarea.php',
            type: 'POST',
            data: {
                idSubtask: idSubtask
            },
            success: function (response) {
                // Obtener los datos de la subtarea
                var subtarea = JSON.parse(response);

                // Mostrar los datos en los campos del formulario
                $('#inputEditSubtask').val(subtarea.trim());

                // Mostrar el modal
                $('#editSubtaskModal').modal('show')
            }
        });

        // Al dar click en btnSubmitEditSubtask
        $('#btnSubmitEditSubtask').click(function () {
            // Obtener el valor del campo inputEditSubtask
            var inputEditSubtask = document.getElementById('inputEditSubtask');
            // Eliminar espacios en blanco de los campos
            inputEditSubtask.value = inputEditSubtask.value.trim();
            // Validar el titulo de la tarea
            if (inputEditSubtask.value.length < 1) {
                inputEditSubtask.classList.add('is-invalid');
                inputEditSubtask.classList.remove('is-valid');
            } else {
                inputEditSubtask.classList.add('is-valid');
                inputEditSubtask.classList.remove('is-invalid');
            }
            // Enviar formulario si todos los campos son validos
            if (inputEditSubtask.classList.contains('is-valid')) {
                // Remover las clases de validacion
                inputEditSubtask.classList.remove('is-valid');
                inputEditSubtask.classList.remove('is-invalid');
                // Redireccionar a editarTarea.php con ajax
                $.ajax({
                    url: './editarSubtarea.php',
                    type: 'POST',
                    data: {
                        idSubtask: idSubtask,
                        inputEditSubtask: inputEditSubtask.value
                    },
                    // Mostrar las tareas del usuario
                    success: function (response) {
                        $('#divTasks').load('./verTareas.php?lista=' + idList);
                        // Limpiar campos
                        inputEditSubtask.value = '';
                        idSubtask = '';
                        // Cerrar el modal
                        $('#editSubtaskModal').modal('hide', function () {
                            // Quitar clases de validacion
                            inputEditSubtask.classList.remove('is-valid');
                            inputEditSubtask.classList.remove('is-invalid');
                            idSubtask = '';
                        }
                        );
                    }
                });

            }
        });
        // Cerrar modal al dar click en boton
        $('#btnCloseEditSubtask').click(function () {
            $('#editSubtaskModal').modal('hide');
            // Quitar clases de validacion
            inputEditSubtask.classList.remove('is-valid');
            inputEditSubtask.classList.remove('is-invalid');
            idSubtask = '';
        });

        // Cerrar el modal
        $('#editSubtaskModal').modal('hide', function () {
            // Quitar clases de validacion
            inputEditSubtask.classList.remove('is-valid');
            inputEditSubtask.classList.remove('is-invalid');
            idSubtask = '';
        });
    });

    // Funciones de lista de tarea
    // Al dar click en checkSubtarea
    $(document).on('click', '#checkSubtarea', function () {
        // Obtener el id de la subtarea
        var idSubtarea = $(this).attr('name');
        // Recortar la cadena "subtarea?"
        idSubtarea = idSubtarea.substring(9);
        // Obtener el valor del checkbox
        var checkSubtarea = $(this).attr('value');
        // Si la tarea esta completada, se la marca como no completada
        if (checkSubtarea == '1') {
            checkSubtarea = 0;
        } else {
            checkSubtarea = 1;
        }
        // Enviar el valor del checkbox a la base de datos
        $.ajax({
            url: './marcarSubtarea.php',
            type: 'POST',
            data: {
                idSubtarea: idSubtarea,
                checkSubtarea: checkSubtarea
            },
            // Mostrar las tareas del usuario
            success: function (response) {
                $('#divTasks').load('./verTareas.php?lista=' + idList);
            }
        });   
    });
    

})();