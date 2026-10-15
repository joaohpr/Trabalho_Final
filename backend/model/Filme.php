<?php 

    class Filme{ 
        
        private $nome;
        private $idTmdb;
        private $notaTmdb;
        private $description;
        private $dataLancamento;
        private $imagem;

        public function __construct($nome,$idTmdb,$notaTmdb,$description,$dataLancamento,$imagem){
           $this->nome = $nome;
           $this->idTmdb = $idTmdb;
           $this->notaTmdb = $notaTmdb;
           $this->description = $description;
           $this->dataLancamento = $dataLancamento;
           $this->imagem = $imagem;
        }

        //Metodos nome
        public function getNome() {
             return $this->nome;
        }
        public function setNome($nome){
            $this->nome = $nome;
        }

        //Metodos idTmdb
        public function getIdTmdb(){
            return $this->idTmdb;
        }
        public function setIdTmdb($idTmdb){
            $this->idTmdb = $idTmdb;
        }

        //Metodos notaTmdb
        public function getNotaTmdb(){
            return $this->notaTmdb;
        }
        public function setNotaTmdb($notaTmdb){
            $this-> notaTmdb = $notaTmdb;
        }

        //Metodos description
        public function getDescription(){
            return $this->description;
        }
        public function setDescription($description){
            $this->description = $description;
        }

        //Metodos dataLancamento
        public function getDataLancamento() {
             return $this->dataLancamento;
        }
        public function setataLancamento($dataLancamento){
            $this->nome = $dataLancamento;
        }

        ///Metodos imagem
        public function getImagem() {
             return $this->imagem;
        }
        public function setImagem($imagem){
            $this->imagem = $imagem;
        }

    }