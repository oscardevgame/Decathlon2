<?php
$loginPage = "index.php";
$bigButtons = array("Logout" => "index.php");
$navLinks = array("Home" => "index.php", "Loja" => "viewLoja.php");

include_once 'templateHead.php';
include_once 'templateBodyHeaderContainer.php';
include_once 'controllerItens.php';
include_once 'itensBE.php';
include_once 'itens_powerBE.php';
include_once 'usuario_itensDAO.php';
include_once 'usuario_itensBE.php';

$controllerItens = new itensController();
$listItensUsuario = $controllerItens->listItensPorUsuario($_SESSION["idUsuario"]);

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
                        <input type="button" value="Iniciar Jogo"/>
                    </td>
                </tr>
            </table>
        </div>
        <div class="letter">
            Partidas Realizadas:
        </div>
        <div class="letter">
            Corridas Disponíveis:
        </div>
    </div>    
</div>
<div class="col-md-8 col-sm-8">
    <div class="letter">
        <center>
            <iframe style="border: 0; overflow: hidden;" width="594" height="400" src="game1/iframe.html" scrolling="no" frameborder="0"/>
        </center>            
    </div>    
</div>
<?php include_once 'templateBodyFooter.php'; ?>
