<?php
session_start();

// Verifica se o usuário logado é admin
if (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] == 'admin') {
    // Destrói todas as variáveis da sessão
    session_unset();
    
    // Destrói a sessão
    session_destroy();
    
    // Redireciona o usuário para a página de login (fora da pasta admin)
    header("Location:  ../login.php");
    exit;
} else {
    // Caso não seja admin ou não esteja logado, redireciona para a página inicial (fora da pasta admin)
    header("Location: ../login.php");
    exit;
}
?>
