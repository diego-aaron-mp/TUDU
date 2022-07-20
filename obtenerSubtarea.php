<?php
require_once 'assets/config/config.php';
require_once 'assets/config/functions.php';
$conexion = connect($server, $port, $db, $user, $pass);
session_start();

if (!$conexion) {
    die("Conexion fallida: " . mysqli_connect_error());
}

$idSubtask = $_POST['idSubtask'];

// Obtener los datos de la subtarea
$sql = "SELECT * FROM subtarea WHERE idSubtarea =" . $idSubtask . "";
$query = $conexion->prepare($sql);
$query->execute();
$subtarea = $query->fetchAll();

// Almacenar descripcion de la subtarea en una variable
$descripcionSubtarea = $subtarea[0]['descripcionSubtarea'];

// Mandar el json al js
echo json_encode($descripcionSubtarea);


?>