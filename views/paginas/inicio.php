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
			
			<div id="tablaCliente"></div>

			<div class="text-left">
				<button class="btn btn-primary text-left" data-toggle="modal" data-target="#insertarRegistroModal">Insertar</button>
			</div>
		</div>

	</main><!-- /.container -->


<!-- Modal Agregar -->
<div class="modal fade" id="insertarRegistroModal" tabindex="-1" role="dialog" aria-labelledby="insetarRegistroModal" aria-hidden="true">
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
						<label for="nombre">Nombre</label>
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
					$('#tablaCliente').load();
					alert("Agregado Ok!");
					// if (r==1) {
					// } else {
					// 	alert(r);
					// }
				}
			});

		});
		
		$('#tablaCliente').load('tabla.php');

	});
</script>