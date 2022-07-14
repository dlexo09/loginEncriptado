<?php
session_start();
if(!isset($_SESSION['usuario'])) {
  header("Location: ../index.php");
} else {
   if($_SESSION['usuario'] == "ok") {
      $nombreUsuario = $_SESSION["nombreUsuario"];
   }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Inicio</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    
    <div class="container">
        <br/>
        <div class="row">
      
            <div class="col-md-12">
                
                <div class="jumbotron">
                    <h1 class="display-3">Bienvenido <?php echo $nombreUsuario; ?> </h1>
                    <p class="lead">Vamos a hacer las requesiciones</p>
                    <hr class="my-2">
                    <p>Más información</p>
                    <p class="lead">
                        <a class="btn btn-primary btn-lg" href="seccion/requisicion.php" role="button">Requisicion</a>
                    </p>
                </div>

            </div>

        </div>
    
    </div>

  </body>
</html>