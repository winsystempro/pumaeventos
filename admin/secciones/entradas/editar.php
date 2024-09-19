<?php 
include("../../bd.php");

if (isset($_GET['txtID'])) {
    //recuperar los datos del ID correspondiente (seleccionado)
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
    //CONSULTAMOS REGISTROS
    $sentencia = $conexion->prepare("SELECT * FROM tbl_entradas WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);

    // RECUPERAMOS REGISTROS CORRESPONDIENTES

    $fecha = $registro['fecha'];
    $titulo = $registro['titulo'];    
    $imagen = $registro['imagen'];
    $descripcion = $registro['descripcion'];
    
}
if ($_POST) {
    $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
    $fecha = (isset($_POST['fecha'])) ? $_POST['fecha'] : "";
    $titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : "";
    $descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : "";
    
    $sentencia = $conexion->prepare("UPDATE `tbl_entradas` 
    SET fecha=:fecha, titulo=:titulo, descripcion=:descripcion WHERE id=:id ");

    $sentencia->bindParam(":fecha", $fecha);
    $sentencia->bindParam(":titulo", $titulo); //coloca las variables y las relaciona para que se ejecute en cada instruccion es decir en titulo     
    $sentencia->bindParam(":descripcion", $descripcion);
    $sentencia->bindParam(":id", $txtID);         
    $sentencia->execute();

    //ACTUALIZACION INDEPENDIENTE DE LA IMAGEN
    if ($_FILES["imagen"]["tmp_name"] != "") {

        $imagen = (isset($_FILES["imagen"]["name"])) ? $_FILES["imagen"]["name"] : "";
        $fecha_imagen = new DateTime();
        $nombre_archivo_imagen = ($imagen != "") ? $fecha_imagen->getTimestamp() . "_" . $imagen : "";

        $tmp_imagen = $_FILES["imagen"]["tmp_name"];

        move_uploaded_file($tmp_imagen, "../../../assets/img/about/" . $nombre_archivo_imagen); //INDICA LOS PUESTOS QUE TIENE QUE SALIR PARA PODER INGRESAR A LA CARPETA DE IMAGENES

        // borrado de registros de imagenes anteriores
        //buscamos datos del portafolio de imagenes anteriores
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

        $sentencia = $conexion->prepare("UPDATE tbl_entradas SET imagen=:imagen WHERE id=:id ");
        $sentencia->bindParam(":imagen", $nombre_archivo_imagen);
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute();
        $imagen=$nombre_archivo_imagen;
    }
    $mensaje="Registro modificado con éxito.";
    header("Location:index.php?mensaje=".$mensaje);//regresa a la pagina de index.php


}

include("../../templates/header.php"); ?>
<div class="card">
    <div class="card-header">Entradas</div>
    <div class="card-body">

        <form action="" method="post" enctype="multipart/form-data"><!--enctype="multipart/form-data" para envio de imagenes o archivos-->

        <div class="mb-3">
            <label for="txtID" class="form-label">ID:</label>
            <input type="text" 
            class="form-control" readonly value="<?php echo $txtID;?>" name="txtID" id="txtID" aria-describedby="helpId" placeholder=""/>
            
        </div>
        

            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha:</label>
                <input type="date" class="form-control" value="<?php echo $fecha;?>" name="fecha" id="fecha" aria-describedby="helpId" placeholder="Fecha" />
            </div>

            <div class="mb-3">
                <label for="titulo" class="form-label">Titulo:</label>
                <input type="text" class="form-control" value="<?php echo $titulo;?>" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Titulo" />
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción:</label>
                <input type="text" class="form-control" value="<?php echo $descripcion;?>" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Descripción" />
            </div>

            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen:</label>
                <img width="50" src="../../../assets/img/about/<?php echo $imagen; ?>" />
                <input type="file" class="form-control" name="imagen" id="imagen" placeholder="Imagen" aria-describedby="fileHelpId" />
            </div>
            <button type="submit" class="btn btn-success">Actualizar</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

        </form>

    </div>
    <div class="card-footer text-muted"></div>
</div>
<?php include("../../templates/footer.php"); ?>