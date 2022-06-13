<?php
include 'assets/config/conexion.php';

$resultado = mysqli_query($link, "SELECT * FROM lista");
$resultado = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

print_r($resultado);
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

  <title>Página principal de TUDÚ</title>
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
        </ul>
      </div>
    </div>
  </nav>

  <!-- Boton para crear una nueva lista -->
  <div class="container mt-3 mb-3">
    <div class="row g-3">
      <div class="col-12">
        <button type="button" id="btnCreateList" class="btn btn-primary btn-block" data-toggle="modal" data-target="#createListModal">
          <i class="bi bi-plus-lg"></i>
          Crear nueva lista
        </button>
      </div>
    </div>
  </div>

  <!-- Contenido -->
  <!-- Card de Lista -->
  <div class="container mt-3 mb-3">
    <div class="row g-3">

    <?php foreach ($resultado as $key => $value) : ?>
        <!-- Aqui inicia una card -->
        <div class="col-12 col-md-6 col-lg-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title"><?php echo $value['nombreLista']; ?></h5>
              <p class="card-text"><?php echo $value['objetivoLista']; ?></p>
              <a href="#" class="btn btn-primary">
                <i class="bi bi-arrow-right"></i>
                Ver más
              </a>
              <a href="#" class="btn btn-danger">
                <i class="bi bi-trash"></i>
                Eliminar
              </a>
            </div>
          </div>
        </div>
        <!-- Aqui acaba -->
      <?php endforeach; ?>

    </div>
  </div>

  <!-- Modal -->
  <!-- Modal para crear una nueva lista -->
  <div class="modal fade" id="createListModal" tabindex="-1" role="dialog" aria-labelledby="createListModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createListModalLabel">Crear nueva lista</h5>
          <button type="button" id="btnCloseCreateList" class="close btn-close" data-dismiss="modal" aria-label="Close">
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="inputListName">Nombre de la lista</label>
              <input type="text" class="form-control" id="inputListName" aria-describedby="inputListName" placeholder="Ej. Estudio de inglés">
            </div>
            <div class="form-group">
              <label for="inputObjective">Objetivo de la lista</label>
              <textarea class="form-control" id="inputObjective" rows="3" placeholder="Ej. Alcanzar un nivel que me permita entablar una conversación con un hablante nativo."></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" id="btnSubmitCreateList" class="btn btn-primary">Crear</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Botones para las frases y consejos -->
  <div class="btnFraseConsejo">
    <div class="container-fluid">
      <div class="row">
        <div class="btn-group btn-group-vertical" role="group" aria-label="Basic example">
          <button id="btnConsejo" type="button" class="btn btn-secondary">
            <i class="bi bi-lightbulb-fill"></i>
          </button>
          <button id="btnFrase" type="button" class="btn btn-secondary">
            <i class="bi bi-brightness-high-fill"></i>
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal de frases motivadoras -->
  <div class="modal fade" id="fraseModal" tabindex="-1" role="dialog" aria-labelledby="fraseModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="fraseModalLabel">Motívame</h5>
          <button type="button" id="btnCloseFraseModal" class="close btn-close" data-dismiss="modal" aria-label="Close">
          </button>
        </div>
        <div class="modal-body">
          <p>
            Una frase bien bonita.
          </p>
        </div>
        <div class="modal-footer">
          <strong>
            Autor de la frase
          </strong>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal de consejos -->
  <div class="modal fade" id="consejoModal" tabindex="-1" role="dialog" aria-labelledby="consejoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="consejoModalLabel">Consejo</h5>
          <button type="button" id="btnCloseConsejoModal" class="close btn-close" data-dismiss="modal" aria-label="Close">
          </button>
        </div>
        <div class="modal-body">
          <p>
            Un consejo bien bonito.
          </p>
        </div>
        <div class="modal-footer">
          <strong>
            Autor del consejo
          </strong>
        </div>
      </div>
    </div>
  </div>



  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <!-- JQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <!-- CreateList Script -->
  <script src="/assets/scripts/createList.js"></script>

  <script src="/assets/scripts/prubas.js"></script>
</body>

</html>