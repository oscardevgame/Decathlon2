<?php
#########################################
# CTASoftware                           #
# Autor: Everton Gonçalves              #
# http://www.ctasoftware.com.br         #
# E-mail: everton@ctasoftware.com.br    #
#########################################

class comprasBE{
    /*
    * Atributos
    */
    private $id_compras;
    private $id_usuario;
    private $id_itens;
    private $data;
    private $valor_pago;
    private $quantidade;

    /*
    * Propriedades dos atributos
    */

    public function setId_compras($id_compras){
        $this->id_compras = $id_compras;
    }

    public function getId_compras(){
        return $this->id_compras;
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

    public function setData($data){
        $this->data = $data;
    }

    public function getData(){
        return $this->data;
    }

    public function setValor_pago($valor_pago){
        $this->valor_pago = $valor_pago;
    }

    public function getValor_pago(){
        return $this->valor_pago;
    }

    public function setQuantidade($quantidade){
        $this->quantidade = $quantidade;
    }

    public function getQuantidade(){
        return $this->quantidade;
    }
}

?>
