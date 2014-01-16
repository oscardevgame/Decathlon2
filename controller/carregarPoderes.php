<?php
    include_once 'itensController.php';
    include_once '../persistence/daos/entidades/powerBE.php';
    
    $itensController = new itensController();
    $poderes = $itensController->listPowers();
    json_encode($poderes);