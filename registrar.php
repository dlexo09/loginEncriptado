<?php 

include("config/bd.php");

$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : "";
$correo = (isset($_POST['correo'])) ? $_POST['correo'] : "";
$contrasenia = (isset($_POST['contrasenia'])) ? $_POST['contrasenia'] : "";
$perfil = (isset($_POST['perfil'])) ? $_POST['perfil'] : "";

$numPerfil = intval($perfil);
if(isset($_POST['registrar'])) {
    $mensaje = "";
    $encriptada = password_hash($contrasenia, PASSWORD_DEFAULT);
    $sentenciaSQL = $conexion->prepare("INSERT INTO usuarios (nombre, correo, contrasenia, perfil) VALUES (:nombre, :correo, :contrasenia, :perfil)");
    $sentenciaSQL->bindParam(':nombre', $nombre);
    $sentenciaSQL->bindParam(':correo', $correo);
    $sentenciaSQL->bindParam(':contrasenia', $encriptada);
    $sentenciaSQL->bindParam(':perfil', $numPerfil);
    if($sentenciaSQL->execute()) {
        $mensaje = "Registro exitoso";
    } else {
        $mensaje = "Falla en el registro";
    }
}

$sentenciaSQL = $conexion->prepare("SELECT * FROM perfiles");
$sentenciaSQL->execute();
$perfilesSQL = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

<!doctype html>
<html lang="en">
  <head>
    <title>Registrar</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>

    <div class="container">
        <div class="row">

            <div class="col-md-4">
                
            </div>
            
            <div class="col-md-4">
                <br/><br/><br/>
                <div class="card">
                    <div class="card-header">
                        Registrar
                    </div>
                    <div class="card-body">

                    <?php if(isset($mensaje)) { ?>
                        <div class="alert alert-info" role="alert">
                            <?php echo $mensaje; ?>
                        </div>
                    <?php } ?>
                        
                        <form action="" method="post">

                            <div class="form-group">
                              <label for="nombre">Nombre</label>
                              <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingresa tu nombre completo">
                            </div>
                        
                            <div class="form-group">
                              <label for="correo">Correo</label>
                              <input type="email" class="form-control" name="correo" id="correo" placeholder="Ingresa tu correo">
                            </div>
                            
                            <div class="form-group">
                              <label for="contrasenia">Contraseña</label>
                              <input type="password" class="form-control" name="contrasenia" id="contrasenia" placeholder="Ingresa tu contraseña">
                            </div>

                            <div class="form-group">
                              <div class="form-group">
                                <label for="perfil">Perfil</label>
                                <select id="perfil" class="form-control" name="perfil">
                                <?php foreach($perfilesSQL as $perfilSQL) { ?>
                                    <option value="<?php echo $perfilSQL['id']; ?>"><?php echo $perfilSQL['nombre']; ?></option>
                                <?php } ?>
                                </select>
                              </div>
                            </div>

                            <input type="submit" name="registrar" id="registrar" class="btn btn-primary" value="Registrar"/>
                            &nbsp;
                            <a href="index.php" class="btn btn-primary">Login</a>
                        
                        </form>
                    
                    </div>
                </div>
            </div>
        </div> 
    </div>
  </body>
</html>