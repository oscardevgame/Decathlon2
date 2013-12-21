<?php
#########################################
# CTASoftware                           #
# Autor: Everton Gon�alves              #
# http://www.ctasoftware.com.br         #
# E-mail: everton@ctasoftware.com.br    #
#########################################

include_once 'entidades/usuariosBE.php';

class perfil_usuarioDAO{

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
        $stmt = $conexao->pdo->prepare('UPDATE perfil_usuario SET id_perfil = ?, id_usuario = ?  WHERE id_usuario_perfil = ?');

        # Seta Atributos nulos


        # Parametros
        $stmt->bindValue(3,$dados->getId_usuario_perfil());
        $stmt->bindValue(1,$dados->getId_perfil());
        $stmt->bindValue(2,$dados->getId_usuario());


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
            $stmt = $conexao->pdo->prepare('INSERT INTO perfil_usuario (id_perfil, id_usuario) VALUES (?,?)');



			$stmt->bindValue(1,$dados->getId_perfil());
			$stmt->bindValue(2,$dados->getId_usuario());

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
	    $stmt = $conexao->pdo->prepare('SELECT id_usuario_perfil, id_perfil, id_usuario FROM perfil_usuario WHERE id_usuario_perfil = ? ');

	    # Passando os valores a serem usados
    	$dados = array($pk);
    	$stmt->execute($dados);
    	$retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);

    	#Inst�ncia da entidade
    	$perfil_usuarioBE = new perfil_usuarioBE();

    	foreach( $retorno as $row ){

    		#Atribui valores
		    $perfil_usuarioBE->setId_usuario_perfil($row['id_usuario_perfil']);
		    $perfil_usuarioBE->setId_perfil($row['id_perfil']);
		    $perfil_usuarioBE->setId_usuario($row['id_usuario']);
    	}

    	return $perfil_usuarioBE;
    }
    /*
    * Obtem todos
    */
    public function ObterPorTodos(){

    	# Faz conex�o
    	$conexao = new conexaoBanco();
    	$conexao->conectar();

    	# Executa comando SQL
    	$stmt = $conexao->pdo->prepare('SELECT id_usuario_perfil, id_perfil, id_usuario FROM perfil_usuario ORDER BY id_usuario_perfil DESC');

    	// Executa Query
    	$stmt->execute();
    	$retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);

    	$lista = array();
    	$i = 0;

    	foreach( $retorno as $row ){
    		#Inst�ncia da entidade
    		$perfil_usuarioBE = new perfil_usuarioBE();

    		#Atribui valores
		    $perfil_usuarioBE->setId_usuario_perfil($row['id_usuario_perfil']);
		    $perfil_usuarioBE->setId_perfil($row['id_perfil']);
		    $perfil_usuarioBE->setId_usuario($row['id_usuario']);

    		$lista[$i] = $perfil_usuarioBE;
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
		$stmt = $conexao->pdo->prepare('DELETE FROM perfil_usuario WHERE id_usuario_perfil = ?');

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
