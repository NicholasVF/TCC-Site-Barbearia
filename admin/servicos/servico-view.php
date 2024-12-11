<?php
include_once(__DIR__ . '/../../conexao.php');
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Serviço - Visualizar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <?php include('../navbar.php'); ?>
    <div class="container mt-5">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4>Visualizar serviço
                <a href="index-servicos.php" class="btn btn-danger float-end">Voltar</a>
              </h4>
            </div>
            <div class="card-body">
                <?php
                if (isset($_GET['id'])) {
                    $servico_id = mysqli_real_escape_string($connection, $_GET['id']);
                    $sql = "SELECT * FROM servicos WHERE id_servico='$servico_id'";
                    $query = mysqli_query($connection, $sql);

                    // Verificar se houve erro na consulta
                    if (!$query) {
                        die('Erro na consulta: ' . mysqli_error($connection));
                    }

                    if (mysqli_num_rows($query) > 0) {
                        $servico = mysqli_fetch_array($query);
                ?>
                <div class="mb-3">
                  <label>Serviço</label>
                  <p class="form-control">
                    <?=$servico['servico'];?>
                  </p>
                </div>
                <div class="mb-3">
                  <label>Preço</label>
                  <p class="form-control">
                    <?=$servico['preco'];?>
                  </p>
                </div>
                <?php
                    } else {
                        echo "<h5>Serviço não encontrado</h5>";
                    }
                } else {
                    echo "<h5>ID do serviço não fornecido</h5>";
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
