<?php
#########################################
# CTASoftware							#
# Autor: Everton Gon�alves				#
# http://www.ctasoftware.com.br			#
# E-mail: everton@ctasoftware.com.br	#
#########################################

/*
* Classe conex�o DAO
* -------------------------------------
*/

class conexaoBanco{

	public $pdo = NULL;

	public function conectar(){
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
}
?>
