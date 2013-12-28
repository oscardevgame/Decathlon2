<?php
#########################################
# CTASoftware                           #
# Autor: Everton Gon�alves              #
# http://www.ctasoftware.com.br         #
# E-mail: everton@ctasoftware.com.br    #
#########################################

require_once 'conexaoBanco.php';
require_once 'entidades/usuariosBE.php';

class usuariosDAO{
    
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
        $stmt = $conexao->pdo->prepare('UPDATE usuarios SET email = ?, nome = ?, senha = ?, facebook = ?, path_file_foto = ?  WHERE id_usuario = ?');

        # Seta Atributos nulos


        # Parametros
        $stmt->bindValue(6,$dados->getId_usuario());
        $stmt->bindValue(1,$dados->getEmail());
        $stmt->bindValue(2,$dados->getNome());
        $stmt->bindValue(3,$dados->getSenha());
        $stmt->bindValue(4,$dados->getFacebook());
        $stmt->bindValue(5,$dados->getPath_file_foto());


        try{
            $retorno = $stmt->execute();
        } catch (PDOException $e) {
            $_SESSION["mensagens"] = array_merge($_SESSION["mensagens"], array("Erro: $e->getMessage()"=>"e"));
            $retorno = -1;
            throw $e;
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
            $stmt = $conexao->pdo->prepare('INSERT INTO usuarios (email, nome, senha, facebook, path_file_foto) VALUES (?,?,?,?,?)');

            $stmt->bindValue(1,$dados->getEmail());
            $stmt->bindValue(2,$dados->getNome());
            $stmt->bindValue(3,$dados->getSenha());
            $stmt->bindValue(4,$dados->getFacebook());
            $stmt->bindValue(5,$dados->getPath_file_foto());
            
            if($stmt->execute()){
                $retorno = $conexao->pdo->lastInsertId(); 
            } else {
                $message = $stmt->errorInfo();
                $_SESSION["mensagens"] = array_merge($_SESSION["mensagens"], array("$message[2]"=>"e"));
                return -1;
            }
            
        } catch ( PDOException $ex ){ 
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
	    $stmt = $conexao->pdo->prepare('SELECT id_usuario, email, nome, senha, facebook, path_file_foto FROM usuarios WHERE id_usuario = ? ');

	    # Passando os valores a serem usados
    	$dados = array($pk);
    	$stmt->execute($dados);
    	$retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);

    	#Inst�ncia da entidade
    	$usuariosBE = new usuariosBE();

    	foreach( $retorno as $row ){

    		#Atribui valores
		    $usuariosBE->setId_usuario($row['id_usuario']);
		    $usuariosBE->setEmail($row['email']);
		    $usuariosBE->setNome($row['nome']);
		    $usuariosBE->setSenha($row['senha']);
		    $usuariosBE->setFacebook($row['facebook']);
		    $usuariosBE->setPath_file_foto($row['path_file_foto']);
    	}

    	return $usuariosBE;
    }
    /*
    * Obtem por Pk
    */
    public function ObterPorEmail($email){

    	# Faz conex�o
	    $conexao = new conexaoBanco();
	    $conexao->conectar();

	    # Executa comando SQL
	    $stmt = $conexao->pdo->prepare('SELECT id_usuario, email, nome, senha, facebook, path_file_foto FROM usuarios WHERE email = ? ');

	    # Passando os valores a serem usados
    	$dados = array($email);
    	$stmt->execute($dados);
    	$retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);

    	#Inst�ncia da entidade
    	$usuariosBE = new usuariosBE();

    	foreach( $retorno as $row ){
            #Atribui valores
            $usuariosBE->setId_usuario($row['id_usuario']);
            $usuariosBE->setEmail($row['email']);
            $usuariosBE->setNome($row['nome']);
            $usuariosBE->setSenha($row['senha']);
            $usuariosBE->setFacebook($row['facebook']);
            $usuariosBE->setPath_file_foto($row['path_file_foto']);
    	}

    	return $usuariosBE;
    }
    /*
    * Obtem todos
    */
    public function ObterPorTodos(){

    	# Faz conex�o
    	$conexao = new conexaoBanco();
    	$conexao->conectar();

    	# Executa comando SQL
    	$stmt = $conexao->pdo->prepare('SELECT id_usuario, email, nome, senha, facebook, path_file_foto FROM usuarios ORDER BY id_usuario DESC');

    	// Executa Query
    	$stmt->execute();
    	$retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);

    	$lista = array();
    	$i = 0;

    	foreach( $retorno as $row ){
    		#Inst�ncia da entidade
    		$usuariosBE = new usuariosBE();

    		#Atribui valores
                $usuariosBE->setId_usuario($row['id_usuario']);
                $usuariosBE->setEmail($row['email']);
                $usuariosBE->setNome($row['nome']);
                $usuariosBE->setSenha($row['senha']);
                $usuariosBE->setFacebook($row['facebook']);
                $usuariosBE->setPath_file_foto($row['path_file_foto']);

    		$lista[$i] = $usuariosBE;
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
		$stmt = $conexao->pdo->prepare('DELETE FROM usuarios WHERE id_usuario = ?');

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
