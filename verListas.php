<?php
require_once 'assets/config/config.php';
require_once 'assets/config/functions.php';
$conexion = connect($server,$port,$db,$user,$pass);
session_start();

if(!$conexion){
    die("Conexion fallida: " . mysqli_connect_error());
}
// Obtener el id de la sesion actual
$id = $_SESSION['idUsuario'];

    // Hacer consulta de las lista del usuario
$sql = "SELECT * FROM lista WHERE Usuario_idUsuario = '" . $id . "'";
$query = $conexion->prepare($sql);
$query->execute();
$resultado = $query->fetchAll(); 
    foreach ($resultado as $key => $value) : ?>
        <!-- Aqui inicia una card -->
        <div class="col-12 col-md-6 col-lg-4">
          <div class="card">
            <div class="card-body">
              <!-- Id oculto -->
              <input type="hidden" id="idLista" value="">
              <h5 class="card-title"><?php echo $value['nombreLista']; ?></h5>
              <p class="card-text"><?php echo $value['objetivoLista']; ?></p>
              <a href="./lista.php?lista=<?php echo $value['idLista']; ?>" class="btn btn-primary">
                <i class="bi bi-arrow-right"></i>
                Ver más
              </a>
              <button id="btnEliminarLista" name="lista?<?php echo $value['idLista']; ?>" class="btn btn-danger">
                <i class="bi bi-trash"></i>
                Eliminar
              </button>
            </div>
          </div>
        </div>
        <!-- Aqui acaba -->
      <?php endforeach; ?>