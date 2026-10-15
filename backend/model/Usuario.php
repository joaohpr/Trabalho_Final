<?php

    class Usuario {
         
        private $idUsuario;
        private $nome;
        private $email;
        private $senha;


        public function __construct($idUsuario,$nome,$email,$senha){

            $this->idUsuario = $idUsuario;
            $this->nome = $nome;
            $this->email = $email;
            $this->senha = $senha;
        }


        //Metodos idUser
        public function getIdUsuario(){
            return $this->idUsuario;
        }
        public function setIdUsuario($idUsuario){
            $this->idUsuario = $idUsuario;
        }

        //Metodos nome
        public function getNome(){
            return $this->nome;
        }
        public function setNome($nome){
            $this->nome = $nome;
        }

        //Metodos email 
        public function getEmail(){
            return $this->email;
        }
        public function setEmail($email){
            $this->email = $email;
        }

        //Metodos senha
        public function getSenha(){
            return $this->senha;
        }
        public function setSenha($senha){
            $this->senha = $senha;
        }
        
    }