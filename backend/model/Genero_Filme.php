
<?php
require_once __DIR__ . "/../model/Filme.php";
require_once __DIR__ . "/../model/Genero.php";
class Genero_Filme
{
    private $idGenero;
    private $idFilme;

    public function __construct($idGenero, $idFilme)
    {
        $this->idGenero = $idGenero;
        $this->idFilme = $idFilme;
    }

    public function getIdGenero()
    {
        return $this->idGenero;
    }

    public function setIdGenero($idGenero)
    {
        $this->idGenero = $idGenero;
    }

    public function getIdFilme()
    {
        return $this->idFilme;
    }

    public function setIdFilme($idFilme)
    {
        $this->idFilme = $idFilme;
    }
}
