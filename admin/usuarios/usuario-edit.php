<?php
session_start();
include_once(__DIR__ . '/../../conexao.php');

?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Usuários - Editar</title>
    <!-- Link para o Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Link para fontes do Google -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        /* Definições gerais */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f7fa;
            color: #333;
            margin: 0;
        }

        .navbar {
            background-color: #007bff;
        }

        .navbar a {
            color: #fff;
        }

        .card {
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .card-header {
            background-color: #007bff;
            color: #fff;
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            font-size: 1.6rem;
            text-align: center;
            padding: 20px;
        }

        .card-body {
            padding: 30px;
            background-color: #ffffff;
            border-radius: 0 0 12px 12px;
        }

        label {
            font-weight: 500;
            font-size: 1.1rem;
            color: #333;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 12px;
            font-size: 1rem;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .form-select {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 12px;
            font-size: 1rem;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-select:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .btn-primary {
            background-color: #ffc107;
            border: none;
            font-weight: 600;
            font-size: 1.1rem;
            padding: 12px 30px;
            border-radius: 25px;
            box-shadow: 0 4px 6px rgba(255, 193, 7, 0.2);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #e0a800;
            box-shadow: 0 6px 12px rgba(255, 193, 7, 0.3);
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
            font-weight: 600;
            font-size: 1.1rem;
            padding: 12px 30px;
            border-radius: 25px;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .float-end {
            float: right;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .card-body {
                padding: 20px;
            }

            .card-header {
                font-size: 1.4rem;
            }

            .form-control,
            .form-select {
                font-size: 1rem;
                padding: 10px;
            }

            .btn-primary,
            .btn-danger {
                font-size: 1rem;
                padding: 10px 25px;
            }
        }
    </style>
</head>

<body>

    <!-- Inclusão do Navbar -->
    <?php include('../navbar.php'); ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <!-- Cartão para edição do usuário -->
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Editar Usuário
                            <a href="index.php" class="btn btn-danger float-end">Voltar</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php
                        $usuario = null; // Inicializa a variável $usuario

                        if (isset($_GET['id_login'])) {
                            $usuario_id = mysqli_real_escape_string($connection, $_GET['id_login']);
                            $sql = "SELECT * FROM login WHERE id_login='$usuario_id'";
                            $query = mysqli_query($connection, $sql);

                            if (mysqli_num_rows($query) > 0) {
                                $usuario = mysqli_fetch_array($query);
                            }
                        }

                        if ($usuario) {
                        ?>
                            <form action="acoes.php" method="post">
                                <input type="hidden" name="usuario_id" value="<?= htmlspecialchars($usuario['id_login']) ?>">
                                <div class="form-group mb-3">
                                    <label>Nome</label>
                                    <input type="text" name="nome" value="<?= htmlspecialchars($usuario['nome']) ?>" class="form-control" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Email</label>
                                    <input type="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" class="form-control" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Senha (Deixe em branco se não quiser alterar)</label>
                                    <input type="password" name="senha" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label>Tipo de Usuário</label>
                                    <select name="tipo_usuario" class="form-select" required>
                                        <option value="usuario" <?= $usuario['tipo_usuario'] == 'usuario' ? 'selected' : '' ?>>Usuário</option>
                                        <option value="admin" <?= $usuario['tipo_usuario'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <button type="submit" name="update_usuario" class="btn btn-primary">Salvar</button>
                                </div>
                            </form>
                        <?php
                        } else {
                            echo "<h5>Usuário não encontrado</h5>";
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