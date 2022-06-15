<?php


function connect($s, $p, $d, $u, $pa){
    try{
        $con = new PDO("mysql:host=$s;port=$p;dbname=$d", $u, $pa);
        return $con;
    }catch(PDOException $e){
        return false;
    }
}

?>