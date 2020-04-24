<?php

    require_once 'controllers/ClienteController.php';

    $objeto = new ClienteController();
    $id = $_POST['idU'];
    $datos = array(
       'nombre'   	=> $_POST['nombreU'],
       'email'    	=> $_POST['emailU'],
    );
    
    $objeto->editarCliente($id, $datos);


?>
