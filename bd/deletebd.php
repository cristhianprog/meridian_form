<?php
    session_start();
    include_once 'conexao.php';

    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    
    $queryDelete = $link->query("delete from clientes  where id='$id'");
    $affected_rows = mysqli_affected_rows($link);

    if(mysqli_affected_rows($link) > 0){
        echo json_encode('Excluido com sucesso!');
    }else{
        echo json_encode('Erro ao excluir!');

    }


?>