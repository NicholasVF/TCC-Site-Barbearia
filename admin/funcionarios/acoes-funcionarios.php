<?php
session_start();
include_once(__DIR__ . '/../../conexao.php');

if (isset($_POST['criar_funcionario'])) {
    $nome = mysqli_real_escape_string($connection, trim($_POST['nome']));
    $email = mysqli_real_escape_string($connection, trim($_POST['email']));
    $id_servico = mysqli_real_escape_string($connection, trim($_POST['id_servico']));

    $sql = "INSERT INTO funcionarios (id_servico, nome, email) VALUES ('$id_servico', '$nome', '$email')";
    $result = mysqli_query($connection, $sql);

    if (mysqli_affected_rows($connection) > 0) {
        $_SESSION['mensagem'] = 'Funcionário criado com sucesso';
        header('Location: index-funcionarios.php');
        exit;
    } else {
        $_SESSION['mensagem'] = 'Funcionário não foi criado';
        header('Location: index-funcionarios.php');
        exit;
    }
}if (isset($_POST['update_funcionario'])) {
    $funcionario_id = mysqli_real_escape_string($connection, $_POST['funcionario_id']);
    $nome = mysqli_real_escape_string($connection, trim($_POST['nome']));
    $email = mysqli_real_escape_string($connection, trim($_POST['email']));
    $id_servico = mysqli_real_escape_string($connection, trim($_POST['id_servico']));

    // Construir a query de atualização
    $sql = "UPDATE funcionarios SET nome='$nome', email='$email', id_servico='$id_servico' WHERE id_funcionario='$funcionario_id'";

    // Executar a query de atualização
    $result = mysqli_query($connection, $sql);

    // Verificar se a atualização foi bem-sucedida
    if (mysqli_affected_rows($connection) > 0) {
        // Verificar se o funcionário foi realmente atualizado
        $sql_check = "SELECT * FROM funcionarios WHERE id_funcionario='$funcionario_id'";
        $result_check = mysqli_query($connection, $sql_check);

        // Se o funcionário existe, houve uma atualização real
        if (mysqli_num_rows($result_check) > 0) {
            $_SESSION['mensagem'] = 'Funcionário editado com sucesso';
        } else {
            // Se o funcionário não existe, então algo deu errado
            $_SESSION['mensagem'] = 'Funcionário não encontrado para editar';
        }
        header('Location: index-funcionarios.php');
        exit;
    } else {
        $_SESSION['mensagem'] = 'Nenhuma alteração detectada ou Funcionário não encontrado';
        header('Location: index-funcionarios.php');
        exit;
    }
}if (isset($_POST['delete_funcionario'])) {
    $funcionario_id = mysqli_real_escape_string($connection, $_POST['delete_funcionario']);
    
    // Construir a query de exclusão
    $sql = "DELETE FROM funcionarios WHERE id_funcionario = '$funcionario_id'";
   
    // Executar a query
    mysqli_query($connection, $sql);

    // Verificar se a exclusão foi bem-sucedida
    if (mysqli_affected_rows($connection) > 0) {
        $_SESSION['mensagem'] = "Funcionário deletado com sucesso";
        header('Location: index-funcionarios.php');
        exit;
    } else {
        $_SESSION['mensagem'] = "Funcionário não foi deletado";
        header('Location: index-funcionarios.php');
        exit;
    }
}

?>
