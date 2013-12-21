<?php
#########################################
# CTASoftware                           #
# Autor: Everton Gonçalves              #
# http://www.ctasoftware.com.br         #
# E-mail: everton@ctasoftware.com.br    #
#########################################

class itensBE{
    /*
    * Atributos
    */
    private $id_itens;
    private $descricao;
    private $valor;

    /*
    * Propriedades dos atributos
    */

    public function setId_itens($id_itens){
        $this->id_itens = $id_itens;
    }

    public function getId_itens(){
        return $this->id_itens;
    }

    public function setDescricao($descricao){
        $this->descricao = $descricao;
    }

    public function getDescricao(){
        return $this->descricao;
    }

    public function setValor($valor){
        $this->valor = $valor;
    }

    public function getValor(){
        return $this->valor;
    }
}

?>
