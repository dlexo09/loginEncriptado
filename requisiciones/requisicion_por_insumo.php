<?php 

include("../config/bd.php");

$buscador = (isset($_POST['buscador'])) ? $_POST['buscador'] : "";
$titulo = '%'.$buscador.'%';

$sentenciaSQL = $conexion->prepare("SELECT * FROM tutoriales WHERE titulo LIKE :titulo ");
$sentenciaSQL->bindParam(':titulo', $titulo);
$sentenciaSQL->execute();
$tutorialSQL = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

if($tutorialSQL['titulo'] != "") {
    $clase = "success";
    $mensaje = "El tutorial se encontro";
} else {
    $clase = "danger";
    $mensaje = "Tutorial no encontrado";
}

include("../template/cabecera.php");

?>

    <div class="col-md-3">

    </div>

    <div class="col-md-6">

        <form method="post">

            <input type="text" name="buscador" id="buscador" />
            &nbsp;
            <input type="submit" class="btn btn-primary" name="buscar" id="buscar" />

        </form>

        <?php if(isset($mensaje)) { ?>
            <div class="alert alert-<?php echo $clase; ?>" role="alert">
                <?php echo $mensaje; ?>
            </div>
        <?php } ?>

        <?php if($tutorialSQL['titulo'] != "") { ?>

            <video width="600" height="300" controls>
                <source src="../videos/<?php echo $tutorialSQL['video']; ?>" />
            </video>
            <br/>
            <label><?php echo $tutorialSQL['titulo']; ?></label>

        <?php } ?>

    </div>

<?php include("../template/pie.php");