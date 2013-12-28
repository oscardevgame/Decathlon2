<?php
include_once 'persistence/daos/ConexaoBanco.php';
include_once 'persistence/daos/usuariosDAO.php';
include_once 'persistence/daos/entidades/usuariosBE.php';

$resourcesFolder = "resources/";
$controllerFolder = "controller";
$bigButtons = array("Cadastre-se" => "view/public/cadastroUsuario.php");
$navLinks = array();

include_once './view/template/head.php';
include_once './view/template/bodyHeaderContainer.php';
?>
<div class="col-md-7 col-sm-7">
    <div class="intro">
        <h1>Jogo</h1>
        <p>Jogue o Remake do Decathlon, disponível em sua rede social. 
            Com vários itens de ação, seu jogo se tornará especial. 
            Utilize-os da melhor forma possível.
            Tome cuidado com os obstáculos no percurso, seja cauteloso em suas jogadas.
            Evolua sua categoria.
        </p>
        <h1>Power Up's</h1>
        <p>Utilize sua pontuação para adquirir itens como roupas e tênis que aumentarão
            sua performance. Itens de ótima qualidade de nossos patrocinadores.
        </p>
        <h1>Mecânica</h1>
        <p>
            Usando teclado, setas direita/esquerda (mouse) o jogador mexe cada perna.
            Corre 5 vezes e deve recuperar o fôlego durante um intervalo de 30 minutos.
            O clima interfere no corrida.
        </p>
    </div>
</div>
<div class="col-md-5 col-sm-5">
    <div class="news">
        <div class="letter">
            <h3>Interatividade</h3>
            <p>Notifique seus amigos quando houver troca de categoria.
                Alerte seu grupo que está torcendo por um corredor.
                Corra com seus amigos e avise quando ultrapassou sua marca.
            </p>
        </div>
    </div>
    <div class="news">
        <div class="letter">
            <h4>Jogar</h4>
            <form role="form" method="POST" action="controller/autentica.php">
                <div class="form-group">
                    <input type="text" name="email" class="form-control" placeholder="Email">
                </div>
                <div class="form-group">
                    <input type="password" name="senha" class="form-control" placeholder="Senha">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-default">Jogar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include_once './view/template/bodyFooter.php'; ?>