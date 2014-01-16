<?php

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
include_once 'partidaBE.php';
include_once 'partidaDAO.php';

$partida = new partidaBE();
$partidaDAO = new partidaDAO();

$usuarioId = $_SESSION['idUsuario'];
$partidaId = $_POST["partidaId"];
$email = $_SESSION['email'];

$partida = $partidaDAO->ObterPorPK($partidaId);

$pathFileTracker = $partida->getPath_file_tracker();

$tracker = file_get_contents($pathFileTracker);

echo json_encode($tracker);
return;

?>
