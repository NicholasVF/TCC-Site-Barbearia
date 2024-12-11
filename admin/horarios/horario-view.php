<?php
include_once(__DIR__ . '/../../conexao.php');
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Horário - Visualizar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <?php include('../navbar.php'); ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Visualizar Horário
                            <a href="index-horarios.php" class="btn btn-danger float-end">Voltar</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_GET['id'])) {
                            $horario_id = mysqli_real_escape_string($connection, $_GET['id']);
                            $sql = "
                                SELECT h.id_horario, h.hora_inicio, h.hora_fim, h.status, f.nome AS funcionario
                                FROM horarios h
                                JOIN funcionarios f ON h.id_funcionario = f.id_funcionario
                                WHERE h.id_horario='$horario_id'
                            ";
                            $query = mysqli_query($connection, $sql);

                            // Verificar se houve erro na consulta
                            if (!$query) {
                                die('Erro na consulta: ' . mysqli_error($connection));
                            }

                            if (mysqli_num_rows($query) > 0) {
                                $horario = mysqli_fetch_array($query);
                                ?>
                        <div class="mb-3">
                            <label>ID</label>
                            <p class="form-control">
                                <?= $horario['id_horario']; ?>
                            </p>
                        </div>
                        <div class="mb-3">
                            <label>Funcionário</label>
                            <p class="form-control">
                                <?= $horario['funcionario']; ?>
                            </p>
                        </div>
                        <div class="mb-3">
                            <label>Hora Início</label>
                            <p class="form-control">
                                <?= $horario['hora_inicio']; ?>
                            </p>
                        </div>
                        <div class="mb-3">
                            <label>Hora Fim</label>
                            <p class="form-control">
                                <?= $horario['hora_fim']; ?>
                            </p>
                        </div>
                        <div class="mb-3">
                            <label>Status</label>
                            <p class="form-control">
                                <?= $horario['status']; ?>
                            </p>
                        </div>
                        <?php
                            } else {
                                echo "<h5>Horário não encontrado</h5>";
                            }
                        } else {
                            echo "<h5>ID do horário não fornecido</h5>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
