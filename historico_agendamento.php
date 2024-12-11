<?php
session_start();
include_once("conexao.php");

// Verifica se o usuário está logado
if (!isset($_SESSION['id_login'])) {
    header('Location: login.php');
    exit;
}

// Obtém o ID do usuário logado
$id_login = $_SESSION['id_login'];

// Data atual
$data_atual = date('Y-m-d');

// Verifica se o pedido de cancelamento foi feito
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancelar_agendamento'])) {
    $id_agendamento = intval($_POST['cancelar_agendamento']);
    
    // Exclui o agendamento
    $cancelarQuery = "DELETE FROM agenda WHERE id_agenda = '$id_agendamento' AND id_login = '$id_login'";
    if (mysqli_query($connection, $cancelarQuery)) {
        $message = "Agendamento cancelado com sucesso.";
    } else {
        $message = "Erro ao cancelar agendamento: " . mysqli_error($connection);
    }
}

// Consulta para agendamentos futuros
$futurosQuery = "SELECT a.*, f.nome AS nome_funcionario, s.servico AS nome_servico 
                 FROM agenda a
                 JOIN funcionarios f ON a.id_funcionario = f.id_funcionario
                 JOIN servicos s ON a.id_servico = s.id_servico
                 WHERE a.id_login = '$id_login' AND DATE(a.data_hora_agendamento) >= '$data_atual'
                 ORDER BY a.data_hora_agendamento ASC";
$futurosResult = mysqli_query($connection, $futurosQuery);

// Consulta para agendamentos passados
$passadosQuery = "SELECT a.*, f.nome AS nome_funcionario, s.servico AS nome_servico 
                  FROM agenda a
                  JOIN funcionarios f ON a.id_funcionario = f.id_funcionario
                  JOIN servicos s ON a.id_servico = s.id_servico
                  WHERE a.id_login = '$id_login' AND DATE(a.data_hora_agendamento) < '$data_atual'
                  ORDER BY a.data_hora_agendamento DESC";
$passadosResult = mysqli_query($connection, $passadosQuery);

// Função para categorizar semanas passadas
function categorizarSemana($data_agendamento) {
    $data_atual = new DateTime();
    $data_agendamento = new DateTime($data_agendamento);
    $diferenca_semanas = (int) $data_agendamento->diff($data_atual)->days / 7;

    if ($diferenca_semanas < 1) {
        return "Esta semana";
    } elseif ($diferenca_semanas < 2) {
        return "Semana passada";
    } elseif ($diferenca_semanas < 3) {
        return "Duas semanas atrás";
    } else {
        return "Mais de duas semanas atrás";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico de Agendamentos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: black;
            margin: 0;
            padding: 0;
            color: white;
        }

        .container {
            margin: 20px auto;
            max-width: 800px;
            background: black;
            padding: 20px;
            border-radius: 10px;
            border: 2px solid yellow;
        }

        h1, h2 {
            color: white;
            text-align: center;
            margin-bottom: 20px;
        }

        .category {
            font-weight: bold;
            font-size: 18px;
            margin-top: 20px;
            color: white;
        }

        .agendamento {
            border: 2px #ffd700;
            background: black;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 4px;
            color: white;
            position: relative;
        }

        .agendamento strong {
            color: #ffd700;
        }

        .btn-cancelar {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #ff4444;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-cancelar:hover {
            background-color: #cc0000;
        }

        .no-agendamento {
            text-align: center;
            color: white;
            font-style: italic;
        }

        .btn-voltar {
            display: inline-flex;
            align-items: center;
            border: 2px solid yellow;
            color: #ffd700;
            padding: 10px 20px;
            border-radius: 30px;
            font-weight: bold;
            font-size: 1rem;
            text-decoration: none;
            margin-top: 20px;
            background: black;
            transition: all 0.3s ease;
        }

        .btn-voltar:hover {
            background: #ffd700;
            color: black;
            text-decoration: none;
        }

        .btn-voltar i {
            margin-right: 8px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Histórico de Agendamentos</h1>

        <?php if (isset($message)): ?>
            <div class="alert <?= strpos($message, 'sucesso') !== false ? 'alert-success' : 'alert-danger'; ?>" role="alert">
                <?= $message; ?>
            </div>
        <?php endif; ?>

        <!-- Agendamentos Futuros -->
        <h2>Agendamentos Futuros</h2>
        <?php if (mysqli_num_rows($futurosResult) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($futurosResult)): ?>
                <div class="agendamento">
                    <strong>Data:</strong> <?= date('d/m/Y H:i', strtotime($row['data_hora_agendamento'])) ?><br>
                    <strong>Funcionário:</strong> <?= $row['nome_funcionario'] ?><br>
                    <strong>Serviço:</strong> <?= $row['nome_servico'] ?>
                    <form method="POST" style="display: inline;">
                        <input type="hidden" name="cancelar_agendamento" value="<?= $row['id_agenda']; ?>">
                        <button type="submit" class="btn-cancelar">Cancelar</button>
                    </form>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="no-agendamento">Não há agendamentos futuros.</p>
        <?php endif; ?>

        <!-- Agendamentos Passados -->
        <h2>Agendamentos Passados</h2>
        <?php if (mysqli_num_rows($passadosResult) > 0): ?>
            <?php
            $semanas = [];
            while ($row = mysqli_fetch_assoc($passadosResult)) {
                $categoria = categorizarSemana($row['data_hora_agendamento']);
                $semanas[$categoria][] = $row;
            }
            ?>
            <?php foreach ($semanas as $categoria => $agendamentos): ?>
                <div class="category"><?= $categoria ?></div>
                <?php foreach ($agendamentos as $row): ?>
                    <div class="agendamento">
                        <strong>Data:</strong> <?= date('d/m/Y H:i', strtotime($row['data_hora_agendamento'])) ?><br>
                        <strong>Funcionário:</strong> <?= $row['nome_funcionario'] ?><br>
                        <strong>Serviço:</strong> <?= $row['nome_servico'] ?>
                    </div>
                <?php endforeach; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="no-agendamento">Não há agendamentos passados.</p>
        <?php endif; ?>

        <!-- Botão de Voltar -->
        <a href="index.php" class="btn-voltar">
            <i class="bi bi-arrow-left-circle"></i> Voltar
        </a>
    </div>
</body>

</html>
