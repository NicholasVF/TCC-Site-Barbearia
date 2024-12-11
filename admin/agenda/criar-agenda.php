<?php
include_once(__DIR__ . '/../../conexao.php');
session_start();
?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Adicionar Agendamento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php
    include('../navbar.php');
    ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Adicionar Agendamento
                            <a href="index-agenda.php" class="btn btn-danger float-end">Voltar</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="acoes-agenda.php" method="post">
                            <div class="mb-3">
                                <label>Usuario</label>
                                <select name="id_usuario" class="form-control" required>
                                    <option value="">Selecione um Usuario</option>
                                    <?php
                                    // Consulta para obter a lista de usuários
                                    $usuarios = mysqli_query($connection, 'SELECT * FROM login');
                                    while ($usuario = mysqli_fetch_assoc($usuarios)) {
                                        echo "<option value='{$usuario['id_login']}'>{$usuario['nome']}</option>";
                                    }
                                    ?>
                                </select>
                                <br>
                                <label>Funcionario</label>
                                <select name="id_funcionario" class="form-control" required>
                                    <option value="">Selecione um funcionário</option>
                                    <?php
                                    // Consulta para obter a lista de funcionários
                                    $funcionarios = mysqli_query($connection, 'SELECT * FROM funcionarios');
                                    while ($funcionario = mysqli_fetch_assoc($funcionarios)) {
                                        echo "<option value='{$funcionario['id_funcionario']}'>{$funcionario['nome']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Serviço</label>
                                <select name="id_servico" class="form-control" required>
                                    <option value="">Selecione um serviço</option>
                                    <?php
                                    // Consulta para obter a lista de serviços
                                    $servicos = mysqli_query($connection, 'SELECT * FROM servicos');
                                    while ($servico = mysqli_fetch_assoc($servicos)) {
                                        echo "<option value='{$servico['id_servico']}'>{$servico['servico']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Data e Hora</label>
                                <input type="datetime-local" name="data_hora_agendamento" class="form-control" required>
                       
                            <div class="mb-3">
                                <button type="submit" name="create_agendamento" class="btn btn-primary">Salvar</button>
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