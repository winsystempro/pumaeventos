<?php
include("admin/bd.php");

// SELECCION DE REGISTROS de servicios
$sentencia = $conexion->prepare("SELECT * FROM `tbl_servicios`");
$sentencia->execute();
$lista_servicios = $sentencia->fetchAll(PDO::FETCH_ASSOC);

// SELECCION DE REGISTROS de portafolio
$sentencia = $conexion->prepare("SELECT * FROM `tbl_portafolio`");
$sentencia->execute();
$lista_portfolio = $sentencia->fetchAll(PDO::FETCH_ASSOC);

// OBTENER CATEGORIAS UNICAS de portafolio para filtro por categorias
$sentencia = $conexion->prepare("SELECT DISTINCT categoria FROM tbl_portafolio");
$sentencia->execute();
$lista_categorias = $sentencia->fetchAll(PDO::FETCH_ASSOC);

// PARA LISTAR REGISTROS de entradas
$sentencia = $conexion->prepare("SELECT * FROM tbl_entradas");
$sentencia->execute();
$lista_entradas = $sentencia->fetchAll(PDO::FETCH_ASSOC);

// PARA LISTAR REGISTROS de equipo
$sentencia = $conexion->prepare("SELECT * FROM tbl_equipo");
$sentencia->execute();
$lista_equipo = $sentencia->fetchAll(PDO::FETCH_ASSOC);

// PARA LISTAR REGISTROS de configuración
$sentencia = $conexion->prepare("SELECT * FROM tbl_configuraciones");
$sentencia->execute();
$lista_configuraciones = $sentencia->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>PumaEventos</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="#page-top"><img src="assets/img/PumaEventos.svg" alt="..." /></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars ms-1"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#services">Servicios</a></li>
                    <li class="nav-item"><a class="nav-link" href="#portfolio">Portafolio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">Nosotros</a></li>
                    <li class="nav-item"><a class="nav-link" href="#team">Equipo</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contacto</a></li>

                </ul>
            </div>
        </div>
    </nav>
    <!-- Botón de WhatsApp -->
    <div class="nav-item">
        <a href="https://wa.me/593962903181?text=%C2%A1Hola!%20me%20puede%20ayudar%20con%20m%C3%B3s%20informaci%C3%B3n" target="_blank" class="whatsapp-container">
            <i class="fab fa-whatsapp whatsapp-icon"></i>
        </a>
    </div>
    <!-- Masthead-->
    <header class="masthead">
        <div class="container">
            <div class="masthead-subheading"><?php echo $lista_configuraciones[0]['valor'] ?></div>
            <div class="masthead-heading masthead-subheading text-uppercase"><?php echo $lista_configuraciones[1]['valor'] ?></div>
            <a class="btn btn-info btn-xl text-uppercase" href="<?php echo $lista_configuraciones[3]['valor'] ?>"><?php echo $lista_configuraciones[2]['valor'] ?></a>
        </div>
    </header>

    <!--videos
    <div class="video-container">
    <iframe width="560" height="315" src="assets/videos/HarleyandtheDavidsons_1.mp4" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>-->

    <!-- Services-->
    <section class="page-section" id="services">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase"><?php echo $lista_configuraciones[4]['valor'] ?></h2>
                <h3 class="section-subheading text-muted"><?php echo $lista_configuraciones[5]['valor'] ?></h3>
            </div>
            <div class="row text-center">
                <!--trae los registros que tengo en la base de datos-->
                <?php foreach ($lista_servicios as $registros) { ?>
                    <div class="col-md-4">
                        <a href="#portfolio" class="link-container">
                            <span class="fa-stack fa-4x">
                                <i class="fas fa-circle fa-stack-2x text-primary"></i>
                                <i class="fas <?php echo $registros["icono"]; ?> fa-stack-1x fa-inverse "></i><!--Para que nos aparezca en la pagina web los registros -->
                            </span>
                            <h4 class="my-3"><?php echo $registros["titulo"]; ?></h4>
                            <p class="text-muted"><?php echo $registros["descripcion"]; ?></p>
                        </a>
                    </div>
                <?php } ?>

            </div>
        </div>
    </section>
    <!-- Portfolio Grid-->

    <!-- desde aqui va la prueba del filtro-->

    <script>
        function filterPortfolio() {
            var selectBox = document.getElementById("categoryFilter");
            var selectedCategory = selectBox.options[selectBox.selectedIndex].value;
            var portfolioItems = document.getElementsByClassName("portfolio-item");

            for (var i = 0; i < portfolioItems.length; i++) {
                var item = portfolioItems[i];
                var dataCategory = item.getAttribute("data-category");

                if (selectedCategory == "all" || dataCategory == selectedCategory) {
                    item.style.display = "block";
                } else {
                    item.style.display = "none";
                }
            }
        }
    </script>

    <section class="page-section bg-light" id="portfolio">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase"><?php echo $lista_configuraciones[6]['valor'] ?></h2>
                <h3 class="section-subheading text-muted"><?php echo $lista_configuraciones[7]['valor'] ?></h3>
            </div>
            <div class="text-center mb-4">
                <h5><label class="form-label" for="categoryFilter">Filtrar por categoría:</label></h5>
                <select id="categoryFilter" class="form-select" onchange="filterPortfolio()">
                    <option value="all">Todas</option>
                    <?php foreach ($lista_categorias as $categoria) { ?>
                        <option value="<?php echo $categoria['categoria']; ?>"><?php echo $categoria['categoria']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="row">
                <?php foreach ($lista_portfolio as $registros) { ?>
                    <div class="col-lg-4 col-sm-6 mb-4 portfolio-item  img-fluid zoom-image" data-category="<?php echo $registros['categoria']; ?>">
                        <div>
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal1<?php echo $registros["ID"]; ?>">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="assets/img/portfolio/<?php echo $registros["imagen"]; ?>" alt="..." />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading"><?php echo $registros["titulo"]; ?></div>
                                <div class="portfolio-caption-subheading text-muted"><?php echo $registros["subtitulo"]; ?></div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="portfolio-modal modal fade" id="portfolioModal1<?php echo $registros["ID"]; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-8">
                                            <div class="modal-body">
                                                <h2 class="text-uppercase"><?php echo $registros["titulo"]; ?></h2>
                                                <p class="item-intro text-muted"><?php echo $registros["subtitulo"]; ?></p>
                                                <img class="img-fluid d-block mx-auto" src="assets/img/portfolio/<?php echo $registros["imagen"]; ?>" alt="..." />
                                                <p><?php echo $registros["descripcion"]; ?></p>
                                                <ul class="list-inline">
                                                    <li>
                                                        <strong>Fecha:</strong>
                                                        <?php echo $registros["fecha"]; ?>
                                                    </li>
                                                    <li>
                                                        <strong>Cliente:</strong>
                                                        <?php echo $registros["cliente"]; ?>
                                                    </li>
                                                    <li>
                                                        <strong>Categoría:</strong>
                                                        <?php echo $registros["categoria"]; ?>
                                                    </li>
                                                </ul>
                                                <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                                    <i class="fas fa-xmark me-1"></i>
                                                    Cerrar proyecto
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <!-- hasta aqui va la prueba del filtro-->
    <!-- About-->
    <section class="page-section" id="about">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase"><?php echo $lista_configuraciones[8]['valor'] ?></h2>
                <h3 class="section-subheading text-muted"><?php echo $lista_configuraciones[9]['valor'] ?></h3>
            </div>
            <ul class="timeline">
                <?php
                $contador = 1;
                foreach ($lista_entradas as $registros) {
                ?>
                    <li <?php echo (($contador % 2) == 0) ? 'class="timeline-inverted"' : ""; ?>>
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets/img/about/<?php echo $registros['imagen']; ?>" alt="..." /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4><?php echo $registros['fecha']; ?></h4>
                                <h4 class="subheading"><?php echo $registros['titulo']; ?></h4>
                            </div>
                            <div class="timeline-body">
                                <p class="text-muted"><?php echo $registros['descripcion']; ?></p>
                            </div>
                        </div>
                    </li>
                <?php
                    $contador++;
                } ?>

                <li class="timeline-inverted">
                    <div class="timeline-image">
                        <h4><br />
                            <?php echo $lista_configuraciones[10]['valor'] ?>
                        </h4>
                    </div>
                </li>
            </ul>
        </div>
    </section>
    <!-- Team-->
    <section class="page-section bg-light" id="team">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase"><?php echo $lista_configuraciones[11]['valor'] ?></h2>
                <h3 class="section-subheading text-muted"><?php echo $lista_configuraciones[12]['valor'] ?></h3>
            </div>
            <div class="row">
                <?php foreach ($lista_equipo as $registros) { ?>
                    <div class="col-lg-4">
                        <div class="team-member">
                            <img class="mx-auto rounded-circle" src="assets/img/team/<?php echo $registros["imagen"]; ?>" alt="..." />
                            <h4><?php echo $registros["nombrecompleto"]; ?></h4>
                            <p class="text-muted"><?php echo $registros["puesto"]; ?></p>
                            <a class="btn btn-dark btn-social mx-2" href="<?php echo $registros["twitter"]; ?>" target="_blank" aria-label="Parveen Anand Twitter Profile"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="<?php echo $registros["facebook"]; ?>" target="_blank" aria-label="Parveen Anand Facebook Profile"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="<?php echo $registros["linkedin"]; ?>" target="_blank" aria-label="Parveen Anand LinkedIn Profile"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                <?php } ?>
            </div>

        </div>
    </section>
    <!-- Clients
    <div class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-3 col-sm-6 my-3">
                    <a href="#!"><img class="img-fluid img-brand d-block mx-auto" src="assets/img/logos/microsoft.svg" alt="..." aria-label="Microsoft Logo" /></a>
                </div>
                <div class="col-md-3 col-sm-6 my-3">
                    <a href="#!"><img class="img-fluid img-brand d-block mx-auto" src="assets/img/logos/google.svg" alt="..." aria-label="Google Logo" /></a>
                </div>
                <div class="col-md-3 col-sm-6 my-3">
                    <a href="#!"><img class="img-fluid img-brand d-block mx-auto" src="assets/img/logos/facebook.svg" alt="..." aria-label="Facebook Logo" /></a>
                </div>
                <div class="col-md-3 col-sm-6 my-3">
                    <a href="#!"><img class="img-fluid img-brand d-block mx-auto" src="assets/img/logos/ibm.svg" alt="..." aria-label="IBM Logo" /></a>
                </div>
            </div>
        </div>
    </div>-->
    <!-- Contact-->
    <section class="page-section" id="contact">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase"><?php echo $lista_configuraciones[13]['valor'] ?></h2>
                <!--<h3 class="section-subheading text-muted"><?php echo $lista_configuraciones[14]['valor'] ?></h3>-->
                <a href="mailto:<?php echo $lista_configuraciones[14]['valor'] ?>?subject=Consulta valores&body=Hola, me interesa obtener más información sobre los                  artículos que ofrecen en su página. ¿Podrían proporcionarme detalles adicionales?" target="_blank"><?php echo $lista_configuraciones[14]['valor'] ?></a>
                <br>
                <br>
                <div class="container">
                    <div class="left">
                        <h1 class="section-heading text-uppercase">Obtén un descuento en tu próximo evento</h1>
                    </div>
                    <div class="right">
                        <h2 class="section-heading text-uppercase">(+593) 096 290 3181 / (+593) 098 943 8414<br></h2>
                        <h3 class="section-heading text-uppercase">Quito - Ecuador<br>
                            Enriqueta Bustamante<br>
                            Ruben Rodriguez</h3>
                    </div>
                    <!--<a href="https://wa.me/593962903181?text=%C2%A1Hola!%20Quiero%20que%20me%20ayudes%20con%20más%20información" target="_blank" class="text-center">
                        <i class="fab fa-whatsapp whatsapp-icon" style="font-size: 2em; color: #25D366;"></i>
                    </a>-->
                </div>
            </div>
            <!-- * * * * * * * * * * * * * * *-->
            <!-- * * SB Forms Contact Form * *-->
            <!-- * * * * * * * * * * * * * * *-->
            <!-- This form is pre-integrated with SB Forms.-->
            <!-- To make this form functional, sign up at-->
            <!-- https://startbootstrap.com/solution/contact-forms-->
            <!-- to get an API token!
            <form id="contactForm" data-sb-form-api-token="API_TOKEN">
                <div class="row align-items-stretch mb-5">
                    <div class="col-md-6">
                        <div class="form-group">
                            <!-- Name input
                            <input class="form-control" id="name" type="text" placeholder="Your Name *" data-sb-validations="required" />
                            <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
                        </div>
                        <div class="form-group">
                            <!-- Email address input
                            <input class="form-control" id="email" type="email" placeholder="Your Email *" data-sb-validations="required,email" />
                            <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                            <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                        </div>
                        <div class="form-group mb-md-0">
                            <!-- Phone number input
                            <input class="form-control" id="phone" type="tel" placeholder="Your Phone *" data-sb-validations="required" />
                            <div class="invalid-feedback" data-sb-feedback="phone:required">A phone number is required.</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-group-textarea mb-md-0">
                            <!-- Message input
                            <textarea class="form-control" id="message" placeholder="Your Message *" data-sb-validations="required"></textarea>
                            <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.</div>
                        </div>
                    </div>
                </div>
                <!-- Submit success message-->
            <!---->
            <!-- This is what your users will see when the form-->
            <!-- has successfully submitted
                <div class="d-none" id="submitSuccessMessage">
                    <div class="text-center text-white mb-3">
                        <div class="fw-bolder">Form submission successful!</div>
                        To activate this form, sign up at
                        <br />
                        <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                    </div>
                </div>
                <!-- Submit error message-->
            <!---->
            <!-- This is what your users will see when there is-->
            <!-- an error submitting the form
                <div class="d-none" id="submitErrorMessage">
                    <div class="text-center text-danger mb-3">Error sending message!</div>
                </div>
                <!-- Submit Button
                <div class="text-center"><button class="btn btn-primary btn-xl text-uppercase disabled" id="submitButton" type="submit">Send Message</button></div>
            </form>-->
        </div>
    </section>
    <!-- Footer-->
    <footer class="footer py-4">
        <div class="container">
            <div class="row align-items-center">
               <div class="col-lg-4 text-lg-start">Copyright &copy; Winsystem 2024. Todos los derechos reservados.</div>
                <div class="col-lg-4 my-3 my-lg-0">
                    <a class="btn btn-dark btn-social mx-2" href="<?php echo $lista_configuraciones[15]['valor'] ?>" target="_blank" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-dark btn-social mx-2" href="<?php echo $lista_configuraciones[16]['valor'] ?>" target="_blank" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-dark btn-social mx-2" href="<?php echo $lista_configuraciones[17]['valor'] ?>" target="_blank" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>                    
                </div>
                
                <div class="col-lg-4 text-lg-start">Desarrolla con winsystem 0990108660.</div>
                <!--VISUALIZACION DEL CONTADOR PARA PAGINAS WEB-->
                <p>Total de visitas: <?php echo $totalVisitas; ?></p>
            </div>
        </div>
                            
        
    </footer>
    <!-- Portfolio Modals-->
    <!-- Portfolio item 1 modal popup-->





    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

</html>