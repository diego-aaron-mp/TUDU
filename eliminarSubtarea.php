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
    
    // Obtener el id de la tarea a eliminar
    $idSubtarea = $_GET['idSubtarea'];

    // Eliminar las subtareas de la tarea
    $sql = "DELETE FROM subtarea WHERE idSubtarea =" . $idSubtarea . "";
    $query = $conexion->prepare($sql);
    $query->execute();

?>