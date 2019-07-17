<?php
    session_start();

    if(!isset($_SESSION['usuario'])){
        ?><script>  window.location.href = 'index.html'; </script><?php
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="title" content="Veterinaria Pandawa">
    <meta name="description" content="La pagina trata de una veterinaria creada para un proyecto">
    <title>Veterinaria Pandawa</title>

    <link rel="icon" href="img/icono.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <!-- Personalizado -->
    <link rel="stylesheet" href="css/micss.css">
</head>
<body>
    <span class="d-none" id="OpcionSalir">Administracion</span>
    <header class="container-fluid">
        <div class="container d-block d-lg-flex justify-content-center">
            <div class="text-center">
                <a href="index.html"><img src="img/logo.png" alt="Logo" width="100" height="100"></a>
            </div>
            <div class="text-center">
                <p id="nombrePag" class="h1 font-weight-light mt-0s mt-lg-5">Veterinaria Pandawa</p>
            </div>
        </div>
    </header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light container position-relative">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menuContenido"
            aria-controls="menuContenido" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="menu" class="position-absolute">

        </div>
        <div class="collapse navbar-collapse" id="menuContenido">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.html">Inicio <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="protectora.html">Protectora</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cita.php">Citas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="informacion.html">Información</a>
                </li>
            </ul>
        </div>
    </nav>
    <main class="container">
    <h3 class="d-block d-md-none text-center pt-2">Gestión del sistema</h3>
        <div class="row">
            <!-- COLUMNA DEL MENU-->
            <div id="columnaOpciones" class="col-4 col-md-3">
                <h2 class="pt-2 text-center d-none d-md-block">¡Bienvenid@!</h2>
                <div class="border rounded p-2">
                    <p><b>Usuario:</b> <?php echo $_COOKIE['username']?>.</p>
                    <p><b>Día:</b> <?php echo date("d")."/".date("m")."/<span class='d-none d-md-inline'>".date("Y") ."</span><span class='d-inline d-md-none'>".date("y")."</span>"; ?></p>
                    <p><b>Recuerda:</b> Sonreir siempre.</p>
                    <p class="text-center"><b>Ten un buen día</b></p>
                    <p class="text-center">ʕ•ᴥ•ʔ</p>
                </div>
            </div>
            <!-- COLUMNA DEL CONTENIDO PRINCIPAL-->
            <div id="columnaContenido" class="col-8 col-md-9">
                <h2 id="tituloZona" class="text-center pt-2 d-none d-md-block">Gestión del sistema</h2>
                <div id="tarjetasZona" class="row">
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <img class="card-img-top imgAdmin" alt="administradores" src="img/administradores.png">
                                <h5 class="card-text m-3"><a href="administracion/administradores.php">Administradores</a></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <img class="card-img-top imgAdmin" alt="animales" src="img/animales.png">
                                <h5 class="card-text m-3"><a href="administracion/animales/mostrarAnimales.php">Animales</a></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <img class="card-img-top imgAdmin" alt="clientes" src="img/clientes.png">
                                <h5 class="card-text m-3"><a href="administracion/clientes/mostrarClientes.php">Clientes</a></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <img class="card-img-top imgAdmin" alt="citas" src="img/citas.png">
                                <h5 class="card-text m-3"><a href="administracion/citas/mostrarCitas.php">Citas</a></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <img class="card-img-top imgAdmin" alt="citas" src="img/veterinarios.png">
                                <h5 class="card-text m-3"><a href="administracion/veterinarios/mostrarVeterinarios.php">Veterinarios</a></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="container-fluid pt-3">
        <div class="container d-flex justify-content-between aling-items-center pb-3" id="share">
            <div class="w-50 m-auto text-center">
                <p class="m-0 text-white">Recuerda proteger, mimar y nunca abandonar</p>
            </div>
            <div class="w-50 m-auto text-center">
                <div class="social-share fb">
                    <span class="fb-inner"></span>
                    <a class="cta fb" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fwwwalejandrocom.hostingerapp.com%2F&amp;src=sdkpreparse">Compartir</a>
                </div>
                <div class="social-share tw">
                    <span class="tw-inner"></span>
                    <a class="cta tw" href="https://twitter.com/intent/tweet?original_referer=http%3A%2F%2Flocalhost%2Fproyecto%2F&ref_src=twsrc%5Etfw&text=Me%20encanta%20la%20veterinaria%20pandawa&tw_p=tweetbutton&url=http%3A%2F%2Fwwwalejandrocom.hostingerapp.com%2F">Tweet</a>
                    <script async src="https://platform.twitter.com/widgets.js"></script>
                </div>
            </div>
        </div>
    </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

    <!-- Personalizado -->
    <script src="js/inicio.js"></script>
</body>
</html>