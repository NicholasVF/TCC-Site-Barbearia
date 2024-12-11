<?php
include_once("conexao.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = array('success' => false, 'message' => '');

    if (isset($_POST['nome'], $_POST['email'], $_POST['senha'])) {
        $nome = mysqli_real_escape_string($connection, $_POST['nome']);
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $senha = $_POST['senha'];

        $email_verifica = "SELECT * FROM login WHERE email = '$email'";
        $result = mysqli_query($connection, $email_verifica);

        if (mysqli_num_rows($result) > 0) {
            $response['message'] = "Email já cadastrado. Por favor, escolha outro.";
        } else {
            $hashed_senha = password_hash($senha, PASSWORD_DEFAULT);
            $sql = "INSERT INTO login (nome, email, senha) VALUES ('$nome', '$email', '$hashed_senha')";
            $result = mysqli_query($connection, $sql);

            if (!$result) {
                $response['message'] = 'Erro ao executar a consulta: ' . mysqli_error($connection);
            } else {
                $response['success'] = true;
                $response['message'] = "Cadastro realizado com sucesso!";
            }
        }
    }
}
mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Barbearia Oliveira</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #111, #333);
            color: #fff;
            font-family: 'Roboto', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding-top: 80px; /* Espaço para a mensagem */
        }

        .alert-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
        }

        .container {
            max-width: 450px;
            width: 100%;
            padding: 2rem;
        }

        .card {
            background-color: rgba(0, 0, 0, 0.8);
            border-radius: 15px;
            box-shadow: 0 15px 45px rgba(0, 0, 0, 0.3);
            padding: 3rem 2.5rem;
        }

        .title {
            font-size: 3rem;
            font-weight: 700;
            color: #ffd700;
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .form-control {
            background-color: #222;
            border: 1px solid #555;
            color: #ffd700;
            border-radius: 8px;
            padding: 1rem;
        }

        .form-control:focus {
            border-color: #ffd700;
            box-shadow: 0 0 12px rgba(255, 215, 0, 0.5);
        }

        .btn-primary {
            background-color: #ffd700;
            color: #000;
            border-radius: 25px;
            padding: 1.2rem 2rem;
            width: 100%;
        }

        .btn-primary:hover {
            background-color: #e5c100;
            box-shadow: 0 6px 20px rgba(255, 215, 0, 0.4);
        }

        .register-link a {
            color: #ffd700;
        }
    </style>
</head>

<body>
    <?php if (isset($response['message'])): ?>
        <div class="alert-container">
            <div class="alert <?= $response['success'] ? 'alert-success' : 'alert-danger'; ?> text-center mb-0" role="alert">
                <?= htmlspecialchars($response['message']); ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="container">
        <h1 class="title">Barbearia Oliveira</h1>

        <div class="card">
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3 position-relative">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="senha" name="senha" required>
                </div>
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </form>
        </div>

        <div class="register-link text-center mt-3">
            <p>Já possui uma conta? <a href="login.php">Faça login aqui!</a></p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>


    <script>
        // Função para alternar a visibilidade da senha
        function togglePassword() {
            var passwordField = document.getElementById('senha');
            var toggleIcon = document.getElementById('toggle-password');

            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggleIcon.classList.remove("bi-eye");
                toggleIcon.classList.add("bi-eye-slash");
            } else {
                passwordField.type = "password";
                toggleIcon.classList.remove("bi-eye-slash");
                toggleIcon.classList.add("bi-eye");
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>