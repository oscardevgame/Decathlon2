<?php
include_once 'verificaSessao.php';

include_once 'partidaBE.php';
include_once 'partidaDAO.php';
include_once 'controllerPartidas.php';

    $controllerPartidas = new partidaController();
    $listPartidasUsusario = $controllerPartidas -> listPartidasPorUsuario($_POST["idAmigo"]);
    echo $listPartidasUsusario;
?>
