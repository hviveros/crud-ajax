<?php

require_once './models/ClienteModel.php';

class ClienteController {

	#estableciendo las vistas
	public function inicio() {
        require_once('./views/includes/cabecera.php');
        require_once('./views/includes/navbar.php');
        require_once('./views/paginas/inicio.php');
        require_once('./views/includes/pie.php');
	}

	public function cargar() {
        require_once('./views/paginas/cargar.php');
	}

	public function insertar() {
        require_once('./views/paginas/insertar.php');
	}

	public function editar() {
        require_once('./views/paginas/editar.php');
	}

	public function eliminar() {
        require_once('./views/paginas/eliminar.php');
	}

	public function insertarCliente($datos) {

		//si es necesario, se compara el registro recibido
		//con los registros de la BD		
		$compararClientes = new ClienteModel();
		$compararClientes = $this->obtenerClientes();

		$error = 0;

		foreach ($compararClientes as $r) {
			//se compara el campo 'email' con todos los registros de la BD
			//si hay otro campo para comparar, ir adhiriendo "if"
		    if ($datos['email'] == $r['email']) {
				$error++;
				$respuesta['mensaje'] = "email ya registrado";
				$respuesta['codigo'] = 400;
	    		echo json_encode($respuesta, JSON_PRETTY_PRINT);
				die();
			}
	    }
		//si 'error' es 0, $datos cumple con todo
		//se procederá a Insertar a la BD
	    if ($error == 0) {
	    	$cliente = new ClienteModel();
			$cliente->insertarCliente($datos);
	    	$respuesta['mensaje'] = "Registro insertado correctamente";
			$respuesta['codigo'] = 200;
	    	echo json_encode($respuesta, JSON_PRETTY_PRINT);
	    }
	}

	public function editarCliente($id, $datos) {
		$cliente = new ClienteModel();		
		$cliente->editarCliente($id, $datos);
	}

	public function eliminarCliente($id) {
		$cliente = new ClienteModel();
		$cliente->eliminarCliente($id);
	}

	public function obtenerClientes() {
		$clientes = new ClienteModel();
		return $clientes->obtenerClientes();
	}

	public function obtenerCliente($id) {
		$cliente = new ClienteModel();
		return $cliente->obtenerCliente($id);
	}

}