<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Administração - Barbearia Oliveira</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
    }

    /* Estilo da Navbar */
    .navbar {
      background: #333;
      border-bottom: 2px solid #ffd700;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
      transition: all 0.3s ease-in-out;
    }

    .navbar:hover {
      background: #222;
      /* Escurece ao passar o mouse */
    }

    /* Logo */
    .navbar-brand {
      font-weight: bold;
      color: #ffd700;
      font-size: 1.7rem;
      text-transform: uppercase;
      letter-spacing: 2px;
      transition: color 0.3s ease-in-out;
    }

    .navbar-brand:hover {
      color: #e5c100;
      text-decoration: none;
    }

    /* Links de navegação */
    .navbar-nav .nav-link {
      color: #fff !important;
      font-weight: 600;
      font-size: 1.1rem;
      text-transform: uppercase;
      letter-spacing: 1px;
      padding: 12px 20px;
      position: relative;
      transition: all 0.3s ease;
    }

    .navbar-nav .nav-link:hover,
    .navbar-nav .nav-link.active {
      color: #000;
      background-color: #ffd700;
      border-radius: 30px;
      box-shadow: 0 4px 10px rgba(255, 215, 0, 0.2);
    }

    /* Ícones ao lado dos links */
    .nav-item i {
      margin-right: 8px;
      font-size: 1.2rem;
      transition: transform 0.3s ease-in-out;
    }

    /* Animação do ícone (escala no hover) */
    .navbar-nav .nav-link:hover i {
      transform: scale(1.2);
    }

    /* Separadores entre os itens de navegação */
    .navbar-nav .nav-item {
      margin-left: 10px;
      margin-right: 10px;
    }

    .navbar-toggler-icon {
      background-color: #ffd700;
    }

    /* Responsividade para dispositivos menores */
    @media (max-width: 991px) {
      .navbar-nav {
        text-align: center;
        width: 100%;
      }

      .navbar-nav .nav-item {
        margin-left: 0;
        margin-right: 0;
      }

      .navbar-nav .nav-link {
        padding: 12px 25px;
        font-size: 1.3rem;
      }
    }

    @media (max-width: 767px) {
      .navbar-nav .nav-item {
        border-bottom: 1px solid #444;
      }

      .navbar-nav .nav-item:last-child {
        border-bottom: none;
      }
    }

    /* Melhorando a transição do botão de alternância */
    .navbar-toggler {
      border: none;
    }

    .navbar-toggler-icon {
      background-color: #ffd700;
      transition: background-color 0.3s ease;
    }

    .navbar-toggler-icon:hover {
      background-color: #e5c100;
    }
  </style>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <!-- Logo -->
      <a class="navbar-brand" href="#">
        <i class="bi bi-house-door"></i> Administração - Barbearia Oliveira
      </a>

      <!-- Botão de menu em dispositivos móveis -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Menu de navegação -->
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="/BarbeariaOliveira/admin/admin-home.php">
              <i class="bi bi-house-door"></i> Home
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/BarbeariaOliveira/admin/agenda/index-agenda.php">
              <i class="bi bi-calendar-event"></i> Agendamento
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="/BarbeariaOliveira/admin/servicos/index-servicos.php">
              <i class="bi bi-gear"></i> Serviços
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/BarbeariaOliveira/admin/usuarios/index.php">
              <i class="bi bi-person"></i> Usuários
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/BarbeariaOliveira/admin/funcionarios/index-funcionarios.php">
              <i class="bi bi-person-badge"></i> Funcionários
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/BarbeariaOliveira/admin/horarios/index-horarios.php">
              <i class="bi bi-clock"></i> Horários
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Script para gerenciar a classe 'active' -->
  <script>
    // Obtém todos os links da navbar
    const navLinks = document.querySelectorAll('.navbar-nav .nav-link');

    // Adiciona evento de clique em cada link
    navLinks.forEach(link => {
      link.addEventListener('click', function() {
        // Remove a classe 'active' de todos os links
        navLinks.forEach(link => link.classList.remove('active'));
        // Adiciona a classe 'active' ao link clicado
        this.classList.add('active');
      });
    });
  </script>

</body>

</html>