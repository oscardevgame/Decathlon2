<?php
#########################################
# CTASoftware                           #
# Autor: Everton Gonçalves              #
# http://www.ctasoftware.com.br         #
# E-mail: everton@ctasoftware.com.br    #
#########################################

class perfisBE{
    /*
    * Atributos
    */
    private $id_perfil;
    private $descricao;

    /*
    * Propriedades dos atributos
    */

    public function setId_perfil($id_perfil){
        $this->id_perfil = $id_perfil;
    }

    public function getId_perfil(){
        return $this->id_perfil;
    }

    public function setDescricao($descricao){
        $this->descricao = $descricao;
    }

    public function getDescricao(){
        return $this->descricao;
    }
}

?>
