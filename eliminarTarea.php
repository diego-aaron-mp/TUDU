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
    $idTarea = $_GET['idTarea'];

    // Eliminar las subtareas de la tarea
    $sql = "DELETE FROM subtarea WHERE Tarea_idTarea =" . $idTarea . "";
    $query = $conexion->prepare($sql);
    $query->execute();

    // Eliminar la tarea de la base de datos
    $sql = "DELETE FROM tarea WHERE idTarea = '" . $idTarea . "'";
    $query = $conexion->prepare($sql);
    $query->execute();
?>