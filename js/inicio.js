
function comprobarCookie(nombreValor) {
    var nombre = nombreValor + "=";
    var cookieArray = document.cookie.split(';');
    for(var i = 0; i < cookieArray.length; i++) {
        var palabra = cookieArray[i];
        while (palabra.charAt(0) == ' ') {
            palabra = palabra.substring(1);
        }

        if (palabra.indexOf(nombre) == 0) {
            return palabra.substring(nombre.length, palabra.length);
        }
    }
    return "";
}

function crearBoton() {
    var menu = document.getElementById("menu");

	var iniciar = document.createElement("button");
	iniciar.setAttribute("type","button");
    iniciar.setAttribute("class","btn botonMismoColor text-white");

    while (menu.firstChild) {
		menu.removeChild(menu.firstChild);
    }

    if(comprobarCookie("username") == ""){
        iniciar.addEventListener("click", iniciarSesion);
	    iniciar.appendChild(document.createTextNode("Iniciar Sesión"));
    }else {
        iniciar.addEventListener("click", cerrarSesion);
        
        var cerrarSes = document.createElement("span");
        cerrarSes.setAttribute("class","d-none d-md-inline");
        cerrarSes.appendChild(document.createTextNode("Cerrar Sesión"));
        iniciar.appendChild(cerrarSes);

        var span = document.createElement("span");
        span.setAttribute("class","d-inline d-md-none fa fa-sign-out");
        iniciar.appendChild(span);
        
        var admin = document.createElement("button");
        admin.setAttribute("id","botonAdmin");
	    admin.setAttribute("type","button");
        admin.setAttribute("class","btn botonMismoColor text-white mr-2");
        admin.addEventListener("click", irAdministracion);
        admin.appendChild(document.createTextNode("Administración"));

        menu.appendChild(admin);
    }

	menu.appendChild(iniciar);
}

function iniciarSesion() {
    window.location.href = 'iniciarSesion.php';
}

function irAdministracion(){
    window.location.href = 'administracion.php';
}

function cerrarSesion(){
    document.cookie = "username=;expires=Thu, 01 Jan 1970 00:00:00 UTC; Path=/";

    var opcion = document.getElementById("OpcionSalir").innerHTML;

    var arrayOpcion = opcion.split("-");
    if(arrayOpcion[0] == "normal"){
        window.location.href='cerrarSesion.php?url='+arrayOpcion[1];
    }

    if(opcion == "Administracion"){
        window.location.href='cerrarSesion.php';
    }

    if(opcion == "Administracion1"){
        window.location.href = '../cerrarSesion.php';
    }

    if(opcion == "Administracion2"){
        window.location.href = '../../cerrarSesion.php';
    }

    crearBoton();
}

function validarFormInicio(){
    var validacion = false;

    var nombre = document.getElementById("usuario");
    var contra = document.getElementById("pass");
    var errorNombre = document.getElementById("errorUsu");
    var errorContra = document.getElementById("errorContra");
    var imagen = document.getElementById("imagenInicioSesion");

    if(nombre.value == "" || contra.value == ""){
        errorNombre.innerHTML = "Introduce un <b>campo</b> valido";
        errorContra.innerHTML = "Introduce un <b>campo</b> valido";
        nombre.setAttribute("style","border-color: red");
        contra.setAttribute("style","border-color: red");

        imagen.setAttribute("src","img/Error.png");
    }else{

        validacion = true;
    }

    return validacion;
}

function validarFormAñadirAnimal(){
    var validacion = false;

    var tarjeta = document.getElementById("tarjeta");
    var nombre = document.getElementById("nombre");
    var raza = document.getElementById("raza");
    var cliente = $('input[name=clientes]:checked', '#añadirAnimal').val();
    var inputCli = document.getElementById("inputClientes");
    var medico = $('input[name=medicos]:checked', '#añadirAnimal').val();
    var inputMed = document.getElementById("inputMedicos");
    var mensaje = document.getElementById("mensajeError");

    if(tarjeta.value == ""){
        mensaje.innerHTML = "Introduce los <b>campos</b> obligatorios";
        tarjeta.setAttribute("style","border-color: red");
    }else{
        tarjeta.removeAttribute("style");
    }

    if(nombre.value == ""){
        mensaje.innerHTML = "Introduce los <b>campos</b> obligatorios";
        nombre.setAttribute("style","border-color: red");
    }else{
        nombre.removeAttribute("style");
    }

    if(raza.value == ""){
        mensaje.innerHTML = "Introduce los <b>campos</b> obligatorios";
        raza.setAttribute("style","border-color: red");
    }else{
        raza.removeAttribute("style");
    }

    if(cliente == undefined){
        mensaje.innerHTML = "Introduce los <b>campos</b> obligatorios";
        inputCli.setAttribute("style","border-color: red");
    }else{
        inputCli.removeAttribute("style");
    }

    if(medico == undefined){
        mensaje.innerHTML = "Introduce los <b>campos</b> obligatorios";
        inputMed.setAttribute("style","border-color: red");
    }else{
        inputMed.removeAttribute("style");
    }

    if(tarjeta != "" && nombre != "" && raza != "" && cliente != undefined && medico != undefined){
        mensaje.innerHTML = "";
        validacion = true;
    }

    return validacion;
}

function validarFormAñadirCliente(){
    var validacion = false;

    var dni = document.getElementById("dni");
    var nombre = document.getElementById("nombre");
    var primer = document.getElementById("primerApellido");
    var segundo = document.getElementById("segundoApellido");
    var mensaje = document.getElementById("mensajeError");

    if(dni.value == ""){
        mensaje.innerHTML = "Introduce los <b>campos</b> obligatorios";
        dni.setAttribute("style","border-color: red");
    }else{
        dni.removeAttribute("style");
    }

    if(nombre.value == ""){
        mensaje.innerHTML = "Introduce los <b>campos</b> obligatorios";
        nombre.setAttribute("style","border-color: red");
    }else{
        nombre.removeAttribute("style");
    }

    if(primer.value == ""){
        mensaje.innerHTML = "Introduce los <b>campos</b> obligatorios";
        primer.setAttribute("style","border-color: red");
    }else{
        primer.removeAttribute("style");
    }

    if(segundo.value == ""){
        mensaje.innerHTML = "Introduce los <b>campos</b> obligatorios";
        segundo.setAttribute("style","border-color: red");
    }else{
        segundo.removeAttribute("style");
    }

    if(dni.value != "" && nombre.value != "" && primer.value != "" && segundo != ""){
        mensaje.innerHTML = "";
        validacion = true;
    }

    return validacion;
}

function validarFormAñadirCita(){
    var validacion = false;

    var animal = $('input[name=animales]:checked', '#añadirCita').val();
    var inputAni = document.getElementById("inputAnimales");
    var fecha = document.getElementById("fecha");
    var fechaActual = new Date().getTime();
    var hora = document.getElementById("hora");
    var mensaje = document.getElementById("mensajeError");

    if(animal == undefined){
        mensaje.innerHTML = "Introduce los <b>campos</b> obligatorios";
        inputAni.setAttribute("style","border-color: red");
    }else{
        inputAni.removeAttribute("style");
    }

    if(fecha.value == ""){
        mensaje.innerHTML = "Introduce los <b>campos</b> obligatorios";
        fecha.setAttribute("style","border-color: red");
    }else{
        fecha.removeAttribute("style");
    }

    if(hora.value == ""){
        mensaje.innerHTML = "Introduce los <b>campos</b> obligatorios";
        hora.setAttribute("style","border-color: red");
    }else{
        hora.removeAttribute("style");
    }

    if(animal != undefined && fecha.value != "" && hora.value != ""){
        var fechaFormat = new Date(fecha.value + " "+hora.value).getTime();
        if(fechaActual < fechaFormat){
            fecha.removeAttribute("style");
            hora.removeAttribute("style");
            mensaje.innerHTML = "";
            validacion = true;
        }else{
            fecha.setAttribute("style","border-color: red");
            hora.setAttribute("style","border-color: red");
            mensaje.innerHTML = "Introduce una <b>fecha</b> valida";
        }
    }

    return validacion;
}

function validarFormAñadirVeterinario(){
    var validacion = false;

    var dni = document.getElementById("dni");
    var nombre = document.getElementById("nombre");
    var primer = document.getElementById("primerApellido");
    var segundo = document.getElementById("segundoApellido");
    var mensaje = document.getElementById("mensajeError");

    if(dni.value == ""){
        mensaje.innerHTML = "Introduce los <b>campos</b> obligatorios";
        dni.setAttribute("style","border-color: red");
    }else{
        dni.removeAttribute("style");
    }

    if(nombre.value == ""){
        mensaje.innerHTML = "Introduce los <b>campos</b> obligatorios";
        nombre.setAttribute("style","border-color: red");
    }else{
        nombre.removeAttribute("style");
    }

    if(primer.value == ""){
        mensaje.innerHTML = "Introduce los <b>campos</b> obligatorios";
        primer.setAttribute("style","border-color: red");
    }else{
        primer.removeAttribute("style");
    }

    if(segundo.value == ""){
        mensaje.innerHTML = "Introduce los <b>campos</b> obligatorios";
        segundo.setAttribute("style","border-color: red");
    }else{
        segundo.removeAttribute("style");
    }

    if(dni.value != "" && nombre.value != "" && primer.value != "" && segundo != ""){
        mensaje.innerHTML = "";
        validacion = true;
    }

    return validacion;
}

function mostrarOpcionesBorrado(usuario){
    var opciones = document.getElementById("opciones"+usuario);
    var cancelar = document.getElementById("cancelar"+usuario);
    var aceptar = document.getElementById("aceptar"+usuario);

    console.log("opciones"+usuario);

    opciones.setAttribute("style","display:none;");
    cancelar.removeAttribute("style");
    aceptar.removeAttribute("style");
}

function mostrarCancelarBorrado(usuario){
    var opciones = document.getElementById("opciones"+usuario);
    var cancelar = document.getElementById("cancelar"+usuario);
    var aceptar = document.getElementById("aceptar"+usuario);

    opciones.removeAttribute("style");
    cancelar.setAttribute("style","display:none;");
    aceptar.setAttribute("style","display:none;");
}

window.onload = crearBoton();