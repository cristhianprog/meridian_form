<?php
	include_once('conexao.php');

    $query = $link->query("select * from clientes");

    while($registros = $query->fetch_assoc()) :
        $id = $registros['id'];
        $pessoa = $registros['pessoa'];
        $nome = $registros['nome'];
        $documento = $registros['documento'];
        $email = $registros['email'];
        $telefone = $registros['telefone'];

        
        echo "<tr>";
		echo "
		<td>$id</td>
		<td>$pessoa</td>
		<td>$nome</td>
		<td>$documento</td>
		<td>$email</td>
		<td>$telefone</td>
		<td><a href='edita.php?id=$id' class='btn btn-primary' >Editar</td>
		<td><a id='".$id."' class='btn btn-danger btnExcluir'>Excluir</td>";
		echo "</tr>";
	
	endwhile;


?>