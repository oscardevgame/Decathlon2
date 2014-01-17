<?php

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
include_once 'partidaBE.php';
include_once 'partidaDAO.php';

//$partida = new partidaBE();
$partidaDAO = new partidaDAO();

$idPartidaAtual = $_POST['idPartidaAtual'];
$usuarioId = $_SESSION['idUsuario'];
$arrayTracker = $_POST["dataTracker"];
$pontuacao = $_POST["pontuacao"];
$email = $_SESSION['email'];
$dataHoraPartida = date('Y-m-d H:i:s');
$fileName = str_replace("-", "", $dataHoraPartida);
$fileName = str_replace(" ", "_", $fileName);
$fileName = str_replace(":", "", $fileName);

$partida = $partidaDAO->ObterPorPK($idPartidaAtual);

$pathFileTracker = "resources/userFiles/$email";

$fullPathFile = $pathFileTracker."/".$fileName.".txt";

if($partida->getId_partida() === null){
    $partida->setId_usuario($usuarioId);
    $partida->setData($dataHoraPartida);
    $partida->setPath_file_tracker($fullPathFile);
    $partida->setPontuacao($pontuacao);
    $partida->setId_partida($partidaDAO->incluir($partida));

    $_SESSION["idPartida"] = $partida->getId_partida();
} else {
    $fullPathFile = $partida->getPath_file_tracker();
}

if(! file_exists($pathFileTracker)){
    mkdir($pathFileTracker);
}
chmod ($pathFileTracker, 777);
file_put_contents($fullPathFile, json_encode($arrayTracker), FILE_APPEND);    

header('Content-Type: application/json');
$retorno = array("dataHora"=>$partida->getData(),"fileTracker"=>$partida->getPath_file_tracker(),"idPartida"=>$partida->getId_partida(),"pontuacao"=>$partida->getPontuacao());
echo json_encode($retorno);

?>
