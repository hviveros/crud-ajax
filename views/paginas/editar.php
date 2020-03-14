<?php


    require_once 'controllers/ClienteController.php';
    $objeto = new ClienteController();

    /*obtener el valor 'id' de la url para buscar en la bd
    y posteriormente llenar el formulario*/

    
    // if (isset($_GET['id'])) {


	   //  $idCliente = $_GET['id'];
    // 	$cliente = $objeto->obtenerCliente($idCliente);

    // 	//echo json_encode($cliente);
    // }

    // if (isset($_POST['btnEditar'])) {
    	$id = $_POST['id'];
    	$datos = array(
			'nombre'   	=> $_POST['nombreU'],
			'email'    	=> $_POST['emailU'],
		);
		$objeto->editarCliente($id, $datos);
    // }


?>
	