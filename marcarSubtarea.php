<?php
require_once 'assets/config/config.php';
require_once 'assets/config/functions.php';
$conexion = connect($server,$port,$db,$user,$pass);
session_start();

if(!$conexion){
    die("Conexion fallida: " . mysqli_connect_error());
}

// Obtener los datos de la subtarea a editar
$idSubtarea = $_POST['idSubtarea'];
$checkSubtarea = $_POST['checkSubtarea'];

// Actualizar la subtarea en la base de datos
$sql = "UPDATE subtarea SET checkSubtarea = '$checkSubtarea' WHERE idSubtarea = '$idSubtarea'";
$query = $conexion->prepare($sql);
$query->execute();

?>