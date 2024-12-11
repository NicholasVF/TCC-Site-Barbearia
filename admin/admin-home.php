<?php
include_once("../conexao.php");
$sqlAgendamentos = "SELECT COUNT(*) AS total_agendamentos 
                    FROM agenda 
                    WHERE MONTH(data_hora_agendamento) = MONTH(CURRENT_DATE()) 
                      AND YEAR(data_hora_agendamento) = YEAR(CURRENT_DATE())";

$resultAgendamentos = $connection->query($sqlAgendamentos);
$totalAgendamentos = ($resultAgendamentos->num_rows > 0) ? $resultAgendamentos->fetch_assoc()['total_agendamentos'] : 0;

// Obter o total de clientes cadastrados
$sqlClientes = "SELECT COUNT(*) AS total_clientes FROM login WHERE tipo_usuario = 'usuario'";
$resultClientes = $connection->query($sqlClientes);
$totalClientes = ($resultClientes->num_rows > 0) ? $resultClientes->fetch_assoc()['total_clientes'] : 0;
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>

    <!-- Adicionando o Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* Usando uma fonte moderna */
        body {
            font-family: 'Roboto', sans-serif;
            background: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        /* Estilizando a Navbar */
        .navbar {
            background: #343a40;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .navbar:hover {
            background: #222;
        }

        .navbar-brand {
            font-size: 1.8rem;
            color: #ffd700 !important;
            font-weight: bold;
        }

        .navbar-nav .nav-link {
            color: #fff !important;
            font-weight: 500;
            padding: 12px 20px;
            letter-spacing: 1px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            background-color: #ffd700;
            color: #343a40;
            border-radius: 25px;
            transform: translateY(-3px);
        }

        /* Estilo do alerta */
        .alert {
            background: linear-gradient(45deg, #f39c12, #f1c40f);
            color: #343a40;
            border-radius: 15px;
            padding: 20px;
            font-weight: bold;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            animation: fadeInAlert 1s ease-out;
        }

        .alert .bi-check-circle-fill {
            font-size: 2rem;
            margin-right: 10px;
            color: #2ecc71;
        }

        @keyframes fadeInAlert {
            0% {
                opacity: 0;
                transform: translateY(-10px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Estilizando os cartões de informação */
        .card {
            margin-bottom: 20px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            transition: transform 0.3s ease;
        }

        .card-body {
            background: #fff;
            border-radius: 15px;
            padding: 30px;
            text-align: center;
        }

        .card-icon {
            font-size: 4rem;
            color: #f39c12;
        }

        .card-title {
            font-weight: 600;
            font-size: 2rem;
            color: #333;
            margin-top: 15px;
        }

        .card-text {
            font-size: 1.2rem;
            color: #555;
            margin-top: 5px;
        }

        .row {
            margin-top: 30px;
        }

        /* Estilo do botão de logout */
        .btn-logout {
            background: linear-gradient(45deg, #ff5733, #e63946);
            color: white;
            padding: 14px 35px;
            font-size: 1.4rem;
            border: none;
            border-radius: 50px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
        }

        /* Efeito hover do botão de logout */
        .btn-logout:hover {
            background: linear-gradient(45deg, #d32f2f, #c2185b);
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        }

        .btn-logout i {
            margin-right: 12px;
            font-size: 1.7rem;
            transition: transform 0.3s ease;
        }

        .btn-logout:hover i {
            transform: rotate(20deg);
        }

        /* Cards responsivos */
        .card-columns {
            column-count: 2;
            column-gap: 30px;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            h1 {
                font-size: 2rem;
            }

            .btn-logout {
                font-size: 1.1rem;
                padding: 12px 25px;
            }

            .navbar-brand {
                font-size: 1.5rem;
            }

            .navbar-nav .nav-link {
                font-size: 1rem;
                padding: 10px;
            }

            .card {
                margin-bottom: 15px;
            }

            .card-columns {
                column-count: 1;
            }
        }

        /* Botão de Logout fixo no rodapé */
        .logout-container {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1000;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <?php include("../admin/navbar.php"); ?>

    <div class="container mt-5">
        <!-- Mensagem de boas-vindas ou alerta -->
        <div class="alert fade show" role="alert">
            <p><i class="bi bi-check-circle-fill"></i> Bem-vindo à área administrativa da Barbearia Oliveira! Vamos administrar com eficiência!</p>
        </div>

        <div class="row">
            <div class="col-md-12 text-center">
                <!-- Cards Informativos -->
                <div class="card-columns">
                    <div class="card">
                    <div class="card-body">
                            <i class="bi bi-calendar-check card-icon"></i>
                            <h5 class="card-title">Agendamentos</h5>
                            <p class="card-text">Total de agendamentos no mês</p>
                            <h3><?php echo $totalAgendamentos; ?></h3>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <i class="bi bi-people-fill card-icon"></i>
                            <h5 class="card-title">Clientes</h5>
                            <p class="card-text">Total de clientes cadastrados</p>
                            <h3><?php echo $totalClientes; ?></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Botão de logout no rodapé -->
    <div class="logout-container">
        <button class="btn btn-logout" onclick="confirmLogout()">
            <i class="bi bi-power"></i> Sair
        </button>
    </div>

    <!-- Adicionando o Bootstrap JS e dependências -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Função de Logout com confirmação
        function confirmLogout() {
            if (confirm("Tem certeza que deseja sair do modo admin?")) {
                window.location.href = "./admin-logout.php"; // Redireciona para o logout
            }
        }
    </script>
</body>

</html>