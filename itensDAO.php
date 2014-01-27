<?php
#########################################
# CTASoftware                           #
# Autor: Everton Goncalves              #
# http://www.ctasoftware.com.br         #
# E-mail: everton@ctasoftware.com.br    #
#########################################

require_once 'entidades/itensBE.php';
require_once 'conexaoBanco.php';


class itensDAO{

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
        $stmt = $conexao->pdo->prepare('UPDATE itens SET descricao = ?, valor = ?, path_image_item = ?  WHERE id_itens = ?');

        # Seta Atributos nulos


        # Parametros
        $stmt->bindValue(3,$dados->getId_itens());
        $stmt->bindValue(1,$dados->getDescricao());
        $stmt->bindValue(2,$dados->getValor());
        $stmt->bindValue(4,$dados-getPath_image_item());


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
            $stmt = $conexao->pdo->prepare('INSERT INTO itens (descricao, valor, path_image_item) VALUES (?,?,?)');



            $stmt->bindValue(1,$dados->getDescricao());
            $stmt->bindValue(2,$dados->getValor());
            $stmt->bindValue(3,$dados->getPath_image_item());

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
	    $stmt = $conexao->pdo->prepare('SELECT id_itens, descricao, valor, path_image_item FROM itens WHERE id_itens = ? ');

	    # Passando os valores a serem usados
    	$dados = array($pk);
    	$stmt->execute($dados);
    	$retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);

    	#Inst�ncia da entidade
    	$itensBE = new itensBE();

    	foreach( $retorno as $row ){

    		#Atribui valores
		    $itensBE->setId_itens($row['id_itens']);
		    $itensBE->setDescricao($row['descricao']);
		    $itensBE->setValor($row['valor']);
                    $itensBE->setPath_image_item($row['path_image_item']);
    	}

    	return $itensBE;
    }
    /*
    * Obtem todos
    */
    public function ObterPorTodos(){

    	# Faz conex�o
    	$conexao = new conexaoBanco();
    	$conexao->conectar();

    	# Executa comando SQL
    	$stmt = $conexao->pdo->prepare('SELECT id_itens, descricao, valor, path_image_item FROM itens ORDER BY id_itens DESC');

    	// Executa Query
    	$stmt->execute();
    	$retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);

    	$lista = array();
    	$i = 0;

    	foreach( $retorno as $row ){
    		#Inst�ncia da entidade
    		$itensBE = new itensBE();

    		#Atribui valores
		    $itensBE->setId_itens($row['id_itens']);
		    $itensBE->setDescricao($row['descricao']);
		    $itensBE->setValor($row['valor']);
                    $itensBE->setPath_image_item($row['path_image_item']);
                    
    		$lista[$i] = $itensBE;
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
		$stmt = $conexao->pdo->prepare('DELETE FROM itens WHERE id_itens = ?');

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
