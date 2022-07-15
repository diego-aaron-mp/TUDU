<?php
require_once 'assets/config/config.php';
require_once 'assets/config/functions.php';
$conexion = connect($server, $port, $db, $user, $pass);
session_start();

if (!$conexion) {
    die("Conexion fallida: " . mysqli_connect_error());
}

// Obtener el id de la lista seleccionada
$idLista = $_GET['lista'];

// Obtener las tareas de la lista
$sql = "SELECT * FROM tarea WHERE Lista_idLista =" . $idLista . "";
$query = $conexion->prepare($sql);
$query->execute();
$tareas = $query->fetchAll();


foreach ($tareas as $key => $value) : ?>
    <!-- Aqui inicia una card -->
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <!-- Titulo de la card -->
            <div class="modal-header">
                <h5 class="card-title" id="taskTitle"><input type="checkbox" class="form-check-input" id="customCheck1">&nbsp;<?php echo $value['tituloTarea']; ?></h5>
                <!-- Boton de eliminar  -->
                <button type="button" id="btnDeleteTask" name="tarea?<?php echo $value['idTarea']; ?>" class="btn btn-close">
                </button>
            </div>
            <div class="card-body">

                <p class="card-text mt-1" id="taskDescription"><?php echo $value['descripciontarea']; ?></p>
                
                <h6 class="card-text">Subtareas
                    <!-- Boton para agregar subtareas -->
                    <button type="button" id="btnAddSubtask" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
                        <i class="bi bi-plus"></i>
                    </button>
                </h6>


                <!-- Checklist -->
                <div class="list-group mb-3">
                    <!-- Aqui inicia una subtarea -->
                    <label class="list-group-item">
                        <div class="row">
                            <div class="col-10">
                                <input class="form-check-input me-1" type="checkbox" value="">
                                Subtarea un poco mas grande para calar esta cosa
                            </div>
                            <div class="col-2">
                                <span class="btn-group-sm">
                                    <!-- Boton de editar -->
                                    <button id="btnEditSubtask" type="button" class="btn btn-secondary">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <!-- Boton de eliminar  -->
                                    <button type="button" class="btn btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </label>
                    <!-- Aqui termina una subtarea -->
                </div>
                <!-- Fin de checklist -->

                <!-- Boton para editar -->
                <button id="btnEditTask" name="tarea?<?php echo $value['idTarea']; ?>" class="btn btn-primary mt-2">Editar</button>
            </div>
        </div>
    </div>

    

<?php endforeach; ?>