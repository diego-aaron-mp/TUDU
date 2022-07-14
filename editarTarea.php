<?php
require_once 'assets/config/config.php';
require_once 'assets/config/functions.php';
$conexion = connect($server,$port,$db,$user,$pass);
session_start();

if(!$conexion){
    die("Conexion fallida: " . mysqli_connect_error());
}

// Obtener los datos de la tarea a editar
$idTask = $_POST['idTask'];
$inputEditTitleTask = $_POST['inputEditTitleTask'];
$inputEditTaskDescription = $_POST['inputEditTaskDescription'];

// Actualizar la tarea en la base de datos
$sql = "UPDATE tarea SET tituloTarea = '" . $inputEditTitleTask . "', descripciontarea = '" . $inputEditTaskDescription . "' WHERE idTarea = '" . $idTask . "'";
$query = $conexion->prepare($sql);
$query->execute();

?>