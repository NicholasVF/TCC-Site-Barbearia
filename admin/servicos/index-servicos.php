<?php
//inclusao feita desta maneira pois da maneira convencional estava dando erro
include_once(__DIR__ . '/../../conexao.php');
session_start();
?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Usuários</title>
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
    <?php include('../navbar.php'); ?>
    <div class="container mt-4">
        <?php include('../mensagem.php'); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Servicos
                            <a href="criar-servico.php" class="btn btn-warning btn-sm float-end">Adicionar Servico</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Servico</th>
                                    <th>Preço</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                
                                $sql = 'SELECT * FROM servicos';
                                $servicos = mysqli_query($connection, $sql);
                                if (mysqli_num_rows($servicos) > 0) {
                                    foreach ($servicos as $servico) {
                                ?>
                                        <tr>
                                            <td><?= $servico['id_servico'] ?></td>
                                            <td><?= $servico['servico'] ?></td>
                                            <td><?= $servico['preco'] ?></td>

                                            <td>
                                                <a href="servico-view.php?id=<?= urlencode($servico['id_servico']); ?>" class="btn btn-warning btn-sm">Visualizar</a>
                                                <a href="servico-edit.php?id=<?=urlencode($servico['id_servico']);?>" class="btn btn-warning btn-sm">Editar</a>
                                                <form action="acoes-servicos.php" method="post" class="d-inline">
                                                    <button onclick="return confirm('Tem certeza que deseja excluir?')" type="submit" name="delete_servico" value="<?=$servico['id_servico']?>" class="btn btn-danger btn-sm">
                                                        Excluir
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='5' class='text-center'>Nenhum servico encontrado</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>