<?php
    session_start();

    if(!isset($_SESSION['usuario'])){
        ?><script>  window.location.href = '../../index.html'; </script><?php
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
    <link rel="stylesheet" href="../../js/MagnificPopup/dist/magnific-popup.css">
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
            <h2 id="tituloZona" class="text-center pt-2">Animales️</h2>
            <div class="d-flex justify-content-between">
                <a class="btn w-100 m-1 btn-outline-mismoColor active" href="mostrarAnimales.php">
                    <span class="d-none d-md-inline">Mostrar</span>
                    <span class="d-inline d-md-none"><i class="fa fa-eye"></i></span>
                </a>
                <a class="btn w-100 m-1 btn-outline-mismoColor" href="añadirAnimal.php">
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
            <div id="tarjetasZona" class="row p-2 pr-3">
                <input id="buscadorMostrarAnimales" type="text" class="form-control mb-3" placeholder="Buscar...">
                <div class="table-responsive">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Tarjeta</th>
                                <th>Nombre</th>
                                <th>Apodo</th>
                                <th>Raza</th>
                                <th>Sexo</th>
                                <th>Edad</th>
                                <th>Dueño</th>
                                <th>MedicoAsignado</th>
                                <th>Imagen</th>
                            </tr>
                        </thead>
                        <tbody id="listaAnimales">
                            <?php
                                require_once('../../php/CRUD.php');
                                $CRUD = new CRUD("u129628487_veter");

                                $resultado = $CRUD -> mostrarAnimales();

                                foreach($resultado as $clave => $valor){
                                    echo "<tr>";
                                        echo "<td>$valor[Tarjeta]</td>";
                                        echo "<td>$valor[Nombre]</td>";
                                        echo "<td>$valor[Apodo]</td>";
                                        echo "<td>$valor[Raza]</td>";
                                        echo "<td>$valor[Sexo]</td>";
                                        echo "<td>$valor[Edad]</td>";
                                        echo "<td>". $CRUD -> devolverNombreDueño($valor['Dueño']) ."</td>";
                                        echo "<td>". $CRUD -> devolverNombreMedico($valor['MedicoAsignado']) ."</td>";
                                        if(!empty($valor['Foto'])){
                                            echo "<td><a class='image-popup-no-margins' href=../../php/imagen.php?Tarjeta=".$valor['Tarjeta'].">
                                                    <img src=../../php/imagen.php?Tarjeta=".$valor['Tarjeta']." width='50' height='50' class='img-zoom'>
                                                </a></td>";
                                            //echo "<td><img src=../../php/imagen.php?Tarjeta=".$valor['Tarjeta']." width=100 height=100></td>";
                                        }else{
                                            echo "<td></td>";
                                        }
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
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
    <script src="../../js/MagnificPopup/dist/jquery.magnific-popup.js"></script>
    <script>
        $(document).ready(function() {
            $(document).ready(function(){
                $("#buscadorMostrarAnimales").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#listaAnimales tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
                });
            });

            $('.image-popup-no-margins').magnificPopup({
                type: 'image',
                closeOnContentClick: true,
                closeBtnInside: false,
                fixedContentPos: true,
                mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
                image: {
                    verticalFit: true
                },
                zoom: {
                    enabled: true,
                    duration: 300 // don't foget to change the duration also in CSS
                }
            });
        });
    </script>
</body>
</html>