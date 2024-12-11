<?php
include_once(__DIR__ . '/../../conexao.php');
?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agendamento - Visualizar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        /* Estilos principais */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f7f7f7;
            margin: 0;
        }

        .navbar {
            background-color: #007bff;
        }

        .navbar a {
            color: #ffffff;
        }

        .card-header {
            background-color: #007bff;
            color: #ffffff;
            font-family: 'Montserrat', sans-serif;
            font-size: 1.6rem;
            font-weight: 600;
            padding: 20px 30px;
        }

        .card-body {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .form-control-plaintext {
            font-size: 1.1rem;
            color: #333;
            font-weight: 500;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            font-size: 1.1rem;
            font-weight: 600;
            padding: 10px 25px;
            border-radius: 25px;
            box-shadow: 0 4px 6px rgba(0, 123, 255, 0.3);
            transition: all 0.3s ease;
        }

        .btn-primary:hover,
        .btn-primary:focus {
            background-color: #0056b3;
            border-color: #004085;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 123, 255, 0.4);
        }

        .btn-danger {
            background-color: #dc3545;
            font-size: 1.1rem;
            font-weight: 600;
            padding: 10px 25px;
            border-radius: 25px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(220, 53, 69, 0.3);
        }

        .btn-danger:hover,
        .btn-danger:focus {
            background-color: #c82333;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(220, 53, 69, 0.4);
        }

        .badge {
            font-size: 1rem;
            font-weight: 500;
            padding: 8px 15px;
            border-radius: 30px;
        }

        .badge-success {
            background-color: #28a745;
            color: white;
        }

        .badge-warning {
            background-color: #ffc107;
            color: white;
        }

        .badge-danger {
            background-color: #dc3545;
            color: white;
        }

        .alert {
            font-weight: 500;
            background: #28a745;
            color: white;
            border-radius: 10px;
            padding: 10px 15px;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .card-header {
                font-size: 1.4rem;
            }

            .form-control-plaintext {
                font-size: 1rem;
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

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-lg">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Visualizar Agendamento</h4>
                        <a href="index-agenda.php" class="btn btn-danger">
                            <i class="bi bi-arrow-left-circle"></i> Voltar
                        </a>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_GET['id_agenda'])) {
                            $agenda_id = mysqli_real_escape_string($connection, $_GET['id_agenda']);
                            $sql = "SELECT a.*, 
                                           f.nome AS funcionario_nome, 
                                           s.servico AS servico_nome, 
                                           l.nome AS usuario_nome 
                                    FROM agenda a 
                                    JOIN funcionarios f ON a.id_funcionario = f.id_funcionario 
                                    JOIN servicos s ON a.id_servico = s.id_servico 
                                    JOIN login l ON a.id_login = l.id_login 
                                    WHERE a.id_agenda='$agenda_id'";
                            $query = mysqli_query($connection, $sql);

                            if (mysqli_num_rows($query) > 0) {
                                $agendamento = mysqli_fetch_array($query);
                        ?>
                                <div class="mb-3">
                                    <label><strong>Funcionário</strong></label>
                                    <p class="form-control-plaintext"><?= htmlspecialchars($agendamento['funcionario_nome']); ?></p>
                                </div>
                                <div class="mb-3">
                                    <label><strong>Serviço</strong></label>
                                    <p class="form-control-plaintext"><?= htmlspecialchars($agendamento['servico_nome']); ?></p>
                                </div>
                                <div class="mb-3">
                                    <label><strong>Data e Hora</strong></label>
                                    <p class="form-control-plaintext"><?= date('d/m/Y H:i', strtotime($agendamento['data_hora_agendamento'])); ?></p>
                                </div>
                                <div class="mb-3">
                                    <label><strong>Usuário</strong></label>
                                    <p class="form-control-plaintext"><?= htmlspecialchars($agendamento['usuario_nome']); ?></p>
                                </div>
                                <div class="mb-3">
                                    <label><strong>Status</strong></label>
                                    <p class="form-control-plaintext">
                                        <?php
                                        if ($agendamento['status'] == 'Confirmado') {
                                            echo '<span class="badge badge-success">Confirmado</span>';
                                        } elseif ($agendamento['status'] == 'Pendente') {
                                            echo '<span class="badge badge-warning">Pendente</span>';
                                        } else {
                                            echo '<span class="badge badge-danger">Cancelado</span>';
                                        }
                                        ?>
                                    </p>
                                </div>
                        <?php
                            } else {
                                echo "<h5 class='text-danger'>Agendamento não encontrado</h5>";
                            }
                        } else {
                            echo "<h5 class='text-danger'>ID do agendamento não especificado.</h5>";
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