<?php
    session_start();

    if(isset($_SESSION['usuario'])){
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
    <!-- Personalizado -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css"/>
    <link rel="stylesheet" href="css/micss.css">
</head>
<body>
    <span class="d-none" id="OpcionSalir">normal-iniciar.php</span>   
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
    <main class="container pt-3">
        <div class="border rounded d-md-flex justify-content-center w-75 m-auto">
            <div class="d-block d-md-inline text-center m-auto">
                <img id="imagenInicioSesion" class="iniciarSesion" alt="" src="img/iniciarSesion.png">
            </div>
            <div class="d-block d-md-inline card-body">
                <form class="p-3" name="formularioInicioSesion" method="POST" action="#" onsubmit="return validarFormInicio()">
                    <div class="form-group">
                        <label for="usuario">*Usuario: </label>
                        <input type="text" class="form-control" id="usuario" name="usuario" maxlength="10">
                        <div id="errorUsu" class="text-danger"></div>
                    </div>
                    <div class="form-group">
                        <label for="pass">*Contraseña: </label>
                        <input type="password" class="form-control" id="pass" name="pass" maxlength="20">
                        <div id="errorContra" class="text-danger"></div>
                    </div>
                    <div class="form-group m-0 text-right">
                        <input type="submit" class="btn btn-block botonMismoColor text-white" name="iniciar" value="Iniciar">  
                    </div>
                </form>
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
    <script src="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.js"></script>
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
    <script src="js/cookie.js"></script>

    <?php
        if(isset($_POST['iniciar'])){
            require_once('php/CRUD.php');

            if($_POST['usuario'] == "" || $_POST['pass'] == ""){
                ?><script>
                    var nombre = document.getElementById("usuario");
                    var contra = document.getElementById("pass");
                    var errorNombre = document.getElementById("errorUsu");
                    var errorContra = document.getElementById("errorContra");
                    var imagen = document.getElementById("imagenInicioSesion");

                    errorNombre.innerHTML = "Introduce un <b>campo</b> valido";
                    errorContra.innerHTML = "Introduce un <b>campo</b> valido";
                    nombre.setAttribute("style","border-color: red");
                    contra.setAttribute("style","border-color: red");

                    imagen.setAttribute("src","img/Error.png");
                </script><?php
            }else{
                $CRUD = new CRUD("u129628487_veter");
                $nombre = $_POST['usuario'];
                $pass = sha1($_POST['pass']);

                if(count($CRUD -> mostrarAdministrador($nombre,$pass))){
                    $_SESSION['usuario'] = $nombre;
                    ?><script>  
                        document.cookie = "username = <?php echo $nombre ?>; expires = " + new Date(2068, 1, 02, 11, 20).toUTCString() + ";Path=/";

                        window.location.href = 'index.html'; 
                    </script>
                    <?php
                }else {
                    ?><script>
                        var nombre = document.getElementById("usuario");
                        var contra = document.getElementById("pass");
                        var errorContra = document.getElementById("errorContra");
                        var imagen = document.getElementById("imagenInicioSesion");

                        errorContra.innerHTML = "Lo sentimos el usuario no existe, introduzca uno valido";
                        nombre.setAttribute("style","border-color: red");
                        contra.setAttribute("style","border-color: red");

                        imagen.setAttribute("src","img/Error.png");
                    </script><?php
                }
            }
        }
    ?>
</body>
</html>