<?php
include_once(__DIR__ . '/../../conexao.php');
session_start();
?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agendamentos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        /* Font e cores base */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f7f8fb;
            margin: 0;
            padding: 0;
            color: #333;
        }

        /* Navbar */
        .navbar {
            background-color: #007bff;
            padding: 12px 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar a {
            color: #fff;
            font-size: 1.2rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .navbar a:hover {
            color: #ffe600;
            text-decoration: none;
        }

        /* Cartões e Títulos */
        .card-header {
            background-color: #007bff;
            color: #fff;
            font-family: 'Montserrat', sans-serif;
            font-size: 1.8rem;
            font-weight: 600;
            padding: 25px 30px;
            border-radius: 8px 8px 0 0;
            transition: transform 0.3s ease;
        }

        .card-header:hover {
            transform: translateY(-5px);
        }

        .card-body {
            padding: 30px;
            background-color: #fff;
            border-radius: 0 0 8px 8px;
        }

        /* Botões */
        .btn-primary,
        .btn-warning,
        .btn-danger {
            font-size: 1.1rem;
            font-weight: 600;
            padding: 12px 25px;
            border-radius: 30px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 123, 255, 0.3);
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover,
        .btn-primary:focus {
            background-color: #0069d9;
            border-color: #0056b3;
            transform: translateY(-2px);
        }

        .btn-warning {
            background-color: #ff9800;
            border-color: #ff9800;
        }

        .btn-warning:hover,
        .btn-warning:focus {
            background-color: #f57c00;
            border-color: #f57c00;
        }

        .btn-danger {
            background-color: #e53935;
            border-color: #e53935;
        }

        .btn-danger:hover,
        .btn-danger:focus {
            background-color: #d32f2f;
            border-color: #d32f2f;
        }

        .btn-sm {
            font-size: 0.9rem;
            padding: 8px 20px;
        }

        .btn-icon {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-icon i {
            margin-right: 8px;
        }

        /* Tabela */
        .table {
            margin-top: 20px;
            border-collapse: collapse;
            width: 100%;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .table th,
        .table td {
            padding: 15px;
            text-align: center;
            font-size: 1rem;
            vertical-align: middle;
            border-top: 1px solid #ddd;
        }

        .table th {
            background-color: #007bff;
            color: #fff;
            font-weight: 600;
        }

        .table-striped tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        .table-striped tbody tr:nth-child(even) {
            background-color: #ffffff;
        }

        .table tbody tr:hover {
            background-color: #f0f4f7;
            transition: background-color 0.3s ease;
        }

        /* Status com cores diferenciadas */
        .badge {
            font-size: 0.9rem;
            font-weight: 500;
            padding: 6px 12px;
            border-radius: 20px;
        }

        .badge-success {
            background-color: #28a745;
            color: white;
        }

        .badge-warning {
            background-color: #ffc107;
            color: white;
        }

        .badge-info {
            background-color: #17a2b8;
            color: white;
        }

        /* Mensagens */
        .alert {
            font-weight: 500;
            background: #28a745;
            color: white;
            border-radius: 10px;
            padding: 12px 18px;
            margin-bottom: 20px;
            animation: fadeIn 1s ease-in-out;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .alert .bi-check-circle-fill {
            font-size: 1.5rem;
            margin-right: 10px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        /* Tabela com Paginação */
        .pagination {
            justify-content: center;
            margin-top: 20px;
        }

        .pagination .page-item a {
            color: #007bff;
        }

        .pagination .page-item.active a {
            background-color: #007bff;
            color: #fff;
        }

        .pagination .page-item:hover a {
            background-color: #0069d9;
            color: #fff;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .card-header {
                font-size: 1.5rem;
                padding: 15px 20px;
            }

            .table th,
            .table td {
                font-size: 0.9rem;
                padding: 8px;
            }

            .btn-primary,
            .btn-secondary,
            .btn-danger,
            .btn-warning {
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
        <?php include('../mensagem.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <!-- Cartão de Agendamentos -->
                <div class="card shadow-lg">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Lista de Agendamentos</h4>
                        <a href="criar-agenda.php" class="btn btn-warning btn-icon">
                            <i class="bi bi-plus-circle"></i> Adicionar Agendamento
                        </a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Funcionário</th>
                                    <th>Usuário</th>
                                    <th>Serviço</th>
                                    <th>Data e Hora</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Consultar agendamentos
                                $sql = 'SELECT a.id_agenda, f.nome as funcionario, l.nome as usuario, s.servico, a.data_hora_agendamento, a.status
                                        FROM agenda a
                                        JOIN funcionarios f ON a.id_funcionario = f.id_funcionario
                                        JOIN login l ON a.id_login = l.id_login
                                        JOIN servicos s ON a.id_servico = s.id_servico';
                                $agendamentos = mysqli_query($connection, $sql);
                                if (mysqli_num_rows($agendamentos) > 0) {
                                    foreach ($agendamentos as $agendamento) {
                                ?>
                                        <tr>
                                            <td><?= $agendamento['id_agenda'] ?></td>
                                            <td><?= $agendamento['funcionario'] ?></td>
                                            <td><?= $agendamento['usuario'] ?></td>
                                            <td><?= $agendamento['servico'] ?></td>
                                            <td><?= $agendamento['data_hora_agendamento'] ?></td>
                                            <td>
                                                <?php
                                                // Status com cores diferenciadas
                                                if ($agendamento['status'] == 'pendente') {
                                                    echo '<span class="badge badge-warning">pendente</span>';
                                                } else {
                                                    echo '<span class="badge badge-success">realizado</span>';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <a href="view-agenda.php?id_agenda=<?= urlencode($agendamento['id_agenda']); ?>" class="btn btn-warning btn-sm">Visualizar</a>
                                                <a href="editar-agenda.php?id_agenda=<?= urlencode($agendamento['id_agenda']); ?>" class="btn btn-warning btn-sm">Editar</a>
                                                <form action="acoes-agenda.php" method="post" class="d-inline">
                                                    <button onclick="return confirm('Tem certeza que deseja excluir?')" type="submit" name="delete_agenda" value="<?= $agendamento['id_agenda'] ?>" class="btn btn-danger btn-sm">
                                                        <i class="bi bi-trash"></i> Excluir
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='7' class='text-center'>Nenhum agendamento encontrado</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>

                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>