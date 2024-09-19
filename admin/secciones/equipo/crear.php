<?php
include("../../bd.php");
//Insercion de datos para crear personal del equipo
if ($_POST) {
    $imagen = (isset($_FILES["imagen"]["name"])) ? $_FILES["imagen"]["name"] : "";
    $nombrecompleto = (isset($_POST['nombrecompleto'])) ? $_POST['nombrecompleto'] : "";
    $puesto = (isset($_POST['puesto'])) ? $_POST['puesto'] : "";
    $twitter = (isset($_POST['twitter'])) ? $_POST['twitter'] : "";
    $facebook = (isset($_POST['facebook'])) ? $_POST['facebook'] : "";
    $linkedin = (isset($_POST['linkedin'])) ? $_POST['linkedin'] : "";

    // DESDE AQUI EL CODIGO PARA ADJUNTAR IMAGEN
    $fecha_imagen = new DateTime();
    $nombre_archivo_imagen = ($imagen != "") ? $fecha_imagen->getTimestamp() . "_" . $imagen : "";

    $tmp_imagen = $_FILES["imagen"]["tmp_name"];
    if ($tmp_imagen != "") {
        move_uploaded_file($tmp_imagen, "../../../assets/img/team/" . $nombre_archivo_imagen); //INDICA LOS PUESTOS QUE TIENE QUE SALIR PARA PODER INGRESAR A LA CARPETA DE IMAGENES

    }
    //guarda registros en la base de datos

    $sentencia = $conexion->prepare("INSERT INTO `tbl_equipo` (`ID`, `imagen`, `nombrecompleto`, `puesto`, `twitter`,`facebook`,`linkedin`) 
VALUES (NULL, :imagen, :nombrecompleto, :puesto, :twitter, :facebook, :linkedin);");

    $sentencia->bindParam(":imagen", $nombre_archivo_imagen); //SE CAMBIA A nombre_archivo_imagen PARA QUE CUANDO LO ADJUNTEMOS ESE NUEVO MONBRE SEA DIFERENTE        
    $sentencia->bindParam(":nombrecompleto", $nombrecompleto);
    $sentencia->bindParam(":puesto", $puesto); //coloca las variables y las relaciona para que se ejecute en cada instruccion es decir en titulo     
    $sentencia->bindParam(":twitter", $twitter);
    $sentencia->bindParam(":facebook", $facebook);
    $sentencia->bindParam(":linkedin", $linkedin);
    $sentencia->execute();

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
                <label for="imagen" class="form-label">Imagen:</label>
                <input type="file" class="form-control" name="imagen" id="imagen" aria-describedby="helpId" placeholder="Imagen" />
            </div>
            <div class="mb-3">
                <label for="nombrecompleto" class="form-label">Nombre Completo:</label>
                <input type="text" class="form-control" name="nombrecompleto" id="nombrecompleto" aria-describedby="helpId" placeholder="Nombre" />
            </div>
            <div class="mb-3">
                <label for="puesto" class="form-label">Puesto:</label>
                <input type="text" class="form-control" name="puesto" id="puesto" aria-describedby="helpId" placeholder="Puesto" />
            </div>
            <div class="mb-3">
                <label for="twitter" class="form-label">Twitter:</label>
                <input type="text" class="form-control" name="twitter" id="twitter" aria-describedby="helpId" placeholder="Twitter" />
            </div>
            <div class="mb-3">
                <label for="facebook" class="form-label">Facebook:</label>
                <input type="text" class="form-control" name="facebook" id="facebook" aria-describedby="helpId" placeholder="Facebook" />
            </div>
            <div class="mb-3">
                <label for="linkedin" class="form-label">Linkedin:</label>
                <input type="text" class="form-control" name="linkedin" id="linkedin" aria-describedby="helpId" placeholder="Linkedin" />
            </div>
            <button type="submit" class="btn btn-success">Agregar</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

        </form>


    </div>
    <div class="card-footer text-muted">

    </div>
</div>

<?php include("../../templates/footer.php"); ?>