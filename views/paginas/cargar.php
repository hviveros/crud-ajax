<?php

	class conectar {
		public function conexion(){
			$conexion = mysqli_connect('localhost', 'root', '', 'crudajax');
			$conexion->set_charset('utf8');
			return $conexion;
		}
	}

	class crud{
		public function obtenDatos($id){
			$obj = new conectar();
			$conexion = $obj->conexion();
			$sql = "SELECT id, nombre, email FROM cliente WHERE id = $id";
			$result = mysqli_query($conexion, $sql);
			$ver = mysqli_fetch_row($result);
			$datos = array(
				'id'		=> $ver[0],
				'nombre'	=> $ver[1],
				'email'		=> $ver[2]
			);
			return $datos;
		}
	}
    
	$obj2 = new crud();

	echo json_encode($obj2->obtenDatos($_POST['id']));

?>
	