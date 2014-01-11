<?php
#########################################
# CTASoftware                           #
# Autor: Everton Gonçalves              #
# http://www.ctasoftware.com.br         #
# E-mail: everton@ctasoftware.com.br    #
#########################################

require_once 'conexaoBanco.php';
require_once 'usuario_itensBE.php';
require_once 'itensBE.php';
require_once 'powerBE.php';
require_once 'usuariosBE.php';

class usuario_itensDAO{

    /*
    * Altera
    * Recebe array como parametro
    */
    public function Update($dados){

        $retorno = 0;

        # Faz conexï¿½o
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
    * Mï¿½todo de Inclusï¿½o
    * Insere dados recebendo valores via parï¿½metro
    * ---------------------------------------------
    */
    public function incluir($dados){
        # Faz conexï¿½o
        $conexao = new conexaoBanco();
        $conexao->conectar();

        try{
            $stmt = $conexao->pdo->prepare('INSERT INTO usuario_itens (id_usuario, id_itens_power, situacao) VALUES (?,?,?)');
            $stmt->bindValue(1,$dados->getId_usuario());
            $stmt->bindValue(2,$dados->getId_itens_power());
            $stmt->bindValue(3,$dados->getSituacao());

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

    	# Faz conexï¿½o
	    $conexao = new conexaoBanco();
	    $conexao->conectar();

	    # Executa comando SQL
	    $stmt = $conexao->pdo->prepare('SELECT id_power, id_usuario, id_itens, situacao FROM usuario_itens WHERE id_power = ? ');

	    # Passando os valores a serem usados
    	$dados = array($pk);
    	$stmt->execute($dados);
    	$retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);

    	#Instï¿½ncia da entidade
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

    	# Faz conexï¿½o
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
    		#Instï¿½ncia da entidade
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

		# Faz conexï¿½o
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
        
   /*
    * Obtem itens disponiveis na loja
    */
    public function ObterItensDisponiveis($idUsuario){

    	# Faz conexao
    	$conexao = new conexaoBanco();
    	$conexao->conectar();
        
        $dados = array($idUsuario);
        
    	# Executa comando SQL
    	$stmt = $conexao->pdo->prepare("SELECT i.id_itens, " .
                                        "i.descricao, " .
                                        "i.valor, " .
                                        "i.categoria, " .
                                        "i.path_image_item, " .
                                        "p.id_power, " .
                                        "p.descricao, " .
                                        "ip.id_itens_power " .
                                        "FROM itens i, power p, itens_power ip " .
                                        "WHERE i.id_itens = ip.id_itens " .
                                        "AND p.id_power = ip.id_power " .
                                        "AND ip.id_itens not in (select ip.id_itens "
                                                                . "from usuario_itens ui, itens_power ip1 "
                                                               . "where ui.id_usuario = ? "
                                                                 . "and ui.id_itens_power = ip.id_itens_power) " .
                                        "ORDER BY i.categoria ");

    	// Executa Query
    	$stmt->execute($dados);
    	$retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);

    	$lista = array();
    	$i = 0;

    	foreach( $retorno as $row ){
    		#Instancia da entidade
                $item = new itensBE();
                $power = new powerBE();
                $item_power = new itens_powerBE();
                $usuario_itensBE = new usuario_itensBE();
                
                $item->setId_itens($row['id_itens']);
                $item->setDescricao($row['descricao']);
                $item->setValor($row['valor']);
                $item->setPath_image_item($row['path_image_item']);
                $item->setCategoria($row['categoria']);
                
                $power->setId_power($row['id_power']);
                $power->setDescricao($row['descricao']);
                
                $item_power->setId_itens_power($row['id_itens_power']);
                $item_power->setId_itens($item);
                $item_power->setId_power($power);
                
    		#Atribui valores
		//$usuario_itensBE->setId_usuario_itens();
		$usuario_itensBE->setId_usuario($idUsuario);
		$usuario_itensBE->setId_itens_power($item_power);
		//$usuario_itensBE->setSituacao($row['situacao']);

    		$lista[$i] = $usuario_itensBE;
    		$i++;
    	}

    	return $lista;
    }

   /*
    * Obtem itens disponiveis na loja
    */
    public function ObterItensPorUsuario($idUsuario){

    	# Faz conexao
    	$conexao = new conexaoBanco();
    	$conexao->conectar();
        
        $dados = array($idUsuario);
        
    	# Executa comando SQL
    	$stmt = $conexao->pdo->prepare("SELECT i.id_itens, " .
                                        "i.descricao, " .
                                        "i.valor, " .
                                        "i.categoria, " .
                                        "i.path_image_item, " .
                                        "p.id_power, " .
                                        "p.descricao, " .
                                        "ip.id_itens_power " .
                                        "FROM itens i, power p, itens_power ip " .
                                        "WHERE i.id_itens = ip.id_itens " .
                                        "AND p.id_power = ip.id_power " .
                                        "AND ip.id_itens in (select ip.id_itens "
                                                                . "from usuario_itens ui, itens_power ip1 "
                                                               . "where ui.id_usuario = ? "
                                                                 . "and ui.id_itens_power = ip.id_itens_power) " .
                                        "ORDER BY i.categoria ");

    	// Executa Query
    	$stmt->execute($dados);
    	$retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);

    	$lista = array();
    	$i = 0;

    	foreach( $retorno as $row ){
    		#Instancia da entidade
                $item = new itensBE();
                $power = new powerBE();
                $item_power = new itens_powerBE();
                $usuario_itensBE = new usuario_itensBE();
                
                $item->setId_itens($row['id_itens']);
                $item->setDescricao($row['descricao']);
                $item->setValor($row['valor']);
                $item->setPath_image_item($row['path_image_item']);
                $item->setCategoria($row['categoria']);
                
                $power->setId_power($row['id_power']);
                $power->setDescricao($row['descricao']);
                
                $item_power->setId_itens_power($row['id_itens_power']);
                $item_power->setId_itens($item);
                $item_power->setId_power($power);
                
    		#Atribui valores
		//$usuario_itensBE->setId_usuario_itens();
		$usuario_itensBE->setId_usuario($idUsuario);
		$usuario_itensBE->setId_itens_power($item_power);
		//$usuario_itensBE->setSituacao($row['situacao']);

    		$lista[$i] = $usuario_itensBE;
    		$i++;
    	}

    	return $lista;
    }

    
}
?>
