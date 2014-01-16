<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

include_once '../persistence/daos/powerDAO.php';
include_once '../persistence/daos/entidades/powerBE.php';

$powerDAO = new powerDAO();
$power = new powerBE();

$descricao = filter_input(INPUT_POST, 'descricaoPower');
        
if (empty(trim($descricao))) {
    $message = "O campo descrição do poder é obrigatório!";
    $_SESSION["mensagens"] = array_merge($_SESSION["mensagens"], array("$message" => "a"));
    header("Location: " . filter_input(INPUT_SERVER, 'HTTP_REFERER'));
    return;
}

$power->setDescricao($descricao);

$novoID = $powerDAO->incluir($power);
$power->setId_power($novoID);

json_encode($power);

header("Location: " . filter_input(INPUT_SERVER, 'HTTP_REFERER'));
