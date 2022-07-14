<?php

$host = 'localhost';
$usuario = 'root';
$contrasenia = '040319659';
$bd = 'login';

try {
    $conexion = new PDO("mysql:host=$host;dbname=$bd", $usuario, $contrasenia);
} catch(Exception $ex) {
    echo $ex->getMessage();
}

?>