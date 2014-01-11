<?php

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
include_once 'usuario_itensBE.php';
include_once 'usuario_itensDAO.php';

$itemUsuario = new usuario_itensBE();
$itemUsuarioDAO = new usuario_itensDAO();

$itens = $_POST['item'];

foreach ($itens as $key => $value) {
    $itemUsuario->setId_usuario($_SESSION['idUsuario']);
    $itemUsuario->setId_itens_power($value);
    $itemUsuario->setSituacao('ativo');
    $itemUsuarioDAO->incluir($itemUsuario);
}

header("Location: " . filter_input(INPUT_SERVER, 'HTTP_REFERER'));
?>
