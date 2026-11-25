<?php

require_once __DIR__ . "/Usuario.php";
require_once __DIR__ . "/Filme.php";

class Avaliacao
{
    // Atributos
    private $id;
    private Usuario $usuario;
    private Filme $filme;
    private $nota;
    private $comentario;
    private $dataCriacao;


    // Construtor
    // Construtor
    public function __construct(Usuario $usuario, Filme $filme, $nota, $comentario, $dataCriacao, $id = null)
    {
        $this->id = $id;
        $this->usuario = $usuario;
        $this->filme = $filme;
        $this->nota = $nota;
        $this->comentario = $comentario;
        $this->dataCriacao = $dataCriacao;
    }


    // Getter e Setter id
    public function getId()
    {
        return $this->id;
    }

    // Getter e Setter nota
    public function getNota()
    {
        return $this->nota;
    }

    public function setNota($nota)
    {
        $this->nota = $nota;
    }


    // Getter e Setter comentario
    public function getComentario()
    {
        return $this->comentario;
    }

    public function setComentario($comentario)
    {
        $this->comentario = $comentario;
    }


    // Getter e Setter dataCriacao
    public function getDataCriacao()
    {
        return $this->dataCriacao;
    }

    public function setDataCriacao($dataCriacao)
    {
        $this->dataCriacao = $dataCriacao;
    }


    // Getter e Setter usuario
    public function getUsuario()
    {
        return $this->usuario;
    }

    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }


    // Getter e Setter filme
    public function getFilme()
    {
        return $this->filme;
    }

    public function setFilme($filme)
    {
        $this->filme = $filme;
    }
}
