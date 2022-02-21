<?php
    header('Content-Type: application/json');

    // Se não postar nada
    if ( ! isset( $_POST ) || empty( $_POST ) ) {
        
        // Mensagem para o usuário
        echo 'Nada a publicar!';
        
        exit;
    }

    // Verifica campos em branco
    foreach ( $_POST as $chave => $valor ) {
        // Cria as variáveis dinamicamente
        $$chave = $valor;
        
        // Verifica campos em branco
        if ( empty( $valor ) ) {
            // Mensagem para o usuário
            echo 'Existem campos em branco.';
            
            // Mata o script
            exit;
        }
    }

    // Verifica se todas as variáveis estão definidas
    if (  
        ! isset( $pessoa )  
        || ! isset( $nome ) 
        || ! isset( $documento )
        || ! isset( $email )
        || ! isset( $telefone )
    ) {
        // Mensagem para o usuário
        echo 'Existem variáveis não definidas.';

        // Mata o script
        exit;
    }

    //valida o telefone
    if(strlen($nome) < 3 ){
        // Mensagem para o usuário
        echo 'Preencha corretamente o Nome.';

        // Mata o script
        exit;
    }

    //validao documento
    if($pessoa == 'Fisica' && strlen($documento) < 14 ){
        // Mensagem para o usuário
        echo 'Preencha corretamente o CPF.';

        // Mata o script
        exit;
    }else if ($pessoa == 'Juridica' && strlen($documento) < 18 ){
         // Mensagem para o usuário
         echo 'Preencha corretamente o CNPJ.';

         // Mata o script
         exit;
    }

    //valida o telefone
    if(strlen($telefone) < 14 ){
        // Mensagem para o usuário
        echo 'Preencha corretamente o Telefone.';

        // Mata o script
        exit;
    }

    $pessoa     = $_POST['pessoa'];
    $nome       = $_POST['nome'];
    $documento  = $_POST['documento'];
    $email      = $_POST['email'];
    $telefone   = $_POST['telefone'];
    $socio   = $_POST['socio'];

    include_once('conexao.php');

    $query = $link->query("select email from clientes");

    while($registro = $query->fetch_assoc()) :
       
        if( $registro['email']  === $email ){
            echo json_encode('email cadastrado'); 
            exit;       
        }

	endwhile;



    $pdo = new PDO('mysql:host=localhost; dbname=formulariodb;', 'root', '');

    $queryInsert = $pdo->prepare('INSERT INTO clientes (pessoa, nome, documento, email, telefone, socio) VALUES (:pe, :no, :do, :em, :te, :so)');
    $queryInsert->bindValue(':no', $nome);
    $queryInsert->bindValue(':pe', $pessoa);
    $queryInsert->bindValue(':do', $documento);
    $queryInsert->bindValue(':em', $email);
    $queryInsert->bindValue(':te', $telefone);
    $queryInsert->bindValue(':so', $socio);
    $queryInsert->execute();

    if ($queryInsert->rowCount() >= 1) {
        echo json_encode('salvo');
    } else {
        echo json_encode('Falha ao salvar dados');
    }