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

// Obtener las notas de la lista
$sql = "SELECT * FROM nota WHERE Lista_idLista =" . $idLista . "";
$query = $conexion->prepare($sql);
$query->execute();
$notas = $query->fetchAll();

foreach ($notas as $key => $value) : ?>
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <!-- Card header -->
            <div class="modal-header">
                <!-- Titulo de la card -->
                <h5 class="card-title"><?php echo $value['tituloNota']; ?></h5>
                <!-- Boton de eliminar  -->
                <button type="button" id="btnDeleteNote" name="nota?<?php echo $value['idNota']; ?>" class="btn btn-close">
                </button>
            </div>
            <div class="card-body">
                <p class="card-text"><?php echo $value['descripcionNota']; ?></p>
                <!-- Boton para editar -->
                <button id="btnEditNote" name="nota?<?php echo $value['idNota']; ?>" type="button" class="btn btn-primary mt-2">Editar</button>
            </div>
        </div>
    </div>
    <!-- Aqui termina -->
<?php endforeach; ?>