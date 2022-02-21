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


	</head>
	<body>
		<div class="d-flex flex-column flex-md-row align-items-center p-2 px-md-4 mb-3 bg-white border-bottom shadow-sm justify-content-between">
            <h3 class="my-1 mr-md-auto font-weight-normal">Formulário Meridian</h5>
            <div class="p-2 m-2">
                <a class="p-2 btnMenuNav" href="index.php">Cadastro</a>
                <a class="p-2 btnMenuNav" href="consulta.php">Consulta</a>
            </div>
		</div>

        <?php
            include_once('bd/conexao.php');
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
            $_SESSION['id'] = $id;
            $query = $link->query("select * from clientes where id='$id'");
            
            while($registro = $query->fetch_assoc()){
                    $pessoa = $registro['pessoa'];
                    $nome = $registro['nome'];
                    $documento = $registro['documento'];
                    $email = $registro['email'];
                    $telefone = $registro['telefone'];
            }
        ?>
				
		<form class="form-cad cadastro"  id="form_clientes"  action="bd/editabd.php" method="post">
			<div class="text-center mb-4">
				<h1 class="h3 mb-3 font-weight-normal">Editar</h1>
			</div>
			<div class="text-left mb-4">

                <input type="text" id="id" value="<?php echo $id ?>" name="id" hidden> <br><br>

                <div class="divInput">
                    <label for="pessoa">Tipo pessoa: </label> 
                    <select class="form-control" id="pessoa" name="pessoa">
                        <option value="Fisica" <?=($pessoa == 'Fisica')?'selected':''?>>Fisica</option>
                        <option value="Juridica" <?=($pessoa == 'Juridica')?'selected':''?>>Juridica</option>
                    </select>
                </div>

                <div class="divInput">
                    <label for="nome" id="nomePessoa">Nome:</label> <br>
                    <input type="text" class="form-control" id="nome" value="<?php echo $nome ?>" name="nome" maxlength="40">
                </div>
            
                <div class="divInput">
                    <label for="documento" id="docPessoa">CPF:</label> <br>
                    <input type="text" class="form-control" id="documento" value="<?php echo $documento ?>" name="documento">
                </div>
			
                <div class="divInput">
                    <label for="email"> Email: </label><br>
                    <input type="text" class="form-control" id="email" value="<?php echo $email ?>" name="email" placeholder="nome@exemplo.com">
                </div>

                <div class="divInput">
                    <label for="telefone"> Telefone: </label><br>
                    <input type="text" class="form-control" id="telefone" value="<?php echo $telefone ?>"  name="telefone" placeholder="(00)00000-0000"
                    onkeypress="$(this).mask('(00) 00000-0000')">
                </div>


			</div>
			<input class="btn btn-primary" type="submit" value="Salvar">
		</form>	
		
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script> 
	</body>
</html>


