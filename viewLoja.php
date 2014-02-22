<?php
$loginPage = "index.php";
$bigButtons = array("Login" => "index.php");
$navLinks = array("Home" => "index.php", "Jogar" => "viewJogador.php");

include_once 'templateHead.php';
include_once 'templateBodyHeaderContainer.php';
include_once 'controllerItens.php';
include_once 'itensBE.php';
include_once 'itens_powerBE.php';
include_once 'usuario_itensDAO.php';
include_once 'usuario_itensBE.php';

$controllerItens = new itensController();
$listItens = $controllerItens->listItensDisponiveis($_SESSION["idUsuario"]);
$listItensUsuario = $controllerItens->listItensPorUsuario($_SESSION["idUsuario"]);
?>
<script>
  $(function(){
    var categoriasSelecionadas = new Array();
    $.each($('td[name="categoriaUsuario"]'), function(k,v){
        categoriasSelecionadas.push($(v).html());
    });
    
    $('#formPedido').submit(function(){
        $(this).find(':checkbox').attr("disabled",false);
    });
    
    $('#formPedido tr').click(function() {
        var valorSel =$(this).find('td[name="valorLinha"]').html();
        var valorDisp=eval($('#valorDisponivel').html());
        var valorTotal=eval($('#valorTotal').html());
        var categoria = $(this).find('td[name="categoriaLinha"]').html();
        
        if ($(this).find(':checkbox').is(':checked')) {
            valorDisp = eval(valorDisp) + eval(valorSel);
            valorTotal = eval(valorTotal) - eval(valorSel);
            if(eval(valorDisp) >= 0){
                $(this).find(':checkbox').attr("disabled",false);
                $(this).find(':checkbox').prop("checked",false);
                $(this).find(':checkbox').attr("disabled",true);
                $('#valorDisponivel').html(valorDisp);
                $('#valorTotal').html(valorTotal);
                if(categoriasSelecionadas.indexOf(categoria) !== -1){
                    categoriasSelecionadas.pop(categoria);
                }
            }
        } else {
            if(categoriasSelecionadas.indexOf(categoria) !== -1){
                alert('Permitido apenas 1 item por categoria!');
                return;
            }
            valorDisp = eval(valorDisp) - eval(valorSel);
            valorTotal = eval(valorTotal) + eval(valorSel);
            if(eval(valorDisp) >= 0){
                $('#valorDisponivel').html(valorDisp);
                $('#valorTotal').html(valorTotal);
                $(this).find(':checkbox').attr("disabled",false);
                $(this).find(':checkbox').prop("checked",true);
                $(this).find(':checkbox').attr("disabled",true);
                if(categoriasSelecionadas.indexOf(categoria) === -1){
                    categoriasSelecionadas.push(categoria);
                }
            } else {
                if(eval(valorDisp) < 0){
                    alert('Você não possui saldo suficiente!');
                }
            }
        }
    });
});
</script>
<div class="col-md-6 col-sm-6">
    <div class="news">
        <div class="letter row">
            <div class="col-md-6 col-sm-6">Olá <?php echo $_SESSION["nome"] ?></div>
            <div class="col-md-4 col-sm-4">Saldo Disponível:</div>
            <div class="col-md-2 col-sm-2" style="text-align: right"><label id="valorDisponivel">0</label></div>
        </div>
        <hr/>
        <div class="letter">
            <h4>Produtos disponíveis:</h4>
            <form id="formPedido" role="form" method="POST" action="controllerItemUsuario.php">
                <table class="table table-hover">
                    <tr>
                        <th>Sel.</th>
                        <th>Imagem</th>
                        <th>Descrição</th>
                        <th>Categoria</th>
                        <th>Valor</th>
                    </tr>
                    <?php foreach ($listItens as $key => $value) { 
                            $item = $value->getId_itens_power();
                        ?>
                        <tr>
                            <td>
                                <input type="checkbox" id="item_<?php echo $item->getId_itens_power() ?>" name="item[]" value="<?php echo $item->getId_itens_power() ?>" disabled="disabled">
                            </td>
                            <td>
                                <img src="<?php echo $item->getId_itens()->getPath_image_item() ?>"/>
                            </td>
                            <td><?php echo $item->getId_itens()->getDescricao() ?></td>
                            <td name="categoriaLinha"><?php echo $item->getId_itens()->getCategoria() ?></td>
                            <td name="valorLinha"><?php echo $item->getId_itens()->getValor() ?></td>
                        </tr>
                    <?php } ?>
                        <tr>
                            <td colspan="3" style="text-align: right"><b>Total:</b></td>
                            <td colspan="2" style="text-align: right"><label id="valorTotal">0</label></td>
                        </tr>
                        <tr>
                            <td colspan="5" style="text-align: right">
                                <input type="submit" value="Comprar"/>
                            </td>
                        </tr>
                </table>
            </form>
        </div>
    </div>    
</div>
<div class="col-md-6 col-sm-6">
    <div class="news">
        <div class="letter">
            <h4>Meus Itens</h4>
            <table class="table table-hover">
                <tr>
                    <th> </th>
                    <th>Imagem</th>
                    <th>Descrição</th>
                    <th>Categoria</th>
                </tr>
                <?php foreach ($listItensUsuario as $key => $value) { 
                        $item = $value->getId_itens_power();
                    ?>
                    <tr>
                        <td> </td>
                        <td><img src="<?php echo $item->getId_itens()->getPath_image_item() ?>"/></td>
                        <td><?php echo $item->getId_itens()->getDescricao() ?></td>
                        <td name="categoriaUsuario"><?php echo $item->getId_itens()->getCategoria() ?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>       
    </div>    
</div>
<?php include_once 'templateBodyFooter.php'; ?>
