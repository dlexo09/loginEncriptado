<?php 

include("../config/bd.php");

$sentenciaSQL = $conexion->prepare("SELECT usuarios.id AS id, usuarios.nombre AS nombre, usuarios.correo AS correo, perfiles.nombre AS perfil FROM usuarios LEFT JOIN perfiles ON usuarios.perfil = perfiles.id");
$sentenciaSQL->execute();
$usuariosSQL = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

include("../template/cabecera.php"); 

?>
    
    <div class="col-md-12">

        <div class="card">
            <div class="card-header">
                Tabla de usuarios
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Perfil</th>
                            <th>Cambiar clave</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($usuariosSQL as $usuarioSQL) { ?>
                        <tr>
                            <td><?php echo $usuarioSQL['nombre']; ?></td>
                            <td><?php echo $usuarioSQL['correo']; ?></td>
                            <td><?php echo $usuarioSQL['perfil']; ?></td>
                            <td><a href="../forms/cambiar_clave.php?id=<?php echo $usuarioSQL['id']; ?>" class="btn btn-primary">Cambiar</a></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php include("../template/pie.php") ?>
