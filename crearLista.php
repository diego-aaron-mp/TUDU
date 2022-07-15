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
$nombreLista = $_POST['listName'];
$objetivoLista = $_POST['listGoal'];

// Insertar la lista en la base de datos
$sql = "INSERT INTO lista (nombreLista, objetivoLista, Usuario_idUsuario) VALUES ('" . $nombreLista . "', '" . $objetivoLista . "', '" . $id . "')";
$query = $conexion->prepare($sql);
$query->execute();

?>
