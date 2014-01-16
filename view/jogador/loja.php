<?php
$loginPage = "../../index.php";
$resourcesFolder = "../../resources/";
$controllerFolder = "../../controller";
$bigButtons = array("Login" => "../../index.php");
$navLinks = array("Home" => "../../index.php", "Jogar" => "jogador.php");

include_once '../template/head.php';
include_once '../template/bodyHeaderContainer.php';
?>
<div class="col-md-4 col-sm-4">
    <div class="news">
        <div class="letter">
            Olá <?php echo $_SESSION["nome"] ?>
        </div>
        <hr/>
        <div class="letter">
            
        </div>
        <div class="letter">
            
        </div>
    </div>    
</div>
<div class="col-md-8 col-sm-8">
    <div class="letter">
                    
    </div>    
</div>
<?php include_once '../template/bodyFooter.php'; ?>
