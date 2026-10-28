<?php 

require_once __DIR__ . "/Usuario.php";

class Seguir { 

    private $idUsuarioSeguido;
    private $idUsuarioSeguidor;
    
    private $id;
    private $dataSeguimento;


    function __construct($idUsuarioSeguido, $idUsuarioSeguidor, $id, $dataSeguimento){
        $this->idUsuarioSeguido = $idUsuarioSeguido;
        $this->idUsuarioSeguidor = $idUsuarioSeguidor;
        $this->id = $id;
        $this->dataSeguimento = $dataSeguimento;
    }


    // Getter e Setter idUsuarioSeguido
    public function getIdUsuarioSeguido(){
        return $this->idUsuarioSeguido;
    }
    public function setIdUsuarioSeguido($idUsuarioSeguido){
        $this->idUsuarioSeguido = $idUsuarioSeguido;
    }


    // Getter e Setter idUsuarioSeguidor
    public function getIdUsuarioSeguidor(){
        return $this->idUsuarioSeguidor;
    }
    public function setIdUsuarioSeguidor($idUsuarioSeguidor){
        $this->idUsuarioSeguidor = $idUsuarioSeguidor;
    }


    // Getter e Setter id
    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }


    // Getter e Setter dataSeguimento
    public function getDataSeguimento(){
        return $this->dataSeguimento;
    }
    public function setDataSeguimento($dataSeguimento){
        $this->dataSeguimento = $dataSeguimento;
    }

}