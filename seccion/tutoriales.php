<?php 

include("../config/bd.php");

$video = (isset($_FILES['video']['name'])) ? $_FILES['video']['name'] : "";
$titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : "";

if(isset($_POST['cargar'])) {
    $sentenciaSQL = $conexion->prepare("INSERT INTO tutoriales (video, titulo) VALUE (:video, :titulo)");

    $fecha = new DateTime();
    $nombreVideo = ($video != "") ? $fecha->getTimestamp()."_".$_FILES['video']['name'] : "video.mp4";

    $tmpVideo = $_FILES['video']['tmp_name'];

    if($tmpVideo != "") {
        move_uploaded_file($tmpVideo, "../videos/".$nombreVideo);
    }

    $sentenciaSQL->bindParam(':video', $nombreVideo);
    $sentenciaSQL->bindParam(':titulo', $titulo);

    if($sentenciaSQL->execute()) {
        $clase = "success";
        $mensaje = "El video fue cargado satisfactoriamente";
    } else {
        $clase = "danger";
        $mensaje = "El video no pudo cargarse";
    }

}

include("../template/cabecera.php");

?>

    <div class="col-md-4">

    </div>

    <div class="col-md-4">

        <div class="card">
            <div class="card-header">
                Cargar tutoriales
            </div>
            <div class="card-body">

                <?php if(isset($mensaje)) { ?>
                    <div class="alert alert-<?php echo $clase; ?>" role="alert">
                        <?php echo $mensaje; ?>
                    </div>
                <?php } ?>

                <form method="post" enctype="multipart/form-data">

                    <div class="form-group">
                    <label for="video"></label>
                    <input type="file" class="form-control" name="video" id="video" placeholder="Selecciona el video">
                    </div>

                    <div class="form-group">
                    <label for="titulo"></label>
                    <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Escribe el titulo del video">
                    </div>

                    <input type="submit" class="btn btn-primary" name="cargar" id="cargar" value="Cargar video" />

                </form>
                
            </div>
        </div>

    </div>

<?php include("../template/pie.php"); ?>