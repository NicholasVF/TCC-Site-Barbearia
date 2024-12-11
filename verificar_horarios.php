<?php
include_once("conexao.php");

// Recebe os parâmetros via GET
if (isset($_GET['funcionario']) && isset($_GET['data'])) {
    $id_funcionario = $_GET['funcionario'];
    $data = $_GET['data'];

    // Consulta os agendamentos para o funcionário e data
    $query = "
        SELECT TIME(data_hora_agendamento) AS hora_agendada 
        FROM agenda 
        WHERE id_funcionario = '$id_funcionario' AND DATE(data_hora_agendamento) = '$data'
    ";
    $result = mysqli_query($connection, $query);

    // Cria um array para armazenar os horários agendados
    $horarios_agendados = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $horarios_agendados[] = $row['hora_agendada'];
    }

    // Retorna os horários agendados como um JSON
    echo json_encode($horarios_agendados);
} else {
    echo json_encode([]);
}
?>
