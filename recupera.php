<?php

session_start();

if(isset($_SESSION['error'])) {
    $clase = 'danger';
    $mensaje = $_SESSION['error'];
    unset($_SESSION['error']);
} else if(isset($_SESSION['respuesta'])){
    $clase = 'success';
    $mensaje = $_SESSION['respuesta'];
} else {
    $clase = 'info';
    $mensaje = "Ingresa tu correo y te haremos recuperar la clave de acceso";
}

?>

<!doctype html>
<html lang="en">
  <head>
    <title>Recuperar contraseña</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/recupera.css" />
  </head>
  <body>

    <div class="container">
        <div class="row">

            <div class="col-md-4">
                
            </div>
            
            <div class="col-md-4">
                <br/><br/><br/><br/><br/><br/>
                <div style="border-radius: 10px; background-color: rgb(195, 201, 201)" class="card">
                    <div class="card-header">
                        Recupera tu contraseña
                    </div>
                    
                    <div class="card-body">
                       <?php if(isset($mensaje)) { ?>
                            <div class="alert alert-<?php echo $clase; ?>" role="alert">
                                <?php echo $mensaje; ?>
                            </div>
                        <?php } ?> 
                        <form action="forms/recuperar_clave.php" method="post">
                        
                            <div class="form-group">
                              <label for="correo">Correo</label>
                              <input style="background-color: rgb(195, 201, 201); border-radius: 25px 25px 25px 25px;" type="email" class="form-control" name="correo" id="correo" placeholder="Ingresa tu correo">
                            </div>

                            <input style="border-radius: 10px;" type="submit" name="recupera" id="recupera" class="btn btn-primary" value="Recupera"/>
                        
                        </form>
                    
                    </div>
                </div>
            </div>
        </div> 
    </div>
  </body>
</html>