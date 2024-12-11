<?php
session_start();
include_once(__DIR__ . '/../../conexao.php');
?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agendamentos - Editar</title>
    <!-- Link para o Bootstrap com o CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Link para fontes do Google -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        /* Definindo fontes e cores principais */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #007bff;
        }

        .navbar a {
            color: #ffffff;
        }

        .card {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .card-header {
            background-color: #007bff;
            color: #ffffff;
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            font-size: 1.5rem;
            padding: 20px;
            text-align: center;
        }

        .card-body {
            padding: 30px;
            background-color: #ffffff;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 12px;
            font-size: 1rem;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        label {
            font-weight: 500;
            font-size: 1.1rem;
            color: #333;
        }

        /* Botões com cores ajustadas */
        .btn-primary {
            background-color: #f57c00;
            /* Amarelo */
            border: none;
            font-weight: 600;
            font-size: 1.1rem;
            padding: 12px 30px;
            border-radius: 25px;
            box-shadow: 0 4px 6px rgba(255, 193, 7, 0.2);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #f57c00;
            /* Amarelo mais escuro */
            box-shadow: 0 6px 12px rgba(255, 193, 7, 0.3);
        }

        .btn-danger {
            background-color: #e53935;
            /* Vermelho */
            border: none;
            font-weight: 600;
            padding: 12px 30px;
            border-radius: 25px;
            box-shadow: 0 4px 6px rgba(227, 57, 53, 0.2);
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            background-color: #c82333;
            /* Vermelho mais escuro */
            box-shadow: 0 6px 12px rgba(227, 57, 53, 0.3);
        }

        /* Melhorando a responsividade */
        @media (max-width: 768px) {
            .card-body {
                padding: 20px;
            }

            .card-header {
                font-size: 1.3rem;
            }

            .btn-primary,
            .btn-danger {
                font-size: 1rem;
                padding: 10px 25px;
            }

            .form-control {
                font-size: 0.95rem;
                padding: 10px;
            }
        }
    </style>
</head>

<body>
    <!-- Inclusão do Navbar -->
    <?php include('../navbar.php'); ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <!-- Cartão para edição do agendamento -->
                <div class="card">
                    <div class="card-header">
                        Editar Agendamento
                        <a href="index-agenda.php" class="btn btn-danger float-end">Voltar</a>
                    </div>
                    <div class="card-body">
                        <?php
                        // Lógica para buscar o agendamento no banco
                        $agendamento = null;
                        if (isset($_GET['id_agenda'])) {
                            $agendamento_id = mysqli_real_escape_string($connection, $_GET['id_agenda']);
                            $sql = "SELECT a.*, f.nome AS funcionario_nome, s.servico AS servico_nome, l.nome AS usuario_nome 
                                    FROM agenda a 
                                    JOIN funcionarios f ON a.id_funcionario = f.id_funcionario 
                                    JOIN servicos s ON a.id_servico = s.id_servico 
                                    JOIN login l ON a.id_login = l.id_login 
                                    WHERE a.id_agenda='$agendamento_id'";
                            $query = mysqli_query($connection, $sql);

                            if (mysqli_num_rows($query) > 0) {
                                $agendamento = mysqli_fetch_array($query);
                            }
                        }

                        if ($agendamento) {
                        ?>
                            <!-- Formulário de edição do agendamento -->
                            <form action="acoes-agenda.php" method="post">
                                <input type="hidden" name="id_agenda" value="<?= htmlspecialchars($agendamento['id_agenda']) ?>">

                                <div class="mb-3">
                                    <label>Usuário</label>
                                    <select name="id_login" class="form-control" required>
                                        <?php
                                        $usuarios = mysqli_query($connection, 'SELECT * FROM login');
                                        while ($usuario = mysqli_fetch_assoc($usuarios)) {
                                            $selected = ($usuario['id_login'] == $agendamento['id_login']) ? 'selected' : '';
                                            echo "<option value='{$usuario['id_login']}' $selected>{$usuario['nome']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label>Funcionário</label>
                                    <select name="id_funcionario" class="form-control" required>
                                        <?php
                                        $funcionarios = mysqli_query($connection, 'SELECT * FROM funcionarios');
                                        while ($funcionario = mysqli_fetch_assoc($funcionarios)) {
                                            $selected = ($funcionario['id_funcionario'] == $agendamento['id_funcionario']) ? 'selected' : '';
                                            echo "<option value='{$funcionario['id_funcionario']}' $selected>{$funcionario['nome']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label>Serviço</label>
                                    <select name="id_servico" class="form-control" required>
                                        <?php
                                        $servicos = mysqli_query($connection, 'SELECT * FROM servicos');
                                        while ($servico = mysqli_fetch_assoc($servicos)) {
                                            $selected = ($servico['id_servico'] == $agendamento['id_servico']) ? 'selected' : '';
                                            echo "<option value='{$servico['id_servico']}' $selected>{$servico['servico']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label>Data e Hora</label>
                                    <input type="datetime-local" name="data_hora_agendamento" value="<?= date('Y-m-d\TH:i', strtotime($agendamento['data_hora_agendamento'])) ?>" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label>Status</label>
                                    <select name="status" class="form-control" required>
                                        <option value="pendente" <?= $agendamento['status'] == 'pendente' ? 'selected' : '' ?>>Pendente</option>
                                        <option value="não pendente" <?= $agendamento['status'] == 'não pendente' ? 'selected' : '' ?>>Não Pendente</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <button type="submit" name="update_agenda" class="btn btn-primary">Salvar Alterações</button>
                                </div>
                            </form>
                        <?php
                        } else {
                            echo "<h5>Agendamento não encontrado</h5>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="

</body>

</html>