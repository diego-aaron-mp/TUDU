// Script para abri modal para editar subtareas
(function(){
    // Variables
    var inputNoteTitle = document.getElementById('inputNoteTitle'),
        inputNoteDescription = document.getElementById('inputNoteDescription');
    
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