<?php
include_once(__DIR__ . '/../../conexao.php');
?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Adicionar Funcionário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
            /* Branco claro para o fundo da página */
        }

        .navbar {
            background-color: #343a40;
            /* Preto para a navbar */
        }

        .navbar a {
            color: #ffffff;
            /* Branco para links da navbar */
        }

        .card-header {
            background-color: #007bff;
            /* Azul para o cabeçalho do card */
            color: #ffffff;
            /* Branco para o texto do cabeçalho */
        }

        .card-body {
            background-color: #ffffff;
            /* Branco para o fundo do corpo do card */
        }

        .btn-primary {
            background-color: #007bff;
            /* Azul para o botão primário */
            border-color: #007bff;
            /* Azul para a borda do botão primário */
        }

        .btn-primary:hover {
            background-color: #0056b3;
            /* Azul mais escuro para hover */
            border-color: #004085;
            /* Azul mais escuro para a borda do hover */
        }

        .btn-secondary {
            background-color: #6c757d;
            /* Cinza escuro para o botão secundário */
            border-color: #6c757d;
            /* Cinza escuro para a borda do botão secundário */
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            /* Cinza mais escuro para hover */
            border-color: #545b62;
            /* Cinza mais escuro para a borda do hover */
        }

        .btn-success {
            background-color: #28a745;
            /* Verde para o botão de sucesso (editar) */
            border-color: #28a745;
            /* Verde para a borda do botão de sucesso */
        }

        .btn-success:hover {
            background-color: #218838;
            /* Verde mais escuro para hover */
            border-color: #1e7e34;
            /* Verde mais escuro para a borda do hover */
        }

        .btn-danger {
            background-color: #dc3545;
            /* Vermelho para o botão de excluir */
            border-color: #dc3545;
            /* Vermelho para a borda do botão de excluir */
        }

        .btn-danger:hover {
            background-color: #c82333;
            /* Vermelho mais escuro para hover */
            border-color: #bd2130;
            /* Vermelho mais escuro para a borda do hover */
        }
    </style>
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
                            Adicionar Funcionário
                            <a href="index-funcionarios.php" class="btn btn-danger float-end">Voltar</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="acoes-funcionarios.php" method="post">
                            <div class="mb-3">
                                <label>Nome</label>
                                <input type="text" name="nome" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Serviço</label>
                                <select name="id_servico" class="form-control" required>
                                    <option value="">Selecione um serviço</option>
                                    <?php
                                    // Consulta para obter serviços
                                    $servicos = mysqli_query($connection, "SELECT * FROM servicos");
                                    while ($servico = mysqli_fetch_assoc($servicos)) {
                                        echo "<option value='{$servico['id_servico']}'>{$servico['servico']} - R$ {$servico['preco']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="criar_funcionario" class="btn btn-primary">Salvar</button>
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
