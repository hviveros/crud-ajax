<?php
	
    require_once 'controllers/ClienteController.php';
    $objeto = new ClienteController();

	$id = $_POST['idD'];
	$objeto->eliminarCliente($id);

?>
	