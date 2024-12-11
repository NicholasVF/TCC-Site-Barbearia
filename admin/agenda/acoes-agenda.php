<?php
session_start();
include_once(__DIR__ . '/../../conexao.php');

// Criar Agendamento
if (isset($_POST['create_agendamento'])) {
    // Pegue o ID do usuário selecionado no formulário
    $id_usuario = mysqli_real_escape_string($connection, $_POST['id_usuario']);
    $id_funcionario = mysqli_real_escape_string($connection, $_POST['id_funcionario']);
    $id_servico = mysqli_real_escape_string($connection, $_POST['id_servico']);
    $data_hora_agendamento = mysqli_real_escape_string($connection, $_POST['data_hora_agendamento']);

    // Certifique-se de que o $id_usuario está sendo usado corretamente no INSERT
    $sql = "INSERT INTO agenda (id_login, id_funcionario, id_servico, data_hora_agendamento)
            VALUES ('$id_usuario', '$id_funcionario', '$id_servico', '$data_hora_agendamento')";

    if (mysqli_query($connection, $sql)) {
        $_SESSION['mensagem'] = 'Agendamento criado com sucesso';
    } else {
        $_SESSION['mensagem'] = 'Erro ao criar agendamento: ' . mysqli_error($connection);
    }

    header('Location: index-agenda.php');
    exit;
}

// Editar Agendamento
if (isset($_POST['update_agenda'])) {
    $agenda_id = mysqli_real_escape_string($connection, $_POST['id_agenda']);
    $id_funcionario = mysqli_real_escape_string($connection, $_POST['id_funcionario']);
    $id_servico = mysqli_real_escape_string($connection, $_POST['id_servico']);
    $data_hora_agendamento = mysqli_real_escape_string($connection, $_POST['data_hora_agendamento']);
    $id_login = mysqli_real_escape_string($connection, $_POST['id_login']);
    $status = mysqli_real_escape_string($connection, $_POST['status']);

    $sql = "UPDATE agenda SET id_funcionario='$id_funcionario', id_servico='$id_servico', data_hora_agendamento='$data_hora_agendamento', id_login='$id_login', status='$status' WHERE id_agenda='$agenda_id'";

    if (mysqli_query($connection, $sql)) {
        $_SESSION['mensagem'] = 'Agendamento atualizado com sucesso';
    } else {
        $_SESSION['mensagem'] = 'Erro ao atualizar agendamento: ' . mysqli_error($connection);
    }
    header('Location: index-agenda.php');
    exit;
}


// Excluir Agendamento
if (isset($_POST['delete_agenda'])) {
    $agenda_id = mysqli_real_escape_string($connection, $_POST['delete_agenda']);

    $sql = "DELETE FROM agenda WHERE id_agenda='$agenda_id'";
    if (mysqli_query($connection, $sql)) {
        $_SESSION['mensagem'] = 'Agendamento excluído com sucesso';
    } else {
        $_SESSION['mensagem'] = 'Erro ao excluir agendamento: ' . mysqli_error($connection);
    }
    header('Location: index-agenda.php');
    exit;
}
?>
