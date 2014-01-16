<?php
#########################################
# CTASoftware                           #
# Autor: Everton Gonçalves              #
# http://www.ctasoftware.com.br         #
# E-mail: everton@ctasoftware.com.br    #
#########################################

class usuariosBE{
    /*
    * Atributos
    */
    private $id_usuario;
    private $email;
    private $nome;
    private $senha;
    private $facebook;
    private $path_file_foto;

    /*
    * Propriedades dos atributos
    */

    public function setId_usuario($id_usuario){
        $this->id_usuario = $id_usuario;
    }

    public function getId_usuario(){
        return $this->id_usuario;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setSenha($senha){
        $this->senha = $senha;
    }

    public function getSenha(){
        return $this->senha;
    }

    public function setFacebook($facebook){
        $this->facebook = $facebook;
    }

    public function getFacebook(){
        return $this->facebook;
    }

    public function setPath_file_foto($path_file_foto){
        $this->path_file_foto = $path_file_foto;
    }

    public function getPath_file_foto(){
        return $this->path_file_foto;
    }
}

?>
