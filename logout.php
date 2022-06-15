<?php

    session_start();

    // Si el usuario esta logeado, redirigir a index.php y cerrar sesion
    if (isset($_SESSION['id'])) {
        session_destroy();
        header('Location: ./index.php');   
    } else {
        // Si no esta logeado, redirigir a index.php
        header('Location: ./index.php');
    }
?>