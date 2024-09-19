<?php
include("../../bd.php");
//borrado de registros
if (isset($_GET['txtID'])) { //recibimos el id 
    //recuperar los datos del ID correspondiente (seleccionado)
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

    // borrado de registros
    //buscamos datos del portafolio
    $sentencia = $conexion->prepare("SELECT imagen FROM `tbl_equipo` WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    //utilizamos el regisatro que encontramos
    $registro_imagen = $sentencia->fetch(PDO::FETCH_LAZY);
    //preguntar si el registro existe y si existe borramos
    if (isset($registro_imagen["imagen"])) {
        if (file_exists("../../../assets/img/team/" . $registro_imagen["imagen"])) {
            // la instruccion unlink nos borra fisicamente la imagen
            unlink("../../../assets/img/team/" . $registro_imagen["imagen"]);
        }
    } 


    //borrado de imagenes de la carpeta, buscamos el nombre de la foto relacionada con el ID
    // borrado de registros
    $sentencia = $conexion->prepare("DELETE FROM `tbl_equipo` WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
}

// PARA LISTAR REGISTROS de EQUIPO
$sentencia = $conexion->prepare("SELECT * FROM tbl_equipo");
$sentencia->execute();
$lista_entradas = $sentencia->fetchAll(PDO::FETCH_ASSOC);

include("../../templates/header.php"); ?>

<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar registros</a>
    </div>
    <div class="card-body">

        <div class="table-responsive-sm">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="text-align: center;" scope="col">ID</th>
                        <th style="text-align: center;" scope="col">Imagen</th>
                        <th style="text-align: center;" scope="col">Nombre</th>
                        <th style="text-align: center;" scope="col">Puesto</th>
                        <th style="text-align: center;" scope="col">Redes sociales</th>

                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lista_entradas as $registros) { ?>
                        <tr class="">
                            <td scope="col"><?php echo $registros['ID']; ?></td>
                            <td scope="col">
                                <img width="50" src="../../../assets/img/team/<?php echo $registros['imagen']; ?>" />
                            </td>
                            <td scope="col"><?php echo $registros['nombrecompleto']; ?></td>
                            <td scope="col"><?php echo $registros['puesto']; ?></td>
                            <td scope="col">
                                <?php echo $registros['twitter']; ?>
                                <br><?php echo $registros['facebook']; ?>
                                <br><?php echo $registros['linkedin']; ?>
                            </td>
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
    <div class="card-footer text-muted">

    </div>
</div>

<?php include("../../templates/footer.php"); ?>