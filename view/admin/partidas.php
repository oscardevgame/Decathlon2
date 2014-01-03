<?php
$loginPage = "../../index.php";
$resourcesFolder = "../../resources/";
$controllerFolder = "../../controller";
$bigButtons = array("Logout" => "../../index.php");
$navLinks = array("Itens"=>"itens.php", 
                  "Partidas"=>"partidas.php", 
                  "Usuarios"=>"usuarios.php");

include_once '../template/head.php';
include_once '../template/bodyHeaderContainer.php';
?>
<div class="col-md-7 col-sm-7">
    <div class="news">
        <div class="letter">
        </div>
    </div>    
</div>
<?php include_once '../template/bodyFooter.php'; ?>
