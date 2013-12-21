<?php 
	include_once 'persistence/CRUDconexaoBanco.php';
	include_once 'persistence/daos/usuariosDAO.php';
	include_once 'persistence/daos/entidades/usuariosBE.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Decathlon</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Jogo para a disciplina de Jogos Sociais">
		<meta name="keywords" content="decathlon, jogo social">
		<meta name="author" content="Oscar">
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
		

		<!-- JS -->
		<!-- HTML5 Support for IE -->
		<!--[if lt IE 9]>
		  <script src="js/html5shim.js"></script>
		<![endif]-->
		
		<!-- Stylesheets -->
		<link href="resources/styles/bootstrap.min.css" rel="stylesheet">
		
		<!-- Font awesome CSS -->
		<link href="resources/styles/font-awesome.min.css" rel="stylesheet">		
		
		<link href="resources/styles/style.css" rel="stylesheet">

		<!-- Favicons -->
		<link rel="shortcut icon" href="resources/images/decathlon.ico">
		
	</head>

	<body>
	
		<header>
			<div class="navi">
			 <div class="container">
				<div class="navbar navbar-default bs-docs-nav" role="banner">
					<div class="navbar-header">
					  <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					  </button>
					  <a class="navbar-brand" href="#">Cadastre-se!</a>
					</div>
					<nav class="collapse navbar-collapse bs-navbar-collapse navbar-left" role="navigation">
					  <ul class="nav navbar-nav ">
						
						<li class="active">
						  <a href="index.html">Home</a>
						</li>
						<li>
						  <a href="view/404.html">Loja</a>
						</li>
					  </ul>
					</nav>
				</div>
			 </div>
			</div>
			<div class="container">
				<div class="row">
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
							<h4>Jogar!!!</h4>
							<form role="form">
							 <div class="form-group">
							  <input type="text" class="form-control" placeholder="Email">
							 </div>
							 <div class="form-group">
							  <input type="password" class="form-control" placeholder="Senha">
							 </div>
							 <div class="form-group">
							 <button type="submit" class="btn btn-default">Subscribe</button>
							 </div>
							</form>
						</div>
						</div>
					</div>
				</div>
			</div>
		</header>
		<footer>
			<div class="container">
				<div class="row">
				<div class="col-md-6 col-sm-6">Copyright &copy; 2012 - <a href="#">Your Site</a></div>				
				<!-- This theme comes under Creative Commons Attribution 3.0 Unported. So don't remove below link back -->
				<div class="col-md-6 col-sm-6 attr">Designed by <a href="http://responsivewebinc.com/bootstrap-themes">Bootstrap Themes</a></div>
				</div>
				<div class="clearfix"></div>
			</div>
		</footer>		

		<!-- JS -->
		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/html5shim.js"></script>
		<script src="js/respond.min.js"></script>
	</body>
</html>