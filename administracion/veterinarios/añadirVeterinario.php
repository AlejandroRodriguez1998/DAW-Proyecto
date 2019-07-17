<?php
    session_start();

    if(!isset($_SESSION['usuario'])){
        ?><script>  window.location.href = '../../index.html'; </script><?php
    }

    require_once('../../php/CRUD.php');
    $CRUD = new CRUD("u129628487_veter");

    if(isset($_POST['añadir'])){
        $dni = $_POST['dni'];
        $nombre = $_POST['nombre'];
        $primerApe = $_POST['primerApellido'];
        $segundoApe = $_POST['segundoApellido'];

        if($dni == "" || $nombre == "" || $primerApe == "" || $segundoApe == ""){
            $resultadoFinal = "Introduce los campos obligatorios";
        }else{
            if(preg_match("/^[0-9]{8,8}[A-Za-z]$/",$dni)){
                $resultadoFinal = $CRUD -> añadirMedico($dni,$nombre,$primerApe,$segundoApe);
            }else{
                $resultadoFinal = "Introduce un DNI con su formato correcto";
            }
        }
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

    <link rel="icon" href="../../img/icono.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Personalizado -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../css/micss.css">
</head>
<body>
<span class="d-none" id="OpcionSalir">Administracion2</span>
    <header class="container-fluid">
        <div class="container d-block d-lg-flex justify-content-center">
            <div class="text-center">
                <a href="../../index.html"><img src="../../img/logo.png" alt="Logo" width="100" height="100"></a>
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
                    <a class="nav-link" href="../../index.html">Inicio <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../protectora.html">Protectora</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../cita.php">Citas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../informacion.html">Información</a>
                </li>
            </ul>
        </div>
    </nav>
    <main class="container">
        <div id="columnaContenido">
            <h2 id="tituloZona" class="text-center pt-2">Veterinarios</h2>
            <div class="d-flex justify-content-between">
                <a class="btn w-100 m-1 btn-outline-mismoColor " href="mostrarVeterinarios.php">
                    <span class="d-none d-md-inline">Mostrar</span>
                    <span class="d-inline d-md-none"><i class="fa fa-eye"></i></span>
                </a>
                <a class="btn w-100 m-1 btn-outline-mismoColor active" href="añadirVeterinario.php">
                    <span class="d-none d-md-inline">Añadir</span>
                    <span class="d-inline d-md-none"><i class="fa fa-plus-circle"></i></span>
                </a>
                <a class="btn w-100 m-1 btn-outline-mismoColor" href="modificarVeterinario.php">
                    <span class="d-none d-md-inline">Modificar</span>
                    <span class="d-inline d-md-none"><i class="fa fa-edit"></i></span>
                </a>
                <a class="btn w-100 m-1 btn-outline-mismoColor" href="eliminarVeterinario.php">
                    <span class="d-none d-md-inline">Eliminar</span>
                    <span class="d-inline d-md-none"><i class="fa fa-trash"></i></span>
                </a>
            </div>
            <div id="tarjetasZona" class=" p-2 pr-3">
                <form class="row p-3" id="añadirVeterinario" name="formularioAñadirVeterinario" method="POST" action="#" onsubmit="return validarFormAñadirVeterinario()">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="dni">*DNI:</label>
                            <input type="text" class="form-control" id="dni" name="dni" maxlength="9" pattern="^[0-9]{8,8}[A-Za-z]$" title="Los DNI tienen 9 numeros y una letra">
                        </div>
                        <div class="form-group">
                            <label for="nombre">*Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" maxlength="30">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="primerApellido">*Primer Apellido:</label>
                            <input type="text" class="form-control" id="primerApellido" name="primerApellido" maxlength="30">
                        </div>
                        <div class="form-group">
                            <label for="segundoApellido">*Segundo Apellido:</label>
                            <input type="text" class="form-control" id="segundoApellido" name="segundoApellido" maxlength="30">
                        </div>
                    </div>  
                    <p id="mensajeError" class="col-12 text-center text-danger font-weight-bold"></p>
                    <input type="submit" class="btn btn-block botonMismoColor text-white" name="añadir" value="Añadir"> 
                </form>
            </div>
        </div>
        <button type="button" class="btn btn-primary d-none" data-toggle="modal" data-target=".correcto" id="botonCorrecto">Boton que activa un modal</button>
        <div class="modal fade correcto" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="alert alert-success m-0 text-center">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <span id="textoCorrecto"><b>¡Correcto!</b> Se ha añadido un veterinario con exito</span>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-primary d-none" data-toggle="modal" data-target=".bd-example-modal-lg" id="botonError">Boton que activa un modal</button>
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="alert alert-danger m-0 text-center">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <span id="textoError"></span>
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
    <script src="../../js/inicio.js"></script>
    <script src="../../js/admin.js"></script>
    
    <?php
        if(isset($resultadoFinal)){
            if($resultadoFinal == 1){
                ?><script>
                    $("#botonCorrecto").click();
                </script> <?php
            }else{
                ?><script>
                    $("#botonError").click();
                    $("#textoError").html("<strong>¡Error!</strong> <?php echo $resultadoFinal; ?>.");
            </script><?php 
            }
        }
    ?>
</body>
</html>