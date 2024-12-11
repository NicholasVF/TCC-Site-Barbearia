<?php
include_once(__DIR__ . '/../../conexao.php');
session_start();
?>
<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Usuários</title>
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

    .card-footer {
      background-color: #f8f9fa;
      border-top: 1px solid #ddd;
    }

    /* Botões */
    .btn-primary {
      background-color: #ffc107;
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

    .btn-warning {
      background-color: #ffc107;
      border-color: #ffc107;
      font-size: 1.1rem;
      font-weight: 600;
      padding: 12px 30px;
      border-radius: 25px;
      transition: all 0.3s ease;
    }

    .btn-warning:hover,
    .btn-warning:focus {
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
      background-color: #c82333;
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

    /* Mensagens de alerta */
    .alert {
      font-weight: 500;
      background: #28a745;
      color: white;
      border-radius: 10px;
      padding: 10px 15px;
    }

    .alert .bi-check-circle-fill {
      font-size: 1.5rem;
      margin-right: 10px;
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
      .btn-warning,
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
    <?php include('../mensagem.php'); ?>

    <div class="row">
      <div class="col-md-12">
        <!-- Cartão de usuários -->
        <div class="card shadow-lg">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Lista de Usuários</h4>
            <a href="usuario-create.php" class="btn btn-warning btn-icon">
              <i class="bi bi-plus-circle"></i> Adicionar Usuário
            </a>
          </div>
          <div class="card-body">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nome</th>
                  <th>Email</th>
                  <th>Tipo de Usuário</th>
                  <th>Ações</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $sql = 'SELECT * FROM login'; // Mudando para a tabela login
                $usuarios = mysqli_query($connection, $sql);
                if (mysqli_num_rows($usuarios) > 0) {
                  foreach ($usuarios as $usuario) {
                ?>
                    <tr>
                      <td><?= $usuario['id_login'] ?></td>
                      <td><?= $usuario['nome'] ?></td>
                      <td><?= $usuario['email'] ?></td>
                      <td><?= $usuario['tipo_usuario'] ?></td>
                      <td>
                        <a href="usuario-view.php?id_login=<?= urlencode($usuario['id_login']); ?>" class="btn btn-warning btn-sm">Visualizar</a>
                        <a href="usuario-edit.php?id_login=<?= urlencode($usuario['id_login']); ?>" class="btn btn-warning btn-sm">Editar</a>
                        <form action="acoes.php" method="post" class="d-inline">
                          <button onclick="return confirm('Tem certeza que deseja excluir?')" type="submit" name="delete_usuario" value="<?= $usuario['id_login'] ?>" class="btn btn-danger btn-sm">
                            Excluir
                          </button>
                        </form>
                      </td>
                    </tr>
                <?php
                  }
                } else {
                  echo "<tr><td colspan='5' class='text-center'>Nenhum usuário encontrado</td></tr>";
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