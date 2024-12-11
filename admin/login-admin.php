<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Admin - Barbearia Oliveira</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Estilos globais */
    body {
      background: linear-gradient(135deg, #1b1b1b, #333);
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
      background: rgba(0, 0, 0, 0.85);
      border-radius: 16px;
      box-shadow: 0 6px 25px rgba(0, 0, 0, 0.4);
      padding: 3rem 2.5rem;
      position: relative;
      z-index: 10;
    }

    /* Título */
    .login-title {
      font-size: 2.8rem;
      font-weight: 700;
      color: #FFCC00;
      text-align: center;
      margin-bottom: 1.5rem;
      text-transform: uppercase;
    }

    /* Subtítulo */
    .login-subtitle {
      font-size: 1.2rem;
      color: #D49A14;
      text-align: center;
      margin-bottom: 2rem;
    }

    /* Card do formulário de login */
    .card {
      background-color: transparent;
      border: none;
      margin-bottom: 1.5rem;
    }

    /* Campos de formulário */
    .form-control {
      background-color: #333;
      border: 1px solid #555;
      color: #FFCC00;
      font-size: 1rem;
      border-radius: 8px;
      padding: 1.2rem;
      transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .form-control:focus {
      border-color: #FFCC00;
      box-shadow: 0 0 12px rgba(255, 204, 0, 0.6);
    }

    /* Label dos campos */
    .form-label {
      font-weight: bold;
      color: #FFCC00;
      margin-bottom: 0.5rem;
      font-size: 1.1rem;
    }

    /* Botão de login */
    .btn-primary {
      background-color: #FFCC00;
      color: #000;
      border-radius: 25px;
      font-weight: 600;
      text-transform: uppercase;
      padding: 1.1rem 2rem;
      transition: background-color 0.3s ease, box-shadow 0.3s ease;
      width: 100%;
      border: none;
    }

    .btn-primary:hover {
      background-color: #E6B800;
      box-shadow: 0 5px 15px rgba(255, 204, 0, 0.2);
    }

    /* Link para cadastro */
    .register-link {
      text-align: center;
      margin-top: 1.5rem;
      font-size: 1rem;
    }

    .register-link a {
      color: #FFCC00;
      text-decoration: none;
      font-weight: 600;
    }

    .register-link a:hover {
      text-decoration: underline;
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

    .login-container {
      animation: fadeIn 1s ease-out;
    }

    /* Ícone de olho */
    .password-toggle {
      position: absolute;
      top: 70%;
      /* Ajuste para mover o ícone mais para baixo */
      right: 10px;
      transform: translateY(-50%);
      /* Mantém o ícone alinhado verticalmente */
      cursor: pointer;
      color: #FFCC00;
      font-size: 1.3rem;
    }
  </style>
</head>

<body>

  <div class="login-container">
    <h1 class="login-title">Admin - Barbearia Oliveira</h1>
    <p class="login-subtitle">Área Administrativa. Entre para gerenciar.</p>

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