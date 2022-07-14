<?php
require_once 'assets/config/config.php';
require_once 'assets/config/functions.php';
$conexion = connect($server, $port, $db, $user, $pass);
session_start();

if (!$conexion) {
    die("Conexion fallida: " . mysqli_connect_error());
}

$idTarea = $_POST['idTask'];

// Obtener los datos de la tarea
$sql = "SELECT * FROM tarea WHERE idTarea =" . $idTarea . "";
$query = $conexion->prepare($sql);
$query->execute();
$tarea = $query->fetch();

$json = array (
    'title' => $tarea['tituloTarea'],
    'description' => $tarea['descripciontarea'],
);

// Mandar el json al js
echo json_encode($json);




?>