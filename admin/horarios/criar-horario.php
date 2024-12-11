<?php
session_start();
include_once(__DIR__ . '/../../conexao.php');

// Verifica se há mensagens de erro ou sucesso
$mensagem = '';
if (isset($_SESSION['mensagem'])) {
    $mensagem = $_SESSION['mensagem'];
    unset($_SESSION['mensagem']);
}
?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Adicionar Horário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #343a40;
        }

        .navbar a {
            color: #ffffff;
        }

        .card-header {
            background-color: #007bff;
            color: #ffffff;
        }

        .card-body {
            background-color: #ffffff;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
    </style>
</head>

<body>
    <?php include('../navbar.php'); ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Adicionar Horário
                            <a href="index-horarios.php" class="btn btn-danger float-end">Voltar</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <!-- Exibir mensagem de sucesso ou erro -->
                        <?php if ($mensagem): ?>
                            <div class="alert alert-info"><?= htmlspecialchars($mensagem) ?></div>
                        <?php endif; ?>

                        <form action="acoes-horarios.php" method="post">
                            <div class="mb-3">
                                <label>Funcionário</label>
                                <select name="id_funcionario" class="form-control" required>
                                    <option value="">Selecione um funcionário</option>
                                    <?php
                                    $funcionarios = mysqli_query($connection, "SELECT * FROM funcionarios");
                                    while ($funcionario = mysqli_fetch_assoc($funcionarios)) {
                                        echo "<option value='{$funcionario['id_funcionario']}'>" . htmlspecialchars($funcionario['nome']) . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Hora Início</label>
                                <select name="hora_inicio" class="form-control" id="hora_inicio" required>
                                    <?php
                                    for ($h = 0; $h < 24; $h++) {
                                        for ($m = 0; $m < 60; $m += 15) {
                                            $hora = sprintf('%02d:%02d', $h, $m);
                                            echo "<option value='{$hora}'>{$hora}</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Hora Fim</label>
                                <select name="hora_fim" class="form-control" id="hora_fim" required>
                                    <?php
                                    for ($h = 0; $h < 24; $h++) {
                                        for ($m = 0; $m < 60; $m += 15) {
                                            $hora = sprintf('%02d:%02d', $h, $m);
                                            echo "<option value='{$hora}'>{$hora}</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <script>
                                document.getElementById('hora_inicio').addEventListener('change', function() {
                                    const horaInicio = this.value;
                                    const horaFimSelect = document.getElementById('hora_fim');
                                    const options = horaFimSelect.options;

                                    // Remover opções que são menores que a hora de início
                                    for (let i = 0; i < options.length; i++) {
                                        const optionValue = options[i].value;
                                        if (optionValue < horaInicio) {
                                            options[i].style.display = 'none';
                                        } else {
                                            options[i].style.display = 'block';
                                        }
                                    }
                                });
                            </script>
                            <div class="mb-3">
                                <label>Status</label>
                                <select name="status" class="form-control" required>
                                    <option value="disponivel">Disponível</option>
                                    <option value="indisponivel">Indisponível</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="criar_horario" class="btn btn-primary">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
