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
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css" />
    <link rel="stylesheet" href="css/micss.css">
</head>
<body>
    <span class="d-none" id="OpcionSalir">normal-cita.php</span>
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
        <h3 class="text-center pt-2 mb-2">Gestión de citas</h3>

        <div class="mediaQuery m-auto border rounded">
            <form class="p-3" id="pedirCita" name="formularioPedirCita" method="POST" action="#">
                <div class="form-group px-1 m-0">
                    <label for="tarjetaAnimal">Tarjeta del animal: </label>
                    <input type="text" class="form-control" id="tarjetaAnimal" name="tarjeta" maxlength="9" placeholder="Introduce los digitos">
                    <p id="errorTarjeta" class="text-center text-danger"></p>
                </div>
                <div class="d-block d-md-flex">
                    <div class="form-group w-100 px-1 m-0">
                        <label for="cita">Fecha: </label>
                        <input type="date" class="form-control" id="cita" name="cita">
                        <p id="errorCita" class="text-center text-danger"></p>
                    </div>
                    <div class="form-group w-100 px-1 m-0">
                        <label for="hora">Hora: </label>
                        <select class="form-control" id="hora" name="hora">
                            <option value="">&nbsp;</option>
                            <?php
                                for($i = 9; $i < 21; $i++){
                                    echo '<option value="'.$i.':00">'.$i.':00</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <p id="error" class="text-center text-danger"></p>
                <div class="form-group m-0 d-flex">
                    <input type="submit" class="btn botonMismoColor text-white w-50 m-2" name="consultar" value="Consultar" id="consultar">
                    <input type="submit" class="btn botonMismoColor text-white w-50 m-2" name="pedir" value="Pedir" id="pedir">  
                </div>
            </form>
        </div>
        
        <?php
            require_once('php/CRUD.php');
            $CRUD = new CRUD("u129628487_veter");

            if(isset($_POST['consultar'])){
                $tarjeta = $_POST['tarjeta'];

                if(empty($tarjeta)){
                    ?><script>
                        document.getElementById("tarjetaAnimal").setAttribute("style","border-color: red");
                        document.getElementById("error").innerHTML = "Introduce una <b>tarjeta</b>";
                    </script><?php
                }else{
                    if(count($CRUD -> comprobarAnimal($tarjeta))){
                        echo '<button type="button" class="btn btn-primary d-none" data-toggle="modal" data-target=".tabla" id="botonTabla">Boton que activa un modal</button>';
                        echo '<div class="modal fade tabla" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title m-auto" id="exampleModalLongTitle">Citas de '.$tarjeta.'</h5>
                                <button type="button" class="close ml-0 pl-0" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">';
                        echo '<div class="w-100 overflow-auto pt-2" style="overflow-y: overlay;">
                        <table class="table table-bordered text-center">
                            <thead><th>Fecha</th><th>Hora</th><th>Medico</th>
                        </thead><tbody>';
                        $resultado = $CRUD -> mostrarCitaDeUnAnimal($tarjeta);
                        
                        foreach($resultado as $clave => $valor){
                            echo "<tr>";
                                echo "<td>$valor[Fecha]</td>";
                                echo "<td>$valor[Hora]</td>";
                                echo "<td>". $CRUD -> devolverNombreMedico($valor['Medico']) ."</td>";
                            echo "<tr>";
                        }
                        echo '</tbody></table></div>';
                        echo '</div></div></div></div></div>';
                        $pulsarModal = "";
                    } else{
                        ?><script>
                            document.getElementById("tarjetaAnimal").setAttribute("style","border-color: red");
                            document.getElementById("tarjetaAnimal").setAttribute("value","<?php echo $tarjeta; ?>");
                            document.getElementById("errorTarjeta").innerHTML = "Introduce una <b>tarjeta</b> valida";
                        </script><?php
                    }
                }
            }
        ?>

        <button type="button" class="btn btn-primary d-none" data-toggle="modal" data-target=".correcto" id="botonCorrecto">Boton que activa un modal</button>
        <div class="modal fade correcto" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="alert alert-success m-0 text-center">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <span id="textoCorrecto"><b>¡Correcto!</b> Se ha pedido una cita con exito</span>
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
        if(isset($_POST['pedir'])){
            $tarjeta = $_POST['tarjeta'];
            $fecha = $_POST['cita'];
            $hora = $_POST['hora'];

            if(empty($tarjeta)){
                ?><script>
                    document.getElementById("tarjetaAnimal").setAttribute("style","border-color: red");
                    document.getElementById("error").innerHTML = "Los <b>campos</b> son obligatorios";
                </script><?php
            }else{
                ?><script>
                    document.getElementById("tarjetaAnimal").setAttribute("value","<?php echo $tarjeta; ?>");
                </script><?php
            }

            if(empty($fecha)){
                ?><script>
                    document.getElementById("cita").setAttribute("style","border-color: red");
                    document.getElementById("error").innerHTML = "Los <b>campos</b> son obligatorios";
                </script><?php
            }else{
                ?><script>
                    document.getElementById("cita").setAttribute("value","<?php echo $fecha; ?>");
                </script><?php
            }

            if(empty($hora)){
                ?><script>
                    document.getElementById("hora").setAttribute("style","border-color: red");
                    document.getElementById("error").innerHTML = "Los <b>campos</b> son obligatorios";
                </script><?php
            }else{
                ?><script>
                    $("#hora > option[value='<?php echo $hora; ?>']").attr("selected",true);
                </script><?php
            }
            
            if(!empty($tarjeta) && !empty($fecha)){
                if(count($CRUD -> comprobarAnimal($tarjeta))){
                    $diaActual = getdate()[0];
                    $citaFormat = strtotime($fecha." ".$hora);
                    
                    if($diaActual < $citaFormat){
                        $medico = $CRUD -> devolverMedicoAsignado($tarjeta);
                        $resultadoFinal = $CRUD -> añadirCitas($tarjeta,$fecha,$hora,$medico);
                    }else{
                        ?><script>
                            document.getElementById("cita").setAttribute("style","border-color: red");
                            document.getElementById("hora").setAttribute("style","border-color: red");
                            document.getElementById("tarjetaAnimal").setAttribute("value","<?php echo $tarjeta; ?>");
                            document.getElementById("cita").setAttribute("value","<?php echo $fecha; ?>");
                            $("#hora > option[value='<?php echo $hora; ?>']").attr("selected",true);
                            document.getElementById("error").innerHTML = "Introduce una <b>fecha</b> valida";
                        </script><?php
                    }

                }else{
                    ?><script>
                        document.getElementById("tarjetaAnimal").setAttribute("style","border-color: red");
                        document.getElementById("tarjetaAnimal").setAttribute("value","<?php echo $tarjeta; ?>");
                        document.getElementById("cita").setAttribute("value","<?php echo $fecha; ?>");
                        $("#hora > option[value='<?php echo $hora; ?>']").attr("selected",true);
                        document.getElementById("errorTarjeta").innerHTML = "Introduce una <b>tarjeta</b> valida";
                    </script><?php
                }
            }
        }

        if(isset($resultadoFinal)){
            if($resultadoFinal == 1){
                ?><script>
                    $("#botonCorrecto").click();
                    document.getElementById("tarjetaAnimal").setAttribute("value","");
                    document.getElementById("cita").setAttribute("value","");
                    $("#hora > option[value='']").attr("selected",true);
                </script> <?php
            }else{
                ?><script>
                    $("#botonError").click();
                    $("#textoError").html("<strong>¡Error!</strong> <?php echo $resultadoFinal; ?>.");
            </script><?php 
            }
        }

        if(isset($pulsarModal)){
            ?><script>
                $("#botonTabla").click();
            </script> <?php
        }
    ?>
</body>
</html>