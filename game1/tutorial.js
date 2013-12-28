// CONSTANTES

var PLAYGROUND_WIDTH	= 594;
var PLAYGROUND_HEIGHT	= 400; //296;
var REFRESH_RATE		= 15;

var GRACE		= 2000;

// MATRIZES PARA AS ANIMACOES
var playerAnimation = new Array();
var obstaculos = new Array(2); // OBSTACULO E CHEGADA

// ESTADO DO JOGO
var modochegada = false;
var idchegada = null;
var playerHit = false;
var timeOfRespawn = 0;
var gameOver = false;
var teclas_apoio_p1 = 0;

// OUTRAS FUNCOES

// REINICIAR O JOGO
function restartgame(){
	window.location.reload();
};

// OBJETOS DO JOGO
function Player(node){

	this.node = node;
	this.grace = false;
	this.corredor1 = 1; 
	this.corredor2 = 1; 
	this.respawnTime = -1;
	
	this.update = function(){
		if((this.respawnTime > 0) && (((new Date()).getTime()-this.respawnTime) > 3000)){
			this.grace = false;
			$(this.node).fadeTo(500, 1); 
			this.respawnTime = -1;
		}
	}
	return true;
}

function obstaculo(node){
	this.corredor1	= 2;
	this.speedx	= -4;
	this.speedy	= 0;
	this.node = $(node);
	
	
	// ATUALIZA A POSICAO DO OBSTACULO
	this.update = function(playerNode){
		this.updateX(playerNode);
		this.updateY(playerNode);
	};	
	this.updateX = function(playerNode){
		this.node.x(this.speedx, true);
	};

}

function barreira(node){
	this.node = $(node);

	this.speedy = 1;
	this.alignmentOffset = 210;
}
barreira.prototype = new obstaculo();
barreira.prototype.updateY = function(playerNode){
	if((this.node.y()+this.alignmentOffset) > $(playerNode).y()){
		this.node.y(this.speedy - 1, true);
	} else if((this.node.y()+this.alignmentOffset) < $(playerNode).y()){
		this.node.y(this.speedy, true);
	}
}

function Bossy(node){
	this.node = $(node);
	this.corredor1	= 20;
	this.speedx = -1;
	this.alignmentOffset = 210;
}
Bossy.prototype = new barreira();
Bossy.prototype.updateX = function(){
	if(this.node.x() > (PLAYGROUND_WIDTH - 200)){
		this.node.x(this.speedx, true)
	}
}

// --------------------------------------------------------------------------------------------------------------------
// --                                      DECLARACAO PRINCIPAL                                                    --
// --------------------------------------------------------------------------------------------------------------------
$(function(){
	
	// CARREGA CENARIO
	var background1 = new $.gQ.Animation({imageURL: "background1.png"});
	var background2 = new $.gQ.Animation({imageURL: "background2.png"});  
	playerAnimation["CENTERTUTORIAL"]  = new $.gQ.Animation({imageURL: "centertutorial.png", numberOfFrame:2, delta: 60, rate: 150, type: $.gQ.ANIMATION_VERTICAL});
	// ANIMACAO DO CORREDOR
	playerAnimation["PLAYER1CORRE"] = new $.gQ.Animation({imageURL: "competidor1.png", numberOfFrame:5, delta: 68, rate: 60, type: $.gQ.ANIMATION_VERTICAL});
	playerAnimation["PLAYER2CORRE"] = new $.gQ.Animation({imageURL: "competidor2.png", numberOfFrame:5, delta: 68, rate: 60, type: $.gQ.ANIMATION_VERTICAL});

	// ITENS AMOSTRA
	// nome jogador
	// usuário
	// ultima posicao
	// foto player
	// COR DA ROUPA // RGB 
	playerAnimation["CORCAMISA"]  = new $.gQ.Animation({imageURL: "centertutorial.png", numberOfFrame:2, delta: 60, rate: 150, type: $.gQ.ANIMATION_VERTICAL});
	playerAnimation["TIPOTENIS"]  = new $.gQ.Animation({imageURL: "centertutorial.png", numberOfFrame:2, delta: 60, rate: 150, type: $.gQ.ANIMATION_VERTICAL});
    playerAnimation["TIPOSUPLEMENTO"]  = new $.gQ.Animation({imageURL: "centertutorial.png", numberOfFrame:2, delta: 60, rate: 150, type: $.gQ.ANIMATION_VERTICAL});
    playerAnimation["TIPOTRAPACA"]  = new $.gQ.Animation({imageURL: "centertutorial.png", numberOfFrame:2, delta: 60, rate: 150, type: $.gQ.ANIMATION_VERTICAL});
	// CAMPO PARA TRACKER

	// OBSTACULO:
	obstaculos[0] = new Array();
	obstaculos[0]["idle"]	= new $.gQ.Animation({imageURL: "obstaculo.png", numberOfFrame: 1, delta: 64, rate: 60, type: $.gQ.ANIMATION_VERTICAL});
	
	// INICIALIZA O JOGO
	$("#playground").playground({height: PLAYGROUND_HEIGHT, width: PLAYGROUND_WIDTH, keyTracker: true});
				
	// INICIA O CENARIO (background)
	$.playground().addGroup("background", {width: PLAYGROUND_WIDTH, height: PLAYGROUND_HEIGHT})
						.addSprite("background1", {animation: background1, width: PLAYGROUND_WIDTH, height: PLAYGROUND_HEIGHT})
						.addSprite("background2", {animation: background2, width: PLAYGROUND_WIDTH, height: PLAYGROUND_HEIGHT, posx: PLAYGROUND_WIDTH})
//						.addSprite("centertutorial", {animation: centertutorial, width: 64, height: 64})
						.addSprite("centertutorial",{animation: playerAnimation["CENTERTUTORIAL"], posx: 260, posy: 10, width: 60, height: 60})
					.end()
					.addGroup("actors", {width: PLAYGROUND_WIDTH, height: PLAYGROUND_HEIGHT})
						.addGroup("player", {posx: 100, posy: 200, width: 64, height: 64})
							.addSprite("playerBody",{animation: playerAnimation["PLAYER1CORRE"], posx: 0, posy: 0, width: 64, height: 64})
						.end()
						.addGroup("player2", {posx: 110, posy: 210, width: 64, height: 64})
							.addSprite("player2Body",{animation: playerAnimation["PLAYER2CORRE"], posx: 0, posy: 0, width: 64, height: 64})
						.end()
					.end()

					.addGroup("overlay",{width: PLAYGROUND_WIDTH, height: PLAYGROUND_HEIGHT});
	
	$("#player")[0].player = new Player($("#player"));
	
	//ESTAS FUNCOES ESPECIFICAM A VIDA E A ENERGIA DO JOGADOR
	$("#overlay").append("<div id='corredor1HUD'style='color: white; width: 100px; position: absolute; font-family: verdana, sans-serif;'></div><div id='corredor2HUD'style='color: white; width: 100px; position: absolute; right: 0px; font-family: verdana, sans-serif;'></div>")
	
	// ESTIPULA O TAMANHO DA BARRA DE CARREGAMENTO
	$.loadCallback(function(percent){
		$("#loadingBar").width(400*percent);
	});
	
	//FUNCAO DO BOTAO INICIAR DO JOGO
	$("#startbutton").click(function(){
		$.playground().startGame(function(){
			$("#welcomeScreen").fadeTo(1000,0,function(){$(this).remove();});
		});
	})
	
	// ESTA E A FUNCAO QUE CONTROLA A MAIORIA DOS EVENTOS DO JOGO
	$.playground().registerCallback(function(){
		if(!gameOver){

			//MOVIMENTO DO JOGADOR E PRESSIONAMENTO DE TECLAS
			if(!playerHit){
				$("#player")[0].player.update();

				if(jQuery.gameQuery.keyTracker[37]){ // PRESSIONA BOTAO ESQUERDA(a)
					teclas_apoio_p1 = 2
				}else if(jQuery.gameQuery.keyTracker[39]){ // PRESSIONA BOTAO DIREITA(a)
					teclas_apoio_p1--
				}
				if(teclas_apoio_p1 == 1){ // VALIDA
					teclas_apoio_p1 = 0
					var nextpos = $("#player").x()+5;
					if(nextpos < PLAYGROUND_WIDTH){ // MANTEM POSICAO DO JOGAR DENTRO DO CAMPO DO JOGO A ESQUERDA
						$("#player").x(nextpos);
					}
				}
					
				if(jQuery.gameQuery.keyTracker[13]){ // PLAYER 2 AUTOMATICO
					var nextpos2 = $("#player2").x()+1;
					if(nextpos2 < PLAYGROUND_WIDTH){ // MANTEM POSICAO DO JOGAR DENTRO DO CAMPO DO JOGO A DIREITA
						$("#player2").x(nextpos2);
					}
				} 
				if($("#player").x() > $("#player2").x()){
					$("#corredor1HUD").html("Corredor 1: "+"Posicao 1 "+$("#player").x());
					$("#corredor2HUD").html("Corredor 2: "+"Posicao 2 "+$("#player2").x());
				}else{
					$("#corredor1HUD").html("Corredor 1: "+"Posicao 2 "+$("#player").x());
					$("#corredor2HUD").html("Corredor 2: "+"Posicao 1 "+$("#player2").x());
				}
				
			
				if($("#player").x() > PLAYGROUND_WIDTH-50){
					gameOver = true;
				}
				if($("#player2").x() > PLAYGROUND_WIDTH-50){
					gameOver = true;
				} 	
			}
			//ATUALIZA A COLISAO DAS BARREIRAS COM O CORREDOR
			$(".obstaculo").each(function(){
					this.obstaculo.update($("#player"));
					var posx = $(this).x();
					if((posx + 100) < 0){
						$(this).remove();
						return;
					}
					//TESTE DE COLISOES
					var collided = $(this).collision("#playerBody,."+$.gQ.groupCssClass);
					if(collided.length > 0){
						$(this).setAnimation(obstaculos[0]["explode"], function(node){$(node).remove();});
						$(this).css("width", 210);
						$(this).removeClass("obstaculo");
						// E FORCADO A PERDER VELOCIDADE VOLTANDO 1 PONTO PARA ESQUERDA
						nextpos = $("#player").x()-50;
						if(nextpos > 0){ // MANTEM POSICAO DO JOGAR DENTRO DO CAMPO DO JOGO A ESQUERDA
							$("#player").x(nextpos);
						}
					}
					var collided2 = $(this).collision("#player2Body,."+$.gQ.groupCssClass);
					if(collided2.length > 0){
						$(this).setAnimation(obstaculos[0]["explode"], function(node){$(node).remove();});
						$(this).css("width", 210);
						$(this).removeClass("obstaculo");
						// E FORCADO A PERDER VELOCIDADE VOLTANDO 1 PONTO PARA ESQUERDA
						nextpos = $("#player2").x()-50;
						if(nextpos > 0){ // MANTEM POSICAO DO JOGAR DENTRO DO CAMPO DO JOGO A ESQUERDA
							$("#player2").x(nextpos);
						}
					}
				});
			

		}
	}, REFRESH_RATE);
	
	//ESTA FUN��O CRIA AS BARREIRAS ALEATORIAMENTE
	$.playground().registerCallback(function(){
		if(!gameOver){
			if(Math.random() < 0.4){
				var name = "obstaculo1_"+Math.ceil(Math.random()*1000);
				$("#actors").addSprite(name, {animation: obstaculos[0]["idle"], posx: PLAYGROUND_WIDTH, posy: 210,width: 64, height: 64});
				$("#"+name).addClass("obstaculo");
				$("#"+name)[0].obstaculo = new barreira($("#"+name));
			}
		}else{
			$("#playground").append('<div style="position: absolute; top: 50px; width: 570px; color: white; font-family: verdana, sans-serif;"><center><h1>Game Over</h1><br><a style="cursor: pointer;" id="restartbutton">FIM DE JOGO</a></center></div>');
			//$("#playground").append('<div style="position: absolute; top: 50px; width: 700px; color: white; font-family: verdana, sans-serif;"><center><h1>Game Over</h1><br><a style="cursor: pointer;" id="restartbutton">Corredor 2 Venceu!</a></center></div>');
			$("#restartbutton").click(restartgame);
		}
		
	}, 1000); //UMA POR SEGUNDO
	
	
	//ANIMA��O DO CENARIO
	$.playground().registerCallback(function(){
		//TAMANHO TOTAL DO CENARIO:
		var newPos = ($("#background1").x() - 4 - PLAYGROUND_WIDTH) % (1 * PLAYGROUND_WIDTH) + PLAYGROUND_WIDTH;
		$("#background1").x(newPos);
		newPos = ($("#background2").x() - 4 - PLAYGROUND_WIDTH) % (1 * PLAYGROUND_WIDTH);
		$("#background2").x(newPos);
	}, REFRESH_RATE);
	
});

