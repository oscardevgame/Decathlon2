<?php
#########################################
# CTASoftware                           #
# Autor: Everton Gonçalves              #
# http://www.ctasoftware.com.br         #
# E-mail: everton@ctasoftware.com.br    #
#########################################

class fansBE{
    /*
    * Atributos
    */
    private $id_fans;
    private $id_usuario;
    private $id_fan;

    /*
    * Propriedades dos atributos
    */

    public function setId_fans($id_fans){
        $this->id_fans = $id_fans;
    }

    public function getId_fans(){
        return $this->id_fans;
    }

    public function setId_usuario($id_usuario){
        $this->id_usuario = $id_usuario;
    }

    public function getId_usuario(){
        return $this->id_usuario;
    }

    public function setId_fan($id_fan){
        $this->id_fan = $id_fan;
    }

    public function getId_fan(){
        return $this->id_fan;
    }
}

?>
