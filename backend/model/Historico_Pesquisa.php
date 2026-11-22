
<?php

require_once __DIR__ . "/Usuario.php";
require_once __DIR__ . "/Filme.php";


class Historico_Pesquisa
{

    private $idHistoricoPesquisa;
    private $termo;
    private $dataPesquisa;
    private Filme $filme;
    private Usuario $usuario;


    public function __construct($idHistoricoPesquisa, $termo, $dataPesquisa, Filme $filme, Usuario $usuario)
    {
        $this->idHistoricoPesquisa = $idHistoricoPesquisa;
        $this->termo = $termo;
        $this->dataPesquisa = $dataPesquisa;
        $this->filme = $filme;
        $this->usuario = $usuario;
    }


    // Getter e Setter idHistoricoPesquisa
    public function getIdHistoricoPesquisa()
    {
        return $this->idHistoricoPesquisa;
    }

    public function setIdHistoricoPesquisa($idHistoricoPesquisa)
    {
        $this->idHistoricoPesquisa = $idHistoricoPesquisa;
    }


    // Getter e Setter termo
    public function getTermo()
    {
        return $this->termo;
    }

    public function setTermo($termo)
    {
        $this->termo = $termo;
    }


    // Getter e Setter dataPesquisa
    public function getDataPesquisa()
    {
        return $this->dataPesquisa;
    }

    public function setDataPesquisa($dataPesquisa)
    {
        $this->dataPesquisa = $dataPesquisa;
    }


    // Getter e Setter Filme
    public function getFilme()
    {
        return $this->filme;
    }

    public function setFilme(Filme $filme)
    {
        $this->filme = $filme;
    }


    // Getter e Setter Usuario
    public function getUsuario()
    {
        return $this->usuario;
    }

    public function setUsuario(Usuario $usuario)
    {
        $this->usuario = $usuario;
    }

}
