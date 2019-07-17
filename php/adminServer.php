<?php
    require_once('CRUD.php');

    $CRUD = new CRUD("u129628487_veter");
    $operacion = $_POST['operacion'];
    
    if($operacion == "Mostrar"){
        $resultado = $CRUD -> mostrarAdministradores();

        print_r(json_encode($resultado));
    }

    if($operacion == "Añadir"){
        $username = $_POST['username'];
        $pass = sha1($_POST['pass']);

        if($username == "" || $pass == ""){
            print_r("Los campos son obligatorios");
        }else{
            $resultado = $CRUD -> añadirAdministrador($username,$pass);

            print_r($resultado);
        }
    } 

    if($operacion == "Modificar"){
        $username = $_POST['username'];
        $pass = sha1($_POST['pass']);
        $buscar = $_POST['buscar'];

        if($username == "" || $pass == ""){
            print_r("Los campos son obligatorios");
        }else{
            $resultado = $CRUD -> modificarAdministrador($username,$pass,$buscar);

            print_r($resultado);
        }

        
    }

    if($operacion == "Eliminar"){
        $username = $_POST['username'];

        if($username == ""){
            print_r("El campo username no puede estar vacio");
        }else{
            $resultado = $CRUD -> eliminarAdministrador($username);

            print_r($resultado);
        }
        
    }

?>