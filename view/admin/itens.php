<?php
$loginPage = "../../index.php";
$resourcesFolder = "../../resources/";
$controllerFolder = "../../controller";
$bigButtons = array("Logout" => "../../index.php");
$navLinks = array("Itens" => "itens.php",
    "Poderes"=>"poderes.php",
    "Partidas" => "partidas.php",
    "Usuarios" => "usuarios.php");

include_once '../template/head.php';
include_once '../template/bodyHeaderContainer.php';
require_once '../../controller/itensController.php';

require_once '../../persistence/daos/itensDAO.php';
require_once '../../persistence/daos/powerDAO.php';
require_once '../../persistence/daos/itens_powerDAO.php';
require_once '../../persistence/daos/usuario_itensDAO.php';
require_once '../../persistence/daos/entidades/itensBE.php';
require_once '../../persistence/daos/entidades/itens_powerBE.php';
require_once '../../persistence/daos/entidades/powerBE.php';
require_once '../../persistence/daos/entidades/usuario_itensBE.php';

$itensController = new itensController();
$listItens = $itensController->listItens();
$listPowers = $itensController->listPowers();
?>
<div class="col-md-12 col-sm-12">
    <div class="news">
        <div class="letter">
            <table class="table table-hover">
                <tr>
                    <th>Id</th>
                    <th>Descricao</th>
                    <th>Valor</th>
                    <th>Poder</th>
                    <th>Imagem</th>
                </tr>
                <?php foreach ($listItens as $keyItens => $valItens) { ?>
                    <tr>
                        <td><?php echo $valItens->getId_itens() ?></td>
                        <td><?php echo $valItens->getDescricao() ?></td>
                        <td><?php echo $valItens->getValor() ?></td>
                        <td><?php echo "poder" ?></td>
                        <td><?php echo $valItens->getPath_image_item() ?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
    <div class="panel-group col-md-12 col-sm-12" id="accordionItem">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordionItem" href="#collapseOne">
                        <span class="glyphicon glyphicon-plus"></span> Novo Item
                    </a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in">
                <div class="panel-body">
                    <form role="form" method="POST" action="../../controller/insereItem.php" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-8 col-sm-8">
                                <div class="form-group">
                                    <input type="text" name="nome" class="form-control" placeholder="Nome">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="valor" class="form-control" placeholder="Valor">
                                </div>
                                <div class="form-group">
                                    <input type="file" name="iconeItem" class="form-control" placeholder="Imagem">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-default">Inserir</button>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="form-group">
                                    <label>Poder Associado:</label>
                                    <select name="poder" id="comboPowers" class="form-control">
                                        <option value="0">Selecione...</option>
                                        <?php foreach ($listPowers as $keyPower => $valuePower) { ?>
                                            <option value="<?php echo $valuePower->getId_power() ?>"><?php echo $valuePower->getId_power()." - ".$valuePower->getDescricao() ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once '../template/bodyFooter.php'; ?>
