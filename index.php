<?php
include_once 'conexaoBanco.php';
include_once 'usuariosDAO.php';
include_once 'usuariosBE.php';

$resourcesFolder = "resources/";
$bigButtons = array("Cadastre-se" => "viewCadastroUsuario.php");
$navLinks = array();

include_once 'templateHead.php';
include_once 'templateBodyHeaderContainer.php';


//PARTE DO FACEBOOK
// Faz o include do arquivo
require 'fb-php-sdk/facebook.php';
// Veja as informa��es a seguir nas configura��es do aplicativo.
$app_id = '590156727665450';
$app_secret = '02931210c5903b3616c62d42fb7aad4c';
$app_url = 'http:apps.facebook.com/testeprototipo' . $app_namespace = 'testeprototipo';
// Quais s�o as a��es que o aplicativo pode realizar
$scope = 'email,publish_actions';
//Inicializa o Facebook
$facebook = new Facebook(array(
		'appId' => $app_id,
		'secret' => $app_secret,
));

$user = $facebook->getUser();
 
if(!$user){
	$loginUrl = $facebook->getLoginUrl(array(
			'scope'=> $scope,
			'redirect_url' => $app_url,
	));
	print('<script> top.location.href=\'' . $loginUrl . '\'</script>');
}
//FIM PARTE DO FACEBOOK


?>
<div class="col-md-7 col-sm-7">
    <div class="intro">
        <h1>Jogo</h1>
        <p>Jogue o Remake do Decathlon, dispon�vel em sua rede social. 
            Com v�rios itens de a��o, seu jogo se tornar� especial. 
            Utilize-os da melhor forma poss�vel.
            Tome cuidado com os obst�culos no percurso, seja cauteloso em suas jogadas.
            Evolua sua categoria.
        </p>
        <h1>Power Up's</h1>
        <p>Utilize sua pontua��o para adquirir itens como roupas e t�nis que aumentar�o
            sua performance. Itens de �tima qualidade de nossos patrocinadores.
        </p>
        <h1>Mec�nica</h1>
        <p>
            Usando teclado, setas direita/esquerda (mouse) o jogador mexe cada perna.
            Corre 5 vezes e deve recuperar o f�lego durante um intervalo de 30 minutos.
            O clima interfere no corrida.
        </p>
    </div>
</div>
<div class="col-md-5 col-sm-5">
    <div class="news">
        <div class="letter">
            <h3>Interatividade</h3>
            <p>Notifique seus amigos quando houver troca de categoria.
                Alerte seu grupo que est�o torcendo por um corredor.
                Corra com seus amigos e avise quando ultrapassou sua marca.
            </p>
        </div>
    </div>
    <div class="news">
        <div class="letter">
            <h4>Jogar</h4>
            <form role="form" method="POST" action="controllerAutentica.php">
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
<div id="fb-root"></div>
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          appId      : 590156727665450,
          status     : true,
          xfbml      : true,
          cookie	 : true
        });
      };

      (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement(s); js.id = id;
         js.src = "//connect.facebook.net/en_US/all.js";
         fjs.parentNode.insertBefore(js, fjs);
       }(document, 'script', 'facebook-jssdk'));
    </script>
<?php include_once 'templateBodyFooter.php'; ?>