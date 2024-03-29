<?php

    require_once './controllers/ClienteController.php';
    $objeto = new ClienteController();
    $clientes = $objeto->obtenerClientes();

?>

	<main role="main" class="container">
		<div class="row py-5 my-5">
			<div class="col-12">
				<div class="starter-template">
					<h1>CRUD MVC con PHP + AJAX</h1>
					<div class="row">
						<div class="col-md-6 offset-3">
							<?php
								if (isset($_GET['mensaje'])) {
									echo "<div class='alert alert-primary alert-dismissible fade show' role='alert'>
											".$_GET['mensaje']."
											<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
												<span aria-hidden='true'>&times;</span>
											</button>
										</div>";
								}
							?>
						</div>
					</div>
					
					<!-- tabla de registros -->
					<div id="tablaCliente">
						<table class="table table-bordered">
							<thead class="thead-dark">
								<tr>
									<th scope="col">#id</th>
									<th scope="col">nombre</th>
									<th scope="col">e-mail</th>
									<th scope="col">acciones</th>
								</tr>
							</thead>
							<tbody>
								<?php
									if (!empty($clientes)) {
										foreach ($clientes as $r) { 
								?>
								<tr>
									<th scope="row"><?=$r['id'];?></th>
									<td><?=$r['nombre'];?></td>
									<td><?=$r['email'];?></td>
									<td>
										<button data-bs-toggle="modal" data-bs-target="#editarRegistroModal" onclick="cargarFormUpdate(<?= $r['id']; ?>)" class="btn btn-info">Editar</button>
										<button data-bs-toggle="modal" data-bs-target="#eliminarRegistroModal" onclick="cargarFormDelete(<?= $r['id']; ?>)" class="btn btn-danger">Eliminar</button>
									</td>
								</tr>
								<?php } } ?>
							</tbody>
						</table>
					</div>

					<div class="text-left">				
						<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insertarRegistroModal">
						Insertar
						</button>
					</div>
				</div>
			</div>
		</div>
	</main><!-- /.container -->


<!-- Modal Agregar -->
<div class="modal fade" id="insertarRegistroModal" tabindex="-1" aria-labelledby="insertarRegistroModal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="insetarRegistroModal">Insertar nuevos registros</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="POST" name="registroForm" id="registroForm" class="text-left">
				<div class="modal-body">
					<div id="mensajeInsertar"></div>
					<div class="form-group">
						<label for="nombreU">Nombre</label>
						<input type="text" id="nombre" name="nombre" class="form-control" aria-describedby="nombreHelp">
						<small id="nombreHelp" class="form-text text-muted">Ingrese el nombre completo del cliente.</small>
					</div>
					<div class="form-group">
						<label for="email">E-mail</label>
						<input type="email" id="email" name="email" class="form-control" aria-describedby="emailHelp">
						<small id="emailHelp" class="form-text text-muted">Ingrese el correo electronico del cliente.</small>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
					<button type="button" id="btnInsertar" name="btnInsertar" class="btn btn-primary">Insertar</button>
				</div>
			</form>
		</div>
	</div>
</div>


<!-- Modal Editar -->
<div class="modal fade" id="editarRegistroModal" tabindex="-1" role="dialog" aria-labelledby="editarRegistroModal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="editarRegistroModal">Editar registro</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form id="editarForm" class="text-left">
				<div class="modal-body">
					<input type="hidden" id="idU" name="idU">
					<div class="form-group">
						<label for="nombreU">Nombre</label>
						<input type="text" id="nombreU" name="nombreU" class="form-control" aria-describedby="nombreHelp">
						<small id="nombreHelp" class="form-text text-muted">Ingrese el nombre completo del cliente.</small>
					</div>
					<div class="form-group">
						<label for="emailU">E-mail</label>
						<input type="email" id="emailU" name="emailU" class="form-control" aria-describedby="emailHelp">
						<small id="emailHelp" class="form-text text-muted">Ingrese el correo electronico del cliente.</small>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
					<button type="button" id="btnEditar" name="btnEditar" class="btn btn-info">Editar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Modal Eliminar -->
<div class="modal fade" id="eliminarRegistroModal" tabindex="-1" role="dialog" aria-labelledby="eliminarRegistroModal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="eliminarRegistroModal">Eliminar registro</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form id="eliminarForm" class="text-left">
				<div class="modal-body">
					<input type="hidden" id="idD" name="idD">
					<div class="form-group">
						<label for="nombreD">Nombre</label>
						<input type="text" id="nombreD" name="nombreD" class="form-control" aria-describedby="nombreHelp" disabled>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
					<button type="button" id="btnEliminar" name="btnEliminar" class="btn btn-danger" data-bs-dismiss="modal">Eliminar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){

		//botón Insertar 
		$('#btnInsertar').click(function(){
			
			datos=$('#registroForm').serialize();

			$.ajax({
				type: "POST",
				data: datos,
				url:  "index.php?page=insertar",
				success: function(r){
					//console.log(r);
					respuesta=jQuery.parseJSON(r);
					if (respuesta['codigo'] == 400) {
						$('#mensajeInsertar').html('<div class="alert alert-danger text-center" role="alert">'+respuesta['mensaje']+'</div>');
					} else{
						$('#mensajeInsertar').html('<div class="alert alert-success text-center" role="alert">'+respuesta['mensaje']+'</div>');
						$('#registroForm')[0].reset();
						$('#tablaCliente').load(' #tablaCliente');
					}
				}
			});

		});

		//botón Editar 
		$('#btnEditar').click(function(){
			
			datos=$('#editarForm').serialize();

			$.ajax({
				type: "POST",
				data: datos,
				url:  "index.php?page=editar",
				success: function(r){
					$('#tablaCliente').load(' #tablaCliente');
				}
			});
		});

		//botón Eliminar 
		$('#btnEliminar').click(function(){

			datos=$('#eliminarForm').serialize();

			$.ajax({
				type: "POST",
				data: datos,
				url:  "index.php?page=eliminar",
				success: function(r){
					$('#tablaCliente').load(' #tablaCliente');
				}
			});
		});
		
		//carga de tabla
		$('#tablaCliente').load(' #tablaCliente');

	});

	function cargarFormUpdate(id){
		$.ajax({
			method: "POST",
			data: "id=" + id,
			url:  "index.php?page=cargar",
			success: function(r){
				//console.log(r);
				datos=jQuery.parseJSON(r);
				$('#idU').val(datos['id']);
				$('#nombreU').val(datos['nombre']);
				$('#emailU').val(datos['email']);
			}
		});
	}

	function cargarFormDelete(id){
		$.ajax({
			method: "POST",
			data: "id=" + id,
			url:  "index.php?page=cargar",
			success: function(r){
				datos=jQuery.parseJSON(r);
				$('#idD').val(datos['id']);
				$('#nombreD').val(datos['nombre']);
			}
		});
	}

</script>