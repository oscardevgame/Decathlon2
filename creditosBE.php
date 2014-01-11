<?php
#########################################
# CTASoftware                           #
# Autor: Everton Gonçalves              #
# http://www.ctasoftware.com.br         #
# E-mail: everton@ctasoftware.com.br    #
#########################################

class creditosBE{
    /*
    * Atributos
    */
    private $id_credito;
    private $id_usuario;
    private $valor;

    /*
    * Propriedades dos atributos
    */

    public function setId_credito($id_credito){
        $this->id_credito = $id_credito;
    }

    public function getId_credito(){
        return $this->id_credito;
    }

    public function setId_usuario($id_usuario){
        $this->id_usuario = $id_usuario;
    }

    public function getId_usuario(){
        return $this->id_usuario;
    }

    public function setValor($valor){
        $this->valor = $valor;
    }

    public function getValor(){
        return $this->valor;
    }
}

?>
