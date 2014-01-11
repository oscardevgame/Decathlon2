<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of itensController
 *
 * @author Oscar
 */
class itensController {
    
    function listItens() {
        $itensDAO = new itensDAO();
        return $itensDAO->ObterPorTodos();
    }
    
    function listPowers(){
        $powerDAO = new powerDAO();
        return $powerDAO->ObterPorTodos();
    }
    
    function listItensDisponiveis($idUsuario){
        $usuarioItens = new usuario_itensDAO();
        return $usuarioItens->ObterItensDisponiveis($idUsuario);
    }
    
    function listItensPorUsuario($idUsuario){
        $usuarioItens = new usuario_itensDAO();
        return $usuarioItens->ObterItensPorUsuario($idUsuario);
    }
}
