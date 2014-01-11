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
    private $id_usuario_itens;
    private $id_usuario;
    private $id_itens_power;
    private $situacao;

    /*
    * Propriedades dos atributos
    */

    public function setId_usuario_itens($id_usuario_itens){
        $this->id_usuario_itens = $id_usuario_itens;
    }

    public function getId_usuario_itens(){
        return $this->id_usuario_itens;
    }

    public function setId_usuario($id_usuario){
        $this->id_usuario = $id_usuario;
    }

    public function getId_usuario(){
        return $this->id_usuario;
    }

    public function setId_itens_power($id_itens_power){
        $this->id_itens_power = $id_itens_power;
    }

    public function getId_itens_power(){
        return $this->id_itens_power;
    }

    public function setSituacao($situacao){
        $this->situacao = $situacao;
    }

    public function getSituacao(){
        return $this->situacao;
    }
}

?>
