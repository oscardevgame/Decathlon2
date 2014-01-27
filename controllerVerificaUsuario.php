<?php 
// Inicia sessões 
include_once 'verificaSessao.php';

// Verifica se existe os dados da sessão de login 
if(!isset($_SESSION["email"]) || !isset($_SESSION["nome"])) 
{
    // Usuário não logado! Redireciona para a página de login 
    header("Location: $loginPage"); 
    exit; 
} 
?>