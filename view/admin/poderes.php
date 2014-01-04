<?php
$loginPage = "../../index.php";
$resourcesFolder = "../../resources/";
$controllerFolder = "../../controller";
$bigButtons = array("Logout" => "../../index.php");
$navLinks = array("Itens" => "itens.php",
    "Poderes" => "poderes.php",
    "Partidas" => "partidas.php",
    "Usuarios" => "usuarios.php");

include_once '../template/head.php';
include_once '../template/bodyHeaderContainer.php';
require_once '../../controller/itensController.php';

require_once '../../persistence/daos/powerDAO.php';
require_once '../../persistence/daos/itens_powerDAO.php';
require_once '../../persistence/daos/entidades/powerBE.php';

$itensController = new itensController();
$list = $itensController->listPowers();
?>
<div class="col-md-12 col-sm-12">
    <div class="news">
        <div class="letter">
            <table class="table table-hover">
                <tr>
                    <th>Id</th>
                    <th>Descrição</th>
                </tr>
                <?php foreach ($list as $key => $value) { ?>
                <tr>
                    <td><?php echo $value->getId_power() ?></td>
                    <td><?php echo $value->getDescricao() ?></td>
                </tr>
                <?php } ?>
            </table>
        </div>
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
                            <input type="text" name="descricaoPower" class="form-control" placeholder="Descrição">
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
<?php include_once '../template/bodyFooter.php'; ?>
