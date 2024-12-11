<?php
session_start();
include_once(__DIR__ . '/../../conexao.php');
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Horários - Editar</title>
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
                            Editar Horário
                            <a href="index-horarios.php" class="btn btn-danger float-end">Voltar</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php
                        $horario = null; // Inicializa a variável $horario

                        if (isset($_GET['id'])) {
                            $horario_id = mysqli_real_escape_string($connection, $_GET['id']);
                            $sql = "SELECT * FROM horarios WHERE id_horario='$horario_id'";
                            $query = mysqli_query($connection, $sql);

                            if (mysqli_num_rows($query) > 0) {
                                $horario = mysqli_fetch_array($query);
                            }
                        }

                        if ($horario) {
                        ?>
                        <form action="acoes-horarios.php" method="post">
                            <input type="hidden" name="horario_id" value="<?= htmlspecialchars($horario['id_horario']) ?>">
                            <div class="mb-3">
                                <label>Funcionário</label>
                                <select name="id_funcionario" class="form-control">
                                    <?php
                                    $funcionarios_sql = "SELECT * FROM funcionarios";
                                    $funcionarios_query = mysqli_query($connection, $funcionarios_sql);
                                    while ($funcionario = mysqli_fetch_assoc($funcionarios_query)) {
                                        $selected = ($funcionario['id_funcionario'] == $horario['id_funcionario']) ? 'selected' : '';
                                        echo "<option value=\"{$funcionario['id_funcionario']}\" $selected>{$funcionario['nome']}</option>";
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
                                            $selected = ($hora == $horario['hora_inicio']) ? 'selected' : '';
                                            echo "<option value='{$hora}' {$selected}>{$hora}</option>";
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
                                            $selected = ($hora == $horario['hora_fim']) ? 'selected' : '';
                                            echo "<option value='{$hora}' {$selected}>{$hora}</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="disponível" <?= $horario['status'] == 'disponível' ? 'selected' : '' ?>>Disponível</option>
                                    <option value="indisponível" <?= $horario['status'] == 'indisponível' ? 'selected' : '' ?>>Indisponível</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="update_horario" class="btn btn-primary">Salvar</button>
                            </div>
                        </form>
                        <?php
                        } else {
                            echo "<h5>Horário não encontrado</h5>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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
</body>
</html>
