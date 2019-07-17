<?php

require_once("CRUD.php");

$tarjeta = $_GET['Tarjeta'];

$CRUD = new CRUD("u129628487_veter");

$result = $CRUD -> obtenerImagen($tarjeta);

$imagen = imagecreatefromstring(base64_decode($result)); //Convertimos la imagen de un string objeto GD(grafico)
 
if ($imagen!=FALSE){
    Header('Content-type: image/jpeg'); //Formatemos la salida del archivo como un archivo JPG
    imagejpeg($imagen);
}else{
    echo "";
}
?>