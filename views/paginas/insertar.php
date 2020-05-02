<?php 

	require_once 'controllers/ClienteController.php';

	$objeto = new ClienteController();

	$datos = array(
		'nombre'   => $_POST['nombre'], //htmlentities, limites caracteres y toda la seguridad...
		'email'    => $_POST['email'],
	);

	
	//validaciones: campo vacio, tipo de dato, comparacion con otros campos del formulario...
	if (empty($datos['nombre'])) {
		$respuesta['mensaje'] = "No puede insertar con campos vacíos";
		$respuesta['codigo'] = 400;
		echo json_encode($respuesta);
	} else if (is_numeric($datos['nombre'])) {
		$respuesta['mensaje'] = "No puede ingresar números";
		$respuesta['codigo'] = 400;
		echo json_encode($respuesta);
	} else {
		//aqui debe ir el array completamente depurado, validado
		//sin caracteres raros, campos numericos o emails validados, longitud correcta etc...
		$objeto->insertarCliente($datos);
	}


?>