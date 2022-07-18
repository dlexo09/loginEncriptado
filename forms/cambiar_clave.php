<?php 

include("../config/bd.php");

$nueva_clave = (isset($_POST['nueva_clave'])) ? $_POST['nueva_clave'] : "1234";
$confirmar_clave = (isset($_POST['confirmar_clave'])) ? $_POST['confirmar_clave'] : "";
$nueva = password_hash($nueva_clave, PASSWORD_DEFAULT);

$id = $_GET['id'];
if($nueva_clave != $confirmar_clave) {
    $clase = "danger";
    $mensaje = "Las contraseñas no coinciden";
} else {
    $sentenciaSQL = $conexion->prepare("UPDATE usuarios SET contrasenia = :contrasenia WHERE id = :id");
    $sentenciaSQL->bindParam(':contrasenia', $nueva);
    $sentenciaSQL->bindParam(':id', $id);
    $sentenciaSQL->execute();
    $clase = "success";
    $mensaje = "La contraseña fue cambiada exitosamente";
}

include("../template/cabecera.php"); 

?>

    <div class="col-md-4">

    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                Cambiar clave
            </div>
            <div class="card-body">

                <form action="" method="post">
                    <?php if(isset($mensaje)) { ?>
                        <div class="alert alert-<?php echo $clase; ?>" role="alert">
                            <?php echo $mensaje; ?>
                        </div>
                    <?php } ?> 
                    <div class="form-group">
                      <label for="nueva_clave">Nueva contraseña</label>
                      <input type="password" class="form-control" name="nueva_clave" id="nueva_clave" placeholder="">
                    </div>

                    <div class="form-group">
                      <label for="confirmar_clave">Confirma contraseña</label>
                      <input type="password" class="form-control" name="confirmar_clave" id="confirmar_clave" placeholder="">
                    </div>

                    <button type="submit" class="btn btn-primary">Cambiar</button>

                </form>
            </div>
        </div>
    </div>

<?php include("../template/pie.php"); ?>