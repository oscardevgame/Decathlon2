<?php
$loginPage = "index.php";
$bigButtons = array("Logout" => "index.php");
$navLinks = array("Home" => "index.php", "Loja" => "viewLoja.php");

include_once 'templateHead.php';
include_once 'templateBodyHeaderContainer.php';
include_once 'controllerItens.php';
include_once 'controllerPartidas.php';
include_once 'itensBE.php';
include_once 'itens_powerBE.php';
include_once 'usuario_itensDAO.php';
include_once 'usuario_itensBE.php';
include_once 'partidaDAO.php';

$controllerItens = new itensController();
$controllerPartidas = new partidaController();

$listItensUsuario = $controllerItens->listItensPorUsuario($_SESSION["idUsuario"]);
$listPartidasUsusario = $controllerPartidas->listPartidasPorUsuario($_SESSION["idUsuario"]);
?>
<script> 
  $(function(){
    $('#tableItensDisp tr').click(function() {
        if ($(this).find(':checkbox').is(':checked')) {            
            $(this).find(':checkbox').attr("disabled",false);
            $(this).find(':checkbox').prop("checked",false);
            $(this).find(':checkbox').attr("disabled",true);
        } else {
            $(this).find(':checkbox').attr("disabled",false);
            $(this).find(':checkbox').prop("checked",true);
            $(this).find(':checkbox').attr("disabled",true);
        }
    });
});
</script>

<div class="col-md-4 col-sm-4">
    <div class="news">
        <div class="letter">
            Olá <?php echo $_SESSION["nome"] ?>
        </div>
        <hr/>
        <div class="letter">
            Itens disponíveis:
            <table class="table table-hover" id="tableItensDisp">
                <tr>
                    <th></th>
                    <th></th>
                    <th>Item</th>
                    <th>Poder</th>
                </tr>
                <?php foreach ($listItensUsuario as $key => $value) { 
                        $item = $value->getId_itens_power();
                    ?>
                    <tr>
                        <td><input type="checkbox" id="item_<?php echo $item->getId_itens_power() ?>" name="item[]" value="<?php echo $item->getId_itens_power() ?>" disabled="disabled"></td>
                        <td><img src="<?php echo $item->getId_itens()->getPath_image_item() ?>"/></td>
                        <td><?php echo $item->getId_itens()->getDescricao() ?></td>
                        <td><?php echo $item->getId_power()->getDescricao() ?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="4" style="text-align: right">
                        <input type="button" id="startbutton" value="Iniciar Jogo"/>
                    </td>
                </tr>
            </table>
        </div>
        <div class="letter">
            Minhas Partidas:
            <div class="news" style="overflow-y: auto; height: 200px">
                <table class="table table-hover" id="tablePartidasUsuario">
                    <thead>
                    <tr>
                        <th>Data</th>
                        <th>pontuacao</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($listPartidasUsusario as $key => $value) { ?>
                        <tr>
                            <td><?php echo $value->getData() ?></td>
                            <td><?php echo $value->getPontuacao() ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="letter">
            Corridas Disponíveis:
        </div>
    </div>    
</div>
<div class="col-md-8 col-sm-8">
    <div class="letter">
        <div id="playground" style="width: 594px; height: 400px; background: black;">
            <div id="welcomeScreen" style="width: 594px; height: 296px; position: absolute; z-index: 100; background-image: url(game1/logo.png); font-family: verdana, sans-serif;">
                <div style="position: absolute; top: 120px; width: 594px; color: white;">
                    <div id="loadingBar" style="position: relative; left: 100px; height: 15px; width: 0px; background: red;"></div>
                </div>
            </div>
	</div>    
    </div>    
</div>
<?php include_once 'templateBodyFooter.php'; ?>
