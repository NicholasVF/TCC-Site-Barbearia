<?php
include_once(__DIR__ . '/../../conexao.php');
session_start();
?>
<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Funcionários</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
  <style>
    /* Fontes e cores principais */
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #f8f9fa;
      margin: 0;
      padding: 0;
    }

    /* Navbar */
    .navbar {
      background-color: #007bff;
      padding: 10px;
    }

    .navbar a {
      color: #ffffff;
      text-decoration: none;
      padding: 10px 15px;
      display: inline-block;
    }

    /* Cartões */
    .card {
      background-color: #ffffff;
      border-radius: 15px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      margin: 20px;
      overflow: hidden;
    }

    .card-header {
      background-color: #007bff;
      color: #ffffff;
      font-family: 'Montserrat', sans-serif;
      font-size: 1.6rem;
      font-weight: 600;
      padding: 20px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .card-body {
      padding: 30px;
    }

    /* Botões */
    .btn {
      display: inline-block;
      font-size: 1.1rem;
      font-weight: 600;
      padding: 12px 30px;
      border-radius: 25px;
      cursor: pointer;
      text-decoration: none;
      transition: all 0.3s ease;
      color: #fff;
      text-align: center;
    }

    .btn-warning {
      background-color: #ffc107;
    }

    .btn-warning:hover {
      background-color: #e0a800;
    }

    .btn-danger {
      background-color: #dc3545;
    }

    .btn-danger:hover {
      background-color: #c82333;
    }

    /* Tabela */
    .table {
      width: 100%;
      margin-top: 20px;
      border-collapse: collapse;
      font-size: 1rem;
    }

    .table th, .table td {
      border: 1px solid #ddd;
      padding: 15px;
      text-align: center;
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

    /* Responsividade */
    @media (max-width: 768px) {
      .card-header {
        font-size: 1.4rem;
      }

      .table th, .table td {
        font-size: 0.9rem;
        padding: 8px;
      }

      .btn {
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
        <div class="card">
          <div class="card-header">
            <h4>Lista de Funcionários</h4>
            <a href="criar-funcionario.php" class="btn btn-warning">Adicionar Funcionário</a>
          </div>
          <div class="card-body">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nome</th>
                  <th>Email</th>
                  <th>Serviço</th>
                  <th>Ações</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $sql = '
                  SELECT f.id_funcionario, f.nome, f.email, s.servico
                  FROM funcionarios f
                  JOIN servicos s ON f.id_servico = s.id_servico
                ';
                $funcionarios = mysqli_query($connection, $sql);
                if (mysqli_num_rows($funcionarios) > 0) {
                  foreach ($funcionarios as $funcionario) {
                ?>
                    <tr>
                      <td><?= $funcionario['id_funcionario'] ?></td>
                      <td><?= $funcionario['nome'] ?></td>
                      <td><?= $funcionario['email'] ?></td>
                      <td><?= $funcionario['servico'] ?></td>
                      <td>
                        <a href="funcionario-view.php?id=<?= urlencode($funcionario['id_funcionario']); ?>" class="btn btn-warning">Visualizar</a>
                        <a href="funcionario-edit.php?id=<?= urlencode($funcionario['id_funcionario']); ?>" class="btn btn-warning">Editar</a>
                        <form action="acoes-funcionarios.php" method="post" style="display: inline;">
                          <button onclick="return confirm('Tem certeza que deseja excluir?')" type="submit" name="delete_funcionario" value="<?= $funcionario['id_funcionario'] ?>" class="btn btn-danger">
                            Excluir
                          </button>
                        </form>
                      </td>
                    </tr>
                <?php
                  }
                } else {
                  echo "<tr><td colspan='5' class='text-center'>Nenhum funcionário encontrado</td></tr>";
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
