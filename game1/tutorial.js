//-------------------------------DECATHLON 2 - CORRIDA DE 100 MTS------------PUC PR JOGOS SOCIAIS 2013/2014-------------------



// -----------------------------------------DECLARACAO DAS VARIÁVEIS E CONFIGURAÇÕES INICIAIS

// //---------------------------------------CONFIGURAÇÃO DO LAYOUT (CONSTANTES)
var PLAYGROUND_WIDTH = 594;
var PLAYGROUND_HEIGHT = 400;
var REFRESH_RATE = 30;
var GRACE = 2000; 

// //---------------------------------------PREPARA VARIAVEIS PARA ELEMENTOS DO JOGO
// // // -----------------------------------MATRIZES PARA AS ANIMACOES
var playerAnimation = new Array();
// // // -----------------------------------OBSTACULO E CHEGADA
var obstaculos = new Array(2); 

// // --------------------------------------VARIAVEIS DE ESTADO DO JOGO
var modochegada = false;
var idchegada = null;
var playerHit = false;
var timeOfRespawn = 0;
var gameOver = false;
var teclas_apoio_p1 = 0;
var nextpos = 100;
var nextpos2 = 100;
var posjump = 210;
var jumpstat = 0;
var $tp = 1;
var $tpx = "";
var idPartidaAtual = "";

// // --------------------------------------VARIAVEIS PARA A MANIPULACAO DA GRAVACAO DO TRACKER 
var $gravatracker = new Array();
var pos1 =0;
var pos2 =0;
var $gravou = 0;

// // --------------------------------------VALIAVEIS PARA A MANIPULACAO E LEITURA DO TRACKER PARA PLAYER 2 VIRTUAL
var $carregatracker = new Array();
var $carregou = 0;

// ------------------------------------------CONFIGURACAO DO SOM COM SOUND MANAGER

soundManager.debugMode = false;
var $playmusic = 1;


// --------------------------------------

// // ---------------------------------------OBJETOS DO JOGO
function Player(node) {
	this.node = node;
	this.grace = false;
	this.corredor1 = 1;
	this.respawnTime = -1;
	this.update = 	function(){    	
						if ((this.respawnTime > 0) && (((new Date()).getTime() - this.respawnTime) > 3000)){
							this.grace = false;
							$(this.node).fadeTo(500, 1);
							this.respawnTime = -1;
						};
					};
	return true;
};

// // ---------------------------------------COMPORTAMENTO DOS OBSTACULOS DO JOGO
function obstaculo(node) {
	this.corredor1 = 2;
	this.speedx = -4;
	this.node = $(node);
	this.update = 	function(playerNode) {
						this.updateX(playerNode);
					};
	this.updateX = 	function(playerNode) {
						this.node.x(this.speedx, true);
					};
};

// // ---------------------------------------ALINHAMENTO DOS OBSTACULOS DO JOGO
function barreira(node) {
	this.node = $(node);
	this.speedy = 1;
	this.alignmentOffset = 210;
};


barreira.prototype = new obstaculo();

// --------------------------------------------------------------------------------------------------------------------
// --                                      DECLARACAO PRINCIPAL                                                    --
// --------------------------------------------------------------------------------------------------------------------

var $premio = 5000;

// // -------------------------------------FUNCAO DO BOTAO INICIAR DO JOGO
$(function(){

	
	$("#startbutton").click(function() {
		$.playground().startGame(function() {
			// Incluir uma partida com novo tracker
			if ($carregou === 0){
				$("#welcomeScreen").fadeTo(1000, 0, function() {
					
						if ($gravatracker.length > 64)
						{
							for (i=0; i<$gravatracker.length; i++){
								for (j=0; j<1000; j++){
									$gravatracker.length[i,j] = 0;
								}
							}
							window.location.reload();
						}
						partida={partidaId:$carregatracker}; //partida = {idUsuario:$trackerp2};
						$.ajax({
							dataType: "json",
							url: "controllerRecuperaPartida.php",
							data: partida ,
							type: 'POST',
							
							sucess:
							function(retorno, textStatus, jqXHR){
								console.log("SUCESSO: \nretorno: " + retorno + "\ntext: " + textStatus + "\njqXHR: " + jqXHR);
							},
							
							complete:
								function( jqXHR, textStatus){
								console.log("COMPLETO: \ntext: " + textStatus + "\njqXHR: " +  jqXHR.responseText);
							},
							error: function(jqXHR, textStatus, errorThrown) {
								console.log('Erro no processamento Ajax.\nTextStatus: '+textStatus+'\nerrorThrown: '+errorThrown+"\nResponse:\n"+jqXHR.responseText);
							}
						});
	   			});
	   			$carregou = 1;
			}
		});
	});
	
// ----------------------------------------------CARREGA CENARIO

var background1 = new $.gQ.Animation({imageURL: "game1/background1.png"});
var background2 = new $.gQ.Animation({imageURL: "game1/background2.png"});
playerAnimation["CENTERTUTORIAL"] = new $.gQ.Animation({imageURL: "game1/centertutorial.png", numberOfFrame: 2, delta: 60, rate: 150, type: $.gQ.ANIMATION_VERTICAL});
playerAnimation["CENTERTUTORIAL2"] = new $.gQ.Animation({imageURL: "game1/centertutorial2.png", numberOfFrame: 2, delta: 64, rate: 150, type: $.gQ.ANIMATION_VERTICAL});

// -----------------------------------------------ANIMACAO DO CORREDOR
playerAnimation["PLAYER1CORRE"] = new $.gQ.Animation({imageURL: "game1/competidor1.png", numberOfFrame: 5, delta: 68, rate: 60, type: $.gQ.ANIMATION_VERTICAL});
playerAnimation["PLAYER2CORRE"] = new $.gQ.Animation({imageURL: "game1/competidor2.png", numberOfFrame: 5, delta: 68, rate: 60, type: $.gQ.ANIMATION_VERTICAL});

/*--------------------------- PUXA DO BANCO DE DADOS OU SESSION ------------------------------------------------------------*/
/*--------------------------------------------------------------------------------------------------------------------------*/

//CARREGAMENTO DAS OPCOES DO JOGADOR (CONEXAO COM A BASE E ITENS COMPRADOS NA LOJA VIRTUAL)

// SUBSTITUIR PELO ITENS DA SESSION

var $nomejogador = $.session.get("j_nome");;	//request.getSession().getAttribute("nome"); //DEFINIDO NA CHAMADA DO AJAX
var $nomejogadorcpu = "Player 2"; // SUBSTITUIR PELO DA BASE DE DADOS
//var $usuario = "Usuario"; // SUBSTITUIR PELO DA BASE DE DADOS
//var $ultimaposicao = 1; // SUBSTITUIR PELO DA BASE DE DADOS
//var $urlfotoplayer = "http://localdafoto/foto.png"; // SUBSTITUIR PELO DA BASE DE DADOS
//var $cor_rgb = "255x255x255"; // SUBSTITUIR PELO DA BASE DE DADOS
//var $premio = 5000; // PREMIO POR GANHAR A CORRIDA - PERDE 100 A CADA IMPACTO
		       
var $idcamisa = $.session.get("j_camisa"); // ID 1 a 5 - CATEGORIA CAMISA (ID SELECIONADO PARA ESTA CORRIDA)
switch  ($idcamisa)
{
	case "#1":	$corcamisa = 1;	break; //Database 'dbdecathlon.itens' {"id_itens": 1,"descricao": "Camisa vermelha","valor": 0,"categoria": "camisa","path_image_item": "game1/camisa1.png"},
	case "#2":	$corcamisa = 2;	break; //Database 'dbdecathlon.itens' {"id_itens": 2,"descricao": "Camisa Amarela","valor": 0,"categoria": "camisa","path_image_item": "game1/camisa2.png"},
	case "#3":	$corcamisa = 3;	break; //Database 'dbdecathlon.itens' {"id_itens": 3,"descricao": "Camisa Azul","valor": 0,"categoria": "camisa","path_image_item": "game1/camisa3.png"},
	case "#4":	$corcamisa = 4;	break; //Database 'dbdecathlon.itens' {"id_itens": 4,"descricao": "Camisa Verde","valor": 0,"categoria": "camisa","path_image_item": "game1/camisa4.png"},
	case "#5":	$corcamisa = 5;	break; //Database 'dbdecathlon.itens' {"id_itens": 5,"descricao": "Camisa Rosa","valor": 0,"categoria": "camisa","path_image_item": "game1/camisa5.png"},
	default: $corcamisa = 1;	
};

var $idtipotenis = $.session.get("j_tipotenis");  // ID 6 a 10 CATEGORIA TENIS (ID SELECIONADO PARA ESTA CORRIDA)
switch  ($idtipotenis)
{   
	case "#6":	$tipotenis = 1; break; //Database 'dbdecathlon.itens' {"id_itens": 6,"descricao": "Tenis Normal","valor": 0,"categoria": "tenis","path_image_item": "game1/tipotenis1.png"}, 
	case "#7":	$tipotenis = 2; break; //Database 'dbdecathlon.itens' {"id_itens": 7,"descricao": "Tenis Veloz","valor": 2000,"categoria": "tenis","path_image_item": "game1/tipotenis2.png"}, 
	case "#8":	$tipotenis = 3; break; //Database 'dbdecathlon.itens' {"id_itens": 8,"descricao": "Tenis Hiper-veloz","valor": 5000,"categoria": "tenis","path_image_item": "game1/tipotenis3.png"}, 
	case "#9":	$tipotenis = 4; break; //Database 'dbdecathlon.itens' {"id_itens": 9,"descricao": "Tenis Aderente","valor": 7000,"categoria": "tenis","path_image_item": "game1/tipotenis4.png"}, 
	case "#10": $tipotenis = 5; break;  //Database 'dbdecathlon.itens' {"id_itens": 10,"descricao": "Tenis Hiper-aderente","valor": 10000,"categoria": "tenis","path_image_item": "game1/tipotenis5.png"},
	default: $tipotenis = 1;    	
};

var $idsuplemento = $.session.get("j_suplemento");  // ID 11 a 15 CATEGORIA SUPLEMENTO (ID SELECIONADO PARA ESTA CORRIDA)
switch  ($idsuplemento)
{   
	case "#11":	$tiposuplemento = 1; break; //Database 'dbdecathlon.itens' {"id_itens": 11,"descricao": "Água","valor": 0,"categoria": "suplemento","path_image_item": "game1/suplemento1.png"}, 
	case "#12":	$tiposuplemento = 2; break; //Database 'dbdecathlon.itens' {"id_itens": 12,"descricao": "Vitaminas","valor": 3000,"categoria": "suplemento","path_image_item": "game1/suplemento2.png"}, 
	case "#13":	$tiposuplemento = 3; break; //Database 'dbdecathlon.itens' {"id_itens": 13,"descricao": "Energético","valor": 7000,"categoria": "suplemento","path_image_item": "game1/suplemento3.png"}, 
	case "#14":	$tiposuplemento = 4; break; //Database 'dbdecathlon.itens' {"id_itens": 14,"descricao": "Feijão mexicano","valor": 10000,"categoria": "suplemento","path_image_item": "game1/suplemento4.png"},
	case "#15":	$tiposuplemento = 5; break; //Database 'dbdecathlon.itens' {"id_itens": 15,"descricao": "Anabolizante","valor": 15000,"categoria": "suplemento","path_image_item": "game1/suplemento5.png"},
	default: $tiposuplemento = 1;
};

var $idtrapaca = $.session.get("j_trapaca");  // ID 16 a 20 CATEGORIA TRAPAÇA (ID SELECIONADO PARA ESTA CORRIDA)
switch  ($idtrapaca)
{   
	case "#16":	$tipotrapaca = 1; break; //Database 'dbdecathlon.itens' {"id_itens": 16,"descricao": "Anjo","valor": 0,"categoria": "trapaca","path_image_item": "game1/tipotrapaca1.png"}, 
	case "#17":	$tipotrapaca = 2; break; //Database 'dbdecathlon.itens' {"id_itens": 17,"descricao": "Empurrão","valor": 10000,"categoria": "trapaca","path_image_item": "game1/tipotrapaca2.png"}, 
	case "#18":	$tipotrapaca = 3; break; //Database 'dbdecathlon.itens' {"id_itens": 18,"descricao": "Rouba trapaça","valor": 20000,"categoria": "trapaca","path_image_item": "game1/tipotrapaca3.png"}, 
	case "#19":	$tipotrapaca = 4; break; //Database 'dbdecathlon.itens' {"id_itens": 19,"descricao": "Desliza","valor": 20000,"categoria": "trapaca","path_image_item": "game1/tipotrapaca4.png"},
	case "#20":	$tipotrapaca = 5; break; //Database 'dbdecathlon.itens' {"id_itens": 20,"descricao": "Cria barreira","valor": 30000,"categoria": "trapaca","path_image_item": "game1/tipotrapaca5.png"}]
	default: $tipotrapaca = 1;
};

/*--------------------------------------------------------------------------------------------------------------------------*/

// ITENS AMOSTRA
playerAnimation["CORCAMISA"] = new $.gQ.Animation({imageURL: "game1/cor" + $corcamisa + ".png", numberOfFrame: 5, delta: 60, rate: 150, type: $.gQ.ANIMATION_VERTICAL});
playerAnimation["TIPOTENIS"] = new $.gQ.Animation({imageURL: "game1/tipotenis" + $tipotenis + ".png", numberOfFrame: 1, delta: 60, rate: 150, type: $.gQ.ANIMATION_VERTICAL});
playerAnimation["TIPOSUPLEMENTO"] = new $.gQ.Animation({imageURL: "game1/tiposuplemento" + $tiposuplemento + ".png", numberOfFrame: 5, delta: 60, rate: 150, type: $.gQ.ANIMATION_VERTICAL});
playerAnimation["TIPOTRAPACA"] = new $.gQ.Animation({imageURL: "game1/tipotrapaca" + $tipotrapaca + ".png", numberOfFrame: 1, delta: 60, rate: 150, type: $.gQ.ANIMATION_VERTICAL});
// CAMPO PARA TRACKER

// OBSTACULO:
obstaculos[0] = new Array();
obstaculos[0]["idle"] = new $.gQ.Animation({imageURL: "game1/obstaculo.png", numberOfFrame: 1, delta: 64, rate: 60, type: $.gQ.ANIMATION_VERTICAL});

// INICIALIZA O JOGO
$("#playground").playground({height: PLAYGROUND_HEIGHT, width: PLAYGROUND_WIDTH, keyTracker: true});

// INICIA O CENARIO (background)
$.playground().addGroup("background", {width: PLAYGROUND_WIDTH, height: PLAYGROUND_HEIGHT})

.addSprite("background1", {animation: background1, width: PLAYGROUND_WIDTH, height: PLAYGROUND_HEIGHT})
.addSprite("background2", {animation: background2, width: PLAYGROUND_WIDTH, height: PLAYGROUND_HEIGHT, posx: PLAYGROUND_WIDTH})
.addSprite("centertutorial", {animation: playerAnimation["CENTERTUTORIAL"], posx: 10, posy: 20, width: 60, height: 60})
.addSprite("centertutorial2", {animation: playerAnimation["CENTERTUTORIAL2"], posx: 100, posy: 20, width: 64, height: 64})
.addSprite("corcamisa", {animation: playerAnimation["CORCAMISA"], posx: 0, posy: 300, width: 60, height: 60})
.addSprite("tipotenis", {animation: playerAnimation["TIPOTENIS"], posx: 60, posy: 300, width: 60, height: 60})
.addSprite("tiposuplemento", {animation: playerAnimation["TIPOSUPLEMENTO"], posx: 120, posy: 300, width: 60, height: 60})
.addSprite("tipotrapaca", {animation: playerAnimation["TIPOTRAPACA"], posx: 180, posy: 300, width: 60, height: 60})
.end()

.addGroup("player2", {posx: 115, posy: 205, width: 64, height: 64})
.addSprite("player2Body", {animation: playerAnimation["PLAYER2CORRE"], posx: 0, posy: 0, width: 64, height: 64})
.end()

.addGroup("actors", {width: PLAYGROUND_WIDTH, height: PLAYGROUND_HEIGHT})
.end()

.addGroup("player", {posx: 100, posy: 210, width: 64, height: 64})
.addSprite("playerBody", {animation: playerAnimation["PLAYER1CORRE"], posx: 0, posy: 0, width: 64, height: 64})
.end()

.addGroup("overlay", {width: PLAYGROUND_WIDTH, height: PLAYGROUND_HEIGHT});

$("#player")[0].player = new Player($("#player"));

//ESTAS FUNCOES ESCREVEM NA TELA DO JOGO A VIDA A ENERGIA E OUTROS DADOS DOS CORREDORES
$("#overlay").append("<div id='corredor1HUD'style='color: blue; bottom: 40px; width: 100px; right : 200px; position: absolute; font-family: verdana, sans-serif;'></div><div id='corredor2HUD'style='color: red; bottom: 40px; width: 100px; position: absolute; right: 50px; font-family: verdana, sans-serif;'></div>");
$("#overlay").append('<div style="position: absolute; top: 0px; right: 20px; color: white; font-family: verdana, sans-serif;"><center><h1>PREMIO</h1><h1><a style="cursor: pointer; color: yellow;" id="mensagemcentral"></a></h1></center></div>');

// ESTA E A FUNCAO QUE CONTROLA A MAIORIA DOS EVENTOS DO JOGO
$.playground().registerCallback(
	function() {
	if (!gameOver) {
		//MOVIMENTO DO JOGADOR E PRESSIONAMENTO DE TECLAS
		if (!playerHit) {
			$("#player")[0].player.update();
			if (jQuery.gameQuery.keyTracker[37] && jumpstat === 0) { // PRESSIONA BOTAO ESQUERDA(a)
				teclas_apoio_p1 = 2;
			} else if (jQuery.gameQuery.keyTracker[39] && jumpstat === 0) { // PRESSIONA BOTAO DIREITA(a)
				teclas_apoio_p1--;
			}
			if (teclas_apoio_p1 === 1) { // VALIDA
				teclas_apoio_p1 = 0;
				if ($tipotenis === 1 || $tipotenis === 4 || $tipotenis === 5) nextpos = $("#player").x() + 5; // CASO TIPO DE TENIS = 1,4 ou 5 (NORMAL)
				if ($tipotenis === 2) nextpos = $("#player").x() + 6; // CASO TIPO DE TENIS = 2 (MAIS RAPIDO)
				if ($tipotenis === 3) nextpos = $("#player").x() + 7; // CASO TIPO DE TENIS = 3 (MUITO MAIS RAPIDO E MAIS CARO TAMBEM)
				if ($tiposuplemento === 2) nextpos = nextpos + 2; // CASO TIPO SUPLEMENTO = 2 (ADICIONA 2 PONTOS DE VELOCIDADE INDEPENDENTE DOS OUTROS ITENS COMPRADOS)
				if ($tiposuplemento === 3) nextpos = nextpos + 3; // CASO TIPO SUPLEMENTO = 3 (ADICIONA 3 PONTOS DE VELOCIDADE INDEPENDENTE DOS OUTROS ITENS COMPRADOS)
				if (nextpos < PLAYGROUND_WIDTH) { // MANTEM POSICAO DO JOGAR DENTRO DO CAMPO DO JOGO A ESQUERDA
					$("#player").x(nextpos);
				}
			}

			if ($("#player").x() > $("#player2").x()) {
				$("#corredor1HUD").html($nomejogador + " " + "Posicao 1 " + " ** " + $("#player").x());
				$("#corredor2HUD").html($nomejogadorcpu + " " + "Posicao 2 " + " >> " + $("#player2").x());
			} else {
				$("#corredor1HUD").html($nomejogador + " " + "Posicao 2 " + " ** " + $("#player").x());
				$("#corredor2HUD").html($nomejogadorcpu + " " + "Posicao 1 " + " >> " + $("#player2").x());
			}

			$("#mensagemcentral").html($premio);
			if ($("#player").x() > PLAYGROUND_WIDTH - 50) {
				gameOver = true;
			}
			if ($("#player2").x() > PLAYGROUND_WIDTH - 50) {
				gameOver = true;
			}
		}

//------------------------------------- LOGICA DO SALTO SOBRE AS BARREIRAS ---------------------------------------------
//----------------------------------------------------------------------------------------------------------------------

		if (jQuery.gameQuery.keyTracker[13] && posjump === 210)	{
			jumpstat = 1;
			soundManager.createSound({
				  id:'pulo',
				  url:'game1/jump.wav',
				  loops:1,
				  autoLoad:true,
				  onload:function() {
				   		this.play();
				  }
			});	
		}
		
		if (jumpstat > 0) {
		//	jumpstat = jumpstat; // usado para paralizar o codigo durante o debug, para testes de pulo
		}

		if (jumpstat === 1)	{
			posjump = posjump - 3;
			$("#player").y(posjump);
		}

		if ($tiposuplemento === 4)
		if (posjump < 150) jumpstat = 2; // CASO SUMPLEMENTO == 4 (PULOS MAIS ALTOS)
		if ($tiposuplemento === 5)
		if (posjump < 140) jumpstat = 2; // CASO SUMPLEMENTO == 5 (PULOS AINDA MAIS ALTOS)
		if ($tiposuplemento !== 4 && $tiposuplemento !== 5)
		if (posjump < 170) jumpstat = 2; // CASO SUMPLEMENTO == 1 2 ou 3

		if (jumpstat === 2)	{
			posjump = posjump + 3;
			$("#player").y(posjump);
		}

		if (posjump >= 210){
			jumpstat = 0;	
			$("#player").y(210);
		} 
		
		
		
//----------------------------------------------------------------------------------------------------------------------
//------------------------------------- FIM DA LOGICA DO SALTO SOBRE AS BARREIRAS --------------------------------------

//--------------------------------INICIO DA LOGICA DA COLISAO DAS BARREIRAS COM O CORREDOR -----------------------------
//----------------------------------------------------------------------------------------------------------------------
			$(".obstaculo").each(
				function() {
					this.obstaculo.update($("#player"));
					//var posx = $(this).x();
			        var posx = $(".obstaculo").x();
					//if ((posx + 100) < 0) {
					if (posx < 100) {
						$(this).remove();
						return;
			        }

					//TESTE DE COLISOES
					var $collided = $(this).collision("#playerBody,." + $.gQ.groupCssClass);
					if ($collided.length > 0) {
						if (jumpstat === 0) 	{// CASO NAO ESTEJA PULANDO,  QUEBRA A BARREIRA
							$(this).setAnimation(
								//obstaculos[0]["explode"], 
								function(node) {
									$(node).remove();
								}
							);
							$(this).css("width", 210);
							$(this).removeClass("obstaculo");
						}// E FORCADO A PERDER VELOCIDADE VOLTANDO POSICOES PARA ESQUERDA
	
						if ($tipotenis !== 4 && $tipotenis !== 5 && jumpstat === 0) nextpos = $("#player").x() - 50; // CASO TIPO DE TENIS <> 4 (RESISTENCIA NORMAL)
						if ($tipotenis === 4 && jumpstat === 0) nextpos = $("#player").x() - 25; // CASO TIPO DE TENIS == 4 (MAIOR RESISTENCIA ESTABILIDADE)
						if ($tipotenis === 5 && jumpstat === 0) nextpos = $("#player").x() - 20; // CASO TIPO DE TENIS == 5 (SUPER RESISTENCIA A OBSTACULOS)
						if (jumpstat === 0 && $premio > 0) $premio = $premio - 100; // perde 100 por colidir com a barreira
						if (nextpos > 0) { // MANTEM POSICAO DO JOGAR DENTRO DO CAMPO DO JOGO A ESQUERDA
							$("#player").x(nextpos);
						}
					}
					
					var $collided2 = $(this).collision("#player2Body,." + $.gQ.groupCssClass);
	
					if ($collided2.length > 0) {
						$(this).setAnimation(
							//obstaculos[0]["explode"], 
							function(node) {
								$(node).remove();
							}
						);	
						$(this).css("width", 210);
						$(this).removeClass("obstaculo");
	
						// E FORCADO A PERDER VELOCIDADE VOLTANDO 1 PONTO PARA ESQUERDA
						nextpos2 = $("#player2").x() - 50;
	
						// MANTEM POSICAO DO JOGAR DENTRO DO CAMPO DO JOGO A ESQUERDA
						if (nextpos2 > 0) { 
							$("#player2").x(nextpos2);
						}
					}
				}
			);
		}
		

		//*************************  mostra valores de variaveis para teste ****************************************
		$valorvar = "..."; // insira aqui o nome da variavel		
		$("#overlay").append("<div id='mostravalordavariavel'style='color: blue; top: 40px; width: 100px; position: middle; font-family: verdana, sans-serif;'></div>");
		$("#mostravalordavariavel").html($valorvar);
		
		//***************************************************  TRACKER *******************************************************

		if (pos2 < 1000){
		//******************************************* RECUPERACAO DO TRACKER P2 **********************************************
				$gravatracker[pos1,pos2] = $("#player").x();
				$("#player2").x($carregatracker[pos1,pos2]);
				pos2++;
				$gravatracker[pos1,pos2] = $("#player").y();
				
				$("#player2").y($carregatracker[pos1,pos2]);
				pos2++;
		//**********************************************************************************************************************
			}else{
				pos1++;
				pos2 = 0;
		}
	},	REFRESH_RATE
);

//------------ESTA FUNÇÃO TESTA SE É FIM DO JOGO E CRIA OBSTACULOS ENQUANTO A CORRIDA NAO TIVER ACABADO------------
	$.playground().registerCallback(
		function() {

			if (!gameOver) {// SE AINDA N�O HOUVER VENCEDOR
				if ($playmusic === 1){
					soundManager.createSound({
						  id:'loopTest',
						  url:'game1/music.mp3',
						  loops:3,
						  autoLoad:true,
						  onload:function() {
						   		this.play();
						  }
					});	
					$playmusic = 0;
				}
				var name = "obstaculo1_" + Math.ceil(Math.random() * 1000); //cria barreiras com nomes aleatorios
				$("#actors").addSprite(name, {animation: obstaculos[0]["idle"], posx: PLAYGROUND_WIDTH, posy: 235, width: 16, height: 64});// configura a animacao e tamanho da barreira criada
				$("#" + name).addClass("obstaculo"); //adiciona a barreira a classe obstaculo
				$("#" + name)[0].obstaculo = new barreira($("#" + name)); //instancia a barreira criada como um obstaculo
			} else { 
				$("#playground").append('<div style="position: absolute; top: 50px; width: 570px; color: white; font-family: verdana, sans-serif;"><center><h1>Game Over</h1><br><a style="cursor: pointer;" id="restartbutton">FIM DE JOGO</a></center></div>');

				//Incluir uma partida com novo tracker
				if ($gravou === 0) {
					$tracker = $gravatracker;
					partida = {pontuacao:$premio,dataTracker:$tracker};
					$.ajax({

						dataType: "json",
						url: "controllerInserePartida.php",
						data: partida ,
						type: 'POST',
						
						success:
						function(json){
							alert("Certo: " + json);
						},
						
						error:
						function(jqXHR, textStatus, errorThrown) {
							console.log('Erro no processamento Ajax.\nTextStatus: '+textStatus+'\nerrorThrown:'+errorThrown+"\nResponse:\n"+jqXHR.responseText);
						}
					});
					$gravou = 1;
					$carregou = 0;
				}
			}
		}, 2000	//UMA BARREIRA A CADA 2 SEGUNDOS 
				
	); 
	
//---------------------------------------------------ANIMAÇÃO DO CENARIO-----------------------------------------------------------
	//TAMANHO TOTAL DO CENARIO:
	$.playground().registerCallback(
		function() {
				var newPos = ($("#background1").x() - 4 - PLAYGROUND_WIDTH) % (1 * PLAYGROUND_WIDTH) + PLAYGROUND_WIDTH;
				$("#background1").x(newPos);
				newPos = ($("#background2").x() - 4 - PLAYGROUND_WIDTH) % (1 * PLAYGROUND_WIDTH);
				$("#background2").x(newPos);
		}, REFRESH_RATE
	);
//---------------------------------------------------------------------------------------------------------------------------------
});

