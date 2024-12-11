<?php
include_once(__DIR__ . '/../../conexao.php');
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Funcionário - Visualizar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <?php include('../navbar.php'); ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Visualizar Funcionário
                            <a href="index-funcionarios.php" class="btn btn-danger float-end">Voltar</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_GET['id'])) {
                            $funcionario_id = mysqli_real_escape_string($connection, $_GET['id']);
                            $sql = "
                                SELECT f.id_funcionario, f.nome, f.email, s.servico
                                FROM funcionarios f
                                JOIN servicos s ON f.id_servico = s.id_servico
                                WHERE f.id_funcionario='$funcionario_id'
                            ";
                            $query = mysqli_query($connection, $sql);

                            // Verificar se houve erro na consulta
                            if (!$query) {
                                die('Erro na consulta: ' . mysqli_error($connection));
                            }

                            if (mysqli_num_rows($query) > 0) {
                                $funcionario = mysqli_fetch_array($query);
                        ?>
                        <div class="mb-3">
                            <label>ID</label>
                            <p class="form-control">
                                <?= $funcionario['id_funcionario']; ?>
                            </p>
                        </div>
                        <div class="mb-3">
                            <label>Nome</label>
                            <p class="form-control">
                                <?= $funcionario['nome']; ?>
                            </p>
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <p class="form-control">
                                <?= $funcionario['email']; ?>
                            </p>
                        </div>
                        <div class="mb-3">
                            <label>Serviço</label>
                            <p class="form-control">
                                <?= $funcionario['servico']; ?>
                            </p>
                        </div>
                        <?php
                            } else {
                                echo "<h5>Funcionário não encontrado</h5>";
                            }
                        } else {
                            echo "<h5>ID do funcionário não fornecido</h5>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
