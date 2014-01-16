<?php
#########################################
# CTASoftware                           #
# Autor: Everton Gonçalves              #
# http://www.ctasoftware.com.br         #
# E-mail: everton@ctasoftware.com.br    #
#########################################

class usuario_itensBE{
    /*
    * Atributos
    */
    private $id_power;
    private $id_usuario;
    private $id_itens;
    private $situacao;

    /*
    * Propriedades dos atributos
    */

    public function setId_power($id_power){
        $this->id_power = $id_power;
    }

    public function getId_power(){
        return $this->id_power;
    }

    public function setId_usuario($id_usuario){
        $this->id_usuario = $id_usuario;
    }

    public function getId_usuario(){
        return $this->id_usuario;
    }

    public function setId_itens($id_itens){
        $this->id_itens = $id_itens;
    }

    public function getId_itens(){
        return $this->id_itens;
    }

    public function setSituacao($situacao){
        $this->situacao = $situacao;
    }

    public function getSituacao(){
        return $this->situacao;
    }
}

?>
