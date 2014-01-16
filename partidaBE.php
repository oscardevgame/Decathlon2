<?php
#########################################
# CTASoftware                           #
# Autor: Everton Gonçalves              #
# http://www.ctasoftware.com.br         #
# E-mail: everton@ctasoftware.com.br    #
#########################################

class partidaBE{
    /*
    * Atributos
    */
    private $id_partida;
    private $id_usuario;
    private $data;
    private $path_file_tracker;
    private $pontuacao;
    
    /*
    * Propriedades dos atributos
    */

    public function setId_partida($id_partida){
        $this->id_partida = $id_partida;
    }

    public function getId_partida(){
        return $this->id_partida;
    }

    public function setId_usuario($id_usuario){
        $this->id_usuario = $id_usuario;
    }

    public function getId_usuario(){
        return $this->id_usuario;
    }

    public function setData($data){
        $this->data = $data;
    }

    public function getData(){
        return $this->data;
    }

    public function setPath_file_tracker($path_file_tracker){
        $this->path_file_tracker = $path_file_tracker;
    }

    public function getPath_file_tracker(){
        return $this->path_file_tracker;
    }
    
     public function setPontuacao($pontuacao){
        $this->pontuacao = $pontuacao;
    }

    public function getPontuacao(){
        return $this->pontuacao;
    }
}

?>
