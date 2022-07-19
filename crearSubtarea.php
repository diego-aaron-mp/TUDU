<?php
require_once 'assets/config/config.php';
require_once 'assets/config/functions.php';
$conexion = connect($server,$port,$db,$user,$pass);
session_start();

if(!$conexion){
    die("Conexion fallida: " . mysqli_connect_error());
}

// Obtener los datos de la subtarea a crear
$idTask = $_POST['idTask'];
$inputAddSubtask = $_POST['inputAddSubtask'];


// Insertar la subtarea en la base de datos
$sql = "INSERT INTO subtarea (descripcionSubtarea, Tarea_idTarea) VALUES ('" . $inputAddSubtask . "', '" . $idTask . "')";  
$query = $conexion->prepare($sql);
$query->execute();


?>