<?php 

include("../config/bd.php");

$titulo = '%requisiciones%';

$sentenciaSQL = $conexion->prepare("SELECT * FROM tutoriales WHERE titulo LIKE :titulo ");
$sentenciaSQL->bindParam(':titulo', $titulo);
$sentenciaSQL->execute();
$tutorialSQL = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

include("../template/cabecera.php");

?>

    <div class="col-md-3">

    </div>

    <div class="col-md-6">

        <video width="600" height="300" controls>
            <source src="../videos/<?php echo $tutorialSQL['video']; ?>" />
        </video>
        <br/>
        <label><?php echo $tutorialSQL['titulo']; ?></label>

    </div>

<?php include("../template/pie.php");