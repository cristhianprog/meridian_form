<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Formulário Ajax</title>

		<link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.css">
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/cssStyle.css" rel="stylesheet">
        <script src="js/jquery-3.5.1.min.js"></script>
		<script src="js/scripts.js"></script>
		<script src="js/jquery.maskedinput-1.1.4.pack.js" type="text/javascript"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>


	</head>
	<body>
		<div class="d-flex flex-column flex-md-row align-items-center p-2 px-md-4 mb-3 bg-white border-bottom shadow-sm justify-content-between">
            <h3 class="my-1 mr-md-auto font-weight-normal">Formulário Meridian</h5>
			<a class="p-2 m-2 btnMenuNav" href="index.php">Cadastro</a>
		</div>
				
		<form class="form-cad consulta"  id="form_consulta" action="" method="post" enctype="multipart/form-data">
			<div class="text-center mb-4">
				<h1 class="h3 mb-3 font-weight-normal">Consultar</h1>
			</div>
			
			<table class="table">
				<thead class="thead-dark head-table">
					<tr>
						<th>Id</th>
						<th>Pessoa</th>
						<th>Nome</th>
						<th>Documento</th>
						<th>Email</th>
						<th>Telefone</th>
                        <th></th>
                        <th></th>
					</tr>
				</thead>
				<tbody>
					<?php
						include_once 'bd/consultabd.php';
					?>
				</tbody>
			</table>

		</form>
		
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script> 

		<!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/> -->
	 	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->
		<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
	</body>
</html>
