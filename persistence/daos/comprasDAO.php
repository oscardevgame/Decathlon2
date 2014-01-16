<?php
#########################################
# CTASoftware                           #
# Autor: Everton Gon�alves              #
# http://www.ctasoftware.com.br         #
# E-mail: everton@ctasoftware.com.br    #
#########################################

require_once 'entidades/comprasBE.php';

class comprasDAO{

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
        $stmt = $conexao->pdo->prepare('UPDATE compras SET id_usuario = ?, id_itens = ?, data = ?, valor_pago = ?, quantidade = ?  WHERE id_compras = ?');

        # Seta Atributos nulos


        # Parametros
        $stmt->bindValue(6,$dados->getId_compras());
        $stmt->bindValue(1,$dados->getId_usuario());
        $stmt->bindValue(2,$dados->getId_itens());
        $stmt->bindValue(3,$dados->getData());
        $stmt->bindValue(4,$dados->getValor_pago());
        $stmt->bindValue(5,$dados->getQuantidade());


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
            $stmt = $conexao->pdo->prepare('INSERT INTO compras (id_usuario, id_itens, data, valor_pago, quantidade) VALUES (?,?,?,?,?)');



			$stmt->bindValue(1,$dados->getId_usuario());
			$stmt->bindValue(2,$dados->getId_itens());
			$stmt->bindValue(3,$dados->getData());
			$stmt->bindValue(4,$dados->getValor_pago());
			$stmt->bindValue(5,$dados->getQuantidade());

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
	    $stmt = $conexao->pdo->prepare('SELECT id_compras, id_usuario, id_itens, data, valor_pago, quantidade FROM compras WHERE id_compras = ? ');

	    # Passando os valores a serem usados
    	$dados = array($pk);
    	$stmt->execute($dados);
    	$retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);

    	#Inst�ncia da entidade
    	$comprasBE = new comprasBE();

    	foreach( $retorno as $row ){

    		#Atribui valores
		    $comprasBE->setId_compras($row['id_compras']);
		    $comprasBE->setId_usuario($row['id_usuario']);
		    $comprasBE->setId_itens($row['id_itens']);
		    $comprasBE->setData($row['data']);
		    $comprasBE->setValor_pago($row['valor_pago']);
		    $comprasBE->setQuantidade($row['quantidade']);
    	}

    	return $comprasBE;
    }
    /*
    * Obtem todos
    */
    public function ObterPorTodos(){

    	# Faz conex�o
    	$conexao = new conexaoBanco();
    	$conexao->conectar();

    	# Executa comando SQL
    	$stmt = $conexao->pdo->prepare('SELECT id_compras, id_usuario, id_itens, data, valor_pago, quantidade FROM compras ORDER BY id_compras DESC');

    	// Executa Query
    	$stmt->execute();
    	$retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);

    	$lista = array();
    	$i = 0;

    	foreach( $retorno as $row ){
    		#Inst�ncia da entidade
    		$comprasBE = new comprasBE();

    		#Atribui valores
		    $comprasBE->setId_compras($row['id_compras']);
		    $comprasBE->setId_usuario($row['id_usuario']);
		    $comprasBE->setId_itens($row['id_itens']);
		    $comprasBE->setData($row['data']);
		    $comprasBE->setValor_pago($row['valor_pago']);
		    $comprasBE->setQuantidade($row['quantidade']);

    		$lista[$i] = $comprasBE;
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
		$stmt = $conexao->pdo->prepare('DELETE FROM compras WHERE id_compras = ?');

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
