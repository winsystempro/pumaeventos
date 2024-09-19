<?php
session_start(); //para loguear todas las paginas
$url_base = "http://localhost:8080/pumaeventos/admin/";
if (!isset($_SESSION['usuario'])) {
    header("location:" . $url_base . "login.php");
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Administrador del sitio web</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

    <!--LINKS PARA SACAR FILTROS DENTRO DE LAS TABLAS-->
    
    <!-- linea para integrar jquery-->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!--link para css de DATATABLES-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>
    <!--link para SweetAlert2-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
</head>

<body>
    <header>
        <!-- place navbar here -->
        <nav class="navbar navbar-expand navbar-light bg-light">
            <div class="nav navbar-nav">
                <a class="nav-item nav-link active" href="#" aria-current="page">Administrador <span class="visually-hidden">(current)</span></a>
                <a class="nav-item nav-link" href="<?php echo $url_base; ?>secciones/servicios/">Servicios</a>
                <a class="nav-item nav-link" href="<?php echo $url_base; ?>secciones/portafolio/">Portafolio</a>
                <a class="nav-item nav-link" href="<?php echo $url_base; ?>secciones/entradas/">Entradas</a>
                <a class="nav-item nav-link" href="<?php echo $url_base; ?>secciones/equipo/">Equipo</a>
                <a class="nav-item nav-link" href="<?php echo $url_base; ?>secciones/configuraciones/">Configuraciones</a>
                <a class="nav-item nav-link" href="<?php echo $url_base; ?>secciones/usuarios/">Usuarios</a>
                <a class="nav-item nav-link" href="<?php echo $url_base; ?>cerrar.php">Salir</a>
            </div>
        </nav>
    </header>
    <main class="container">
        <br />
        <script> //para que salga el cuadro de los mensajes
            <?php if (isset($_GET['mensaje'])){ ?>
            Swal.fire({icon:"success", title:"<?php echo $_GET['mensaje'];?>"});
            <?php } ?>

        </script>