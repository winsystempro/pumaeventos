<?php 
include("../../bd.php");

if(isset($_GET['txtID'])){
//borrar dicho registro con el ID correspondiente
$txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
$sentencia=$conexion->prepare("DELETE FROM `tbl_servicios` WHERE id=:id");
$sentencia->bindParam(":id",$txtID);
$sentencia->execute();
}

// SELECCION DE REGISTROS
$sentencia=$conexion->prepare("SELECT * FROM `tbl_servicios`");
$sentencia->execute();
$lista_servicios=$sentencia->fetchAll(PDO::FETCH_ASSOC);


include("../../templates/header.php"); ?>

<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar registros</a>
        <a href="https://fontawesome.com/v5/search" target="_blank"> revisar iconos</a>
    </div>
    <div class="card-body">
        
    <div
        class="table-responsive-sm"
    >
        <table
            class="table table-striped">
            <thead>
                <tr>
                    <th style="text-align: center;" scope="col">ID</th>
                    <th style="text-align: center;" scope="col">Icono</th>
                    <th style="text-align: center;" scope="col">Titulo</th>
                    <th style="text-align: center;" scope="col">Descripción</th>
                    <th style="text-align: center;" scope="col">Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($lista_servicios as $registros){?>
                <tr class="">
                    <td><?php echo $registros['ID'];?></td>
                    <td><?php echo $registros['icono'];?></td>
                    <td><?php echo $registros['titulo'];?></td>
                    <td ><?php echo $registros['descripcion'];?></td>
                    <td class="d-flex justify-content-center">
                        <a name="" id="" class="btn btn-success me-2" href="editar.php?txtID=<?php echo $registros['ID']; ?>" role="button">Editar</a>
                        
                        <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo $registros['ID']; ?>" role="button">Eliminar</a>
                        
                    </td>
                </tr>  
                <!-- Agregar fila vacía para la línea -->
        <!--<tr>
            <td colspan="5" style="border-bottom: 0.5px; background-color: #dee2e6;"></td>
        </tr>  -->
                <?php }?>             
            </tbody>
        </table>
    </div>   

    </div>
    
</div>

<?php include("../../templates/footer.php"); ?>