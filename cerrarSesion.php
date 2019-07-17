<?php
    session_start();

    if(isset($_GET['url'])){
        unset($_SESSION['usuario']);
        header ('Location: '.$_GET['url']);
    }else{
        unset($_SESSION['usuario']);
        header ('Location: index.html');
    }    
?>