
function mostrarOpciones(){
    document.getElementById("botonAdmin").addEventListener("click", irAdmin);
	var menu = document.getElementById("opciones");

	while (menu.firstChild) {
		menu.removeChild(menu.firstChild);
    }
    
    var arrayOpciones = ["Mostrar","Añadir","Modificar","Eliminar"];
    
	for(let i = 0; i < arrayOpciones.length; i++){
		//Crea las opciones
		var enlace = document.createElement("button");
        enlace.setAttribute("class","btn w-100 m-1 btn-outline-mismoColor");
        enlace.setAttribute("id", arrayOpciones[i]);
        enlace.setAttribute("value", arrayOpciones[i]);
        
        var texto = document.createElement("span");
        texto.setAttribute("class","d-none d-md-inline");
        texto.appendChild(document.createTextNode(arrayOpciones[i]));

        var span = document.createElement("span");
        span.setAttribute("class","d-inline d-md-none");

        var icono = document.createElement("i");

        if(arrayOpciones[i] == "Mostrar"){
            icono.setAttribute("class","fa fa-eye");
        }
        if(arrayOpciones[i] == "Añadir"){
            icono.setAttribute("class","fa fa-plus-circle");
        }
        if(arrayOpciones[i] == "Modificar"){
            icono.setAttribute("class","fa fa-edit");
        }
        if(arrayOpciones[i] == "Eliminar"){
            icono.setAttribute("class","fa fa-trash");
        }

        span.appendChild(icono);

        enlace.appendChild(texto);
        enlace.appendChild(span);
		enlace.addEventListener("click", validarOpciones);
        
        menu.appendChild(enlace);
    }
    
}

function validarOpciones(){
    var opcion = this.value;

    if(opcion == "Mostrar"){
        mostrarAdmin();
    }

    if(opcion == "Añadir"){
        mostrarAñadirAdmin();
    }

    if(opcion == "Modificar"){
        mostrarModificarAdmin();
    }

    if(opcion == "Eliminar"){
        mostrarEliminarAdmin();
    }

}

function irAdmin(){
    window.location.href = '../administracion.php';
}

function mostrarAdmin(){
    document.getElementById("Mostrar").setAttribute("class","btn w-100 m-1 btn-outline-mismoColor active");
    document.getElementById("Añadir").setAttribute("class","btn w-100 m-1 btn-outline-mismoColor");
    document.getElementById("Modificar").setAttribute("class","btn w-100 m-1 btn-outline-mismoColor");
    document.getElementById("Eliminar").setAttribute("class","btn w-100 m-1 btn-outline-mismoColor");
    $.ajax({
        url: '../php/adminServer.php',
        type: 'POST',
        data: "operacion=Mostrar",
    }).done(function(data){
        var datos = JSON.parse(data);

        //Selecciona el titulo central y le cambia el nombre
        var tituloContenido = document.getElementById("tituloZona");
        tituloContenido.innerHTML = "Administradore️s";

        //Selecciona la zona central donde van las tarjetas de las categorias
        var tarjetas = document.getElementById("tarjetasZona");

        //QUITA TODO EL CONTENIDO QUE HAYA EN LA VARIABLE CONTENIDO
        while (tarjetas.firstChild) {
            tarjetas.removeChild(tarjetas.firstChild);
        }

        var buscador = document.createElement("input");
        buscador.setAttribute("id","buscadorMostrarAdmin");
        buscador.setAttribute("type","text");
        buscador.setAttribute("class","form-control mb-3 mt-2");
        buscador.setAttribute("placeholder","Buscar...");

        var divScroll = document.createElement("div");
        divScroll.setAttribute("class","w-100 overflow-auto");
        divScroll.setAttribute("style","overflow-y: overlay;");

        var tabla = document.createElement("table");
        tabla.setAttribute("class","table table-bordered text-center");

        var thead = document.createElement("thead");

        var th1 = document.createElement("th");
        th1.append(document.createTextNode("ID"));

        var th2 = document.createElement("th");
        th2.append(document.createTextNode("Nombre"));

        var th3 = document.createElement("th");
        th3.append(document.createTextNode("Contraseña"));

        var tbody = document.createElement("tbody");
        tbody.setAttribute("id","myTable")

        tarjetas.appendChild(buscador);
        tarjetas.appendChild(divScroll);
        divScroll.appendChild(tabla);
        tabla.appendChild(thead);
        thead.appendChild(th1);
        thead.appendChild(th2);
        thead.appendChild(th3);
        tabla.appendChild(tbody);

        for(let i = 0; i < datos.length; i++){
            var tr = document.createElement("tr");

            var tdID = document.createElement("td");
            tdID.appendChild(document.createTextNode(datos[i].ID));

            var tdNombre = document.createElement("td");
            tdNombre.appendChild(document.createTextNode(datos[i].Nombre));

            var tdPass = document.createElement("td");

            if(datos[i].clave != ""){
                tdPass.appendChild(document.createTextNode("Sí"));
            }else{
                tdPass.appendChild(document.createTextNode("No"));
            }

            tr.appendChild(tdID);
            tr.appendChild(tdNombre);
            tr.appendChild(tdPass);
            tbody.appendChild(tr);
        }

        $(document).ready(function(){
            $("#buscadorMostrarAdmin").on("keyup", function() {
              var value = $(this).val().toLowerCase();
              $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
              });
            });
        });
    });
}

function mostrarAñadirAdmin(){
    document.getElementById("Mostrar").setAttribute("class","btn w-100 m-1 btn-outline-mismoColor");
    document.getElementById("Añadir").setAttribute("class","btn w-100 m-1 btn-outline-mismoColor active");
    document.getElementById("Modificar").setAttribute("class","btn w-100 m-1 btn-outline-mismoColor");
    document.getElementById("Eliminar").setAttribute("class","btn w-100 m-1 btn-outline-mismoColor");
   //Selecciona el titulo central y le cambia el nombre
	var tituloContenido = document.getElementById("tituloZona");
	tituloContenido.innerHTML = "Administradores";

	//Selecciona la zona central donde van las tarjetas de las categorias
	var tarjetas = document.getElementById("tarjetasZona");

	//QUITA TODO EL CONTENIDO QUE HAYA EN LA VARIABLE CONTENIDO
	while (tarjetas.firstChild) {
		tarjetas.removeChild(tarjetas.firstChild);
    }
 
    var form = document.createElement("form");
    form.setAttribute("id","formAñadir")
    form.setAttribute("method","POST");
    form.setAttribute("class","w-100 mt-3")

    tarjetas.appendChild(form);

    form.innerHTML = "<div class=\"form-group\">\
        <label for=\"username\">*Nombre:</label>\
        <input type=\"text\" class=\"form-control\" id=\"username\" name=\"username\" maxlength=\"10\">\
    </div>\
    <div class=\"form-group\">\
        <label for=\"pass\">*Contraseña:</label>\
        <input type=\"password\" class=\"form-control\" id=\"pass\" name=\"pass\" maxlength=\"20\">\
    </div>\
    <p id=\"exception\" class=\"text-center text-danger font-weight-bold\"></p>\
    <div class=\"form-group\" id=\"botonAñadir\">\
    </div>";

    var divBoton = document.getElementById("botonAñadir");

    var botonAñadir = document.createElement("input");
    botonAñadir.setAttribute("type","button");
    botonAñadir.setAttribute("class","btn btn-block botonMismoColor text-white");
    botonAñadir.setAttribute("id","añadir");
    botonAñadir.setAttribute("name","añadir");
    botonAñadir.setAttribute("value","Añadir");
    botonAñadir.addEventListener("click",añadirAdmin);

    divBoton.appendChild(botonAñadir);

}

function añadirAdmin(){
    var nombre = document.getElementById("username");
    var pass = document.getElementById("pass");
    var exception = document.getElementById("exception");

    if(nombre.value == "" || pass.value == ""){
        nombre.setAttribute("style","border-color: red");
        pass.setAttribute("style","border-color: red");
        exception.innerHTML = "Los <b>campos</b> son obligatorios";
    }else {
        nombre.removeAttribute("style");
        pass.removeAttribute("style");
        exception.innerHTML = "";

        $.ajax({
            url: '../php/adminServer.php',
            type: 'POST',
            data: "operacion=Añadir&"+$("#formAñadir").serialize(),
        }).done(function(data){
            if(data == 1){
                $("#botonCorrecto").click();
                $("#textoCorrecto").html("<b>¡Correcto!</b> Has añadido un administrador con exito.");
            }else {
                $("#botonError").click();
                $("#textoError").html("<strong>¡Error!</strong> "+ data + ".");
            }
        });
    }
}

function mostrarModificarAdmin(){
    document.getElementById("Mostrar").setAttribute("class","btn w-100 m-1 btn-outline-mismoColor");
    document.getElementById("Añadir").setAttribute("class","btn w-100 m-1 btn-outline-mismoColor ");
    document.getElementById("Modificar").setAttribute("class","btn w-100 m-1 btn-outline-mismoColor active");
    document.getElementById("Eliminar").setAttribute("class","btn w-100 m-1 btn-outline-mismoColor");
    $.ajax({
        url: '../php/adminServer.php',
        type: 'POST',
        data: "operacion=Mostrar",
    }).done(function(data){
        var datos = JSON.parse(data);

        //Selecciona el titulo central y le cambia el nombre
        var tituloContenido = document.getElementById("tituloZona");
        tituloContenido.innerHTML = "Administradores";

        //Selecciona la zona central donde van las tarjetas de las categorias
        var tarjetas = document.getElementById("tarjetasZona");

        //QUITA TODO EL CONTENIDO QUE HAYA EN LA VARIABLE CONTENIDO
        while (tarjetas.firstChild) {
            tarjetas.removeChild(tarjetas.firstChild);
        }
        var buscador = document.createElement("input");
        buscador.setAttribute("id","buscadorMostrarAdmin");
        buscador.setAttribute("type","text");
        buscador.setAttribute("class","form-control mb-3 mt-2");
        buscador.setAttribute("placeholder","Buscar...");

        var divScroll = document.createElement("div");
        divScroll.setAttribute("class","w-100 overflow-auto");
        divScroll.setAttribute("style","overflow-y: overlay;");

        var tabla = document.createElement("table");
        tabla.setAttribute("class","table table-bordered text-center");

        var thead = document.createElement("thead");

        var th1 = document.createElement("th");
        th1.append(document.createTextNode(""));

        var th2 = document.createElement("th");
        th2.append(document.createTextNode("Nombre"));

        var th3 = document.createElement("th");
        th3.append(document.createTextNode("Contraseña"));

        var tbody = document.createElement("tbody");
        tbody.setAttribute("id","myTable")

        tarjetas.appendChild(buscador);
        tarjetas.appendChild(divScroll);
        divScroll.appendChild(tabla);
        tabla.appendChild(thead);
        thead.appendChild(th1);
        thead.appendChild(th2);
        thead.appendChild(th3);
        tabla.appendChild(tbody);

        for(let i = 0; i < datos.length; i++){
            var tr = document.createElement("tr");
            var tdButton = document.createElement("td");
            var button = document.createElement("button");
            button.setAttribute("type","button");
            button.setAttribute("class","btn borrarBoton p-0 bg-transparent");
            button.setAttribute("value",datos[i].Nombre);
            button.addEventListener("click", modificarAdmin);
        
            var img = document.createElement("img");
            img.setAttribute("src","../img/modificar.png");
            img.setAttribute("alt",datos[i].Nombre);
            img.setAttribute("style","width: 25px;");

            button.appendChild(img);
            tdButton.appendChild(button);

            var tdNombre = document.createElement("td");
            var inputNombre = document.createElement("input");
            inputNombre.setAttribute("class","form-control");
            inputNombre.setAttribute("type","text");
            inputNombre.setAttribute("id","inputNom" + datos[i].Nombre);
            inputNombre.setAttribute("value",datos[i].Nombre);
            inputNombre.setAttribute("maxlength","10");

            var nombreBuscar = document.createElement("p");
            nombreBuscar.setAttribute("style","display:none");
            nombreBuscar.appendChild(document.createTextNode(datos[i].Nombre));

            tdNombre.appendChild(nombreBuscar);
            tdNombre.appendChild(inputNombre);
            
            var tdPass = document.createElement("td");
            var inputPass = document.createElement("input");
            inputPass.setAttribute("class","form-control");
            inputPass.setAttribute("type","password");
            inputPass.setAttribute("id","inputPass" + datos[i].Nombre);
            inputPass.setAttribute("value",datos[i].clave);
            inputPass.setAttribute("maxlength","20");
            
            tdPass.appendChild(inputPass);

            tbody.appendChild(tr);
            tr.appendChild(tdButton);
            tr.appendChild(tdNombre);
            tr.appendChild(tdPass);
        }

        $(document).ready(function(){
            $("#buscadorMostrarAdmin").on("keyup", function() {
              var value = $(this).val().toLowerCase();
              $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
              });
            });
        });
    });
}

function modificarAdmin(){
    var nombreBuscar = this.value
    var nombre = document.getElementById("inputNom" + this.value).value;
    var pass = document.getElementById("inputPass" + this.value).value;

    if(nombre == "" || pass == ""){
        $("#botonError").click();
        $("#textoError").html("<strong>¡Atención!</strong> No puedes dejar campos vacios.");
    }else{
        $.ajax({
            url: '../php/adminServer.php',
            type: 'POST',
            data: "operacion=Modificar&username="+nombre+"&pass="+pass+"&buscar="+nombreBuscar,
        }).done(function(data){
            if(data == 1){
                $("#botonCorrecto").click();
                $("#textoCorrecto").html("<b>¡Correcto!</b> Has modificado un administrador con exito.");
                mostrarModificarAdmin();
            }else {
                $("#botonError").click();
                $("#textoError").html("<strong>¡Error!</strong> "+ data + ".");
            }

        });
    }
}

function mostrarEliminarAdmin(){
    document.getElementById("Mostrar").setAttribute("class","btn w-100 m-1 btn-outline-mismoColor");
    document.getElementById("Añadir").setAttribute("class","btn w-100 m-1 btn-outline-mismoColor");
    document.getElementById("Modificar").setAttribute("class","btn w-100 m-1 btn-outline-mismoColor");
    document.getElementById("Eliminar").setAttribute("class","btn w-100 m-1 btn-outline-mismoColor active");
    $.ajax({
        url: '../php/adminServer.php',
        type: 'POST',
        data: "operacion=Mostrar",
    }).done(function(data){
        var datos = JSON.parse(data);

        //Selecciona el titulo central y le cambia el nombre
        var tituloContenido = document.getElementById("tituloZona");
        tituloContenido.innerHTML = "Administradores";

        //Selecciona la zona central donde van las tarjetas de las categorias
        var tarjetas = document.getElementById("tarjetasZona");

        //QUITA TODO EL CONTENIDO QUE HAYA EN LA VARIABLE CONTENIDO
        while (tarjetas.firstChild) {
            tarjetas.removeChild(tarjetas.firstChild);
        }

        var buscador = document.createElement("input");
        buscador.setAttribute("id","buscadorMostrarAdmin");
        buscador.setAttribute("type","text");
        buscador.setAttribute("class","form-control mb-3 mt-2");
        buscador.setAttribute("placeholder","Buscar...");

        var divScroll = document.createElement("div");
        divScroll.setAttribute("class","w-100 overflow-auto");
        divScroll.setAttribute("style","overflow-y: overlay;");

        var tabla = document.createElement("table");
        tabla.setAttribute("class","table table-bordered text-center");

        var thead = document.createElement("thead");

        var th1 = document.createElement("th");
        th1.append(document.createTextNode(""));

        var th2 = document.createElement("th");
        th2.append(document.createTextNode("Nombre"));

        var tbody = document.createElement("tbody");
        tbody.setAttribute("id","myTable")

        tarjetas.appendChild(buscador);
        tarjetas.appendChild(divScroll);
        divScroll.appendChild(tabla);
        tabla.appendChild(thead);
        thead.appendChild(th1);
        thead.appendChild(th2);
        tabla.appendChild(tbody);

        for(let i = 0; i < datos.length; i++){
            var tr = document.createElement("tr");
            var td = document.createElement("td");
            td.setAttribute("id","borrar"+datos[i].Nombre);
            td.setAttribute("class","w-50");
            var button = document.createElement("button");
            button.setAttribute("type","button");
            button.setAttribute("class","btn borrarBoton p-0 bg-transparent");
            button.setAttribute("value",datos[i].Nombre);
            button.addEventListener("click", mostrarOpcionesBorrado);

            var img = document.createElement("img");
            img.setAttribute("src","../img/eliminar.png");
            img.setAttribute("alt",datos[i].Nombre);
            img.setAttribute("style","width: 25px;");

            button.appendChild(img);
            
            var tdNombre = document.createElement("td");
            tdNombre.setAttribute("id","buscarBorrar"+datos[i].Nombre);
            tdNombre.appendChild(document.createTextNode(datos[i].Nombre));

            tbody.appendChild(tr);
            tr.appendChild(td);
            tr.appendChild(tdNombre);
            td.appendChild(button);
        }

        $(document).ready(function(){
            $("#buscadorMostrarAdmin").on("keyup", function() {
              var value = $(this).val().toLowerCase();
              $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
              });
            });
        });
    });
}

function mostrarOpcionesBorrado(){
    var usuario = this.value
    var td = document.getElementById("borrar"+usuario);

    while (td.firstChild) {
        td.removeChild(td.firstChild);
    }

    if(this.id == "cancelar"){
        var button = document.createElement("button");
        button.setAttribute("type","button");
        button.setAttribute("class","btn borrarBoton p-0 bg-transparent");
        button.setAttribute("value", usuario);
        button.addEventListener("click", mostrarOpcionesBorrado);

        var img = document.createElement("img");
        img.setAttribute("src","../img/eliminar.png");
        img.setAttribute("alt", usuario);
        img.setAttribute("style","width: 25px;");

        button.appendChild(img);
        td.appendChild(button);
    }else{
        var aceptar = document.createElement("button");
        aceptar.setAttribute("class","btn botonMismoColor text-white m-1 pr-3 pl-3");
        aceptar.setAttribute("value", usuario);
        aceptar.append(document.createTextNode("Aceptar"));
        aceptar.addEventListener("click",eliminarAdmin);

        var cancelar = document.createElement("button");
        cancelar.setAttribute("class","btn botonMismoColor text-white m-1");
        cancelar.setAttribute("value", usuario);
        cancelar.append(document.createTextNode("Cancelar"));
        cancelar.setAttribute("id","cancelar");
        cancelar.addEventListener("click", mostrarOpcionesBorrado);

        td.appendChild(cancelar);
        td.appendChild(aceptar);
    }
}

function eliminarAdmin(){
    var contenidoBorrar = document.getElementById("buscarBorrar"+this.value).textContent;

    $.ajax({
        url: '../php/adminServer.php',
        type: 'POST',
        data: "operacion=Eliminar&username="+contenidoBorrar,
    }).done(function(data){
        if(data == 1){
            $("#botonCorrecto").click();
            $("#textoCorrecto").html("<b>¡Correcto!</b> Has eliminado un administrador con exito.");
            mostrarEliminarAdmin();
        }else {
            $("#botonError").click();
            $("#textoError").html("<strong>¡Error!</strong> "+ data + ".");
        }

    });
    
}

function init(){
    mostrarOpciones();
    mostrarAdmin();  
}

window.onload = init();

