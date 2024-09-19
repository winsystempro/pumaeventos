<?php
session_start();
//resepcion de datos
if ($_POST) {
    include("./bd.php");

    $usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : "";
    $password = (isset($_POST['password'])) ? $_POST['password'] : "";

    // SELECCION DE REGISTROS
    $sentencia = $conexion->prepare("SELECT *, count(*) as n_usuario 
        FROM tbl_usuarios
        WHERE usuario=:usuario AND password=:password");

    $sentencia->bindParam(":usuario", $usuario); //coloca las variables y las relaciona para que se ejecute en cada instruccion es decir en titulo 
    $sentencia->bindParam(":password", $password);
    $sentencia->execute();

    $lista_usuarios = $sentencia->fetch(PDO::FETCH_LAZY); //consulta todos los datos y muestra los registros

    if ($lista_usuarios['n_usuario'] > 0) {        
        $_SESSION['usuario'] = $lista_usuarios['usuario'];
        $_SESSION['usuario'] = true;
        header("location:index.php");
    } else {
        $mensaje = "Error: El usuario o contraseña son incorrectos";
    }
}

?>
<!doctype html>
<html lang="en">

<head>
    <title>Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    <header>
        <!-- place navbar here -->
    </header>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-4">

                </div>
                <div class="col-4">
                    <br />
                    <br />
                    <!--etiqueta de mensaje-->
                    <?php if(isset ($mensaje)){?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong><?php echo $mensaje?></strong>
                    </div>
                    <?php } ?>
                    <div class="card">
                        <div class="card-header">Acceso</div>
                        <div class="card-body">


                            <script>
                                var alertList = document.querySelectorAll(".alert");
                                alertList.forEach(function(alert) {
                                    new bootstrap.Alert(alert);
                                });
                            </script>


                            <form action="" method="post">

                                <div class="mb-3">
                                    <label for="usuario" class="form-label">Usuario</label>
                                    <input type="text" class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="" />

                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Contraseña</label>
                                    <input type="password" class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="" />

                                </div>

                                <input name="" id="" class="btn btn-primary" type="submit" value="Entrar" />

                            </form>

                        </div>
                        <div class="card-footer text-muted"></div>
                    </div>


                </div>

            </div>
        </div>

    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>