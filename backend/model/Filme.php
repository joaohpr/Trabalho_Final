<?php

require_once __DIR__ . "/Genero.php";

class Filme { 

    private $generos;

    private $nome;
    private $idTmdb;
    private $notaTmdb;
    private $description;
    private $dataLancamento;
    private $imagem;


    public function __construct(
        $nome,
        $idTmdb,
        $notaTmdb,
        $description,
        $dataLancamento,
        $imagem
    ) {
        $this->nome = $nome;
        $this->idTmdb = $idTmdb;
        $this->notaTmdb = $notaTmdb;
        $this->description = $description;
        $this->dataLancamento = $dataLancamento;
        $this->imagem = $imagem;
        $this->generos = [];
    }


    // Métodos nome
    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }


    // Métodos idTmdb
    public function getIdTmdb() {
        return $this->idTmdb;
    }

    public function setIdTmdb($idTmdb) {
        $this->idTmdb = $idTmdb;
    }


    // Métodos notaTmdb
    public function getNotaTmdb() {
        return $this->notaTmdb;
    }

    public function setNotaTmdb($notaTmdb) {
        $this->notaTmdb = $notaTmdb;
    }


    // Métodos description
    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }


    // Métodos dataLancamento
    public function getDataLancamento() {
        return $this->dataLancamento;
    }

    public function setDataLancamento($dataLancamento) {
        $this->dataLancamento = $dataLancamento;
    }


    // Métodos imagem
    public function getImagem() {
        return $this->imagem;
    }

    public function setImagem($imagem) {
        $this->imagem = $imagem;
    }


    // Métodos generos
    public function getGeneros() {
        return $this->generos;
    }

    public function setGeneros($generos) {
        $this->generos = $generos;
    }

    public function adicionarGenero($genero) {
        $this->generos[] = $genero;
    }

}