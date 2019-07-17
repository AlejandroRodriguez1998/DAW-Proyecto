function irAdmin(){
    window.location.href = '../../administracion.php';
}

window.onload = function(){
    document.getElementById("botonAdmin").addEventListener("click", irAdmin);
}

