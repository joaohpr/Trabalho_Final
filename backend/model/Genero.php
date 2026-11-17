<?php

    class Genero {

        private $idGenero;
        private $nome;
        private $descricao;


        function __construct($idGenero,$nome,$descricao){
           $this->idGenero = $idGenero;
           $this->nome = $nome;
           $this->descricao = $descricao;
        }


        //Get e Set idGenero
        public function getIdGenero(){
            return $this->idGenero;
        }
        public function setIdGenero($idGenero){
            $this->idGenero = $idGenero; 
        }


        //Get e Set
        public function getNome(){
            return $this->nome;
        }
        public function setNome($nome){
            $this->nome = $nome;
        }


        //Get e Set
        public function getDescricao(){
            return $this->descricao;
        }
        public function setDescricao($descricao){
            $this->descricao = $descricao;
        }
        
    }