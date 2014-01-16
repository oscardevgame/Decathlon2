<?php

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
include_once 'partidaBE.php';
include_once 'partidaDAO.php';

$partida = new partidaBE();
$partidaDAO = new partidaDAO();

$usuarioId = $_SESSION['idUsuario'];
$arrayTracker = $_POST["dataTracker"];
$pontuacao = $_POST["pontuacao"];
$email = $_SESSION['email'];
$dataHoraPartida = date('Y-m-d h:i:s');
$fileName = str_replace("-", "", $dataHoraPartida);
$fileName = str_replace(" ", "_", $fileName);
$fileName = str_replace(":", "", $fileName);

$pathFileTracker = "resources/userFiles/$email";
if(! file_exists($pathFileTracker)){
    mkdir($pathFileTracker);
}

chmod ($pathFileTracker, 777); 
file_put_contents($pathFileTracker."/".$fileName.".txt", json_encode($arrayTracker));

$partida->setId_usuario($usuarioId);
$partida->setData($dataHoraPartida);
$partida->setPath_file_tracker($pathFileTracker."/".$fileName.".txt");
$partida->setPontuacao($pontuacao);
$partida->setId_partida($partidaDAO->incluir($partida));

echo json_encode($partida);
return;
//header("Location: " . filter_input(INPUT_SERVER, 'HTTP_REFERER'));
?>
