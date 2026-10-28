<?php 

    require_once __DIR__ .  "/Usuario.php";
    require_once __DIR__ . "/Filme.php";

    class Comentario { 

        private $usuario;
        private $filme;

        private $idComentario;
        private $texto;
        private $dataComentario;



        function __construct($usuario,$filme,$idComentario,$texto,$dataComentario){
            
            $this->usuario = $usuario;
            $this->filme = $filme;
            $this->idComentario;
            $this->texto = $texto;
            $this->dataComentario;

        }


        //Getter e Setter user
        public function getUsuario(){
            return $this->usuario;
        }
        public function setUsuario($usuario){
            $this->usuario = $usuario;
        }


        //Getter e Setter Filme
        public function getFilme(){
            return $this->filme;
        }
        public function setFilme($filme){
            $this->filme = $filme;
        }


        //Getter e Setter idComentario
        public function getIdComentario(){
            return $this->idComentario;
        }
        public function setIdComentario($idComentario){
            $this->idComentario = $idComentario;
        }


        //Getter e Setter texto
        public function getTexto(){
            return $this->texto;
        }
        public function setTexto($texto){
            $this->texto = $texto;
        }
        

        //Getter e Setter data comentario
        public function getDataComentario(){
            return $this->dataComentario;
        }
        public function setDataComentario($dataComentario){
            $this->dataComentario = $dataComentario;
        }
    }