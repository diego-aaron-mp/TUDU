<?php
require_once 'assets/config/config.php';
require_once 'assets/config/functions.php';
$conexion = connect($server, $port, $db, $user, $pass);
session_start();

if (!$conexion) {
    die("Conexion fallida: " . mysqli_connect_error());
}

$idNota = $_POST['idNote'];

// Obtener los datos de la Nota
$sql = "SELECT * FROM Nota WHERE idNota =" . $idNota . "";
$query = $conexion->prepare($sql);
$query->execute();
$Nota = $query->fetch();

$json = array (
    'title' => $Nota['tituloNota'],
    'description' => $Nota['descripcionNota'],
);

// Mandar el json al js
echo json_encode($json);




?>