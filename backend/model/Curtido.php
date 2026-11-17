<?php 

require_once __DIR__ . "/Usuario.php";
require_once __DIR__ . "/Filme.php";

class Curtida { 

    private $usuario;
    private $filme;

    private $id;
    private $dataCurtida;


    function __construct($usuario, $filme, $id, $dataCurtida){
        $this->usuario = $usuario;
        $this->filme = $filme;
        $this->id = $id;
        $this->dataCurtida = $dataCurtida;
    }


    // Getter e Setter usuario
    public function getUsuario(){
        return $this->usuario;
    }

    public function setUsuario($usuario){
        $this->usuario = $usuario;
    }


    // Getter e Setter filme
    public function getFilme(){
        return $this->filme;
    }

    public function setFilme($filme){
        $this->filme = $filme;
    }


    // Getter e Setter id
    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }


    // Getter e Setter dataCurtida
    public function getDataCurtida(){
        return $this->dataCurtida;
    }

    public function setDataCurtida($dataCurtida){
        $this->dataCurtida = $dataCurtida;
    }

}