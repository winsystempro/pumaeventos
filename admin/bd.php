<?php 

$servidor="localhost";
$baseDeDatos="pumaeventos";
$usuario="root";
$contrasenia="";

try{

    $conexion=new PDO("mysql:host=$servidor;dbname=$baseDeDatos",$usuario,$contrasenia);
    
}catch(Exception $error){
    echo $error->getMessage();

}

// CONTADOR PARA VER CUANTAS PERSONAS INGRSAN A LA PAGINA WEB

// Función para actualizar el contador de visitas
function actualizarContador($conexion) {
    $fechaHoy = date('Y-m-d');

    // Verificar si ya existe un registro para el día de hoy
    $sentencia = $conexion->prepare("SELECT * FROM visitas WHERE fecha = :fecha");
    $sentencia->bindParam(':fecha', $fechaHoy);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_ASSOC);

    if ($registro) {
        // Si ya existe, incrementar el contador
        $nuevoConteo = $registro['visitas'] + 1;
        $sentencia = $conexion->prepare("UPDATE visitas SET visitas = :visitas WHERE fecha = :fecha");
        $sentencia->bindParam(':visitas', $nuevoConteo);
        $sentencia->bindParam(':fecha', $fechaHoy);
    } else {
        // Si no existe, crear un nuevo registro
        $nuevoConteo = 1;
        $sentencia = $conexion->prepare("INSERT INTO visitas (fecha, visitas) VALUES (:fecha, :visitas)");
        $sentencia->bindParam(':fecha', $fechaHoy);
        $sentencia->bindParam(':visitas', $nuevoConteo);
    }

    $sentencia->execute();
}

// Llamar a la función para actualizar el contador
actualizarContador($conexion);

// Obtener el número total de visitas
$sentencia = $conexion->prepare("SELECT SUM(visitas) as total_visitas FROM visitas");
$sentencia->execute();
$totalVisitas = $sentencia->fetch(PDO::FETCH_ASSOC)['total_visitas'];

?>