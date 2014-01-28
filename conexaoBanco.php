<?php
#########################################
# CTASoftware							#
# Autor: Everton Gon�alves				#
# http://www.ctasoftware.com.br			#
# E-mail: everton@ctasoftware.com.br	#
#########################################

/*
* Classe conexao DAO
* -------------------------------------
*/

class conexaoBanco{

	public $pdo = NULL;

	public function conectar(){
		if (strpos($_SERVER['SERVER_NAME'], 'decathlon.bl.ee') !== false) {
			$this->conectarRemoto();
		}else{
			$this->conectarLocal();
		}
	}
	
	function conectarLocal(){
		// Conexao com MySQL via PDO
		$dsn = 'mysql:host=localhost;port=3306;dbname=DBDecathlon';
		$usuario = 'root';
		$senha = '';
		$opcoes = array(
			PDO::ATTR_PERSISTENT => true,
			PDO::ATTR_CASE => PDO::CASE_LOWER,
                        PDO::ATTR_EMULATE_PREPARES => true,
                        PDO::ERRMODE_WARNING => true, 
                        PDO::ERRMODE_EXCEPTION => true
		);

		try {
			$this->pdo = new PDO($dsn, $usuario, $senha, $opcoes);
		} catch (PDOException $e) {
			echo 'Erro: '.$e->getMessage();
		}
	}
	
	function conectarRemoto(){
		// Conexao com MySQL via PDO
		$dsn = 'mysql:host=mysql.hostinger.com.br;port=3306;dbname=u893297990_deca';
		$usuario = 'u893297990_root';
		$senha = 'decaroot';
		$opcoes = array(
			PDO::ATTR_PERSISTENT => true,
			PDO::ATTR_CASE => PDO::CASE_LOWER,
                        PDO::ATTR_EMULATE_PREPARES => true,
                        PDO::ERRMODE_WARNING => true, 
                        PDO::ERRMODE_EXCEPTION => true
		);

		try {
			$this->pdo = new PDO($dsn, $usuario, $senha, $opcoes);
		} catch (PDOException $e) {
			echo 'Erro: '.$e->getMessage();
		}
	}
}
?>
