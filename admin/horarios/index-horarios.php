<?php
include_once(__DIR__ . '/../../conexao.php');
session_start();
?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Horários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        /* Fontes e cores principais */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
        }

        .navbar {
            background-color: #007bff;
        }

        .navbar a {
            color: #ffffff;
        }

        /* Cartões */
        .card-header {
            background-color: #007bff;
            color: #ffffff;
            font-family: 'Montserrat', sans-serif;
            font-size: 1.6rem;
            font-weight: 600;
            padding: 20px 30px;
        }

        .card-body {
            padding: 30px;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        /* Botões */
        .btn-primary {
            background-color: #ffc107;;
            border-color: #ffc107;
            font-size: 1.1rem;
            font-weight: 600;
            padding: 12px 30px;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover,
        .btn-primary:focus {
            background-color: #e0a800;
            border-color: #d39e00;
            transform: translateY(-2px);
        }

        .btn-danger {
            background-color: #dc3545;
            font-size: 1.1rem;
            font-weight: 600;
            padding: 12px 30px;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .btn-danger:hover,
        .btn-danger:focus {
            background-color: #ffc107;;
            transform: translateY(-2px);
        }

        /* Tabela */
        .table {
            margin-top: 20px;
            border-collapse: collapse;
            border: 1px solid #ddd;
        }

        .table th,
        .table td {
            padding: 15px;
            text-align: center;
            font-size: 1rem;
            vertical-align: middle;
        }

        .table th {
            background-color: #007bff;
            color: #fff;
            font-weight: 600;
        }

        .table-striped tbody tr:nth-child(odd) {
            background-color: #f8f9fa;
        }

        .table-striped tbody tr:nth-child(even) {
            background-color: #ffffff;
        }

        .table tbody tr:hover {
            background-color: #e2e6ea;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .card-header {
                font-size: 1.4rem;
            }

            .table th,
            .table td {
                font-size: 0.9rem;
                padding: 8px;
            }

            .btn-primary,
            .btn-danger {
                font-size: 1rem;
                padding: 8px 20px;
            }

            .card-body {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <?php include('../navbar.php'); ?>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <!-- Cartão de horários -->
                <div class="card shadow-lg">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Horários</h4>
                        <a href="criar-horario.php" class="btn btn-warning btn-sm">Adicionar Horário</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nome do Funcionário</th>
                                    <th>Hora Início</th>
                                    <th>Hora Fim</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = '
                                    SELECT h.id_horario, f.nome, h.hora_inicio, h.hora_fim, h.status
                                    FROM horarios h
                                    JOIN funcionarios f ON h.id_funcionario = f.id_funcionario
                                ';
                                $horarios = mysqli_query($connection, $sql);
                                if (mysqli_num_rows($horarios) > 0) {
                                    foreach ($horarios as $horario) {
                                ?>
                                        <tr>
                                            <td><?= htmlspecialchars($horario['nome']) ?></td>
                                            <td><?= htmlspecialchars($horario['hora_inicio']) ?></td>
                                            <td><?= htmlspecialchars($horario['hora_fim']) ?></td>
                                            <td><?= htmlspecialchars($horario['status']) ?></td>
                                            <td>
                                                <a href="horario-view.php?id=<?= urlencode($horario['id_horario']); ?>" class="btn btn-warning btn-sm">Visualizar</a>
                                                <a href="horario-edit.php?id=<?= urlencode($horario['id_horario']); ?>" class="btn btn-warning btn-sm">Editar</a>
                                                <form action="acoes-horarios.php" method="post" class="d-inline">
                                                    <button onclick="return confirm('Tem certeza que deseja excluir?')" type="submit" name="delete_horario" value="<?= $horario['id_horario'] ?>" class="btn btn-danger btn-sm">
                                                        Excluir
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='5' class='text-center'>Nenhum horário encontrado</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
