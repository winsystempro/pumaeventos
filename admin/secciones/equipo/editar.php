<?php
include("../../bd.php");

if (isset($_GET['txtID'])) {
    //recuperar los datos del ID correspondiente (seleccionado)
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
    //CONSULTAMOS REGISTROS
    $sentencia = $conexion->prepare("SELECT * FROM tbl_equipo WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);

    // RECUPERAMOS REGISTROS CORRESPONDIENTES

    $imagen = $registro['imagen'];
    $nombrecompleto = $registro['nombrecompleto'];
    $puesto = $registro['puesto'];
    $twitter = $registro['twitter'];
    $facebook = $registro['facebook'];
    $linkedin = $registro['linkedin'];
}

if ($_POST) {
    //recoleccion de informacion
    $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
    $imagen = (isset($_FILES["imagen"]["name"])) ? $_FILES["imagen"]["name"] : "";
    $nombrecompleto = (isset($_POST['nombrecompleto'])) ? $_POST['nombrecompleto'] : "";
    $puesto = (isset($_POST['puesto'])) ? $_POST['puesto'] : "";
    $twitter = (isset($_POST['twitter'])) ? $_POST['twitter'] : "";
    $facebook = (isset($_POST['facebook'])) ? $_POST['facebook'] : "";
    $linkedin = (isset($_POST['linkedin'])) ? $_POST['linkedin'] : "";

    //guarda registros en la base de datos

    $sentencia = $conexion->prepare("UPDATE tbl_equipo SET
 nombrecompleto=:nombrecompleto, 
 puesto=:puesto, 
 twitter=:twitter, 
 facebook=:facebook, 
 linkedin=:linkedin 
WHERE ID=:id ");

    $sentencia->bindParam(":id", $txtID);
    $sentencia->bindParam(":nombrecompleto", $nombrecompleto);
    $sentencia->bindParam(":puesto", $puesto); //coloca las variables y las relaciona para que se ejecute en cada instruccion es decir en titulo     
    $sentencia->bindParam(":twitter", $twitter);
    $sentencia->bindParam(":facebook", $facebook);
    $sentencia->bindParam(":linkedin", $linkedin);
    $sentencia->execute();

    //ACTUALIZACION INDEPENDIENTE DE LA IMAGEN
    if ($_FILES["imagen"]["tmp_name"] != "") {

        $imagen = (isset($_FILES["imagen"]["name"])) ? $_FILES["imagen"]["name"] : "";
        $fecha_imagen = new DateTime();
        $nombre_archivo_imagen = ($imagen != "") ? $fecha_imagen->getTimestamp() . "_" . $imagen : "";

        $tmp_imagen = $_FILES["imagen"]["tmp_name"];

        move_uploaded_file($tmp_imagen, "../../../assets/img/team/" . $nombre_archivo_imagen); //INDICA LOS PUESTOS QUE TIENE QUE SALIR PARA PODER INGRESAR A LA CARPETA DE IMAGENES

        // borrado de registros de imagenes anteriores
        //buscamos datos del portafolio de imagenes anteriores
        $sentencia = $conexion->prepare("SELECT imagen FROM `tbl_equipo` WHERE id=:id");
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute();
        //utilizamos el registro que encontramos
        $registro_imagen = $sentencia->fetch(PDO::FETCH_LAZY);
        //preguntar si el registro existe y si existe borramos
        if (isset($registro_imagen["imagen"])) {
            if (file_exists("../../../assets/img/team/" . $registro_imagen["imagen"])) {
                // la instruccion unlink nos borra fisicamente la imagen
                unlink("../../../assets/img/team/" . $registro_imagen["imagen"]);
            }
        }

        $sentencia = $conexion->prepare("UPDATE tbl_equipo SET imagen=:imagen WHERE id=:id ");
        $sentencia->bindParam(":imagen", $nombre_archivo_imagen);
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute();
        $imagen = $nombre_archivo_imagen;
    }
    $mensaje = "Registro modificado con éxito.";
    header("Location:index.php?mensaje=" . $mensaje); //regresa a la pagina de index.php

}
include("../../templates/header.php"); ?>
<div class="card">
    <div class="card-header">
        Datos de la Persona
    </div>
    <div class="card-body">

        <form action="" method="post" enctype="multipart/form-data"><!--enctype="multipart/form-data" para envio de imagenes o archivos-->

            <div class="mb-3">
                <label for="txtID" class="form-label">ID:</label>
                <input type="text" readonly class="form-control" value="<?php echo $txtID; ?>" name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID" />

            </div>

            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen:</label>
                <img width="50" src="../../../assets/img/team/<?php echo $imagen; ?>" />
                <input type="file" class="form-control" name="imagen" id="imagen" aria-describedby="helpId" placeholder="Imagen" />
            </div>
            <div class="mb-3">
                <label for="nombrecompleto" class="form-label">Nombre Completo:</label>
                <input type="text" class="form-control" value="<?php echo $nombrecompleto; ?>" name="nombrecompleto" id="nombrecompleto" aria-describedby="helpId" placeholder="Nombre" />
            </div>
            <div class="mb-3">
                <label for="puesto" class="form-label">Puesto:</label>
                <input type="text" class="form-control" value="<?php echo $puesto; ?>" name="puesto" id="puesto" aria-describedby="helpId" placeholder="Puesto" />
            </div>
            <div class="mb-3">
                <label for="twitter" class="form-label">Twitter:</label>
                <input type="text" class="form-control" value="<?php echo $twitter; ?>" name="twitter" id="twitter" aria-describedby="helpId" placeholder="Twitter" />
            </div>
            <div class="mb-3">
                <label for="facebook" class="form-label">Facebook:</label>
                <input type="text" class="form-control" value="<?php echo $facebook; ?>" name="facebook" id="facebook" aria-describedby="helpId" placeholder="Facebook" />
            </div>
            <div class="mb-3">
                <label for="linkedin" class="form-label">Linkedin:</label>
                <input type="text" class="form-control" value="<?php echo $linkedin; ?>" name="linkedin" id="linkedin" aria-describedby="helpId" placeholder="Linkedin" />
            </div>
            <button type="submit" class="btn btn-success">Actualizar</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

        </form>


    </div>
    <div class="card-footer text-muted">

    </div>
</div>
<?php include("../../templates/footer.php"); ?>