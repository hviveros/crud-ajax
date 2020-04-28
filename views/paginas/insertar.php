<?php 

	require_once 'controllers/ClienteController.php';

	$objeto = new ClienteController();

	$datos = array(
		'nombre'   => $_POST['nombre'], //htmlentities y toda la seguridad
		'email'    => $_POST['email'],
	);

	//metodo obtenerClientes() si email coincide, respuesta[codigo] = 0

	if ($datos['nombre'] == 'Arya Stark') {
		$respuesta['mensaje'] = "Registro ya existente";
		$respuesta['codigo'] = 0;
		echo json_encode($respuesta);
	} else {
		$respuesta['mensaje'] = "Registro insertado";
		$respuesta['codigo'] = 1;
		//aqui debe ir el array completamente depurado, verificado
		$objeto->insertarCliente($datos);
		echo json_encode($respuesta);
	}


?>