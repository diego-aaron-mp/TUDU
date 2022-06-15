<?php

require_once 'config.php';

try{
    $con = new PDO("mysql:host=$server;port=$port;dbname=$db", $user, $pass);
    echo "OK";
} catch(PDOException $e){
    echo "Conexión fallida: ".$e->getMessage();
}

$con = null;

?>