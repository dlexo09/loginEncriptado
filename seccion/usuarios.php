<?php 

include("../config/bd.php");

$sentenciaSQL = $conexion->prepare("SELECT usuarios.id AS id, usuarios.nombre AS nombre, usuarios.correo AS correo, perfiles.nombre AS perfil, usuarios.imagen AS imagen FROM usuarios LEFT JOIN perfiles ON usuarios.perfil = perfiles.id");
$sentenciaSQL->execute();
$usuariosSQL = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

include("../template/cabecera.php"); 

?>
    
    <div class="col-md-12">

        <h2 style="color: #5693e7">Tabla de usuarios</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="color: #3eb7d8">Imagen</th>
                    <th style="color: #3eb7d8">Nombre</th>
                    <th style="color: #3eb7d8">Correo</th>
                    <th style="color: #3eb7d8">Perfil</th>
                    <th style="color: #3eb7d8">Cambiar clave</th>
                    <th style="color: #3eb7d8">Editar usuario</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($usuariosSQL as $usuarioSQL) { ?>
                <tr>
                    <td><img src="../img/<?php echo $usuarioSQL['imagen']; ?>" height="100" width="100" /></td>
                    <td style="color: #72ddfa"><?php echo $usuarioSQL['nombre']; ?></td>
                    <td style="color: #72ddfa"><?php echo $usuarioSQL['correo']; ?></td>
                    <td style="color: #72ddfa"><?php echo $usuarioSQL['perfil']; ?></td>
                    <td>
                        <a style="border-radius: 10px;" href="../forms/cambiar_clave.php?id=<?php echo $usuarioSQL['id']; ?>" class="btn btn-primary">Cambiar</a>
                    </td>
                    <td>
                        <a style="border-radius: 10px;" href="editar_perfil.php?id=<?php echo $usuarioSQL['id']; ?>" class="btn btn-warning">Editar</a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

<?php include("../template/pie.php") ?>
