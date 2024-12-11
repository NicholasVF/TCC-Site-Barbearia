<?php
session_start();
include_once(__DIR__ . '/../../conexao.php');
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Funcionários - Editar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <?php include('../navbar.php'); ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Editar Funcionário
                            <a href="index-funcionarios.php" class="btn btn-danger float-end">Voltar</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php
                        $funcionario = null; // Inicializa a variável $funcionario

                        if (isset($_GET['id'])) {
                            $funcionario_id = mysqli_real_escape_string($connection, $_GET['id']);
                            $sql = "SELECT * FROM funcionarios WHERE id_funcionario='$funcionario_id'";
                            $query = mysqli_query($connection, $sql);

                            if (mysqli_num_rows($query) > 0) {
                                $funcionario = mysqli_fetch_array($query);
                            }
                        }

                        if ($funcionario) {
                        ?>
                        <form action="acoes-funcionarios.php" method="post">
                            <input type="hidden" name="funcionario_id" value="<?= htmlspecialchars($funcionario['id_funcionario']) ?>">
                            <div class="mb-3">
                                <label>Nome</label>
                                <input type="text" name="nome" value="<?= htmlspecialchars($funcionario['nome']) ?>" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" name="email" value="<?= htmlspecialchars($funcionario['email']) ?>" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Serviço</label>
                                <select name="id_servico" class="form-control">
                                    <?php
                                    $servicos_sql = "SELECT * FROM servicos";
                                    $servicos_query = mysqli_query($connection, $servicos_sql);
                                    while ($servico = mysqli_fetch_assoc($servicos_query)) {
                                        $selected = ($servico['id_servico'] == $funcionario['id_servico']) ? 'selected' : '';
                                        echo "<option value=\"{$servico['id_servico']}\" $selected>{$servico['servico']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="update_funcionario" class="btn btn-primary">Salvar</button>
                            </div>
                        </form>
                        <?php
                        } else {
                            echo "<h5>Funcionário não encontrado</h5>";
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
