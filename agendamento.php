<?php
session_start();
include_once("conexao.php");

// Verifica se o usuário está logado
if (!isset($_SESSION['id_login'])) {
    header('Location: login.php');
    exit;
}

// Inicializa variáveis
$agendamentoRealizado = false;

// Obtém o ID do usuário logado
$id_login = $_SESSION['id_login'];

// Consulta de serviços
$servicosQuery = "SELECT id_servico, servico FROM servicos";
$servicosResult = mysqli_query($connection, $servicosQuery);

// Consulta de funcionários com horários de trabalho
$funcionariosQuery = "
    SELECT f.id_funcionario, f.nome, h.hora_inicio, h.hora_fim
    FROM funcionarios f
    JOIN horarios h ON f.id_funcionario = h.id_funcionario
    WHERE h.status = 'disponível'
    GROUP BY f.id_funcionario
";

$funcionariosResult = mysqli_query($connection, $funcionariosQuery);

// Se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_funcionario = $_POST['funcionario'];
    $id_servico = $_POST['service'];
    $data = $_POST['date'];
    $hora = $_POST['time'];  // Recebe o horário selecionado via dropdown

    $data_hora_agendamento = $data . ' ' . $hora;

    // Obtém a data e hora atuais
    $data_hora_atual = date('Y-m-d H:i');

    // Verifica se a data e hora do agendamento são futuras
    if ($data_hora_agendamento < $data_hora_atual) {
        echo "<p class='text-danger'>Erro: Você não pode agendar uma data/hora que já passou.</p>";
    } else {
        $insertQuery = "INSERT INTO agenda (
        id_funcionario, id_login, id_servico, data_hora_agendamento, status) 
                        VALUES ('$id_funcionario', '$id_login', '$id_servico', '$data_hora_agendamento', 'pendente')";

        if (mysqli_query($connection, $insertQuery)) {
            $agendamentoRealizado = true;
            header("Location: historico_agendamento.php");
            exit;
        } else {
            echo "<p class='text-danger'>Erro ao agendar: " . mysqli_error($connection) . "</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar Corte - Barbearia Oliveira</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilos globais */
        body {
            background: linear-gradient(135deg, #1a1a1a, #444);
            color: #fff;
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* Container do agendamento */
        .agendamento-container {
            max-width: 600px;
            width: 100%;
            background: rgba(0, 0, 0, 0.85);
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.5);
            padding: 3rem 2rem;
            animation: fadeIn 1s ease-out;
        }

        /* Animação de entrada */
        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(-50px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Título */
        .agendamento-title {
            font-size: 3rem;
            font-weight: 700;
            color: #ffd700;
            text-align: center;
            margin-bottom: 1rem;
            text-transform: uppercase;
        }

        /* Subtítulo */
        .agendamento-subtitle {
            font-size: 1.2rem;
            color: #bbb;
            text-align: center;
            margin-bottom: 2rem;
        }

        /* Estilo do formulário */
        .form-label {
            font-size: 1.1rem;
            font-weight: 600;
            color: #ffd700;
        }

        .form-control {
            background-color: #222;
            border: 1px solid #555;
            color: #ffd700;
            font-size: 1rem;
            border-radius: 8px;
            padding: 0.75rem;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            border-color: #ffd700;
            box-shadow: 0 0 10px rgba(255, 215, 0, 0.4);
        }

        .form-select {
            background-color: #222;
            border: 1px solid #555;
            color: #ffd700;
            font-size: 1rem;
            border-radius: 8px;
            padding: 0.75rem;
            transition: border-color 0.3s ease;
        }

        .form-select:focus {
            border-color: #ffd700;
            box-shadow: 0 0 10px rgba(255, 215, 0, 0.4);
        }

        .mb-3 {
            margin-bottom: 1.5rem;
        }

        /* Botão de agendamento */
        .btn-primary {
            background-color: #ffd700;
            color: #000;
            font-weight: 600;
            text-transform: uppercase;
            padding: 1rem 2rem;
            border-radius: 25px;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-primary:hover {
            background-color: #e5c100;
            box-shadow: 0 4px 10px rgba(255, 215, 0, 0.2);
        }

        /* Botão de voltar */
        .btn-back {
            background-color: #444;
            color: #ffd700;
            font-weight: 600;
            padding: 1rem 2rem;
            border-radius: 25px;
            text-align: center;
            width: 100%;
            transition: all 0.3s ease;
            text-transform: uppercase;
            margin-top: 1rem;
        }

        .btn-back:hover {
            background-color: #333;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        /* Link para agendamentos passados */
        .schedule-link {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 1rem;
        }

        .schedule-link a {
            color: #ffd700;
            text-decoration: none;
            font-weight: 600;
        }

        .schedule-link a:hover {
            text-decoration: underline;
        }

        /* Responsividade */
        @media (max-width: 576px) {
            .agendamento-container {
                padding: 2rem;
            }

            .agendamento-title {
                font-size: 2rem;
            }
        }
    </style>
</head>

<body>
    <div class="agendamento-container">
        <h1 class="agendamento-title">Agendar Corte</h1>
        <p class="agendamento-subtitle">Escolha um funcionário, serviço, data e hora.</p>

        <form method="POST" action="">
            <div class="mb-3">
                <label for="funcionario" class="form-label">Funcionário:</label>
                <select class="form-select" name="funcionario" id="funcionario" required>
                    <option value="">Selecione um funcionário</option>
                    <?php while ($row = mysqli_fetch_assoc($funcionariosResult)): ?>
                        <option value="<?= $row['id_funcionario'] ?>" data-start="<?= $row['hora_inicio'] ?>" data-end="<?= $row['hora_fim'] ?>"><?= $row['nome'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="service" class="form-label">Serviço:</label>
                <select class="form-select" name="service" id="service" required>
                    <option value="">Selecione um serviço</option>
                    <?php while ($row = mysqli_fetch_assoc($servicosResult)): ?>
                        <option value="<?= $row['id_servico'] ?>"><?= $row['servico'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="date" class="form-label">Data:</label>
                <input type="date" class="form-control" name="date" id="date" required min="<?= date('Y-m-d') ?>">
            </div>

            <div class="mb-3">
                <label for="time" class="form-label">Hora:</label>
                <select class="form-select" name="time" id="time" required>
                    <option value="">Selecione o horário</option>
                    <!-- Horários serão inseridos aqui via JS -->
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Agendar</button>
        </form>

        <div class="schedule-link">
            <p><a href="historico_agendamento.php">Ver histórico de agendamentos</a></p>
        </div>
    </div>

    <script>
        document.getElementById('funcionario').addEventListener('change', function () {
            const selectedFuncionario = this.options[this.selectedIndex];
            const startHora = selectedFuncionario.getAttribute('data-start');
            const endHora = selectedFuncionario.getAttribute('data-end');
            const timeSelect = document.getElementById('time');

            // Limpa as opções anteriores
            timeSelect.innerHTML = '<option value="">Selecione o horário</option>';

            // Formata as horas para o formato de 20 em 20 minutos
            let start = new Date('1970-01-01T' + startHora + 'Z');
            let end = new Date('1970-01-01T' + endHora + 'Z');

            while (start <= end) {
                const option = document.createElement('option');
                const hour = start.getUTCHours().toString().padStart(2, '0');
                const minutes = start.getUTCMinutes().toString().padStart(2, '0');
                const timeStr = `${hour}:${minutes}`;
                option.value = timeStr;
                option.textContent = timeStr;
                timeSelect.appendChild(option);
                start.setMinutes(start.getMinutes() + 20); // Incrementa 20 minutos
            }
        });
    </script>

</body>

</html>
