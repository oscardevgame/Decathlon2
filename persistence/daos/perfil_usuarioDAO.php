<?php
#########################################
# CTASoftware                           #
# Autor: Everton Goncalves              #
# http://www.ctasoftware.com.br         #
# E-mail: everton@ctasoftware.com.br    #
#########################################

require_once 'conexaoBanco.php';
require_once 'entidades/usuariosBE.php';
require_once 'entidades/perfisBE.php';

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
        /*
        * Obtem por Email e Senha
        */
        public function ObterPorEmailESenha($email, $senha){

            try {
                # Faz conex�o
                $conexao = new conexaoBanco();
                $conexao->conectar();

                # Executa comando SQL
                $stmt = $conexao->pdo->prepare('SELECT up.id_usuario_perfil, u.id_usuario, u.email, u.nome, u.senha, u.facebook, u.path_file_foto, p.id_perfil, p.descricao FROM perfil_usuario up, perfis p, usuarios u WHERE up.id_perfil = p.id_perfil and up.id_usuario = u.id_usuario and u.email = ? and u.senha = ?');
                # Passando os valores a serem usados
                $dados = array($email, $senha);
                $stmt->execute($dados);
                
                $retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                if(! $retorno){
                    echo '<br/>';
                    print_r($stmt->errorInfo());
                    echo "<br/>";
                    $stmt->debugDumpParams();
                    echo '<br/>';
                }
                
                $lista = array();
                $i = 0;

                foreach( $retorno as $row ){
                    #Instancia da entidade
                    $perfil_usuarioBE = new perfil_usuarioBE();
                    $usuariosBE = new usuariosBE();
                    $perfisBE = new perfisBE();
                    
                    #Atribui valores
                    $perfil_usuarioBE->setId_usuario_perfil($row['id_usuario_perfil']);

                    $usuariosBE->setId_usuario($row['id_usuario']);
                    $usuariosBE->setEmail($row['email']);
                    $usuariosBE->setNome($row['nome']);
                    $usuariosBE->setSenha($row['senha']);
                    $usuariosBE->setFacebook($row['facebook']);
                    $usuariosBE->setPath_file_foto($row['path_file_foto']);
                    $perfil_usuarioBE->setId_usuario($usuariosBE);

                    $perfisBE->setId_perfil($row['id_perfil']);
                    $perfisBE->setDescricao($row['descricao']);
                    $perfil_usuarioBE->setId_perfil($perfisBE);

                    $lista[$i] = $perfil_usuarioBE;
                    $i++;
                }

            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            }
            return $lista;
        }
        
        /*
        * Obtem por Email, senha e perfil
        */
        public function ObterPorEmailSenhaEPerfil($email, $senha, $perfil){
            try{
                # Faz conex�o
                $conexao = new conexaoBanco();
                $conexao->conectar();

                # Executa comando SQL
                $stmt = $conexao->pdo->prepare('SELECT up.id_usuario_perfil, u.id_usuario, u.email, u.nome, u.senha, u.facebook, u.path_file_foto, p.id_perfil, p.descricao FROM perfil_usuario up, perfil p, usuarios u WHERE up.id_perfil = p.id_perfil and up.id_usuario = u.id_usuario and u.email = ? and u.senha = ? and p.descricao = ?');
                # Passando os valores a serem usados
                $dados = array($email, $senha);
                $stmt->execute($dados);
                $retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $lista = array();
                $i = 0;
                print_r($retorno);
                foreach( $retorno as $row ){
                    #Instancia da entidade
                    print_r($row);
                    $perfil_usuarioBE = new perfil_usuarioBE();
                    $usuariosBE = new usuariosBE();
                    $perfisBE = new perfisBE();

                    #Atribui valores
                    $perfil_usuarioBE->setId_usuario_perfil($row['up.id_usuario_perfil']);

                    $usuariosBE->setId_usuario($row['id_usuario']);
                    $usuariosBE->setEmail($row['email']);
                    $usuariosBE->setNome($row['nome']);
                    $usuariosBE->setSenha($row['senha']);
                    $usuariosBE->setFacebook($row['facebook']);
                    $usuariosBE->setPath_file_foto($row['path_file_foto']);
                    $perfil_usuarioBE->setId_perfil($usuariosBE);

                    $perfisBE->setId_perfil($row['id_perfil']);
                    $perfisBE->setDescricao($row['descricao']);
                    $perfil_usuarioBE->setId_usuario($perfisBE);

                    $lista[$i] = $perfil_usuarioBE;
                    $i++;
                }

                return $lista;
                
            } catch (Exception $ex) {
                print "Ocorreu um erro ao tentar executar esta ação, foi gerado um LOG do mesmo, tente novamente mais tarde."; 
                GeraLog::getInstance()->inserirLog("Erro: Código: " . $e-> getCode() . " Mensagem: " . $e->getMessage());
                return null;
            }
        }
}
?>
