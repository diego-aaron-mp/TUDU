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


// Obtener el nombre de la lista a crear
$idLista = $_POST['idList'];
$nombreLista = $_POST['inputTitle'];
$objetivoLista = $_POST['inputGoal'];

// Editar el objetivo y el titulo de la lista
$sql = "UPDATE lista SET nombreLista = '$nombreLista', objetivoLista = '$objetivoLista' WHERE idLista = '$idLista'";
$query = $conexion->prepare($sql);
$query->execute();

?>