<?php
    require_once '../persistence/daos/perfil_usuarioDAO.php';
    require_once '../persistence/daos/entidades/perfil_usuarioBE.php';
    require_once '../persistence/daos/entidades/usuariosBE.php';
    require_once '../persistence/daos/entidades/perfisBE.php';
    
    if(session_status() != PHP_SESSION_ACTIVE){
        session_start();
    }

    $mensagens = Array();
    $email = isset($_POST["email"]) ? addslashes(trim($_POST["email"])) : FALSE;
    //$senha = isset($_POST["senha"]) ? md5(trim($_POST["senha"])) : FALSE;
    $senha = isset($_POST["senha"]) ? addslashes(trim($_POST["senha"])) : FALSE;
    
    if(!$email || !$senha) 
    { 
        $_SESSION["mensagens"] = array_merge($_SESSION["mensagens"], array("Usuário ou senha inválidos!"=>"a"));
        header("Location: ".filter_input(INPUT_SERVER, 'HTTP_REFERER'));
        return;
    } 

    $perfisUsuarioDAO = new perfil_usuarioDAO();
    $listResult = $perfisUsuarioDAO->ObterPorEmailESenha($email, $senha);
    
    $total = count($listResult);
    $senhaDB = "";
    if($total) 
    {
        $_SESSION["email"]= $listResult[0]->getId_usuario()->getEmail(); 
        $_SESSION["nome"] = stripslashes($listResult[0]->getId_usuario()->getNome());
        $userRoles = Array();
        $pos =0;
        foreach ($listResult as $userData) {
            $userRoles[$pos] = stripslashes($userData->getId_perfil()->getDescricao());
            $senhaDB = $userData->getId_usuario()->getSenha();
            $pos++;
        }
        $_SESSION["perfis"] = $userRoles;
        if(!strcmp($senha, $senhaDB)){   
            if(in_array("admin", $userRoles)){
                header("Location: ../view/admin/admin.php");
            } else if(in_array("jogador", $userRoles)){
                header("Location: ../view/jogador/jogador.php"); 
            }
            exit; 
        } else { 
            $_SESSION["mensagens"] = array_merge($_SESSION["mensagens"], array("Senha inválida!"=>"a"));
            header("Location: ".filter_input(INPUT_SERVER, 'HTTP_REFERER'));
            return;
        } 
    } else { 
        $_SESSION["mensagens"] = array_merge($_SESSION["mensagens"], array("O login fornecido é inexistente!"=>"a"));
        header("Location: ".filter_input(INPUT_SERVER, 'HTTP_REFERER'));
        return;
    }