<?php
session_start();
include_once(__DIR__ . '/../../conexao.php');

// método para criar um novo horário
if (isset($_POST['criar_horario'])) {
    $id_funcionario = mysqli_real_escape_string($connection, trim($_POST['id_funcionario']));
    $hora_inicio = mysqli_real_escape_string($connection, trim($_POST['hora_inicio']));
    $hora_fim = mysqli_real_escape_string($connection, trim($_POST['hora_fim']));
    $status = mysqli_real_escape_string($connection, trim($_POST['status']));

    $sql = "INSERT INTO horarios (id_funcionario, hora_inicio, hora_fim, status) VALUES ('$id_funcionario', '$hora_inicio', '$hora_fim', '$status')";
    $result = mysqli_query($connection, $sql);

    if (mysqli_affected_rows($connection) > 0) {
        $_SESSION['mensagem'] = 'Horário criado com sucesso';
        header('Location: index-horarios.php');
        exit;
    } else {
        $_SESSION['mensagem'] = 'Horário não foi criado';
        header('Location: index-horarios.php');
        exit;
    }
}

// método para editar o horário
if (isset($_POST['update_horario'])) {
    $horario_id = mysqli_real_escape_string($connection, $_POST['horario_id']);
    $id_funcionario = mysqli_real_escape_string($connection, trim($_POST['id_funcionario']));
    $hora_inicio = mysqli_real_escape_string($connection, trim($_POST['hora_inicio']));
    $hora_fim = mysqli_real_escape_string($connection, trim($_POST['hora_fim']));
    $status = mysqli_real_escape_string($connection, trim($_POST['status']));

    // Construir a query de atualização
    $sql = "UPDATE horarios SET id_funcionario='$id_funcionario', hora_inicio='$hora_inicio', hora_fim='$hora_fim', status='$status' WHERE id_horario='$horario_id'";

    // Executar a query de atualização
    $result = mysqli_query($connection, $sql);

    // Verificar se a atualização foi bem-sucedida
    if (mysqli_affected_rows($connection) > 0) {
        // Verificar se o horário foi realmente atualizado
        $sql_check = "SELECT * FROM horarios WHERE id_horario='$horario_id'";
        $result_check = mysqli_query($connection, $sql_check);

        // Se o horário existe, houve uma atualização real
        if (mysqli_num_rows($result_check) > 0) {
            $_SESSION['mensagem'] = 'Horário editado com sucesso';
        } else {
            // Se o horário não existe, então algo deu errado
            $_SESSION['mensagem'] = 'Horário não encontrado para editar';
        }
        header('Location: index-horarios.php');
        exit;
    } else {
        $_SESSION['mensagem'] = 'Nenhuma alteração detectada ou Horário não encontrado';
        header('Location: index-horarios.php');
        exit;
    }
}

// método para deletar o horário
if (isset($_POST['delete_horario'])) {
    $horario_id = mysqli_real_escape_string($connection, $_POST['delete_horario']);
    
    // Construir a query de exclusão
    $sql = "DELETE FROM horarios WHERE id_horario = '$horario_id'";
   
    // Executar a query
    mysqli_query($connection, $sql);

    // Verificar se a exclusão foi bem-sucedida
    if (mysqli_affected_rows($connection) > 0) {
        $_SESSION['mensagem'] = "Horário deletado com sucesso";
        header('Location: index-horarios.php');
        exit;
    } else {
        $_SESSION['mensagem'] = "Horário não foi deletado";
        header('Location: index-horarios.php');
        exit;
    }
}
?>
