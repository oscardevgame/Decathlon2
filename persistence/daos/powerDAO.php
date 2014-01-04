<?php
#########################################
# CTASoftware                           #
# Autor: Everton Gon�alves              #
# http://www.ctasoftware.com.br         #
# E-mail: everton@ctasoftware.com.br    #
#########################################

require_once 'entidades/powerBE.php';
require_once 'conexaoBanco.php';

class powerDAO{

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
        $stmt = $conexao->pdo->prepare('UPDATE power SET descricao = ?  WHERE id_power = ?');

        # Seta Atributos nulos


        # Parametros
        $stmt->bindValue(2,$dados->getId_power());
        $stmt->bindValue(1,$dados->getDescricao());


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
        # Faz conexao
        $conexao = new conexaoBanco();
        $conexao->conectar();

        try{
            $stmt = $conexao->pdo->prepare('INSERT INTO power (descricao) VALUES (?)');
	    $stmt->bindValue(1,$dados->getDescricao());
            
            if($stmt->execute()){
                $retorno = $conexao->pdo->lastInsertId(); 
            } else {
                $message = $stmt->errorInfo();
                $_SESSION["mensagens"] = array_merge($_SESSION["mensagens"], array("$message[2]"=>"e"));
                return -1;
            }
        }
        catch ( PDOException $ex ){  
            throw $ex;
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
	    $stmt = $conexao->pdo->prepare('SELECT id_power, descricao FROM power WHERE id_power = ? ');

	    # Passando os valores a serem usados
    	$dados = array($pk);
    	$stmt->execute($dados);
    	$retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);

    	#Inst�ncia da entidade
    	$powerBE = new powerBE();

    	foreach( $retorno as $row ){

    		#Atribui valores
		    $powerBE->setId_power($row['id_power']);
		    $powerBE->setDescricao($row['descricao']);
    	}

    	return $powerBE;
    }
    /*
    * Obtem todos
    */
    public function ObterPorTodos(){

    	# Faz conex�o
    	$conexao = new conexaoBanco();
    	$conexao->conectar();

    	# Executa comando SQL
    	$stmt = $conexao->pdo->prepare('SELECT id_power, descricao FROM power ORDER BY id_power DESC');

    	// Executa Query
    	$stmt->execute();
    	$retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);

    	$lista = array();
    	$i = 0;

    	foreach( $retorno as $row ){
    		#Inst�ncia da entidade
    		$powerBE = new powerBE();

    		#Atribui valores
		    $powerBE->setId_power($row['id_power']);
		    $powerBE->setDescricao($row['descricao']);

    		$lista[$i] = $powerBE;
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
		$stmt = $conexao->pdo->prepare('DELETE FROM power WHERE id_power = ?');

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
