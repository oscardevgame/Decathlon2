<?php
#########################################
# CTASoftware                           #
# Autor: Everton Gonçalves              #
# http://www.ctasoftware.com.br         #
# E-mail: everton@ctasoftware.com.br    #
#########################################

class itens_powerBE{
    /*
    * Atributos
    */
    private $id_itens_power;
    private $id_power;
    private $id_itens;

    /*
    * Propriedades dos atributos
    */

    public function setId_itens_power($id_itens_power){
        $this->id_itens_power = $id_itens_power;
    }

    public function getId_itens_power(){
        return $this->id_itens_power;
    }

    public function setId_power($id_power){
        $this->id_power = $id_power;
    }

    public function getId_power(){
        return $this->id_power;
    }

    public function setId_itens($id_itens){
        $this->id_itens = $id_itens;
    }

    public function getId_itens(){
        return $this->id_itens;
    }
}

?>
