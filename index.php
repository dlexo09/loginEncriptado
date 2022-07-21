<?php

session_start();
include("config/bd.php");

$correo = (isset($_POST['correo'])) ? $_POST['correo'] : "";
$contrasenia = (isset($_POST['contrasenia'])) ? $_POST['contrasenia'] : "";

$sentenciaSQL = $conexion->prepare("SELECT * FROM usuarios WHERE correo = :correo");
$sentenciaSQL->bindParam(':correo', $correo);
$sentenciaSQL->execute();
$loginSQL = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

if($_POST) {
    if(($correo == $loginSQL['correo']) && (password_verify($contrasenia, $loginSQL['contrasenia']))) {
        $_SESSION['usuario'] = "ok";
        $_SESSION['nombreUsuario'] = $loginSQL['nombre'];
        header("Location: inicio.php");
    } else {
        $mensaje = "Correo o contraseña son incorrectos";
    }
}

?>

<!doctype html>
<html lang="en">
  <head>
    <title>Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login.css" />
  </head>
  <body>

    <div class="container">
        <div class="row">

            
            <div class="col-md-4">
                
            </div>
            
            <div class="col-md-4">
                <br/><br/><br/><br/>
                <div style="border-radius: 10px; background-color: rgb(195, 201, 201)" class="card">
                    <div class="card-header">
                        Login 
                    </div>
                    <div class="card-body">
                        
                        <?php if(isset($mensaje)) { ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $mensaje; ?>
                            </div>
                        <?php } ?>
                        
                        <form action="" method="post">
                            
                            <div style="text-align: center;" class="form-group">
                                <img src="img/desel.png" width="100" />
                            </div>

                            <div class="form-group">
                              <label for="correo">Correo</label>
                              <input style="background-color: rgb(195, 201, 201); border-radius: 25px 25px 25px 25px;" type="email" class="form-control" name="correo" id="correo" placeholder="Ingresa tu correo">
                            </div>
                            
                            <div class="form-group">
                              <label for="contrasenia">Contrseña</label>
                              <input style="background-color: rgb(195, 201, 201); border-radius: 25px 25px 25px 25px;" type="password" class="form-control" name="contrasenia" id="contrasenia" placeholder="Ingresa tu contraseña">
                            </div>

                            <a href="recupera.php">Recupera tu contraseña</a><br/>

                            <input style="border-radius: 10px;" type="submit" name="entrar" id="entrar" class="btn btn-primary" value="Entrar"/>
                            &nbsp;
                            <a style="border-radius: 10px;" href="registrar.php" class="btn btn-primary">Registrar</a>
                        
                        </form>
                    
                    </div>
                </div>
            </div>
        </div> 
    </div>

  </body>
</html>