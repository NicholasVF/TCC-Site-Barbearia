<?php
session_start();
include_once("conexao.php");

// Verificar se o usuário já está logado
if (isset($_SESSION['id_login'])) {
    // Se o usuário já estiver logado, redireciona para a página principal ou de admin
    $redirectUrl = ($_SESSION['tipo_usuario'] === 'admin') ? 'admin/admin-home.php' : 'index.php';
    header("Location: $redirectUrl");
    exit; // Finaliza o script para evitar execução adicional
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $senha = $_POST['senha'];

    $query = "SELECT * FROM login WHERE email = '$email'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) === 1) {
        $usuario = mysqli_fetch_assoc($result);

        if (password_verify($senha, $usuario['senha'])) {
            session_regenerate_id(true); // Evita roubo de sessão
            $_SESSION['id_login'] = $usuario['id_login'];
            $_SESSION['nome'] = $usuario['nome'];
            $_SESSION['email'] = $usuario['email'];
            $_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];

            // Redireciona para a página correta sem mensagens de erro ou sleep
            if ($usuario['tipo_usuario'] === 'admin') {
                header("Location: admin/admin-home.php");
            } else {
                header("Location: index.php");
            }
            exit;
        } else {
            echo "Senha incorreta.";
        }
    } else {
        echo "Usuário não encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Barbearia Oliveira</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilos globais */
        body {
            background: linear-gradient(135deg, #1a1a1a, #444);
            color: #fff;
            font-family: 'Roboto', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
        }

        /* Container do login */
        .login-container {
            width: 100%;
            max-width: 450px;
            background: rgba(0, 0, 0, 0.8);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            padding: 4rem 2.5rem;
            position: relative;
            z-index: 10;
            backdrop-filter: blur(10px);
            animation: fadeIn 1s ease-out;
        }

        /* Animação de entrada */
        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(-50px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Título */
        .login-title {
            font-size: 2.8rem;
            font-weight: 700;
            color: #ffd700;
            text-align: center;
            margin-bottom: 1.5rem;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        /* Subtítulo */
        .login-subtitle {
            font-size: 1.1rem;
            color: #bbb;
            text-align: center;
            margin-bottom: 2rem;
            letter-spacing: 0.5px;
        }

        /* Card do formulário de login */
        .card {
            background-color: transparent;
            border: none;
        }

        /* Campos de formulário */
        .form-control {
            background-color: #222;
            border: 1px solid #555;
            color: #ffd700;
            font-size: 1rem;
            border-radius: 8px;
            padding: 1rem;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-control:focus {
            border-color: #ffd700;
            box-shadow: 0 0 10px rgba(255, 215, 0, 0.4);
        }

        /* Label dos campos */
        .form-label {
            font-weight: bold;
            color: #ffd700;
            margin-bottom: 0.5rem;
            font-size: 1.1rem;
        }

        /* Botão de login */
        .btn-primary {
            background-color: #ffd700;
            color: #000;
            border-radius: 25px;
            font-weight: 600;
            text-transform: uppercase;
            padding: 1.2rem 2rem;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            width: 100%;
            letter-spacing: 1px;
        }

        .btn-primary:hover {
            background-color: #e5c100;
            box-shadow: 0 6px 12px rgba(255, 215, 0, 0.3);
        }

        /* Link para cadastro */
        .register-link {
            text-align: center;
            margin-top: 1rem;
            font-size: 1.1rem;
        }

        .register-link a {
            color: #ffd700;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .register-link a:hover {
            color: #e5c100;
            text-decoration: underline;
        }

        /* Ícone de olho */
        .password-toggle {
            position: absolute;
            top: 75%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #ffd700;
            font-size: 1.3rem;
        }

        /* Responsividade */
        @media (max-width: 576px) {
            .login-container {
                padding: 3rem 2rem;
            }

            .login-title {
                font-size: 2.2rem;
            }

            .login-subtitle {
                font-size: 1rem;
            }

            .btn-primary {
                padding: 1rem 1.5rem;
            }
        }
    </style>
</head>

<body>

    <div class="login-container">
        <h1 class="login-title">Barbearia Oliveira</h1>
        <p class="login-subtitle">Aqueça o visual com estilo! Entre para a nossa comunidade.</p>

        <div class="card">
            <div class="card-body">
                <form method="post">
                    <div class="mb-4">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="mb-4 position-relative">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="senha" name="senha" required>
                        <i id="toggle-password" class="bi bi-eye password-toggle" onclick="togglePassword()"></i>
                    </div>

                    <button type="submit" class="btn btn-primary">Entrar</button>
                </form>
            </div>
        </div>

        <div class="register-link">
            <p>Não tem uma conta? <a href="cadastro.php">Cadastre-se Aqui!</a></p>
        </div>
    </div>

    <!-- Importando o ícone de olho do Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

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