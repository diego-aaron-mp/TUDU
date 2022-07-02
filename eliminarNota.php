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
    
    // Obtener el id de la nota a eliminar
    $idNota = $_GET['idNota'];

    // Obtener el id de la lista a la que pertenece la nota
    // $sql = "SELECT Lista_idLista FROM nota WHERE idNota = '".$idNota."'";
    // $query = $conexion->prepare($sql);
    // $query->execute();
    // Guardar el id de la lista en una variable
    // $lista = $query->fetchAll(PDO::FETCH_ASSOC);

    // Eliminar la Nota de la base de datos
//     $sql = "DELETE FROM nota WHERE idNota = '" . $idNota . "'";
//     $query = $conexion->prepare($sql);
//     $query->execute();
// ?>