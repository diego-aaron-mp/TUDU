<?php
// Diego Aarón Macías Padilla | Programación para Internet | CUALTOS | 6to Semestre
$server = "localhost";
$port = "3306";
$db = "tudu";
$user = "root";
$pass = "root";

//Si la contraseña no es root, se manda error 403
if($pass != "root"){ 
    header("HTTP/1.0 403 Forbidden");
    die("Error 403: Acceso prohibido");  
}

// Se hace la conexión
$link = new mysqli($server, $user, $pass, $db, $port);

// Si hay error en la conexión, se manda error 500
if($link -> connect_errno){
    header("HTTP/1.0 500 Internal Server Error");
    die("Error al conectar con la base de datos" . $link -> connect_error);
}else{
    // echo "Conexión exitosa";
}


?>