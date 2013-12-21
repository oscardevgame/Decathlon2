<?php
#########################################
# CTASoftware                           #
# Autor: Everton Gon�alves              #
# http://www.ctasoftware.com.br         #
# E-mail: everton@ctasoftware.com.br    #
#########################################

include_once 'entidades/itens_powerBE.php';

class itens_powerDAO{

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
        $stmt = $conexao->pdo->prepare('UPDATE itens_power SET id_power = ?, id_itens = ?  WHERE id_itens_power = ?');

        # Seta Atributos nulos


        # Parametros
        $stmt->bindValue(3,$dados->getId_itens_power());
        $stmt->bindValue(1,$dados->getId_power());
        $stmt->bindValue(2,$dados->getId_itens());


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
            $stmt = $conexao->pdo->prepare('INSERT INTO itens_power (id_power, id_itens) VALUES (?,?)');



			$stmt->bindValue(1,$dados->getId_power());
			$stmt->bindValue(2,$dados->getId_itens());

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
	    $stmt = $conexao->pdo->prepare('SELECT id_itens_power, id_power, id_itens FROM itens_power WHERE id_itens_power = ? ');

	    # Passando os valores a serem usados
    	$dados = array($pk);
    	$stmt->execute($dados);
    	$retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);

    	#Inst�ncia da entidade
    	$itens_powerBE = new itens_powerBE();

    	foreach( $retorno as $row ){

    		#Atribui valores
		    $itens_powerBE->setId_itens_power($row['id_itens_power']);
		    $itens_powerBE->setId_power($row['id_power']);
		    $itens_powerBE->setId_itens($row['id_itens']);
    	}

    	return $itens_powerBE;
    }
    /*
    * Obtem todos
    */
    public function ObterPorTodos(){

    	# Faz conex�o
    	$conexao = new conexaoBanco();
    	$conexao->conectar();

    	# Executa comando SQL
    	$stmt = $conexao->pdo->prepare('SELECT id_itens_power, id_power, id_itens FROM itens_power ORDER BY id_itens_power DESC');

    	// Executa Query
    	$stmt->execute();
    	$retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);

    	$lista = array();
    	$i = 0;

    	foreach( $retorno as $row ){
    		#Inst�ncia da entidade
    		$itens_powerBE = new itens_powerBE();

    		#Atribui valores
		    $itens_powerBE->setId_itens_power($row['id_itens_power']);
		    $itens_powerBE->setId_power($row['id_power']);
		    $itens_powerBE->setId_itens($row['id_itens']);

    		$lista[$i] = $itens_powerBE;
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
		$stmt = $conexao->pdo->prepare('DELETE FROM itens_power WHERE id_itens_power = ?');

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
