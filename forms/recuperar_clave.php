<?php

session_start();

include("../config/bd.php");

$correo = (isset($_POST['correo'])) ? $_POST['correo'] : "";

$sentenciaSQL = $conexion->prepare("SELECT * FROM usuarios WHERE correo = :correo LIMIT 1");
$sentenciaSQL->bindParam(':correo', $correo);
$sentenciaSQL->execute();
$loginSQL = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

if($loginSQL['correo'] == "") {
    $_SESSION['error'] = "Usuario inexistente";
    header("Location: ../recupera.php");
    die();
}

$clave_nueva = rand(10000000, 99999999);
$correo = $loginSQL['correo'];
$contrasenia = password_hash($clave_nueva, PASSWORD_DEFAULT);

$token = md5($loginSQL['id'] . time() . rand(1000, 9999));
/*
$sentenciaSQL = $conexion->prepare("UPDATE login SET contrasenia = :contrasenia WHERE correo = :correo LIMIT 1");
$sentenciaSQL->bindParam(':contrasenia', $contrasenia);
$sentenciaSQL->bindParam(':correo', $correo);
$sentenciaSQL->execute();
*/
$sentenciaSQL = $conexion->prepare("INSERT INTO recuperar(correo, clave_nueva, token, fecha_alta) VALUES (:correo, :clave_nueva, :token, now())");
$sentenciaSQL->bindParam(':correo', $correo);
$sentenciaSQL->bindParam(':clave_nueva', $clave_nueva);
$sentenciaSQL->bindParam(':token', $token);
$sentenciaSQL->execute();

$link = "http://".$_SERVER['HTTP_HOST']."/login/forms/recuperar_clave_confirmar.php?c=$correo&t=$token";
//echo $token;
//echo '<hr/>';

$mensaje = <<<EMAIL
<p>Has solicitado recuperar tu contraseña, el sistema te ha generado una nueva clave que es <code style='background: lightyellow; color: darkred; padding: 1px 2px;'>$clave_nueva</code></p>
<p>Pero antes de poder usarla, deberás hacer <a href='$link'>click en este vínculo</a> o copiar este código en la URL de tu navegador</p>
<code style='background: black; color: white; padding: 4px;'>$link</code>
<p>Si tu no has hecho esta solicitud, ignora el presente mensaje</p>
EMAIL;

echo $mensaje;

?>