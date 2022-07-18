<?php
session_start();
include("../config/bd.php");

$correo = $_GET['c'];
$token = $_GET['t'];


$sentenciaSQL = $conexion->prepare("SELECT clave_nueva FROM recuperar WHERE correo = :correo AND token = :token LIMIT 1");
$sentenciaSQL->bindParam(':correo', $correo);
$sentenciaSQL->bindParam(':token', $token);
$sentenciaSQL->execute();
$recuperarSQL = $sentenciaSQL->fetch(PDO::FETCH_LAZY); 

if($recuperarSQL['clave_nueva'] == "") {
    $_SESSION['error'] = "Solicitud no encontrada";
    header("Location: ../recupera.php");
    die();
}

$clave = password_hash($recuperarSQL['clave_nueva'], PASSWORD_DEFAULT);

$sentenciaSQL = $conexion->prepare("UPDATE usuarios SET contrasenia = :contrasenia WHERE correo = :correo LIMIT 1");
$sentenciaSQL->bindParam(':contrasenia', $clave);
$sentenciaSQL->bindParam(':correo', $correo);
$sentenciaSQL->execute();

$sentenciaSQL = $conexion->prepare("DELETE FROM recuperar WHERE correo = :correo LIMIT 1");
$sentenciaSQL->bindParam(':correo', $correo);
$sentenciaSQL->execute();

$_SESSION['respuesta'] = "Contraseña actualizada satisfactoriamente, ya se puede loguear";
header("Location: ../recupera.php");

?>