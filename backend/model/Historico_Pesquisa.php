<?php

    require_once __DIR__ . "/Usuario.php";

    class HistoricoPesquisa {

        private $idHistoricoPesquisa;
        private $termo;
        private $dataPesquisa;
        private $usuario;


        public function __construct($idHistoricoPesquisa, $termo, $dataPesquisa, $usuario) {
            $this->idHistoricoPesquisa = $idHistoricoPesquisa;
            $this->termo = $termo;
            $this->dataPesquisa = $dataPesquisa;
            $this->usuario = $usuario;
        }


        // Getter e Setter idHistoricoPesquisa
        public function getIdHistoricoPesquisa() {
            return $this->idHistoricoPesquisa;
        }
        public function setIdHistoricoPesquisa($idHistoricoPesquisa) {
            $this->idHistoricoPesquisa = $idHistoricoPesquisa;
        }


        // Getter e Setter termo
        public function getTermo() {
            return $this->termo;
        }
        public function setTermo($termo) {
            $this->termo = $termo;
        }


        // Getter e Setter dataPesquisa
        public function getDataPesquisa() {
            return $this->dataPesquisa;
        }
        public function setDataPesquisa($dataPesquisa) {
            $this->dataPesquisa = $dataPesquisa;
        }


        // Getter e Setter usuario
        public function getUsuario() {
            return $this->usuario;
        }
        public function setUsuario($usuario) {
            $this->usuario = $usuario;
        }

    }