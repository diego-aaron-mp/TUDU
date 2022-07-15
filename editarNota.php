<?php
require_once 'assets/config/config.php';
require_once 'assets/config/functions.php';
$conexion = connect($server,$port,$db,$user,$pass);
session_start();

if(!$conexion){
    die("Conexion fallida: " . mysqli_connect_error());
}

// Obtener los datos de la nota a editar
$idNote = $_POST['idNote'];
$inputEditTitleNote = $_POST['inputEditTitleNote'];
$inputEditDescriptionNote = $_POST['inputEditDescriptionNote'];

// Actualizar la nota en la base de datos
$sql = "UPDATE nota SET tituloNota = '" . $inputEditTitleNote . "', descripcionNota = '" . $inputEditDescriptionNote . "' WHERE idNota = '" . $idNote . "'";
$query = $conexion->prepare($sql);
$query->execute();

?>