<?php
$loginPage = "../../index.php";
$resourcesFolder = "../../resources/";
$controllerFolder = "../../controller";
$bigButtons = array("Login" => "../../index.php");
$navLinks = array("Home" => "../../index.php", "Loja" => "loja.php", "Meu Cadastro"=>"cadastro.php");

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
            Itens disponíveis:
        </div>
        <div class="letter">
            Partidas Realizadas:
        </div>
    </div>    
</div>
<div class="col-md-8 col-sm-8">
    <div class="letter">
        <center>
            <iframe style="border: 0; overflow: hidden;" width="594" height="400" src="../../game1/iframe.html" scrolling="no" frameborder="0"/>
        </center>            
    </div>    
</div>
<?php include_once '../template/bodyFooter.php'; ?>
