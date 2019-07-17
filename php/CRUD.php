<?php
    require_once('libreriaPDO.php');

    class CRUD {
        private $con;    //Propiedad para guardar el objeto conexion

        public function __CONSTRUCT($BBDD){
		    try{
                $this -> con = new PDO1($BBDD); 
		    }catch(Exception $e){
			    die($e->getMessage());
            }
	    }

        /** ADMINISTRADORES */
        
        //Metodo que se una en inicio de sesión
        public function mostrarAdministrador($username,$pass){
            $consulta = ("SELECT ID FROM administradores WHERE Nombre = '$username' AND clave = '$pass'");

            $this -> con -> consultaDatos($consulta);

            return $this -> con -> filas;
        }

        //Muestra todos los administradores del sistema
        public function mostrarAdministradores(){
            $consulta = "SELECT * FROM administradores";

            $this -> con -> consultaDatos($consulta);

            return $this -> con -> filas;
        }

        //Añade un administrador
        public function añadirAdministrador($username,$pass){
            if(count($this -> comprobarAdmin($username))){
                return "Lo sentimos, el usuario ya existe";
            }else{
                $consulta = "INSERT INTO administradores VALUES(null,'$username','$pass')";

                return $this -> con -> consultaSimple($consulta);
            }
        }

        //Modifica un administrador
        public function modificarAdministrador($username,$pass,$buscar){

            if($username != $buscar){
                if(count($this -> comprobarAdmin($username))){
                    return "Lo sentimos, el usuario ya existe";
                }
            }

            $id = $this -> comprobarAdmin($buscar);
            $consulta = "UPDATE administradores SET Nombre='$username', clave='$pass' WHERE ID = ". $id[0]['ID'];

            return $this -> con -> consultaSimple($consulta);
        }

        //Elimina un administrador
        public function eliminarAdministrador($username){
            $id = $this -> comprobarAdmin($username);
            $consulta = "DELETE FROM administradores WHERE ID = ". $id[0]['ID'];

            return $this -> con -> consultaSimple($consulta);
        }

        //Comprueba si existe o no dicho administrador        
        public function comprobarAdmin($username){
            $consulta = ("SELECT ID FROM administradores WHERE Nombre = '$username'");

            $this -> con -> consultaDatos($consulta);

            return $this -> con -> filas;
        }

        /** ANIMALES */

        //Muestra todos los animales existentes en el sistema
        public function mostrarAnimales(){
            $consulta = "SELECT * FROM animales";

            $this -> con -> consultaDatos($consulta);

            return $this -> con -> filas;
        }

        //Añade un nuevo animal
        public function añadirAnimal($tarjeta,$nombre,$apodo,$raza,$sexo,$edad,$foto,$tipo,$dueño,$medico){
            if(count($this -> comprobarAnimal($tarjeta))){
                return "Lo sentimos, esta tarjeta ya esta registrada";
            }else{
                $consulta = "INSERT INTO animales VALUES('$tarjeta','$nombre','$apodo','$raza','$sexo',$edad,'$dueño','$medico','$foto','$tipo')";
                
                return $this -> con -> consultaSimple($consulta);
            }
        }

        //Modifica un animal
        public function modificarAnimal($tarjeta,$nombre,$apodo,$raza,$sexo,$edad,$foto,$tipo,$dueño,$medico){
           $consulta = "UPDATE animales SET Tarjeta='$tarjeta', Nombre='$nombre', Apodo='$apodo', Raza='$raza', Sexo='$sexo', Edad= $edad, Dueño='$dueño', MedicoAsignado='$medico', Foto='$foto', Tipo='$tipo' WHERE Tarjeta='$tarjeta'";

           return $this -> con -> consultaSimple($consulta);
        }

        //Elimina un animal
        public function eliminarAnimal($tarjeta){
            $consulta = "DELETE FROM animales WHERE Tarjeta='$tarjeta'";

            return $this -> con -> consultaSimple($consulta);
        }

        //Comprueba si existe dicho animal
        public function comprobarAnimal($tarjeta){
            $consulta = ("SELECT Tarjeta FROM animales WHERE Tarjeta = '$tarjeta'");

            $this -> con -> consultaDatos($consulta);

            return $this -> con -> filas;
        }

        //Obtiene la imagen del animal
        public function obtenerImagen($tarjeta){
            $consulta = "SELECT Foto FROM animales Where Tarjeta = '$tarjeta'";

            $this -> con -> consultaDatos($consulta);

            return $this -> con -> filas[0]['Foto'];
        }

        /** CLIENTES */

        //Muestra todos los clientes existentes en el sistema
        public function mostrarClientes(){
            $consulta = "SELECT * FROM clientes";

            $this -> con -> consultaDatos($consulta);

            return $this -> con -> filas;
        }

        //Añade un nuevo cliente
        public function añadirCliente($dni,$nombre,$apellido,$apellido2){
            if(count($this -> comprobarCliente($dni))){
                return "Lo sentimos, este DNI ya esta registrado";
            }else{
                $consulta = "INSERT INTO clientes VALUES('$dni','$nombre','$apellido','$apellido2')";
            
                return $this -> con -> consultaSimple($consulta);
            }
        }

        //Modifica un cliente
        public function modificarCliente($dni,$nombre,$apellido,$apellido2){
            $consulta = "UPDATE clientes SET DNI='$dni', Nombre='$nombre', PrimerApellido='$apellido', SegundoApellido='$apellido2' WHERE DNI='$dni'";

           return $this -> con -> consultaSimple($consulta);
        }

        //Elimina un cliente
        public function eliminarCliente($dni){
            $consulta = "DELETE FROM clientes WHERE DNI='$dni'";

            return $this -> con -> consultaSimple($consulta);
        }

        //Comprueba si dicho cliente existe
        public function comprobarCliente($dni){
            $consulta = ("SELECT DNI FROM clientes WHERE DNI = '$dni'");

            $this -> con -> consultaDatos($consulta);

            return $this -> con -> filas;
        }

        /** MEDICOS */ 

        //Muestra todos los medicos existentes en el sistema
        public function mostrarMedicos(){
            $consulta = "SELECT * FROM medicos";

            $this -> con -> consultaDatos($consulta);

            return $this -> con -> filas;
        }

        //Añade un nuevo medico
        public function añadirMedico($dni,$nombre,$apellido,$apellido2){
            if(count($this -> comprobarMedico($dni))){
                return "Lo sentimos, este DNI ya esta registrado";
            }else{
                $consulta = "INSERT INTO medicos VALUES('$dni','$nombre','$apellido','$apellido2')";
            
                return $this -> con -> consultaSimple($consulta);
            }
        }

        //Modifica un medico
        public function modificarMedico($dni,$nombre,$apellido,$apellido2){
            $consulta = "UPDATE medicos SET DNI='$dni', Nombre='$nombre', PrimerApellido='$apellido', SegundoApellido='$apellido2' WHERE DNI='$dni'";

            return $this -> con -> consultaSimple($consulta);
        }

        //Elimina un medico
        public function eliminarMedico($dni){
            $consulta = "DELETE FROM medicos WHERE DNI='$dni'";

            return $this -> con -> consultaSimple($consulta);
        }

        //Comprueba si existe dicho medico
        public function comprobarMedico($dni){
            $consulta = ("SELECT DNI FROM medicos WHERE DNI = '$dni'");

            $this -> con -> consultaDatos($consulta);

            return $this -> con -> filas;
        }
        
        /** CITAS */

        //Muestra todas las citas existentes en el sistema
        public function mostrarCitas(){
            $consulta = "SELECT * FROM citas";

            $this -> con -> consultaDatos($consulta);

            return $this -> con -> filas;
        }

        //Añade una nueva cita
        public function añadirCitas($animal,$fecha,$hora,$medico){
            if(count($this -> comprobarCitas($animal,$fecha,$hora,$medico))){
                return "Lo sentimos, ya tiene una cita";
            }else{
                $consulta = "INSERT INTO citas VALUES(null,'$fecha','$hora','$animal','$medico')";
                
                return $this -> con -> consultaSimple($consulta);
            }
        }

        //Modifica una cita
        public function modificarCitas($id,$animal,$fecha,$hora,$medico){
            $consulta = "UPDATE citas SET ID=$id, Fecha='$fecha', Hora='$hora', Animal='$animal', Medico='$medico' WHERE ID=$id";

            return $this -> con -> consultaSimple($consulta);
        }

        //Elimina una cita
        public function eliminarCitas($id){
            $consulta = "DELETE FROM citas WHERE ID=$id";

            return $this -> con -> consultaSimple($consulta);
        }

        //Comprueba si dicha cita existe
        public function comprobarCitas($animal,$fecha,$hora,$medico){
            $consulta = "SELECT ID FROM citas WHERE Fecha='$fecha' AND Hora='$hora' AND Animal='$animal' AND Medico='$medico'";
        
            $this -> con -> consultaDatos($consulta);

            return $this -> con -> filas;
        }

        //Devuelve el medico asignado 
        public function devolverMedicoAsignado($tarjeta){
            $consulta = "SELECT MedicoAsignado FROM animales WHERE Tarjeta='$tarjeta'";

            $this -> con -> consultaDatos($consulta);

            return $this -> con -> filas[0]['MedicoAsignado'];
        }

        /** MÁS FUNCIONALIDADES */

        //Devuelve el nombre completo de dicho animal
        public function devolverNombreAnimal($tarjeta){
            $consulta = "SELECT Tarjeta, Nombre FROM animales WHERE Tarjeta = '$tarjeta'";

            $this -> con -> consultaDatos($consulta);

            $nombre = "(".$this -> con -> filas[0]['Tarjeta'] . ") " . $this -> con -> filas[0]['Nombre'];
            
            return $nombre;
        }

        //Devuelve el nombre completo de dicho dueño/cliente
        public function devolverNombreDueño($DNI){
            $consulta = "SELECT Nombre, PrimerApellido, SegundoApellido FROM clientes WHERE DNI = '$DNI'";

            $this -> con -> consultaDatos($consulta);

            $nombre = $this -> con -> filas[0]['Nombre'] . " " . $this -> con -> filas[0]['PrimerApellido'] . " " . $this -> con -> filas[0]['SegundoApellido'];

            return $nombre;
        }

        //Devuelve el nombre completo de dicho medico
        public function devolverNombreMedico($DNI){
            $consulta = "SELECT Nombre, PrimerApellido, SegundoApellido FROM medicos WHERE DNI = '$DNI'";

            $this -> con -> consultaDatos($consulta);

            $nombre = $this -> con -> filas[0]['Nombre'] . " " . $this -> con -> filas[0]['PrimerApellido'] . " " . $this -> con -> filas[0]['SegundoApellido'];

            return $nombre;
        }

        public function mostrarCitaDeUnAnimal($tarjeta){
            $consulta = "SELECT * FROM citas WHERE Animal='$tarjeta'";

            $this -> con -> consultaDatos($consulta);

            return $this -> con -> filas;
        }
    }
?>