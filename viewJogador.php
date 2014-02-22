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

?>
                <script type="text/javascript"> 
                $.session.clear();
                $.session.set('j_nome',"teste");
					//$.session.set('j_nome',<?php echo "'".$_SESSION["nome"]."'"; ?>);
				</script>

<?PHP

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
            Ol� <?php echo $_SESSION["nome"] ?>
        </div>
        <hr/>
        <div class="letter">
            Itens dispon�veis:
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
                        <script>
 
							$itemsSelecionados = <?php echo $item->getId_itens_power() ?>;

								switch  ($itemsSelecionados)
								{
									case 1:		$.session.set('j_camisa',"#1");	break; //Database 'dbdecathlon.itens' {"id_itens": 1,"descricao": "Camisa vermelha","valor": 0,"categoria": "camisa","path_image_item": "game1/camisa1.png"},
									case 2:		$.session.set('j_camisa',"#2");	break; //Database 'dbdecathlon.itens' {"id_itens": 2,"descricao": "Camisa Amarela","valor": 0,"categoria": "camisa","path_image_item": "game1/camisa2.png"},
									case 3:		$.session.set('j_camisa',"#3");	break; //Database 'dbdecathlon.itens' {"id_itens": 3,"descricao": "Camisa Azul","valor": 0,"categoria": "camisa","path_image_item": "game1/camisa3.png"},
									case 4:		$.session.set('j_camisa',"#4");	break; //Database 'dbdecathlon.itens' {"id_itens": 4,"descricao": "Camisa Verde","valor": 0,"categoria": "camisa","path_image_item": "game1/camisa4.png"},
									case 5:		$.session.set('j_camisa',"#5");	break; //Database 'dbdecathlon.itens' {"id_itens": 4,"descricao": "Camisa Verde","valor": 0,"categoria": "camisa","path_image_item": "game1/camisa4.png"},
									case 6:		$.session.set('j_tipotenis',"#6"); break; //Database 'dbdecathlon.itens' {"id_itens": 6,"descricao": "Tenis Normal","valor": 0,"categoria": "tenis","path_image_item": "game1/tipotenis1.png"}, 
									case 7:		$.session.set('j_tipotenis',"#7"); break; //Database 'dbdecathlon.itens' {"id_itens": 7,"descricao": "Tenis Veloz","valor": 2000,"categoria": "tenis","path_image_item": "game1/tipotenis2.png"}, 
									case 8:		$.session.set('j_tipotenis',"#8"); break; //Database 'dbdecathlon.itens' {"id_itens": 8,"descricao": "Tenis Hiper-veloz","valor": 5000,"categoria": "tenis","path_image_item": "game1/tipotenis3.png"}, 
									case 9:		$.session.set('j_tipotenis',"#9"); break; //Database 'dbdecathlon.itens' {"id_itens": 9,"descricao": "Tenis Aderente","valor": 7000,"categoria": "tenis","path_image_item": "game1/tipotenis4.png"}, 
									case 10:	$.session.set('j_tipotenis',"#10"); break;  //Database 'dbdecathlon.itens' {"id_itens": 10,"descricao": "Tenis Hiper-aderente","valor": 10000,"categoria": "tenis","path_image_item": "game1/tipotenis5.png"},    	
									case 11:	$.session.set('j_suplemento',"#11"); break; //Database 'dbdecathlon.itens' {"id_itens": 11,"descricao": "Água","valor": 0,"categoria": "suplemento","path_image_item": "game1/suplemento1.png"}, 
									case 12:	$.session.set('j_suplemento',"#12"); break; //Database 'dbdecathlon.itens' {"id_itens": 12,"descricao": "Vitaminas","valor": 3000,"categoria": "suplemento","path_image_item": "game1/suplemento2.png"}, 
									case 13:	$.session.set('j_suplemento',"#13"); break; //Database 'dbdecathlon.itens' {"id_itens": 13,"descricao": "Energético","valor": 7000,"categoria": "suplemento","path_image_item": "game1/suplemento3.png"}, 
									case 14:	$.session.set('j_suplemento',"#14"); break; //Database 'dbdecathlon.itens' {"id_itens": 14,"descricao": "Feijão mexicano","valor": 10000,"categoria": "suplemento","path_image_item": "game1/suplemento4.png"},
									case 15:	$.session.set('j_suplemento',"#15"); break; //Database 'dbdecathlon.itens' {"id_itens": 15,"descricao": "Anabolizante","valor": 15000,"categoria": "suplemento","path_image_item": "game1/suplemento5.png"},
									case 16:	$.session.set('j_trapaca',"#16"); break; //Database 'dbdecathlon.itens' {"id_itens": 16,"descricao": "Anjo","valor": 0,"categoria": "trapaca","path_image_item": "game1/tipotrapaca1.png"}, 
									case 17:	$.session.set('j_trapaca',"#17"); break; //Database 'dbdecathlon.itens' {"id_itens": 17,"descricao": "Empurrão","valor": 10000,"categoria": "trapaca","path_image_item": "game1/tipotrapaca2.png"}, 
									case 18:	$.session.set('j_trapaca',"#18"); break; //Database 'dbdecathlon.itens' {"id_itens": 18,"descricao": "Rouba trapaça","valor": 20000,"categoria": "trapaca","path_image_item": "game1/tipotrapaca3.png"}, 
									case 19:	$.session.set('j_trapaca',"#19"); break; //Database 'dbdecathlon.itens' {"id_itens": 19,"descricao": "Desliza","valor": 20000,"categoria": "trapaca","path_image_item": "game1/tipotrapaca4.png"},
									case 20:	$.session.set('j_trapaca',"#20"); break; //Database 'dbdecathlon.itens' {"id_itens": 20,"descricao": "Cria barreira","valor": 30000,"categoria": "trapaca","path_image_item": "game1/tipotrapaca5.png"}]
								};

							</script> 
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
            Corridas Dispon�veis:
        </div>
    </div>    
</div>
<div class="col-md-8 col-sm-8">
    <div id="playground" style="width: 594px; height: 400px; background: black;">
        <div id="welcomeScreen" style="width: 594px; height: 296px; position: absolute; z-index: 100; background-image: url(game1/logo.png); font-family: verdana, sans-serif;">
            <div style="position: absolute; top: 120px; width: 594px; color: white;">
                <div id="loadingBar" style="position: relative; left: 100px; height: 15px; width: 0px; background: red;"></div>
            </div>
        </div>
    </div>       
</div>
<?php include_once 'templateBodyFooter.php'; ?>
