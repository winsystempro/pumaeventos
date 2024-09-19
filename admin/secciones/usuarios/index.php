<?php
include("../../bd.php");

if(isset($_GET['txtID'])){
    //borrar dicho registro con el ID correspondiente
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
    $sentencia=$conexion->prepare("DELETE FROM tbl_usuarios WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    }

// SELECCION DE REGISTROS
$sentencia = $conexion->prepare("SELECT * FROM tbl_usuarios");
$sentencia->execute();
$lista_usuarios = $sentencia->fetchAll(PDO::FETCH_ASSOC);

include("../../templates/header.php");
?>

<div class="card">
    <div class="card-header"><a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar registros</a></div>
    <div class="card-body">

        <div class="table-responsive-sm">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="text-align: center;" scope="col">ID</th>
                        <th style="text-align: center;" scope="col">Usuario</th>
                        <th style="text-align: center;" scope="col">Contraseña</th>
                        <th style="text-align: center;" scope="col">Correo</th>
                        <th style="text-align: center;" scope="col">Aciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lista_usuarios as $registros) { ?>
                        <tr class="">
                            <td scope="col"><?php echo $registros['ID']; ?></td>
                            <td scope="col"><?php echo $registros['usuario']; ?></td>
                            <td scope="col"><?php echo $registros['password']; ?></td>
                            <td scope="col"><?php echo $registros['correo']; ?></td>
                            
                            <td style="max-width: 200px;">
                            <div class="d-flex">
                                <a name="" id="" class="btn btn-success me-2" href="editar.php?txtID=<?php echo $registros['ID']; ?>" role="button">Editar</a>
                                <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo $registros['ID']; ?>" role="button">Eliminar</a>
                            </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
    <div class="card-footer text-muted"></div>
</div>



<?php include("../../templates/footer.php"); ?>