<?php
#########################################
# CTASoftware                           #
# Autor: Everton Goncalves              #
# http://www.ctasoftware.com.br         #
# E-mail: everton@ctasoftware.com.br    #
#########################################

require_once 'entidades/perfisBE.php';

class perfisDAO{

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
        $stmt = $conexao->pdo->prepare('UPDATE perfis SET descricao = ?  WHERE id_perfil = ?');

        # Seta Atributos nulos


        # Parametros
        $stmt->bindValue(2,$dados->getId_perfil());
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
        # Faz conex�o
        $conexao = new conexaoBanco();
        $conexao->conectar();

        try{
            $stmt = $conexao->pdo->prepare('INSERT INTO perfis (descricao) VALUES (?)');



			$stmt->bindValue(1,$dados->getDescricao());

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
	    $stmt = $conexao->pdo->prepare('SELECT id_perfil, descricao FROM perfis WHERE id_perfil = ? ');

	    # Passando os valores a serem usados
    	$dados = array($pk);
    	$stmt->execute($dados);
    	$retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);

    	#Inst�ncia da entidade
    	$perfisBE = new perfisBE();

    	foreach( $retorno as $row ){

    		#Atribui valores
		    $perfisBE->setId_perfil($row['id_perfil']);
		    $perfisBE->setDescricao($row['descricao']);
    	}

    	return $perfisBE;
    }
    /*
    * Obtem todos
    */
    public function ObterPorTodos(){

    	# Faz conex�o
    	$conexao = new conexaoBanco();
    	$conexao->conectar();

    	# Executa comando SQL
    	$stmt = $conexao->pdo->prepare('SELECT id_perfil, descricao FROM perfis ORDER BY id_perfil DESC');

    	// Executa Query
    	$stmt->execute();
    	$retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);

    	$lista = array();
    	$i = 0;

    	foreach( $retorno as $row ){
    		#Inst�ncia da entidade
    		$perfisBE = new perfisBE();

    		#Atribui valores
		    $perfisBE->setId_perfil($row['id_perfil']);
		    $perfisBE->setDescricao($row['descricao']);

    		$lista[$i] = $perfisBE;
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
		$stmt = $conexao->pdo->prepare('DELETE FROM perfis WHERE id_perfil = ?');

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
