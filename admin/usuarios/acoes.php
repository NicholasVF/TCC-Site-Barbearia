<?php
session_start();
include_once(__DIR__ . '/../../conexao.php');

// Criar usuário no banco de login
if (isset($_POST['create_usuario'])) {
    $nome = mysqli_real_escape_string($connection, trim($_POST['nome']));
    $email = mysqli_real_escape_string($connection, trim($_POST['email']));
    $senha = isset($_POST['senha']) ? mysqli_real_escape_string($connection, password_hash(trim($_POST['senha']), PASSWORD_DEFAULT)) : "";
    $tipo_usuario = mysqli_real_escape_string($connection, trim($_POST['tipo_usuario']));

    $sql = "INSERT INTO login (nome, email, senha, tipo_usuario) VALUES ('$nome', '$email', '$senha', '$tipo_usuario')";
    $result = mysqli_query($connection, $sql);
    if (mysqli_affected_rows($connection) > 0) {
        $_SESSION['mensagem'] = 'Usuário criado com sucesso';
        header('Location: index.php');
        exit;
    } else {
        $_SESSION['mensagem'] = 'Usuário não foi criado';
        header('Location: index.php');
        exit;
    }
}

// Atualizar usuário no banco de login
if (isset($_POST['update_usuario'])) {
    $usuario_id = mysqli_real_escape_string($connection, $_POST['usuario_id']);
    $nome = mysqli_real_escape_string($connection, trim($_POST['nome']));
    $email = mysqli_real_escape_string($connection, trim($_POST['email']));
    $senha = isset($_POST['senha']) ? mysqli_real_escape_string($connection, trim($_POST['senha'])) : "";
    $tipo_usuario = mysqli_real_escape_string($connection, trim($_POST['tipo_usuario']));

    // Construir a query de atualização
    $sql = "UPDATE login SET nome='$nome', email='$email', tipo_usuario='$tipo_usuario'";
    if (!empty($senha)) {
        $senha = mysqli_real_escape_string($connection, password_hash($senha, PASSWORD_DEFAULT));
        $sql .= ", senha='$senha'";
    }
    $sql .= " WHERE id_login='$usuario_id'";

    // Executar a query de atualização
    $result = mysqli_query($connection, $sql);

    if (mysqli_affected_rows($connection) > 0) {
        $_SESSION['mensagem'] = 'Usuário editado com sucesso';
        header('Location: index.php');
        exit;
    } else {
        $_SESSION['mensagem'] = 'Nenhuma alteração detectada ou usuário não encontrado';
        header('Location: index.php');
        exit;
    }
}

// Deletar usuário
if(isset($_POST['delete_usuario'])){
    $usuario_id = mysqli_real_escape_string($connection, $_POST['delete_usuario']);
    
    $sql = "DELETE FROM login WHERE id_login = '$usuario_id'";
   
    mysqli_query($connection,$sql);

    if(mysqli_affected_rows($connection)>0){
        $_SESSION['mensagem'] = "Usuário deletado com sucesso";
        header('Location: index.php');
        exit;
    }else{
        $_SESSION['mensagem'] = "Usuário não foi deletado ";
        header('Location: index.php');
        exit;
    }
}
?>
