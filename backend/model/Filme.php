<?php

require_once __DIR__ . "/Genero.php";

class Filme
{
    private $idFilme;
    private $generos;
    private $nome;
    private $idTmdb;
    private $notaTmdb;
    private $description;
    private $dataLancamento;
    private $imagem;


    public function __construct($nome, $idTmdb, $notaTmdb, $description, $dataLancamento, $imagem)
    {
        $this->idFilme = null;
        $this->generos = array();
        $this->nome = $nome;
        $this->idTmdb = $idTmdb;
        $this->notaTmdb = $notaTmdb;
        $this->description = $description;
        $this->dataLancamento = $dataLancamento;
        $this->imagem = $imagem;
    }


    // ID local do filme no banco de dados
    public function getIdFilme()
    {
        return $this->idFilme;
    }

    public function setIdFilme($idFilme)
    {
        $this->idFilme = $idFilme;
    }


    // Gêneros associados ao filme
    public function getGeneros()
    {
        return $this->generos;
    }

    public function setGeneros($generos)
    {
        $this->generos = $generos;
    }

    public function addGenero(Genero $genero)
    {
        $this->generos[] = $genero;
    }


    // Nome do filme
    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }


    // ID do filme na API TMDb
    public function getIdTmdb()
    {
        return $this->idTmdb;
    }

    public function setIdTmdb($idTmdb)
    {
        $this->idTmdb = $idTmdb;
    }


    // Nota do filme na TMDb
    public function getNotaTmdb()
    {
        return $this->notaTmdb;
    }

    public function setNotaTmdb($notaTmdb)
    {
        $this->notaTmdb = $notaTmdb;
    }


    // Descrição do filme
    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }


    // Data de lançamento
    public function getDataLancamento()
    {
        return $this->dataLancamento;
    }

    public function setDataLancamento($dataLancamento)
    {
        $this->dataLancamento = $dataLancamento;
    }


    // Imagem do filme
    public function getImagem()
    {
        return $this->imagem;
    }

    public function setImagem($imagem)
    {
        $this->imagem = $imagem;
    }
}

?>