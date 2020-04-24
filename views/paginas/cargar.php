<?php

	require_once 'controllers/ClienteController.php';
    $objeto = new ClienteController();

    $id = $_POST['id'];
    $cliente = $objeto->obtenerCliente($id);

    foreach ($cliente as $r) {
	    $datos = array(
	    	'id' 	=> $r['id'],
	    	'nombre'=> $r['nombre'],
	    	'email' => $r['email']
	    );
    }

	echo json_encode($datos);
?>
	