<?php

    require_once 'config.php';

    $con = new mysqli($server, $user, $pass, $db);

    if($con->connect_error){
        echo "Conexión Fallida ".$con->connect_error;
        $con->close();
    } else {
        echo "OK";
    }
?>