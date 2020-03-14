<?php

    require_once './controllers/ClienteController.php';
    $objeto = new ClienteController();
    $clientes = $objeto->obtenerClientes();

?>

	<main role="main" class="container">

		<div class="starter-template">
			<h1>CRUD sencillo con PHP + AJAX</h1>
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
			<hr>
			
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
								<button class="btn btn-info" data-toggle="modal" data-target="#editarRegistroModal" onclick="cargarFormEditar(<?= $r['id']; ?>)">Editar</button>
								<button href="?page=eliminar&id=<?= $r['id']; ?>" class="btn btn-danger">Eliminar</button>
							</td>
						</tr>
						<?php } } ?>
					</tbody>
				</table>
			</div>

			<div class="text-left">
				<button class="btn btn-primary text-left" data-toggle="modal" data-target="#insertarRegistroModal">Insertar</button>
			</div>
		</div>

	</main><!-- /.container -->


<!-- Modal Agregar -->
<div class="modal fade" id="insertarRegistroModal" tabindex="-1" role="dialog" aria-labelledby="insertarRegistroModal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="insetarRegistroModal">Insertar nuevos registros</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="POST" name="registroForm" id="registroForm" class="text-left">
				<div class="modal-body">
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
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="editarForm" class="text-left">
				<div class="modal-body">
					<input type="hidden" id="id" name="id">
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
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					<button type="button" id="btnEditar" name="btnEditar" class="btn btn-info">Editar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#btnInsertar').click(function(){
			datos=$('#registroForm').serialize();

			$.ajax({
				type: "POST",
				data: datos,
				//prestar atención a "url"
				url:  "index.php?page=insertar",
				success: function(r){
					$('#registroForm')[0].reset();
					$('#tablaCliente').load(' #tablaCliente');
					//alert("Agregado Ok!");
					// if (r==1) {
					// } else {
					// 	alert(r);
					// }
				}
			});

		});

		$('#btnEditar').click(function(){
			
			datos=$('#editarForm').serialize();

			$.ajax({
				type: "POST",
				data: datos,
				url:  "index.php?page=editar",
				success: function(r){
					//console.log(datos);
					$('#tablaCliente').load(' #tablaCliente');
					// if (r==1) {
					// 	alert("Editado Ok!");
					// } else {
					// 	alert("Fallo al editar");
					// }
				}
			});
		});
		
		$('#tablaCliente').load(' #tablaCliente');

	});

	function cargarFormEditar(id){
		//alert(id);
		$.ajax({
			method: "POST",
			data: "id=" + id,
			url: "views/paginas/cargar.php",
			success: function(r){
				//console.log(r);
				//if (r==1) {
				//alert("Funciona hasta aqui");
				datos=jQuery.parseJSON(r);
				$('#id').val(datos['id']);
				$('#nombreU').val(datos['nombre']);
				$('#emailU').val(datos['email']);
				//} else {
				//alert("Fallo al editar");
				//}
			}
		});
	}

</script>