<?php

class Curtida_Avaliacao
{
    // Atributos
    private $id;
    private $data_curtida;
    private $Avaliacao_id;
    private $Usuario_id;
    private $Filme_id;


    // Construtor
    public function __construct($id, $data_curtida, $Avaliacao_id, $Usuario_id, $Filme_id)
    {
        $this->id = $id;
        $this->data_curtida = $data_curtida;
        $this->Avaliacao_id = $Avaliacao_id;
        $this->Usuario_id = $Usuario_id;
        $this->Filme_id = $Filme_id;
    }


    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getDataCurtida()
    {
        return $this->data_curtida;
    }

    public function getAvaliacaoId()
    {
        return $this->Avaliacao_id;
    }

    public function getUsuarioId()
    {
        return $this->Usuario_id;
    }

    public function getFilmeId()
    {
        return $this->Filme_id;
    }


    // Setters
    public function setDataCurtida($data_curtida)
    {
        $this->data_curtida = $data_curtida;
    }

    public function setAvaliacaoId($Avaliacao_id)
    {
        $this->Avaliacao_id = $Avaliacao_id;
    }

    public function setUsuarioId($Usuario_id)
    {
        $this->Usuario_id = $Usuario_id;
    }

    public function setFilmeId($Filme_id)
    {
        $this->Filme_id = $Filme_id;
    }
}
