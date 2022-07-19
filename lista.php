<?php
require_once 'assets/config/config.php';
require_once 'assets/config/functions.php';
$conexion = connect($server, $port, $db, $user, $pass);
session_start();

if (!$conexion) {
  die("Conexion fallida: " . mysqli_connect_error());
}

// Obtener el id de la sesion actual
$idUsuario = $_SESSION['idUsuario'];

// Obtener el id de la lista seleccionada
$idLista = $_GET['lista'];

// Obtener el nombre y el objetivo de la lista
$sql = "SELECT DISTINCT objetivoLista, nombreLista FROM lista WHERE idLista =" . $idLista . "";
$query = $conexion->prepare($sql);
$query->execute();
$objetivo = $query->fetchAll();

// Obtener las tareas de la lista
$sql = "SELECT * FROM tarea WHERE idLista =" . $idLista . "";
$query = $conexion->prepare($sql);
$query->execute();
$tareas = $query->fetchAll();


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Icon -->
  <link rel="icon" href="./assets/images/Tudu.ico">
  <link rel="stylesheet" href="./assets/css/styles.css">
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

  <title>Lista</title>
</head>

<body style="background-color: #EDF2F6;">

  <!-- Cabecera -->
  <nav class="navbar navbar-expand-lg navbar-light bg-primary shadow sticky-top">
    <div class="container-fluid">
      <!-- Logo para ir a Inicio -->
      <a class="navbar-brand text-white fw-bold" href="#"> <img src="./assets/images/TuduComprimido.png" alt="Ir a inicio" class="img-fluid goHome">TUDÚ</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

          <!-- Dropdown de Usuario -->
          <div class="dropdown me-2 mb-1 mt-1">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="bi bi-person-fill"></i>
              Usuario
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="#">Perfil</a>
              <a class="dropdown-item" href="#">Cerrar sesión</a>
            </div>
          </div>
          <!-- Fin de Dropdown de usuario -->

          <!-- Dropdown de Listas -->
          <div class="dropdown me-2 mb-1 mt-1"">
              <button class=" btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="bi bi-list-check"></i>
            Listas
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="#">Lista 1</a>
              <a class="dropdown-item" href="#">Lista 2</a>
              <a class="dropdown-item" href="#">Lista 3</a>
            </div>
          </div>
          <!-- Fin de Dropdown de Listas -->

          <!-- Botón de para abir el modal de frase -->
          <div>
            <button type="button" class="btn btn-secondary me-2 mb-1 mt-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
              <i class="bi bi-brightness-high-fill"></i>
              Frase
            </button>
          </div>
          <!-- Fin de Botón de para abir el modal de frase -->

          <!-- Boton para abrir el modal de consejo -->
          <div>
            <button type="button" class="btn btn-secondary me-2 mb-1 mt-1" data-bs-toggle="modal" data-bs-target="#exampleModal2">
              <i class="bi bi-lightbulb-fill"></i>
              Consejo
            </button>
          </div>
          <!-- Fin de Boton para abrir el modal de consejo -->

          <!-- Boton para ocultar tareas completadas -->
          <div>
            <button type="button" class="btn btn-secondary me-2 mb-1 mt-1" data-bs-toggle="modal" data-bs-target="#exampleModal3">
              <i class="bi bi-eye-fill"></i>
              Completadas
            </button>
          </div>
          <!-- Fin de Boton para ocultar tareas completadas -->

        </ul>
      </div>
    </div>
  </nav>

  <!-- Contenido -->
  <!-- Jumbotron del objetivo de la lista -->
  <div class="p-5 jumbotron jumbotron-fluid mb-2 mt-2">
    <div class="container-fluid py-2">
      <!-- Titulo de la lista -->
      <h1 class="display-3 text-center mb-3" id="listTitle">
        <?php foreach ($objetivo as $key => $value) : ?>
          <?php echo $value['nombreLista']; ?>
        <?php endforeach; ?>
      </h1>
      <!-- Una linea -->
      <hr class="my-4">

      <h2 class="display-5 fw-bold"><i class="bi bi-trophy-fill"> </i>Objetivo
        <!-- Boton para editar el objetivo -->
        <button id="btnEditGoal" class="btn btn-secondary btn-lg btn-block" type="button" data-toggle="modal" data-target="#exampleModal">
          <i class="bi bi-pencil"></i>
        </button>
      </h2>
      <p class="col-md-12 fs-4" id="listGoal">
        <!-- Imprimir objetivoLista de la variable objetivo con php  -->
        <?php foreach ($objetivo as $key => $value) : ?>
          <?php echo $value['objetivoLista']; ?>
        <?php endforeach; ?>
      </p>
    </div>

  </div>

  <!-- Jumbotron del Temporizador para Pomodoro -->
  <div class="jumbotron jumbotron-fluid mb-2 mt-2">
    <div class="container">
      <h3 class="text-center">Temporizador Pomodoro</h3>
      <h5 class="text-center text-secondary">Bloques completados: <span id="iterBlockNumber">0</span> <span>/ </span>
        <span id="totalBlocks">4</span>
      </h5>
      <h6 class="text-center text-capitalize" id="modoActual"></h6>
      <div class="text-center">
        <div class="display-3 fw-bold">
          <span id="minutes">25</span>:<span id="seconds">0</span>
        </div>
        <!-- Botones para el temporizador -->
        <div class="btn-group" role="group" aria-label="pomodoroTimer">
          <button type="button" class="btn btn-primary bi-play-fill" id="start">
          </button>
          <button type="button" class="btn btn-primary bi-pause-fill" id="pause">
          </button>
          <button type="button" class="btn btn-primary bi-stop-fill" id="stop">
          </button>
        </div>
        <!-- Botones para elegir temporizador -->
        <div class="btn-group" role="group" aria-label="pomodoroTimer">
          <button type="button" class="btn btn-secondary active" id="btnTypeOne">
            25:5
          </button>
          <button type="button" class="btn btn-secondary" id="btnTypeTwo">
            50:10
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Input para agregar una nueva tarea/nota con su descripcion -->
  <div class="container mt-3 mb-3">
    <div class="row g-3">
      <!-- Agregar una nueva tarea -->
      <div class="col-12 col-md-6 col-lg-6 col-sm-12">
        <div class="card">
          <div class="card-body">
            <!-- Input para agregar nueva tarea -->
            <h5 class="card-title">
              <i class="bi bi-list-task"></i>
              Agregar nueva tarea
            </h5>
            <div class="input-group">
              <input type="text" id="inputTaskTitle" class="form-control" placeholder="Agregar tarea" aria-label="Agregar subtarea" aria-describedby="basic-addon2">
            </div>
            <div class="input-group mt-3">
              <!-- Text area para escribir la descipcion de la nueva tarea -->
              <textarea class="form-control" id="inputTaskDescription" rows="1" placeholder="Descripción de la tarea"></textarea>
            </div>
            <div class="input-group mt-3">
              <!-- Boton para agregar la nueva tarea -->
              <button id="btnSubmitTask" type="button" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i>
                Agregar
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Agregar una nueva nota -->
      <div class="col-12 col-md-6 col-lg-6 col-sm-12">
        <div class="card">
          <div class="card-body">
            <!-- Input para agregar nueva nota -->
            <h5 class="card-title">
              <i class="bi bi-journal-text"></i>
              Agregar nueva nota
            </h5>
            <div class="input-group">
              <input type="text" id="inputNoteTitle" class="form-control" placeholder="Agregar nota" aria-label="Agregar nota" aria-describedby="basic-addon2">
            </div>
            <div class="input-group mt-3">
              <!-- Text area para escribir la descipcion de la nueva nota -->
              <textarea id="inputNoteDescription" class="form-control" id="exampleFormControlTextarea1" rows="1" placeholder="Descripción de la nota"></textarea>
            </div>
            <div class="input-group mt-3">
              <!-- Boton para agregar la nueva nota -->
              <button id="btnSubmitNote" type="button" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i>
                Agregar
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- Fin de agregar nueva nota -->
    </div>
  </div>

  <!-- Tareas y subtareas -->
  <div class="container mt-3 mb-3">
    <div class="row g-3" id="divTasks">

    </div>
  </div>

  <!-- Notas -->
  <div class="container mt-3 mb-3">
    <div class="row g-3" id="divNotes">

    </div>
  </div>

  <!-- Modales -->
  <!-- Modal para editar tareas-->
  <div class="modal fade" id="editTaskModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-secondary">
          <h5 class="modal-title text-white" id="exampleModalLabel">
            <i class="bi bi-pencil-fill"></i>
            Editar tarea
          </h5>
          <button type="button" id="btnCloseEditTaskModal" class="close btn-close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"></span>
          </button>
        </div>

        <div class="modal-body">
          <!-- Input para editar el titulo de la tarea -->
          <div class="form-group">
            <label for="inputEditTitleTask">Titulo de la tarea</label>
            <input type="text" class="form-control" id="inputEditTitleTask" aria-describedby="inputEditTitleTask" placeholder="Ej. Tarea de estudio">
          </div>

          <!-- Text area para editar la descripcion de la tarea -->
          <div class="form-group">
            <label for="inputEditTaskDescription">Descripcion de la tarea</label>
            <textarea class="form-control" id="inputEditTaskDescription" rows="3" placeholder="Ej. Estudiar para el examen de final de semestre"></textarea>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSubmitEditTask" class="btn btn-primary">Guardar</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal para editar subtareas -->
  <div class="modal fade" id="editSubtaskModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
          <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"></span>
          </button>
        </div>

        <div class="modal-body">
          <!-- Input para editar el titulo de la subtarea -->
          <div class="form-group">
            <label for="inputEditSubtask">Titulo de la subtarea</label>
            <input type="text" class="form-control" id="inputEditSubtask" aria-describedby="inputEditSubtask" placeholder="Ej. Subtarea de estudio">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary">Guardar</button>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- Modal para editar una nota -->
  <div class="modal fade" id="editModalNote" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-secondary">
          <h5 class="modal-title text-white" id="exampleModalLabel">
            <i class="bi bi-pencil-fill"></i>
            Editar nota
          </h5>
          <button type="button" id="btnCloseEditNoteModal" class="close btn-close" data-dismiss="modal" aria-label="Close">

          </button>
        </div>
        <div class="modal-body">
          <!-- Input para el titulo de la nota -->

          <div class="form-group">
            <label for="inputTitleNote">Titulo de la nota</label>
            <input type="text" class="form-control" id="inputEditTitleNote" aria-describedby="inputTitleNote" placeholder="Ej. Nota de estudio">
          </div>

          <!-- Input para editar la descripcion de la nota -->
          <div class="form-group">
            <label for="inputDescriptionNote">Descripcion de la nota</label>
            <textarea class="form-control" id="inputEditDescriptionNote" rows="3" placeholder="Ej. Estudio de inglés"></textarea>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSubmitEditNote" class="btn btn-primary">Guardar</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal para editar el titulo y el objetivo -->
  <div class="modal fade" id="editModalGoal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-secondary">
          <h5 class="modal-title text-white" id="exampleModalLabel">
            <i class="bi bi-pencil-fill"></i>
            Editar objetivo
          </h5>
          <button type="button" id="btnCloseModalGoal" class="close btn-close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"></span>
          </button>
        </div>
        <!-- <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST"> -->
        <div class="modal-body">
          <!-- Input para editar la descripcion del objetivo -->
          <div class="form-group">
            <!-- Input del titulo de la lista -->
            <label for="inputTitle">Titulo de la lista</label>
            <input type="text" class="form-control" id="inputTitle" aria-describedby="inputTitle" placeholder="Ej. Objetivo de estudio">
            <!-- Input del Objetivo -->
            <label for="inputGoal">Descripcion del objetivo</label>
            <textarea class="form-control" id="inputGoal" rows="3" placeholder="Ej. Estudiar para el examen de final de semestre"></textarea>
          </div>
          <div class="modal-footer">
            <button id="btnSubmitEditGoal" type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </div>
        <!-- </form> -->
      </div>
    </div>
  </div>


  <!-- Modal para agregar una subtarea -->
  <div class="modal fade" id="addSubtaskModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Agregar</h5>
          <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"></span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Input para agregar el titulo de la subtarea -->
          <div class="form-group">
            <label for="inputAddSubtask">Descripción de la subtarea</label>
            <input type="text" class="form-control" id="inputAddSubtask" aria-describedby="inputAddSubtask" placeholder="Ej. Subtarea de estudio">
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSubmitAddSubtask" class="btn btn-primary">Guardar</button>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <!-- JQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <!-- Temporizador -->
  <script src="./assets/scripts/pomodoroTimer.js"></script>

  <script src="./assets/scripts/editTask.js"></script>
  <script src="./assets/scripts/editSubtask.js"></script>
  <script src="./assets/scripts/editGoal.js"></script>


  <script src="./assets/scripts/pruebas.js"></script>
</body>

</html>