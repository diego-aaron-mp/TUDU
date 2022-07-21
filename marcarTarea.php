<?php
require_once 'assets/config/config.php';
require_once 'assets/config/functions.php';
$conexion = connect($server,$port,$db,$user,$pass);
session_start();

if(!$conexion){
    die("Conexion fallida: " . mysqli_connect_error());
}

// Obtener los datos de la subtarea a editar
$idTarea = $_POST['idTarea'];
$checkTarea = $_POST['checkTarea'];


// Actualizar la tarea en la base de datos
$sql = "UPDATE tarea SET checkTarea = " . $checkTarea . " WHERE idTarea = " . $idTarea . "";
$query = $conexion->prepare($sql);
$query->execute();

// Actualizar las subtareas de la tarea en la base de datos
$sql = "UPDATE subtarea SET checkSubtarea = " . $checkTarea . " WHERE Tarea_idTarea = " . $idTarea . "";
$query = $conexion->prepare($sql);
$query->execute();



?>