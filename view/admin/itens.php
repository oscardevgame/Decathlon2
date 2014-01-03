<?php
$loginPage = "../../index.php";
$resourcesFolder = "../../resources/";
$controllerFolder = "../../controller";
$bigButtons = array("Logout" => "../../index.php");
$navLinks = array("Itens" => "itens.php",
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
            <?php foreach ($listItens as $keyItens => $valItens) { ?>
                <?php foreach ($valItem as $keyItem => $valItem) { ?>

                <?php } ?>
            <?php } ?>
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
                                    <input type="text" name="valor" class="form-control" placeholder="Valor">
                                </div>

                                <div class="form-group">
                                    <input type="file" name="imagem" class="form-control" placeholder="Imagem">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-default">Inserir</button>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="form-group">
                                    <label>Poder Associado:</label>
                                    <select id="comboPowers" class="form-control">
                                        <option value="0">Selecione...</option>
                                        <?php foreach ($listPowers as $keyPower => $valuePower) { ?>
                                            <option value="<?php echo $valuePower->getId_power() ?>"><?php $valuePower->getDescricao() ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="panel-group" id="accordionPower">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordionPower" href="#collapseTwo">
                                                    <span class="glyphicon glyphicon-plus"></span> Novo Poder
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseTwo" class="panel-collapse collapse out">
                                            <div class="panel-body">
                                                <form role="form" method="POST" action="../../controller/inserePoder.php">
                                                    <div class="form-group">
                                                        <input type="text" name="descrição" class="form-control" placeholder="Descrição">
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-default">Inserir</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
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
