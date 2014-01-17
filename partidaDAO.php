<?php
#########################################
# CTASoftware                           #
# Autor: Everton Gon�alves              #
# http://www.ctasoftware.com.br         #
# E-mail: everton@ctasoftware.com.br    #
#########################################

require_once 'conexaoBanco.php';
require_once 'partidaBE.php';

class partidaDAO{

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
        $stmt = $conexao->pdo->prepare('UPDATE partida SET id_usuario = ?, data = ?, path_file_tracker = ?  WHERE id_partida = ?');

        # Seta Atributos nulos


        # Parametros
        $stmt->bindValue(4,$dados->getId_partida());
        $stmt->bindValue(1,$dados->getId_usuario());
        $stmt->bindValue(2,$dados->getData());
        $stmt->bindValue(3,$dados->getPath_file_tracker());


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
            $stmt = $conexao->pdo->prepare('INSERT INTO partida (id_usuario, data, path_file_tracker, pontuacao) VALUES (?,?,?,?)');
            $stmt->bindValue(1,$dados->getId_usuario());
            $stmt->bindValue(2,$dados->getData());
            $stmt->bindValue(3,$dados->getPath_file_tracker());
            $stmt->bindValue(4,$dados->getPontuacao());
            
            if($stmt->execute()){
                $retorno = $conexao->pdo->lastInsertId(); 
            } else {
                $message = $stmt->errorInfo();
                $_SESSION["mensagens"] = array_merge($_SESSION["mensagens"], array("$message[2]"=>"e"));
                return -1;
            }
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
	    $stmt = $conexao->pdo->prepare('SELECT id_partida, id_usuario, data, path_file_tracker, pontuacao FROM partida WHERE id_partida = ? ');

	    # Passando os valores a serem usados
    	$dados = array($pk);
    	$stmt->execute($dados);
    	$retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);

    	#Inst�ncia da entidade
    	$partidaBE = new partidaBE();

    	foreach( $retorno as $row ){

    		#Atribui valores
		    $partidaBE->setId_partida($row['id_partida']);
		    $partidaBE->setId_usuario($row['id_usuario']);
		    $partidaBE->setData($row['data']);
		    $partidaBE->setPath_file_tracker($row['path_file_tracker']);
    	}

    	return $partidaBE;
    }
    /*
    * Obtem todos
    */
    public function ObterPorTodos(){

    	# Faz conex�o
    	$conexao = new conexaoBanco();
    	$conexao->conectar();

    	# Executa comando SQL
    	$stmt = $conexao->pdo->prepare('SELECT id_partida, id_usuario, data, path_file_tracker FROM partida ORDER BY id_partida DESC');

    	// Executa Query
    	$stmt->execute();
    	$retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);

    	$lista = array();
    	$i = 0;

    	foreach( $retorno as $row ){
    		#Inst�ncia da entidade
    		$partidaBE = new partidaBE();

    		#Atribui valores
		    $partidaBE->setId_partida($row['id_partida']);
		    $partidaBE->setId_usuario($row['id_usuario']);
		    $partidaBE->setData($row['data']);
		    $partidaBE->setPath_file_tracker($row['path_file_tracker']);

    		$lista[$i] = $partidaBE;
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
		$stmt = $conexao->pdo->prepare('DELETE FROM partida WHERE id_partida = ?');

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
/*
    * Obtem todos
    */
    public function ObterPorUsuario($idUsuario){

    	# Faz conexao
    	$conexao = new conexaoBanco();
    	$conexao->conectar();

    	# Executa comando SQL
    	$stmt = $conexao->pdo->prepare('SELECT id_partida, id_usuario, data, path_file_tracker, pontuacao FROM partida WHERE id_usuario = ? ORDER BY id_partida DESC');

        $dados = array($idUsuario);
    	
    	// Executa Query
    	$stmt->execute($dados);
    	$retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);

    	$lista = array();
    	$i = 0;

    	foreach( $retorno as $row ){
    		#Inst�ncia da entidade
    		$partidaBE = new partidaBE();

    		#Atribui valores
                $partidaBE->setId_partida($row['id_partida']);
                $partidaBE->setId_usuario($row['id_usuario']);
                $partidaBE->setData($row['data']);
                $partidaBE->setPontuacao($row['pontuacao']);
                $partidaBE->setPath_file_tracker($row['path_file_tracker']);

    		$lista[$i] = $partidaBE;
    		$i++;
    	}

    	return $lista;
    }
}
?>
