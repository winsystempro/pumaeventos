<?php
include("../../bd.php");

// BORRADO DE REGISTROS CON EL ID
if (isset($_GET['txtID'])) { //recibimos el id 
    //recuperar los datos del ID correspondiente (seleccionado)
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

    // borrado de registros
    //buscamos datos del portafolio
    $sentencia = $conexion->prepare("SELECT imagen FROM `tbl_entradas` WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    //utilizamos el regisatro que encontramos
    $registro_imagen = $sentencia->fetch(PDO::FETCH_LAZY);
    //preguntar si el registro existe y si existe borramos
    if (isset($registro_imagen["imagen"])) {
        if (file_exists("../../../assets/img/about/" . $registro_imagen["imagen"])) {
            // la instruccion unlink nos borra fisicamente la imagen
            unlink("../../../assets/img/about/" . $registro_imagen["imagen"]);
        }
    } 


    //borrado de imagenes de la carpeta, buscamos el nombre de la foto relacionada con el ID
    // borrado de registros
    $sentencia = $conexion->prepare("DELETE FROM `tbl_entradas` WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
}

// PARA LISTAR REGISTROS de entradas
$sentencia = $conexion->prepare("SELECT * FROM tbl_entradas");
$sentencia->execute();
$lista_entradas = $sentencia->fetchAll(PDO::FETCH_ASSOC);

include("../../templates/header.php");
?>

<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar registros</a>
    </div>
    <div class="card-body">

        <div class="table-responsive-sm">
            <table class="table table-striped"><!--table-striped para poner color una fila de un colo y la siguente de otro color-->
                <thead>
                    <tr>
                        <th style="text-align: center;" scope="col">ID</th>
                        <th style="text-align: center;" scope="col">Fecha</th>                        
                        <th style="text-align: center;" scope="col">Titulo</th>
                        <th style="text-align: center;" scope="col">Descripción</th>
                        <th style="text-align: center;" scope="col">Imagen</th>
                        <th style="text-align: center;" scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lista_entradas as $registros) { ?>

                        <tr class="">
                            <td><?php echo $registros['ID']; ?></td>
                            <td><?php echo $registros['fecha']; ?></td>
                            <td><?php echo $registros['titulo']; ?></td>
                            <td><?php echo $registros['descripcion']; ?></td>
                            <td>
                            <img width="50" src="../../../assets/img/about/<?php echo $registros['imagen']; ?>" />
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