<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of partidaController
 *
 * @author Oscar
 */
class partidaController {
    
    function listPartidasPorUsuario($idUsuario){
        $partidasDAO = new partidaDAO();
        return $partidasDAO->ObterPorUsuario($idUsuario);
    }
}
