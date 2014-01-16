<?php 
// Inicia sessões 
if(!session_status() == PHP_SESSION_ACTIVE){
    session_start();
}

// Verifica se existe os dados da sessão de login 
if(!isset($_SESSION["email"]) || !isset($_SESSION["nome"])) 
{
    // Usuário não logado! Redireciona para a página de login 
    header("Location: $loginPage"); 
    exit; 
} 
?>