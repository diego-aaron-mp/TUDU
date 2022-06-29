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
    
    // Obtener el id de la lista a eliminar
    $idLista = $_GET['idlista'];

    // Eliminar la lista de la base de datos
    $sql = "DELETE FROM lista WHERE idLista = '" . $idLista . "'";
    $query = $conexion->prepare($sql);
    $query->execute();
    
    
    // Recargar la pagina
    header('Location: ./principal.php');
?>