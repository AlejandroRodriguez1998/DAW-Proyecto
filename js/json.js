
function mostrarAnimales(){
    var request  = new XMLHttpRequest();
    request.onreadystatechange = function() {
  		if (this.readyState == 4 && this.status == 200) {
            var archivo = request.response;
            
            var tarjetas = document.getElementById("tarjetasZona");

            for(var i = 0; i < archivo.Protectora.length; i++){
                var tarjeta = document.createElement("div");
                tarjeta.setAttribute("class","col-12 col-lg-6 col-xl-4 mb-4");

                var cuerpo = document.createElement("div");
                cuerpo.setAttribute("class","card text-center position-relative");

                var header = document.createElement("div");
                header.setAttribute("class","card-header");
                header.setAttribute("style","height: 120px;position: absolute;width: 100%;background-color:#1C2833");

                var divImagen = document.createElement("div");
                divImagen.setAttribute("class","divImagen");
                divImagen.setAttribute("style","z-index: 1;text-align: center;");

                var img = document.createElement("img");
                img.setAttribute("src","img/protectora/"+archivo.Protectora[i].Nombre+".jpg");
                img.setAttribute("alt","Imagen de la mascota que quiere ser adoptada");

                var contenido = document.createElement("div");
                contenido.setAttribute("class","card-body");

                var titulo = document.createElement("h4");
                titulo.setAttribute("class","card-title");
                titulo.appendChild(document.createTextNode(archivo.Protectora[i].Nombre));

                var span = document.createElement("span");
                span.setAttribute("class","badge");
                
                var icono = document.createElement("img");
                icono.setAttribute("width","20px");
                icono.setAttribute("src","img/protectora/"+archivo.Protectora[i].Tipo+".png");
                icono.setAttribute("alt","iconoAnimal");

                span.appendChild(icono);
                titulo.appendChild(span);

                var ul = document.createElement("ul");
                ul.setAttribute("class","list-group list-group-flush");

                var fecha = document.createElement("li");
                fecha.setAttribute("class","fa fa-calendar list-group-item");
                fecha.appendChild(document.createTextNode(" "+archivo.Protectora[i].Edad));
                ul.appendChild(fecha);

                var raza = document.createElement("li");
                raza.setAttribute("class","fa fa-dna list-group-item");
                raza.appendChild(document.createTextNode(" "+archivo.Protectora[i].Raza));
                ul.appendChild(raza);
                
                var sexo = document.createElement("li");
                
                if(archivo.Protectora[i].Sexo == "Macho"){
                    sexo.setAttribute("class","fa fa-mars list-group-item");
                    sexo.appendChild(document.createTextNode(" "+archivo.Protectora[i].Sexo));
                    ul.appendChild(sexo);
                }else{
                    sexo.setAttribute("class","fa fa-venus list-group-item");
                    sexo.appendChild(document.createTextNode(" "+archivo.Protectora[i].Sexo));
                    ul.appendChild(sexo);
                }

                var texto = document.createElement("p");
                texto.setAttribute("class","card-text");

                tarjetas.appendChild(tarjeta);
                tarjeta.appendChild(cuerpo);
                cuerpo.appendChild(header);
                cuerpo.appendChild(divImagen);
                divImagen.appendChild(img);
                cuerpo.appendChild(contenido);
                contenido.appendChild(titulo);
                contenido.appendChild(ul);
                contenido.appendChild(texto);

            }
        }
    };
    request.open("GET", "php/Protectora.json", true);
    request.responseType = 'json';
    request.send(); 
}

window.onload = mostrarAnimales();