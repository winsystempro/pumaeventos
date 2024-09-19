<?php 
include("../../bd.php");

if(isset($_GET['txtID'])){
    //recuperar los datos del ID correspondiente (seleccionado)
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("SELECT * FROM tbl_configuraciones WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);

    $nombreconfiguracion=$registro['nombreconfiguracion'];
    $valor=$registro['valor'];

    }

    if($_POST){

        //Recepcionamos los valores del formulario
        $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
        $nombreconfiguracion=(isset($_POST['nombreconfiguracion']))?$_POST['nombreconfiguracion']:"";
        $valor=(isset($_POST['valor']))?$_POST['valor']:"";
    
        $sentencia=$conexion->prepare("UPDATE tbl_configuraciones 
        SET nombreconfiguracion=:nombreconfiguracion, valor=:valor WHERE id=:id;"); 
          
        $sentencia->bindParam(":nombreconfiguracion",$nombreconfiguracion);
        $sentencia->bindParam(":valor",$valor);
        $sentencia->bindParam(":id",$txtID);
        $sentencia->execute();
    
        $mensaje="Registro modificado con éxito.";
        header("Location:index.php?mensaje=".$mensaje);//regresa a la pagina de index.php
    
    }

include("../../templates/header.php"); ?>


<div class="card">
    <div class="card-header">Configuración</div>
    <div class="card-body">

        <form action="" method="post">

        <div class="mb-3">
            <label for="txtID" class="form-label">ID:</label>
            <input readonly type="text" value="<?php echo $txtID;?>" class="form-control" name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID"/>
        </div>        

            <div class="mb-3">
                <label for="nombreconfiguracion" class="form-label">Nombre:</label>
                <input readonly type="text" value="<?php echo $nombreconfiguracion;?>" class="form-control" name="nombreconfiguracion" id="nombreconfiguracion" aria-describedby="helpId" placeholder="Nombre de la configuración" />
            </div>

            <div class="mb-3">
                <label for="valor" class="form-label">Valor</label>
                <input type="text" value="<?php echo $valor;?>" class="form-control" name="valor" id="valor" aria-describedby="helpId" placeholder="Valor de la configuración" />
            </div>
            <button type="submit" class="btn btn-success">Actualizar</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

        </form>

    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../templates/footer.php"); ?>