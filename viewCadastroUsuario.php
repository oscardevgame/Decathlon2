<?php
include_once 'ConexaoBanco.php';
include_once 'usuariosDAO.php';
include_once 'usuariosBE.php';

$loginPage = "index.php";
$bigButtons = array("Login" => "index.php");
$navLinks = array("Home" => "index.php");

include_once 'templateHead.php';
include_once 'templateBodyHeaderContainer.php';
?>
<div class="col-md-7 col-sm-7">
    <div class="news">
        <div class="letter">
            <h4>Cadastro</h4>
            <form role="form" method="POST" action="controllerInsereUsuario.php" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="text" name="nome" class="form-control" placeholder="Nome">
                </div>
                <div class="form-group">
                    <input type="text" name="email" class="form-control" placeholder="Email">
                </div>
                <div class="form-group">
                    <input type="password" name="senha" class="form-control" placeholder="Senha">
                </div>
                <div class="form-group">
                    <input type="password" name="senhaConfirm" class="form-control" placeholder="Confirme a Senha">
                </div>
                <div class="form-group">
                    <input type="text" name="facebook" class="form-control" placeholder="facebook">
                </div>
                <div class="form-group">
                    <input type="file" name="avatar" class="form-control" placeholder="minha foto">
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-default">Inserir</button>
                </div>
            </form>
        </div>
    </div>    
</div>
<?php include_once 'templateBodyFooter.php'; ?>
