<?php
session_start();
include_once(__DIR__ . '/../../conexao.php');

if (isset($_POST['criar_servico'])) {
    $servico = mysqli_real_escape_string($connection, trim($_POST['servico']));
    $preco = mysqli_real_escape_string($connection, trim($_POST['preco']));
   
    $sql = "INSERT INTO servicos (servico, preco) VALUES ('$servico', '$preco')";
    $result = mysqli_query($connection, $sql);
    if (mysqli_affected_rows($connection) > 0) {
        $_SESSION['mensagem'] = 'Servico criado com sucesso';
        header('Location: index-servicos.php');
        exit;
    } else {
        $_SESSION['mensagem'] = 'Serviço não foi criado';
        header('Location: index-servicos.php');
        exit;
    }
}if (isset($_POST['update_servico'])) {
    $servico_id = mysqli_real_escape_string($connection, $_POST['servico_id']);
    $servico = mysqli_real_escape_string($connection, trim($_POST['servico']));
    $preco = mysqli_real_escape_string($connection, trim($_POST['preco']));


    // Construir a query de atualização
    $sql = "UPDATE servicos SET servico='$servico', preco='$preco'";

    $sql .= " WHERE id_servico='$servico_id'";

    // Executar a query de atualização
    $result = mysqli_query($connection, $sql);

    // Verificar se a atualização foi bem-sucedida
    if (mysqli_affected_rows($connection) > 0) {
        // Verificar se o usuário foi realmente atualizado
        $sql_check = "SELECT * FROM servicos WHERE id_servico='$servico_id'";
        $result_check = mysqli_query($connection, $sql_check);

        // Se o usuário existe, houve uma atualização real
        if (mysqli_num_rows($result_check) > 0) {
            $_SESSION['mensagem'] = 'Serviço editado com sucesso';
        } else {
            // Se o usuário não existe, então algo deu errado
            $_SESSION['mensagem'] = 'Serviço não foi encontrado para editar';
        }
        header('Location: index-servicos.php');
        exit;
    } else {
        $_SESSION['mensagem'] = 'Nenhuma alteração detectada ou Serviço não encontrado';
        header('Location: index-servicos.php');
        exit;
    }
}
if(isset($_POST['delete_servico'])){
    $servico_id = mysqli_real_escape_string($connection,$_POST['delete_servico']);
    
    $sql = "DELETE FROM servicos WHERE id_servico = '$servico_id'";
   
    mysqli_query($connection,$sql);

    if(mysqli_affected_rows($connection)>0){
        $_SESSION['mensagem'] = "Serviço deletado com sucesso";
        header('Location: index-servicos.php');
        exit;
    }else{
        $_SESSION['mensagem'] = "Serviçp não foi deletado ";
        header('Location: index-servicos.php');
        exit;
    }
    
}
?>