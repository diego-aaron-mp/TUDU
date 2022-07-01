<?php
require_once 'assets/config/config.php';
require_once 'assets/config/functions.php';
$conexion = connect($server,$port,$db,$user,$pass);
session_start();

if(!$conexion){
    die("Conexion fallida: " . mysqli_connect_error());
}

// Obtener los datos de la nota a crear
$idList = $_POST['idList'];
$inputNoteTitle = $_POST['inputNoteTitle'];
$inputNoteDescription = $_POST['inputNoteDescription'];

// Insertar la nota en la base de datos
$sql = "INSERT INTO nota (tituloNota, descripcionNota, Lista_idLista) VALUES ('" . $inputNoteTitle . "', '" . $inputNoteDescription . "', '" . $idList . "')";
$query = $conexion->prepare($sql);
$query->execute();

?>