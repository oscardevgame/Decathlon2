<?php
#########################################
# CTASoftware                           #
# Autor: Everton Gon�alves              #
# http://www.ctasoftware.com.br         #
# E-mail: everton@ctasoftware.com.br    #
#########################################

require_once 'conexaoBanco.php';
require_once 'entidades/usuario_itensBE.php';

class usuario_itensDAO{

    /*
    * Altera
    * Recebe array como parametro
    */
    public function Update($dados){

        $retorno = 0;

        # Faz conex�o
        $conexao = new conexaoBanco();
        $conexao->conectar();

        # Executa comando SQL
        $stmt = $conexao->pdo->prepare('UPDATE usuario_itens SET id_usuario = ?, id_itens = ?, situacao = ?  WHERE id_power = ?');

        # Seta Atributos nulos


        # Parametros
        $stmt->bindValue(4,$dados->getId_power());
        $stmt->bindValue(1,$dados->getId_usuario());
        $stmt->bindValue(2,$dados->getId_itens());
        $stmt->bindValue(3,$dados->getSituacao());


        try{
            $retorno = $stmt->execute();
        }
        catch (PDOException $e) {
            echo 'Erro: '.$e->getMessage();
            $retorno = -1;
        }

        return $retorno;
    }
    /*
    * M�todo de Inclus�o
    * Insere dados recebendo valores via par�metro
    * ---------------------------------------------
    */
    public function incluir($dados){
        # Faz conex�o
        $conexao = new conexaoBanco();
        $conexao->conectar();

        try{
            $stmt = $conexao->pdo->prepare('INSERT INTO usuario_itens (id_usuario, id_itens, situacao) VALUES (?,?,?)');



			$stmt->bindValue(1,$dados->getId_usuario());
			$stmt->bindValue(2,$dados->getId_itens());
			$stmt->bindValue(3,$dados->getSituacao());

            $retorno = $stmt->execute();
        }
        catch ( PDOException $ex ){  
            echo 'Erro: ' . $ex->getMessage(); 
        }

        return $retorno;
    }
    /*
    * Obtem por Pk
    */
    public function ObterPorPK($pk){

    	# Faz conex�o
	    $conexao = new conexaoBanco();
	    $conexao->conectar();

	    # Executa comando SQL
	    $stmt = $conexao->pdo->prepare('SELECT id_power, id_usuario, id_itens, situacao FROM usuario_itens WHERE id_power = ? ');

	    # Passando os valores a serem usados
    	$dados = array($pk);
    	$stmt->execute($dados);
    	$retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);

    	#Inst�ncia da entidade
    	$usuario_itensBE = new usuario_itensBE();

    	foreach( $retorno as $row ){

    		#Atribui valores
		    $usuario_itensBE->setId_power($row['id_power']);
		    $usuario_itensBE->setId_usuario($row['id_usuario']);
		    $usuario_itensBE->setId_itens($row['id_itens']);
		    $usuario_itensBE->setSituacao($row['situacao']);
    	}

    	return $usuario_itensBE;
    }
    /*
    * Obtem todos
    */
    public function ObterPorTodos(){

    	# Faz conex�o
    	$conexao = new conexaoBanco();
    	$conexao->conectar();

    	# Executa comando SQL
    	$stmt = $conexao->pdo->prepare('SELECT id_power, id_usuario, id_itens, situacao FROM usuario_itens ORDER BY id_power DESC');

    	// Executa Query
    	$stmt->execute();
    	$retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);

    	$lista = array();
    	$i = 0;

    	foreach( $retorno as $row ){
    		#Inst�ncia da entidade
    		$usuario_itensBE = new usuario_itensBE();

    		#Atribui valores
		    $usuario_itensBE->setId_power($row['id_power']);
		    $usuario_itensBE->setId_usuario($row['id_usuario']);
		    $usuario_itensBE->setId_itens($row['id_itens']);
		    $usuario_itensBE->setSituacao($row['situacao']);

    		$lista[$i] = $usuario_itensBE;
    		$i++;
    	}

    	return $lista;
    }
    /*
    * Delete
    * Recebe PK como parametro
	*/
    public function Deletar($pk){

		$retorno = 0;

		# Faz conex�o
		$conexao = new conexaoBanco();
		$conexao->conectar();

		# Executa SQL
		$stmt = $conexao->pdo->prepare('DELETE FROM usuario_itens WHERE id_power = ?');

		$dadosDelete = array($pk);

		try{
			$retorno = $stmt->execute($dadosDelete);
		}
		catch (PDOException $e) {
			echo 'Erro: '.$e->getMessage();
			$retorno = -1;
		}

		return $retorno;
	}

}
?>
