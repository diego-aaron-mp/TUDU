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
$nombreLista = $_GET['name'];
$objetivoLista = $_GET['objective'];

// Insertar la lista en la base de datos
$sql = "INSERT INTO lista (nombreLista, objetivoLista, Usuario_idUsuario) VALUES ('" . $nombreLista . "', '" . $objetivoLista . "', '" . $id . "')";
$query = $conexion->prepare($sql);
$query->execute();

// Recargar la pagina
header('Location: ./principal.php');
?>
