<?php
include("../../bd.php");

if (isset($_GET['txtID'])) { //recibimos el id 
    //recuperar los datos del ID correspondiente (seleccionado)
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

    // borrado de registros
    //buscamos datos del portafolio
    $sentencia = $conexion->prepare("SELECT imagen FROM `tbl_portafolio` WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    //utilizamos el regisatro que encontramos
    $registro_imagen = $sentencia->fetch(PDO::FETCH_LAZY);
    //preguntar si el registro existe y si existe borramos
    if (isset($registro_imagen["imagen"])) {
        if (file_exists("../../../assets/img/portfolio/" . $registro_imagen["imagen"])) {
            // la instruccion unlink nos borra fisicamente la imagen
            unlink("../../../assets/img/portfolio/" . $registro_imagen["imagen"]);
        }
    } 


    //borrado de imagenes de la carpeta, buscamos el nombre de la foto relacionada con el ID
    // borrado de registros
    $sentencia = $conexion->prepare("DELETE FROM `tbl_portafolio` WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
}
// SELECCION DE REGISTROS
$sentencia = $conexion->prepare("SELECT * FROM tbl_portafolio");
$sentencia->execute();
$lista_portafolio = $sentencia->fetchAll(PDO::FETCH_ASSOC);

include("../../templates/header.php"); ?>

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
                        <th style="text-align: center;" scope="col">Título</th>
                        <th style="text-align: center;" scope="col">Subtitulo</th>
                        <th style="text-align: center;" scope="col">Imagen</th>
                        <th style="text-align: center;" scope="col">Descripcion</th>
                        <th style="text-align: center;" scope="col">Cliente</th>
                        <th style="text-align: center;" scope="col">Categoria</th>
                        <th style="text-align: center;" scope="col">url</th>
                        <th style="text-align: center;" scope="col">Acciones</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lista_portafolio as $registros) { ?>
                        <tr class="">
                            <td scope="col"><?php echo $registros['ID']; ?></td>
                            <td scope="col"><?php echo $registros['titulo']; ?></td>
                            <td scope="col"><?php echo $registros['subtitulo']; ?></td>
                            <td scope="col">
                                <img width="50" src="../../../assets/img/portfolio/<?php echo $registros['imagen']; ?>" />
                            </td>
                            <td scope="col"><?php echo $registros['descripcion']; ?></td>
                            <td scope="col"><?php echo $registros['cliente']; ?></td>
                            <td scope="col"><?php echo $registros['categoria']; ?></td>
                            <td scope="col"><?php echo $registros['url']; ?></td>
                            <td style="max-width: 200px;">
                            <div class="d-flex">
                                <a name="" id="" class="btn btn-success me-2" href="editar.php?txtID=<?php echo $registros['ID']; ?>" role="button">Editar</a>
                                <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo $registros['ID']; ?>" role="button">Eliminar</a>
                            </div>
                            </td>
                        </tr>
                        <!-- Agregar fila vacía para la línea -->
                        <!--<tr>
            <td colspan="5" style="border-bottom: 0.5px; background-color: #dee2e6;"></td>
        </tr>  -->
                    <?php } ?>
                </tbody>
            </table>
        </div>




    </div>
</div>

<?php include("../../templates/footer.php"); ?>