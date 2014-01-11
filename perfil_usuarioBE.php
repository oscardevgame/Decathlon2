<?php
#########################################
# CTASoftware                           #
# Autor: Everton Gonçalves              #
# http://www.ctasoftware.com.br         #
# E-mail: everton@ctasoftware.com.br    #
#########################################

class perfil_usuarioBE{
    /*
    * Atributos
    */
    private $id_usuario_perfil;
    private $id_perfil;
    private $id_usuario;

    /*
    * Propriedades dos atributos
    */

    public function setId_usuario_perfil($id_usuario_perfil){
        $this->id_usuario_perfil = $id_usuario_perfil;
    }

    public function getId_usuario_perfil(){
        return $this->id_usuario_perfil;
    }

    public function setId_perfil($id_perfil){
        $this->id_perfil = $id_perfil;
    }

    public function getId_perfil(){
        return $this->id_perfil;
    }

    public function setId_usuario($id_usuario){
        $this->id_usuario = $id_usuario;
    }

    public function getId_usuario(){
        return $this->id_usuario;
    }
}

?>
