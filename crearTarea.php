<?php
require_once 'assets/config/config.php';
require_once 'assets/config/functions.php';
$conexion = connect($server,$port,$db,$user,$pass);
session_start();

if(!$conexion){
    die("Conexion fallida: " . mysqli_connect_error());
}

// Obtener los datos de la tarea a crear
$idList = $_POST['idList'];
$inputTaskTitle = $_POST['inputTaskTitle'];
$inputTaskDescription = $_POST['inputTaskDescription'];

// Insertar la nota en la base de datos
$sql = "INSERT INTO tarea (tituloTarea, descripciontarea, Lista_idLista) VALUES ('" . $inputTaskTitle . "', '" . $inputTaskDescription . "', '" . $idList . "')";
$query = $conexion->prepare($sql);
$query->execute();

?>