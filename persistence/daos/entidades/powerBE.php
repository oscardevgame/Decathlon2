<?php
#########################################
# CTASoftware                           #
# Autor: Everton Gonçalves              #
# http://www.ctasoftware.com.br         #
# E-mail: everton@ctasoftware.com.br    #
#########################################

class powerBE{
    /*
    * Atributos
    */
    private $id_power;
    private $descricao;

    /*
    * Propriedades dos atributos
    */

    public function setId_power($id_power){
        $this->id_power = $id_power;
    }

    public function getId_power(){
        return $this->id_power;
    }

    public function setDescricao($descricao){
        $this->descricao = $descricao;
    }

    public function getDescricao(){
        return $this->descricao;
    }
}

?>
