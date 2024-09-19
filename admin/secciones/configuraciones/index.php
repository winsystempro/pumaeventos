<?php
include("../../bd.php");

if(isset($_GET['txtID'])){
    //borrar dicho registro con el ID correspondiente
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
    $sentencia=$conexion->prepare("DELETE FROM `tbl_configuraciones` WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    
    }

// PARA LISTAR REGISTROS de configuraciones
$sentencia = $conexion->prepare("SELECT * FROM tbl_configuraciones");
$sentencia->execute();
$lista_configuraciones = $sentencia->fetchAll(PDO::FETCH_ASSOC);

include("../../templates/header.php"); ?>

<div class="card">
    <div class="card-header">
       <!-- <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar registros</a> -->
      <h4> Configuraciones</h4>
    </div>
    <div class="card-body">

        <div class="table-responsive-sm">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="text-align: center;" scope="col">ID</th>
                        <th style="text-align: center;" scope="col">Nombre de la configuración</th>
                        <th style="text-align: center;" scope="col">Valor</th>
                        <th style="text-align: center;" scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lista_configuraciones as $registros) { ?>
                        <tr class="">
                            <td><?php echo $registros['ID']; ?></td>
                            <td><?php echo $registros['nombreconfiguracion']; ?></td>
                            <td><?php echo $registros['valor']; ?></td>
                            <td style="max-width: 200px;">
                                <div class="d-flex">
                                    <a name="" id="" class="btn btn-success me-2" href="editar.php?txtID=<?php echo $registros['ID']; ?>" role="button">Editar</a>
                                   <!-- <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo $registros['ID']; ?>" role="button">Eliminar</a> -->
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