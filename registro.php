<?php
require_once 'assets/config/config.php';
require_once 'assets/config/functions.php';
$conexion = connect($server,$port,$db,$user,$pass);

if(!$conexion){
    die("Conexion fallida: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM usuario WHERE emailUsuario = '" . $email . "' AND passwordUsuario = '" . $password . "'";
  $query = $conexion->prepare($sql);
  $query->execute();
  $resultado = $query->fetchAll();

  foreach ($resultado as $fila) {
    $id = $fila['idUsuario'];
    $correo = $fila['emailUsuario'];
    $contrasena = $fila['passwordUsuario'];
  }

  if (count($resultado) == 0) {
  // Crear usuario nuevo
    $sql = "INSERT INTO usuario (emailUsuario, passwordUsuario) VALUES ('" . $email . "', '" . $password . "')";
    $query = $conexion->prepare($sql);
    $query->execute();
    
    // Redirigir al login
    header('Location: index.php');

    
  } else {
    // Imprime ventana de alerta
    echo "<script>alert('Usuario ya existente');</script>";
  }
}

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
  <title>Registrarse en TUDÚ</title>
</head>

<body>
  <!-- Login -->
  <!-- Pantilla de: Bootstraptor -->
  <!-- Imagen de Steve Buissinne en Pixabay  -->
  <section class="pt-5 pb-5 mt-0 align-items-center d-flex bg-dark"
    style="min-height: 100vh; background-size: cover; background-image: url(./assets/images/tomates-registro.jpg);">
    <div class="container-fluid">
      <div class="row  justify-content-center align-items-center d-flex-row text-center h-100">
        <div class="col-12 col-md-5 col-lg-4   h-50 ">
          <div class="card shadow">
            <div class="card-body mx-auto">
              <!-- Logo de TUDU -->
              <img src="./assets/images/TuduComprimido.png" alt="Logo de TUDÚ" class="img-fluid" style="width: 100px;">
              <h4 class="card-title mt-3 text-center">T U D Ú</h4>
              <h5 class="card-title mt-3 text-center">Registro</h5>
              <!-- Linea -->
              <hr class="bg-black">



              <!-- Formulario de inicio de sesion -->
              <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <!-- Correo -->
                <div class="form-group input-group mt-2">
                  <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="bi bi-envelope-fill"></i> </span>
                  </div>
                  <input name="email" class="form-control" placeholder="Correo electrónico" type="email" required>
                </div>
                <!-- Fin de correo -->

                <!-- Contraseña -->
                <div class="form-group input-group mt-2">
                  <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="bi bi-lock-fill"></i> </span>
                  </div>
                  <input name="password" class="form-control" placeholder="Contraseña" type="password" required>
                </div>
                <!-- Fin de contraseña -->

                <!-- Checkbox de terminos y condiciones -->
                <div class="form-group mt-2">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck" required>
                    <label class="form-check-label" for="gridCheck">
                      Acepto los <a href="#" class="text-secondary">Términos y condiciones.</a>
                    </label>
                  </div>
                </div>
                <!-- Fin de checkbox -->

                <div class="form-group mt-2">
                  <button type="submit" class="btn btn-primary btn-block">
                    <i class="bi bi-box-arrow-in-down-left"></i>
                    Registrarme
                  </button>
                </div>
              </form>
              <p class="text-center mt-2">¿Ya tienes cuenta?
                <a href="./index.php" class="text-secondary">Inicia sesión</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
  <!-- JQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</body>

</html>