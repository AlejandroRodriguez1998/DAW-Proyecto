<?php
    session_start();

    if(!isset($_SESSION['usuario'])){
        ?><script>  window.location.href = '../../index.html'; </script><?php
    }

    require_once('../../php/CRUD.php');
    $CRUD = new CRUD("u129628487_veter");

    if(isset($_POST['añadir'])){
        $tarjeta = $_POST['tarjeta'];
        $nombre = $_POST['nombre'];
        $apodo = $_POST['apodo'];
        $raza = $_POST['raza'];
        $sexo = $_POST['sexo'];
        $edad = $_POST['edad'];

        $tipoIma = "";
        $imagen = "";
        if(!empty($_FILES['foto']['name'])){
            $nombreOri = $_FILES['foto']['name'];
            $campos = explode(".",$nombreOri); //Cogemos el nombre del archivo y la extension con el explode
            $nombreIma = $campos[0];
            $tipoIma = $campos[1];
        
            $Temporal = $_FILES['foto']['tmp_name'];

            if(!empty($Temporal)){
                $imagen = base64_encode(file_get_contents($Temporal));
            }
        }

        $dueño = "";
        if(isset($_POST['clientes'])){
            $dueño = $_POST['clientes'];
        }

        $medico = "";
        if(isset($_POST['medicos'])){
            $medico = $_POST['medicos'];
        }

        if($edad == ""){
            $edad = "null";
        }

        if($tarjeta == "" || $nombre == "" || $raza == "" || $dueño == "" || $medico == ""){
            $resultadoFinal = "Introduce los campos obligatorios";
        }else{
            $resultadoFinal = $CRUD -> añadirAnimal($tarjeta,$nombre,$apodo,$raza,$sexo,$edad,$imagen,$tipoIma,$dueño,$medico);
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
            <h2 id="tituloZona" class="text-center pt-2">Animales</h2>
            <div class="d-flex justify-content-between">
                <a class="btn w-100 m-1 btn-outline-mismoColor" href="mostrarAnimales.php">
                    <span class="d-none d-md-inline">Mostrar</span>
                    <span class="d-inline d-md-none"><i class="fa fa-eye"></i></span>
                </a>
                <a class="btn w-100 m-1 btn-outline-mismoColor active" href="añadirAnimal.php">
                    <span class="d-none d-md-inline">Añadir</span>
                    <span class="d-inline d-md-none"><i class="fa fa-plus-circle"></i></span>
                </a>
                <a class="btn w-100 m-1 btn-outline-mismoColor" href="modificarAnimal.php">
                    <span class="d-none d-md-inline">Modificar</span>
                    <span class="d-inline d-md-none"><i class="fa fa-edit"></i></span>
                </a>
                <a class="btn w-100 m-1 btn-outline-mismoColor" href="eliminarAnimal.php">
                    <span class="d-none d-md-inline">Eliminar</span>
                    <span class="d-inline d-md-none"><i class="fa fa-trash"></i></span>
                </a>
            </div>
            <div id="tarjetasZona" class=" p-2 pr-3">
                <form class="row p-3" id="añadirAnimal" name="formularioInicioSesion" method="POST" action="#" onsubmit="return validarFormAñadirAnimal()" enctype="multipart/form-data">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="tarjeta">*Tarjeta:</label>
                            <input type="text" class="form-control" id="tarjeta" name="tarjeta" aria-describedby="tarjetaHelp" maxlength="9">
                            <small id="tarjetaHelp" class="form-text text-muted">Año y mes de nacimiento junto a la 1ª letra de su nombre</small>
                        </div>
                        <div class="form-group">
                            <label for="nombre">*Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" maxlength="30">
                        </div>
                        <div class="form-group">
                            <label for="apodo">Apodo:</label>
                            <input type="text" class="form-control" id="apodo" name="apodo" maxlength="30">
                        </div>
                        <div class="form-group">
                            <label for="raza">*Raza:</label>
                            <input type="text" class="form-control" id="raza" name="raza" maxlength="30">
                        </div>
                        <div class="form-group">
                            <label for="sexo">Sexo:</label>
                            <input type="text" class="form-control" id="sexo" name="sexo" maxlength="1">
                        </div>
                        <div class="form-group">
                            <label for="edad">Edad:</label>
                            <input type="number" class="form-control" id="edad" name="edad" max="99" min="0">
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto:</label>
                            <input type="file" class="form-control" id="foto" name="foto" accept=".jpg">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="row">
                            <div class="col-6 col-md-12">
                                <div class="form-group">
                                    <label for="inputClientes">*Dueño:</label>
                                    <input class="form-control" id="inputClientes" type="text" placeholder="Buscar..">
                                </div>
                                <div class="form-group">
                                    <ul class="list-group selectGeneral" id="listaClientes">
                                        <?php
                                            $resultado = $CRUD -> mostrarClientes();

                                            foreach($resultado as $clave => $valor){
                                                echo '<li class="list-group-item">';
                                                echo '<input type="radio" name="clientes" value="'.$valor['DNI'].'" class="mr-2">';
                                                echo $valor['Nombre'] . " " . $valor['PrimerApellido'] . " " . $valor['SegundoApellido'];
                                                echo '</li>';
                                            }

                                        ?>
                                    </ul>  
                                </div>
                            </div>
                            <div class="col-6 col-md-12">
                                <div class="form-group">
                                    <label for="inputMedicos">*Medico:</label>
                                    <input class="form-control" id="inputMedicos" type="text" placeholder="Buscar..">
                                </div>
                                <div class="form-group">
                                    <ul class="list-group selectGeneral" id="listaMedicos">
                                        <?php
                                            $resultadoM = $CRUD -> mostrarMedicos();

                                            foreach($resultadoM as $claveM => $valorM){
                                                echo '<li class="list-group-item">';
                                                echo '<input type="radio" name="medicos" value="'.$valorM['DNI'].'" class="mr-2">';
                                                echo $valorM['Nombre'] . " " . $valorM['PrimerApellido'] . " " . $valorM['SegundoApellido'];
                                                echo '</li>';
                                            }

                                        ?>
                                    </ul>
                                </div>
                            </div>
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
                        <span id="textoCorrecto"><b>¡Correcto!</b> Se ha añadido un animal con exito</span>
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
    <script>
        $(document).ready(function(){
            $("#inputClientes").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#listaClientes li").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
            $("#inputMedicos").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#listaMedicos li").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });    
    </script>

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