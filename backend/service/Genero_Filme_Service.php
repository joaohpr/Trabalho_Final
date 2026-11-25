<?php

require_once __DIR__ . "/../model/Genero_Filme.php";
require_once __DIR__ . "/../model/Genero.php";
require_once __DIR__ . "/../model/Filme.php";
require_once __DIR__ . "/../repository/Genero_Filme_Repository.php";

class Genero_Filme_Service
{
    private Genero_Filme_Repository $genero_filme_repository;

    public function __construct()
    {
        require __DIR__ . "/../config/Conexao.php";

        $this->genero_filme_repository = new Genero_Filme_Repository($conexao);
    }

    // Cadastrar associação entre um gênero e um filme
    public function cadastrarGeneroFilme(Genero_Filme $generoFilme)
    {
        if (!$this->validarGeneroFilme($generoFilme)) {
            return false;
        }

        $associacaoExistente = $this->genero_filme_repository
            ->findGeneroFilme($generoFilme);

        if ($associacaoExistente !== null) {
            return false;
        }

        return $this->genero_filme_repository
            ->insertGeneroFilme($generoFilme);
    }

    // Buscar associação entre gênero e filme
    public function readGeneroFilme(Genero_Filme $generoFilme)
    {
        if (!$this->validarGeneroFilme($generoFilme)) {
            return false;
        }

        return $this->genero_filme_repository
            ->findGeneroFilme($generoFilme);
    }

    // Buscar os gêneros associados a um filme
    public function readGenerosPorFilme(Filme $filme)
    {
        $idFilme = $filme->getIdFilme();

        if (!is_numeric($idFilme) || $idFilme <= 0) {
            return false;
        }

        return $this->genero_filme_repository
            ->findGeneroByFilme((int) $idFilme);
    }

    // Buscar os filmes associados a um gênero
    public function readFilmesPorGenero(Genero $genero)
    {
        $idGenero = $genero->getIdGenero();

        if (!is_numeric($idGenero) || $idGenero <= 0) {
            return false;
        }

        return $this->genero_filme_repository
            ->findFilmeByGenero((int) $idGenero);
    }

    public function validarGeneroFilme(Genero_Filme $generoFilme)
    {
        $idGenero = $generoFilme->getIdGenero();
        $idFilme = $generoFilme->getIdFilme();

        return is_numeric($idGenero)
            && $idGenero > 0
            && is_numeric($idFilme)
            && $idFilme > 0;
    }
}
