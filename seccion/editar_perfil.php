<?php 

$id = $_GET['id'];

include("../config/bd.php");

$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : "";
$correo = (isset($_POST['correo'])) ? $_POST['correo'] : "";
$perfil = (isset($_POST['perfil'])) ? $_POST['perfil'] : "";
$foto = (isset($_FILES['foto']['name'])) ? $_FILES['foto']['name'] : "";

$numPerfil = intval($perfil);

$sentenciaSQL = $conexion->prepare("SELECT * FROM usuarios WHERE id = :id");
$sentenciaSQL->bindParam(':id', $id);
$sentenciaSQL->execute();
$usuarioSQL = $sentenciaSQL->fetch(PDO::FETCH_LAZY); 

$sentenciaSQL = $conexion->prepare("SELECT * FROM perfiles");
$sentenciaSQL->execute();
$perfilesSQL = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST['modificar'])) {
    $sentenciaSQL = $conexion->prepare("UPDATE usuarios SET nombre = :nombre, correo = :correo, perfil = :perfil WHERE id = :id");
    $sentenciaSQL->bindParam(':nombre', $nombre);
    $sentenciaSQL->bindParam(':correo', $correo);
    $sentenciaSQL->bindParam(':perfil', $numPerfil);
    $sentenciaSQL->bindParam(':id', $id);
    if($sentenciaSQL->execute()) {
        $clase = "success";
        $mensaje = "Actualizacion exitosa";
    } else {
        $clase = "danger";
        $mensaje = "Falla en la actualizacion";
    }

    if($foto != "") {

        $fecha = new DateTime();
        $nombreArchivo = ($foto != "") ? $fecha->getTimestamp()."_".$_FILES['foto']['name'] : "imagen.jpg";
        $tmpImagen = $_FILES['foto']['tmp_name'];

        move_uploaded_file($tmpImagen, "../img/".$nombreArchivo);

        $sentenciaSQL = $conexion->prepare("SELECT * FROM usuarios WHERE id = :id");
        $sentenciaSQL->bindParam(':id', $id);
        $sentenciaSQL->execute();
        $usuarioSQL = $sentenciaSQL->fetch(PDO::FETCH_LAZY);  

        if(isset($usuarioSQL['imagen']) && $usuarioSQL['imagen'] != "imagen.jpg") {
            if(file_exists("../img/".$usuarioSQL['imagen'])) {
                unlink("../img/".$usuarioSQL['imagen']);
            }
        }

        $sentenciaSQL = $conexion->prepare("UPDATE usuarios SET imagen = :imagen WHERE id = :id");
        $sentenciaSQL->bindParam(':imagen', $nombreArchivo);
        $sentenciaSQL->bindParam(':id', $id);
        if($sentenciaSQL->execute()) {
            $clase = "success";
            $mensaje = "Actualizacion exitosa";
        } else {
            $clase = "danger";
            $mensaje = "Falla en la actualizacion";
        }
    }

    
}

include("../template/cabecera.php"); 

?>

    <div class="col-md-4">

    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                Perfil de usuario
            </div>
            <div class="card-body">

                <?php if(isset($mensaje)) { ?>
                    <div class="alert alert-<?php echo $clase; ?>" role="alert">
                        <?php echo $mensaje; ?>
                    </div>
                <?php } ?>

                <form action="" method="post" enctype="multipart/form-data">
                    
                    <div class="form-group">
                        <label for="foto">Foto</label><br/>
                        <input type="file" class="form-control" name="foto" id="foto" placeholder="Ingresa tu foto">
                        <img src="../img/<?php echo $usuarioSQL['imagen']; ?>" height="200" width="200" />
                    </div>

                    <div class="form-group">
                        <label for="nombre">Nombre completo</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $usuarioSQL['nombre']; ?>" placeholder="Ingresa tu nombre completo">
                    </div>
                        
                    <div class="form-group">
                        <label for="correo">Correo</label>
                        <input type="email" class="form-control" name="correo" id="correo" value="<?php echo $usuarioSQL['correo']; ?>" placeholder="Ingresa tu correo">
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

                    <input type="submit" name="modificar" id="modificar" class="btn btn-primary" value="Modificar"/>

                </form>
            </div>
        </div>
    </div>

<?php include("../template/pie.php"); ?>